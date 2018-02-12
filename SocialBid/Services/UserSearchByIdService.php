<?php
namespace SocialBid\Services;

use Guzzle\Http\Client;
use Symfony\Component\DomCrawler\Crawler;
use Sunra\PhpSimple\HtmlDomParser;
use Artdarek\OAuth\OAuth;
use Madcoda\Youtube;
use Config, DB;

class UserSearchByIdService {
    public function __construct(
        Client $client,
        Crawler $crawler,
        OAuth $oauth,
        UserSearchService $search
    ) {
        $this->client = $client;
        $this->crawler = $crawler;
        $this->oauth = $oauth;
        $this->search = $search;
    }

    public function search($type, $identifier, $username)
    {

        return $this->{'searchById' . ucfirst($type)}($identifier, $username);
    }

    public function searchByIdInstagram($identifier, $username)
    {
        try {
            $redis = \Redis::connection();
            $res = $redis->get('Profile.Instagram.' . $username);
            $data = @json_decode($res, true);

            if (!empty($data)) {
                return $data;
            }
        } catch (Exception $e) {

        }

        $data = ['valid' => false];

        $request = $this->client->get(
            \Config::get('services.instagram.baseUrl') . '/users/' . $identifier
        );

        $request->getQuery()->set('q', $identifier)->set(
            'client_id',
            \Config::get('oauth-4-laravel::consumers.Instagram.client_id')
        );

        $res = $request->send();
        if (!is_null($res)) {
            $response = $res->json();
            if (count($response['data']) > 0) {
                $data = ['valid' => true];

                $data['data'] = [
                    'avatar' => $response['data']['profile_picture'],
                    'username' => $response['data']['username'],
                    'name' => $response['data']['name'],
                    'identifier' => $response['data']['id'],
                    'following' => $response['data']['counts']['follows'],
                    'followers' => $response['data']['counts']['followed_by'],
                    'url' => 'http://instagram.com/' .
                        $response['data']['username']
                ];
            }
        }

        // for caching.
        $redis->set('Profile.Instagram.' . $username, @json_encode($data));
        return $data;
    }

    public function searchByIdFacebook($identifier, $username)
    {
        try {
            $redis = \Redis::connection();
            $res = $redis->get('Profile.Facebook.' . $username);
            $data = @json_decode($res, true);

            if (!empty($data)) {
                return $data;
            }
        } catch (Exception $e) {

        }

        $facebook = $this->oauth->consumer('Facebook');
        $response = json_decode(
            $facebook->request(
                '/' . $identifier,
                'GET',
                null,
                array('reqAction' => 'default')
            )
        );
        if (count($response) > 0) {

            $data = ['valid' => true];

            $data['data'] = [
                'avatar' => "https://graph.facebook.com/{$response->id}/picture?type=large",
                'username' => $response->name,
                'identifier' => $response->id,
                'likes' => isset($response->likes) ? $response->likes : 0,
                'url' => $response->link
            ];

        } else {
            $data = ['valid' => false];
        }

        // for caching.
        $redis->set('Profile.Facebook.' . $username, @json_encode($data));

        return $data;
    }

    public function searchByIdTwitter($identifier, $username)
    {
        try {
            $redis = \Redis::connection();
            $res = $redis->get('Profile.Twitter.' . $username);
            $data = @json_decode($res, true);

            if (!empty($data)) {
                return $data;
            }
        } catch (Exception $e) {
        }

        $twitter = $this->oauth->consumer('Twitter');

        //'https://api.twitter.com/1.1/users/show.json?user_id='.$identifier
        $response = json_decode(
            $twitter->request(
                '/users/show.json?user_id=' . $identifier,
                'GET',
                null,
                array('reqAction' => 'default')
            )
        );

        if (count($response) > 0) {
            $data = ['valid' => true];

            $data['data'] = [
                // get original image (bigger)
                'avatar' => isset($response->profile_image_url) ?
                    str_replace('_normal', '', $response->profile_image_url) :
                    null,
                'username' => $response->name,
                'identifier' => $response->id,
                'followers' => $response->followers_count,
                'following' => $response->friends_count,
                'url' => 'https://twitter.com/' . $response->screen_name
            ];
        } else {
            $data = ['valid' => false];
        }

        // for caching.

        $redis->set('Profile.Twitter.' . $username, @json_encode($data));

        return $data;
    }

    public function searchByIdYoutube($identifier, $username)
    {
        try {
            $redis = \Redis::connection();
            $res = $redis->get('Profile.Youtube.' . $username);
            $data = @json_decode($res, true);

            if (!empty($data)) {
                return $data;
            }
        } catch (Exception $e) {
        }

        $youtube = new Youtube(
            array('key' => Config::get('otherconstants.youtube_key'))
        );
        $results = $youtube->getChannelById($identifier);

        if (count($results) > 0 && !empty($results)) {

            $result = ['valid' => true];

            $result['data'] = [
                // get original image (bigger)
                'avatar' => isset($results->snippet->thumbnails->default) ?
                    $results->snippet->thumbnails->default->url : null,
                'username' => $results->snippet->title,
                'description' => $results->snippet->description,
                'identifier' => $identifier,
                'view' => $results->statistics->viewCount,
                'subscribe' => $results->statistics->subscriberCount,
                'url' => 'http://www.youtube.com/channel/' . $results->id
            ];

        } else {
            $result = ['valid' => false];
        }

        // for caching.

        $redis->set('Profile.Youtube.' . $username, @json_encode($data));
        return $result;
    }

    public function searchByIdVine($identifier, $username)
    {
        try {
            $redis = \Redis::connection();
            $res = $redis->get('Profile.Vine.' . $username);
            $data = @json_decode($res, true);

            if (!empty($data)) {
                return $data;
            }
        } catch (Exception $e) {
        }

        $username = str_replace(" ", "+", $username);
        //$search_url = 'https://api.vineapp.com/users/search/'.$username;    //   Search user list by name
        $search_url = 'https://api.vineapp.com/users/profiles/' . $identifier;

        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, $search_url);
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($tuCurl, CURLOPT_SSL_VERIFYPEER, 0);
        //$results = json_decode(curl_exec($tuCurl));
        $res = curl_exec($tuCurl);
        $json = preg_replace(
            '/:\s*(\-?\d+(\.\d+)?([e|E][\-|\+]\d+)?)/',
            ': "$1"',
            $res
        );
        $result = json_decode($json);
        curl_close($tuCurl);

        $data = array();
        if (count($result) > 0) {

            $data = ['valid' => true];
            $data['data'] = [
                // get original image (bigger)
                'avatar' => isset($result->data->avatarUrl) ?
                    $result->data->avatarUrl : null,
                'username' => $result->data->username,
                'name' => $result->data->name,
                'identifier' => $identifier,
                'followers' => $result->data->followerCount,
                'category' => $result->category,
                'following' => $result->data->followingCount,
                'url' => $result->data->shareUrl
            ];
        } else {
            $data = ['valid' => false];
        }

        $redis->set('Profile.Vine.' . $username, @json_encode($data));
        return $data;
    }

    // for caching.
    public function searchByIdFollowback($identifier, $username)
    {

        $results = DB::select(
            "select * from users where id = '$identifier' and username = '$username'"
        );
        if (count($results) > 0) {

            $data = ['valid' => true];
            foreach ($results as $result) {
                $data['data'] = [
                    // get original image (bigger)
                    'avatar' => isset($result->avatar) ? $result->avatar : null,
                    'username' => $result->username,
                    'category' => $result->category,
                    'name' => $result->name,
                    'description' => '',
                    'identifier' => $result->id,
                    'type' => 'followback',
                    'url' => '/' . $result->username .
                        '/redirect/FollowbackAcc/' . "?idf=" . $result->id .
                        "&img=" . $result->avatar
                ];
            }
        } else {
            $data = ['valid' => false];
        }
        return $data;
    }
}

