<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaylistLatestLink extends Model
{
    protected $fillable = [
        'playlist_id',
        'url'
    ];

    protected $appends = ['full_url'];

    public function getFullUrlAttribute()
    {
        return route('youtube-playlist-latest.redirect', ['url' => $this->url]);
    }
}
