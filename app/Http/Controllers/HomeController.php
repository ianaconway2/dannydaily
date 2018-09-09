<?php

namespace App\Http\Controllers;

use App\Card;
use App\CardScanLog;
use App\JailSettings;
use Illuminate\Http\Request;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $end = strtotime("November 20, 2018 12:00 AM");
        $remaining = $end - time();

        $days_remaining = floor($remaining / 86400);

        $unlocked_cards = Card::where(['unlocked' => 1])->orderBy('unlocked_at', 'desc')->get();

        $jail_settings = JailSettings::findOrFail(1);

        return view('home', [
            'remaining' => $days_remaining,
            'unlocked'  => $unlocked_cards,
            'jail'      => $jail_settings
        ]);
    }

    public function uploadCard(Request $request)
    {
        $client = new RekognitionClient([
            'credentials' => [
                'key'    => $_ENV['AWS_ACCESS'],
                'secret' => $_ENV['AWS_SECRET']
            ],
            'region'    => 'us-west-2',
            'version'   => 'latest'
        ]);

        // Store local image as a byte
        $fp_image = fopen(str_replace(' ' ,'', $_FILES["file"]["tmp_name"]), 'r');
        $image = fread($fp_image, filesize($_FILES["file"]["tmp_name"]));
        fclose($fp_image);

        // Send image to AWS for inspection
        $result = $client->detectText(['Image' => ['Bytes' => $image]]);

        // Store results returned by AWS
        // If this array is empty, photo passed
        $text_results = $result['TextDetections'];

        // Log scan
        CardScanLog::log($text_results);

        // Declare keywords
        $keywords = [];

        // Find matching cards
        foreach($text_results as $item)
        {
            $exploded = explode(' ', $item['DetectedText']);
            foreach($exploded as $exploded_item)
            {
                array_push($keywords, strtolower(preg_replace('/[^\p{L}\p{N}\s]/u', '', $exploded_item)));
            }
        }

        foreach($keywords as $item)
        {
            $matching_card = Card::where('keyword', $item)->where(['unlocked' => 0, 'redeemed' => 0, 'completed' => 0])->limit(1)->get();

            if(count($matching_card) > 0)
            {
                Mail::send('email', ['body' => 'Danny just unlocked a card. Card: ' . $matching_card[0]->series . ' ' . $matching_card[0]->title . '<img src="data:image/png;base64 ' . base64_encode(file_get_contents($request->file('file'))) . '">'], function ($message) {
                    $message->to('ianconway@protonmail.com');
                    $message->subject('DD: Card Unlocked');
                });


                $matching_card[0]->unlock($request);
                request()->session()->flash('status', 'Fuck Yeah! You just unlocked a ' . $matching_card[0]->series . ' card!');
                return redirect()->route('cards.show', $matching_card[0]->id);
                break;
            }
        }

        request()->session()->flash('error', 'Could not identify that card, please check your background and lighting and try again.');
        return redirect()->back();
    }
}
