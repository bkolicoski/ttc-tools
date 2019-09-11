<?php

namespace App\Http\Controllers;

use App\YouTubeChannel;
use Carbon\Carbon;
use Google_Client;
use Google_Service_YouTube;
use Google_Service_YouTubeAnalytics;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class YouTubeSightController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Google_Exception
     */
    public function index()
    {
        $access_token = session('access_token', null);
        if ($access_token != null) {
            if (!isset($access_token['error'])) {
                $channel = YouTubeChannel::where('channel_id', session('channel_id'))->first();
                if ($channel) {
                    $client = $this->getGoogleClient();
                    $client->setAccessToken(session('access_token'));
                    $youtube = new Google_Service_YouTubeAnalytics($client);
                    $report = $youtube->reports->query([
                        'ids' => 'channel==MINE',
                        'metrics' => 'views,subscribersGained,subscribersLost,estimatedMinutesWatched,averageViewDuration',
                        'startDate' => $channel['published_at']->format('Y-m-d'),
                        'endDate' => Carbon::now()->format('Y-m-d')
                    ]);
                    return view('youtube-sight.stats', ['data' => $report->getRows()[0]]);
                }
                session()->flush();
                return redirect()->route('youtube-sight.index')->with('error', 'Unknown channel. Please try again.');
            }
            session()->flush();
            return redirect()->route('youtube-sight.index')->with('error', $access_token['error_description']);
        }
        return view('youtube-sight.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Google_Exception
     */
    public function login()
    {
        $client = $this->getGoogleClient();
        return redirect($client->createAuthUrl());
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Google_Exception
     */
    public function auth(Request $request)
    {
        if ($request->has('code')) {
            $client = $this->getGoogleClient();
            $token = $client->fetchAccessTokenWithAuthCode($request->get('code'));
            if (!isset($token['error'])) {
                $client->setAccessToken($token['access_token']);
                $channel_data = $this->getChannelData($client);
                $channel = YouTubeChannel::where('channel_id', $channel_data['id'])->first();
                if (!$channel) {
                    $channel = new YouTubeChannel();
                    $channel['channel_id'] = $channel_data['id'];
                    $channel['name'] = $channel_data['name'];
                    $channel['published_at'] = Carbon::parse($channel_data['published_at']);
                    $channel['access_token'] = $token;
                    $channel['api_access_key'] = Str::uuid()->toString();
                    $channel->save();
                }
                session()->put('access_token', $token);
                session()->put('channel_id', $channel_data['id']);
                return redirect()->route('youtube-sight.index');
            }
            return redirect()->route('youtube-sight.index')->with('error', $token['error_description']);
        }
        dd($request->all());
    }

    /**
     * @return \Google_Client
     * @throws \Google_Exception
     */
    private function getGoogleClient(): \Google_Client
    {
        $client = new Google_Client();
        $client->setAuthConfig(base_path(config('services.google.credentials')));
        $client->setAccessType("offline");        // offline access
        $client->setIncludeGrantedScopes(true);   // incremental auth
        $client->addScope(Google_Service_YouTubeAnalytics::YT_ANALYTICS_READONLY);
        $client->addScope(Google_Service_YouTube::YOUTUBE_READONLY);
        $client->setRedirectUri(route('youtube-sight.auth'));
        return $client;
    }

    /**
     * @param \Google_Client $client
     *
     * @return array
     */
    private function getChannelData(Google_Client $client): array
    {
        $service = new Google_Service_YouTube($client);
        $data = $service->channels->listChannels(
            'id,snippet',
            ['mine' => true]
        )->getItems();
        return [
            'id' => $data[0]['id'],
            'name' => $data[0]['snippet']['title'],
            'published_at' => $data[0]['snippet']['publishedAt']
        ];
    }
}
