<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YouTubeChannel extends Model
{
    protected $table = 'youtube_sight';

    protected $casts = ['access_token' => 'array'];

    protected $dates = ['published_at'];
}
