<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JailSettings extends Model
{
    public $fillable = [
        'in_jail_at',
        'out_of_jail_at',
        'has_get_out_card',
        'used_get_out_card',
    ];
}
