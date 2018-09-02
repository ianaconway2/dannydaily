<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardScanLog extends Model
{
    public $table = 'card_scan_log';

    public $fillable = [
        'results'
    ];

    public static function log($results)
    {
        $log = new CardScanLog();
        $log->results = json_encode($results);
        $log->save();
    }
}
