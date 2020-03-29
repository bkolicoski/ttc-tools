<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LatestLink extends Model
{
    protected $fillable = [
        'channel_id',
        'url'
    ];

    protected $appends = ['full_url'];

    public function getFullUrlAttribute()
    {
        return route('youtube-latest.redirect', ['url' => $this->url]);
    }
}
