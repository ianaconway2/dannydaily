<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CardsController extends Controller
{
    public function show($id)
    {
        $card = Card::findOrFail($id);

        $total = Card::where(['series' => $card->series, 'title' => $card->title])->get();
        $total_locked = Card::where(['series' => $card->series, 'title' => $card->title, 'unlocked' => 0])->get();
        $total_unlocked = Card::where(['series' => $card->series, 'title' => $card->title, 'unlocked' => 1])->get();

        return view('cards.show', [
            'card'      => $card,
            'totals'    => (object) [
                'all'       => $total,
                'locked'    => $total_locked,
                'unlocked'  => $total_unlocked
            ]
        ]);
    }

    public function submitCompleted(Request $request, $id)
    {
        $card = Card::findOrFail($id);

        $update_data = [
            'complete_redeem_results' => $request->input('comments')
        ];

        if($card->redeemable)
        {
            $update_data['redeemed'] = 1;
            $update_data['redeemed_at'] = date('Y-m-d H:i:s', time());
            $message = 'Fuck Yeah! You just redeemed a card!';
        }
        else if($card->completable)
        {
            $update_data['completed'] = 1;
            $update_data['completed_at'] = date('Y-m-d H:i:s', time());
            $message = 'Fuck Yeah! You just completed a card!';
        }
        else
        {
            $message = 'Fuck Yeah! You just finished a card!';
        }

        $card->update($update_data);

        request()->session()->flash('status', $message);

        Mail::send('email', ['body' => 'Danny just redeemed/completed a card. Card: ' . $card->series . ' ' . $card->title . ' Comments: ' . $request->input('comments')], function ($message) {
            $message->to('ianconway@protonmail.com');
            $message->subject('Card Completed');
        });

        return redirect()->route('cards.show', $card->id);
    }

    public function uploadCompleted(Request $request, $id)
    {
        $card = Card::findOrFail($id);

        $update_data = [
            'finished_image' => base64_encode(file_get_contents($request->file('file')))
        ];

        if($card->redeemable)
        {
            $update_data['redeemed'] = 1;
            $update_data['redeemed_at'] = date('Y-m-d H:i:s', time());
            $message = 'Fuck Yeah! You just redeemed a card!';
        }
        else if($card->completable)
        {
            $update_data['completed'] = 1;
            $update_data['completed_at'] = date('Y-m-d H:i:s', time());
            $message = 'Fuck Yeah! You just completed a card!';
        }
        else
        {
            $message = 'Fuck Yeah! You just finished a card!';
        }

        $card->update($update_data);

        request()->session()->flash('status', $message);

        Mail::send('email', ['body' => 'Danny just redeemed/completed a card. Card: ' . $card->series . ' ' . $card->title . ' Comments: ' . $request->input('comments') . ' <img src="data:image/png;base64 ' . base64_encode(file_get_contents($request->file('file'))) . '">'], function ($message) {
            $message->to('ianconway@protonmail.com');
            $message->subject('Card Completed');
        });

        return redirect()->route('cards.show', $card->id);
    }
}
