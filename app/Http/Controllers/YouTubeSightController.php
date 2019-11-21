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
                    $data = $this->getAnalyticsApiData($client, $channel);
                    return view('youtube-sight.stats', [
                        'channel' => $channel,
                        'data' => $data
                    ]);
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function privacy()
    {
        return view('youtube-sight.privacy-policy');
    }

    /**
     * @param string $guid
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Google_Exception
     */
    public function apiIndex(string $guid)
    {
        $channel = YouTubeChannel::where('api_access_key', $guid)->first();
        if ($channel) {
            $client = $this->getGoogleClient();
            $access_token = $client->fetchAccessTokenWithRefreshToken($channel['access_token']['refresh_token']);
            if (!isset($access_token['error'])) {
                $channel['access_token'] = $access_token;
                $channel->save();
                $data = $this->getAnalyticsApiData($client, $channel);
                if(request()->expectsJson()) {
                    $result = [
                        'views' => $data[0],
                        'subscribers_gained' => $data[1],
                        'subscribers_lost' => $data[2],
                        'subscribers_count' => $data[1] - $data[2],
                        'estimated_minutes_watched' => $data[3],
                        'average_view_duration' => (int)($data[4] / 60) . ':' . (($data[4] % 60) < 10 ? '0' . ($data[4] % 60) : $data[4] % 60)
                    ];
                    if (request()->has('include-data-stats')) {
                        $result['data_statistics'] = $this->getDataApiData($client, $channel);
                    }
                    return response()->json($result);
                }
                $data[4] = (int)($data[4]/60) . ':' . (($data[4]%60) < 10 ? '0'.($data[4]%60) : $data[4]%60);
                array_splice( $data, 3, 0, $data[1] - $data[2]);
                return response(join(',', $data));
            }
            return response('There was an error authenticating the request. Please visit the app UI at ' . config('app.url') . ' to login again!', 401);
        }
        return response('The specified channel can not be found.', 404);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        session()->flush();
        return redirect()->route('youtube-sight.index');
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
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Google_Exception
     */
    public function disconnect()
    {
        $access_token = session('access_token', null);
        if ($access_token != null) {
            if (!isset($access_token['error'])) {
                $channel = YouTubeChannel::where('channel_id', session('channel_id'))->first();
                if ($channel) {
                    $client = $this->getGoogleClient();
                    $client->setAccessToken(session('access_token'));
                    $client->revokeToken(session('access_token'));
                    $channel->delete();
                    session()->flush();
                    return redirect()->route('youtube-sight.index')->with('success', 'Your channel was removed.');
                }
                session()->flush();
                return redirect()->route('youtube-sight.index')->with('error', 'Unknown channel. Please try again.');
            }
            session()->flush();
            return redirect()->route('youtube-sight.index')->with('error', $access_token['error_description']);
        }
        return redirect()->route('youtube-sight.index')->with('error', 'You need to be logged in to disconnect a channel.');
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

    /**
     * @param \Google_Client $client
     * @param $channel
     *
     * @return array
     */
    private function getAnalyticsApiData(Google_Client $client, $channel): array
    {
        $youtube = new Google_Service_YouTubeAnalytics($client);
        $data = $youtube->reports->query([
            'ids' => 'channel==MINE',
            'metrics' => 'views,subscribersGained,subscribersLost,estimatedMinutesWatched,averageViewDuration',
            'startDate' => $channel['published_at']->format('Y-m-d'),
            'endDate' => Carbon::now()->format('Y-m-d')
        ]);
        return $data->getRows()[0];
}

    private function getDataApiData(Google_Client $client, $channel)
    {
        $service = new Google_Service_YouTube($client);
        $data = $service->channels->listChannels(
            'id,statistics',
            ['mine' => true]
        )->getItems();
        return [
            'subscriber_count' => $data[0]['statistics']['subscriberCount'],
            'video_count' => $data[0]['statistics']['videoCount'],
            'views' => $data[0]['statistics']['viewCount']
        ];
    }
}
