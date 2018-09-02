<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Card extends Model
{
    public $fillable = [
        'unlocked',
        'unlocked_at',
        'redeemed_at',
        'completed_at',
        'redeemable',
        'redeemed',
        'completable',
        'completed',
        'should_upload_finished',
        'title',
        'series',
        'image_path',
        'description',
        'keyword',
        'uploaded_image',
        'show_uploaded_as_thumb',
        'finished_image',
        'complete_redeem_label',
        'complete_redeem_results'
    ];

    public static function seed()
    {
        $cards = [
            [
                'series'        => 'Truth or Dare',
                'title'         => 'Truth Card',
                'keyword'       => 'answered',
                'copy'          => 6,
                'image'         => '/cards/todt.png',
                'description'   => 'This card entitles you to one question answered truthfully',
                'show_upload'   => 0,
                'redeemable'    => 0,
                'completable'   => 1,
                'upload_finished' => 0,
                'complete_redeem_label' => 'Enter your question below',
                'complete_redeem_results' => ''
            ],
            [
                'series'        => 'Truth or Dare',
                'title'         => 'Dare Card',
                'keyword'       => 'performed',
                'copy'          => 6,
                'image'         => '/cards/todd.png',
                'description'   => 'This card entitles you to one dare performed by the other (rules apply)',
                'show_upload'   => 0,
                'redeemable'    => 0,
                'completable'   => 1,
                'upload_finished' => 0,
                'complete_redeem_label' => 'Enter your dare below',
                'complete_redeem_results' => ''
            ],
            [
                'series'        => 'Kill The DJ',
                'title'         => 'One Album, Any Artist',
                'keyword'       => 'artist',
                'copy'          => 6,
                'image'         => '/cards/ktd.png',
                'description'   => 'This card entitles you to select one album of any artist for everyone to listen to',
                'show_upload'   => 0,
                'redeemable'    => 1,
                'completable'   => 0,
                'upload_finished' => 0,
                'complete_redeem_label' => 'Enter the album and artist below',
                'complete_redeem_results' => ''
            ],
            [
                'series'        => 'TV Time',
                'title'         => 'One Season, Any Show',
                'keyword'       => 'season',
                'copy'          => 6,
                'image'         => '/cards/tt.png',
                'description'   => 'This card entitles you to select one season of any television show for everyone to watch',
                'show_upload'   => 0,
                'redeemable'    => 1,
                'completable'   => 0,
                'upload_finished' => 0,
                'complete_redeem_label' => 'Enter the season and television show below',
                'complete_redeem_results' => ''
            ],
            [
                'series'        => 'Challenge Card',
                'title'         => 'Puzzle',
                'keyword'       => 'pieces',
                'copy'          => 1,
                'image'         => '/cards/ccp.png',
                'description'   => 'To win this challenge, you must put together the included puzzle pieces and send your finished picture directly to Ian. Good luck!',
                'show_upload'   => 0,
                'redeemable'    => 0,
                'completable'   => 1,
                'upload_finished' => 1,
                'complete_redeem_label' => '',
                'complete_redeem_results' => ''
            ],
            [
                'series'        => 'Challenge Card',
                'title'         => 'Danny Digest',
                'keyword'       => 'digest',
                'copy'          => 1,
                'image'         => '/cards/ccdd.png',
                'description'   => 'To win this challenge, you must complete the attached crossword puzzle and send your answers directly to Ian. Good luck!',
                'attachments'   => [
                    '/cards/ccdd/1.png'
                ],
                'show_upload'   => 0,
                'redeemable'    => 0,
                'completable'   => 1,
                'upload_finished' => 1,
                'complete_redeem_label' => '',
                'complete_redeem_results' => ''
            ],
            [
                'series'        => 'Challenge Card',
                'title'         => 'Spot The Differences',
                'keyword'       => 'spot',
                'copy'          => 1,
                'image'         => '/cards/ccstd.png',
                'description'   => '(Kayaking) To win this challenge, you must find all differences between the two attached pictures and send your answers directly to Ian. Good luck!',
                'attachments'   => [
                    '/cards/ccstd/std-1a.jpg',
                    '/cards/ccstd/std-1b.jpg',
                ],
                'show_upload'   => 0,
                'redeemable'    => 0,
                'completable'   => 1,
                'upload_finished' => 1,
                'complete_redeem_label' => '',
                'complete_redeem_results' => ''
            ],
            [
                'series'        => 'Challenge Card',
                'title'         => 'Spot The Differences',
                'keyword'       => 'spot',
                'copy'          => 1,
                'image'         => '/cards/ccstd.png',
                'description'   => '(Camp Crabtree) To win this challenge, you must find all differences between the two attached pictures and send your answers directly to Ian. Good luck!',
                'attachments'   => [
                    '/cards/ccstd/std-3a.jpg',
                    '/cards/ccstd/std-3b.jpg',
                ],
                'show_upload'   => 0,
                'redeemable'    => 0,
                'completable'   => 1,
                'upload_finished' => 1,
                'complete_redeem_label' => '',
                'complete_redeem_results' => ''
            ],
            [
                'series'        => 'Challenge Card',
                'title'         => 'Spot The Differences',
                'keyword'       => 'spot',
                'copy'          => 1,
                'image'         => '/cards/ccstd.png',
                'description'   => '(Pride) To win this challenge, you must find all differences between the two attached pictures and send your answers directly to Ian. Good luck!',
                'attachments'   => [
                    '/cards/ccstd/std-2a.jpg',
                    '/cards/ccstd/std-2b.jpg',
                ],
                'show_upload'   => 0,
                'redeemable'    => 0,
                'completable'   => 1,
                'upload_finished' => 1,
                'complete_redeem_label' => '',
                'complete_redeem_results' => ''
            ],
            [
                'series'        => 'Jail',
                'title'         => 'Go To Jail',
                'keyword'       => '200',
                'copy'          => 1,
                'image'         => '/cards/gtj.png',
                'description'   => 'Do not pass go, do not collect $200, and do not draw any cards for four days',
                'show_upload'   => 0,
                'redeemable'    => 0,
                'completable'   => 0,
                'upload_finished' => 0,
                'complete_redeem_label' => '',
                'complete_redeem_results' => ''
            ],
            [
                'series'        => 'Jail',
                'title'         => 'Get Out Of Jail',
                'keyword'       => 'trade',
                'copy'          => 1,
                'image'         => '/cards/gooj.png',
                'description'   => 'This card gets you out of jail. Save this card until needed or trade it in for one free card',
                'show_upload'   => 0,
                'redeemable'    => 1,
                'completable'   => 0,
                'upload_finished' => 0,
                'complete_redeem_label' => 'If you are not in jail, this card will be redeemed for one additional card',
                'complete_redeem_results' => ''
            ],
            [
                'series'        => 'Special',
                'title'         => 'Draw Four',
                'keyword'       => 'additional',
                'copy'          => 1,
                'image'         => '/cards/d4.png',
                'description'   => 'This card entitles you to draw four additional cards right now',
                'show_upload'   => 0,
                'redeemable'    => 0,
                'completable'   => 0,
                'upload_finished' => 0,
                'complete_redeem_label' => '',
                'complete_redeem_results' => ''
            ],
            [
                'series'        => 'Special',
                'title'         => 'Draw One',
                'keyword'       => 'extra',
                'copy'          => 1,
                'image'         => '/cards/d1.png',
                'description'   => 'This card entitles you to draw one additional card right now, or you can save this card for later',
                'show_upload'   => 0,
                'redeemable'    => 1,
                'completable'   => 0,
                'upload_finished' => 0,
                'complete_redeem_label' => 'This card will be redeemed for one additional card',
                'complete_redeem_results' => ''
            ],
            [
                'series'        => 'Trivia Time',
                'title'         => 'You Ask',
                'keyword'       => 'yourself',
                'copy'          => 4,
                'image'         => '/cards/tty.png',
                'description'   => 'For this card, you have to create the trivia question about yourself, and Ian has to answer it. Good luck!',
                'show_upload'   => 0,
                'redeemable'    => 0,
                'completable'   => 1,
                'upload_finished' => 0,
                'complete_redeem_label' => 'Enter your trivia question below',
                'complete_redeem_results' => ''
            ],
            [
                'series'        => 'Trivia Time',
                'title'         => 'You Answer',
                'keyword'       => 'alabama',
                'copy'          => 1,
                'image'         => '/cards/tts.png',
                'description'   => 'For this card, circle the states the I have traveled to and send the results to Ian. Good luck!',
                'show_upload'   => 0,
                'redeemable'    => 0,
                'completable'   => 1,
                'upload_finished' => 1,
                'complete_redeem_label' => '',
                'complete_redeem_results' => ''
            ],
            [
                'series'        => 'Trivia Time',
                'title'         => 'You Answer',
                'keyword'       => 'wcsi',
                'copy'          => 1,
                'image'         => '/cards/ttw.png',
                'description'   => 'For this card, circle the states the I have traveled to and send the results to Ian. Good luck!',
                'show_upload'   => 0,
                'redeemable'    => 0,
                'completable'   => 1,
                'upload_finished' => 1,
                'complete_redeem_label' => '',
                'complete_redeem_results' => ''
            ],
            [
                'series'        => 'Things I Love About You',
                'title'         => 'Random',
                'keyword'       => 'things',
                'copy'          => 50,
                'image'         => '/cards/tilab.png',
                'description'   => 'Things I Love About You',
                'show_upload'   => 1,
                'redeemable'    => 0,
                'completable'   => 0,
                'upload_finished' => 0,
                'complete_redeem_label' => '',
                'complete_redeem_results' => ''
            ],
        ];

        foreach($cards as $card)
        {
            for($x = 0; $x < $card['copy']; $x++)
            {
                $new_card = new Card();
                $new_card->title = $card['title'];
                $new_card->keyword = $card['keyword'];
                $new_card->image_path = $card['image'];
                $new_card->series = $card['series'];
                $new_card->description = $card['description'];
                $new_card->show_uploaded_as_thumb = $card['show_upload'];
                $new_card->redeemable = $card['redeemable'];
                $new_card->completable = $card['completable'];
                $new_card->should_upload_finished = $card['upload_finished'];
                $new_card->complete_redeem_label = $card['complete_redeem_label'];
                $new_card->complete_redeem_results = $card['complete_redeem_results'];
                $new_card->save();

                if(isset($card['attachments']))
                {
                    for($y = 0; $y < count($card['attachments']); $y++)
                    {
                        $new_card->attachments()->create(['file_path' => $card['attachments'][$y]]);
                    }
                }
            }
        }

        $jail_settings = new JailSettings();
        $jail_settings->save();
    }

    public function unlock(Request $request)
    {
        if($this->title === 'Go To Jail')
        {
            $jail_settings = JailSettings::findOrFail(1);
            $jail_settings->update(['in_jail_at' => date('Y-m-d H:i:s', time()), 'out_of_jail_at' => date('Y-m-d H:i:s', strtotime('+ 4 days'))]);
        }
        else if($this->title === 'Get Out Of Jail')
        {
            $jail_settings = JailSettings::findOrFail(1);
            $jail_settings->update(['has_get_out_card' => 1]);
        }
        else if(!$this->redeemable && !$this->completable)
        {
            $this->update(['completed' => 1, 'completed_at' => date('Y-m-d H:i:s', time())]);
        }

        $this->update(['uploaded_image' => base64_encode(file_get_contents($request->file('file'))), 'unlocked' => 1, 'unlocked_at' => date('Y-m-d H:i:s', time())]);
    }

    public function attachments()
    {
        return $this->hasMany(CardAttachment::class);
    }
}
