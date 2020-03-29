<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateYouTubeLinkRequest;
use App\LatestLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class YouTubeLatestController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('youtube-latest.index');
    }

    public function store(CreateYouTubeLinkRequest $request)
    {
        if (LatestLink::create($request->data())) {
            return response()->json([
                'success' => true,
                'links' => LatestLink::where('channel_id', $request->get('channel_id'))
                    ->orderby('id', 'desc')
                    ->get()
                    ->map(function ($item) {
                        return ['full_url' => $item['full_url']];
                    })
            ]);
        }
        return response()->json([
            'success' => false,
            'links' => LatestLink::where('channel_id', $request->get('channel_id'))
                ->orderby('id', 'desc')
                ->get()
                ->map(function ($item) {
                    return ['full_url' => $item['full_url']];
                })
        ]);
    }

    public function redirect(string $url)
    {
        $link = LatestLink::where('url', $url)->first();
        if ($link) {
            try {
                $url = Cache::remember($url, 21600, function () use ($link) {
                    $xml = simplexml_load_file('https://www.youtube.com/feeds/videos.xml?channel_id=' . $link['channel_id']);
                    return (string) $xml->entry->link['href'];
                });
                return redirect($url);
            } catch (\Exception $e) {
                Log::error($e);
                return redirect()->route('youtube-latest.index');
            }
        }
        return redirect()->route('youtube-latest.index');
    }
}
