<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateYouTubePlaylistLinkRequest;
use App\PlaylistLatestLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class YouTubePlaylistLatestController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('youtube-playlist-latest.index');
    }

    public function store(CreateYouTubePlaylistLinkRequest $request)
    {
        if (PlaylistLatestLink::create($request->data())) {
            return response()->json([
                'success' => true,
                'links' => PlaylistLatestLink::where('playlist_id', $request->get('playlist_id'))
                    ->orderby('id', 'desc')
                    ->get()
                    ->map(function ($item) {
                        return ['full_url' => $item['full_url']];
                    })
            ]);
        }
        return response()->json([
            'success' => false,
            'links' => PlaylistLatestLink::where('playlist_id', $request->get('playlist_id'))
                ->orderby('id', 'desc')
                ->get()
                ->map(function ($item) {
                    return ['full_url' => $item['full_url']];
                })
        ]);
    }

    public function redirect(string $url)
    {
        $link = PlaylistLatestLink::where('url', $url)->first();
        if ($link) {
            try {
                $url = Cache::remember($url, 21600, function () use ($link) {
                    $xml = simplexml_load_file('https://www.youtube.com/feeds/videos.xml?playlist_id=' . $link['playlist_id']);
                    return (string) $xml->entry->link['href'];
                });
                return redirect($url);
            } catch (\Exception $e) {
                Log::error($e);
                return redirect()->route('youtube-playlist-latest.index');
            }
        }
        return redirect()->route('youtube-playlist-latest.index');
    }
}
