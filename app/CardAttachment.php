<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardAttachment extends Model
{
    public $fillable = [
        'file_path',
        'card_id'
    ];
}
