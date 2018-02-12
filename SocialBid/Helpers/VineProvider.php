<?php
namespace SocialBid\Helpers;

class VineProvider { 
    private $username;
    private $password;
    private $userid;
    private $name;
    private $key;
    private $log;
    var $baseurl = "https://vine.co/api";
    var $success;

    function __construct($username, $password) {
        $ch = curl_init($this->baseurl . "/users/authenticate");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "username=" . $username . "&password=" . $password);
        $return = json_decode(curl_exec($ch), 1);

        if($this->is_user_exist($return)) {

            $this->name = $return['data']['username'];
            $this->key = $return['data']['key'];
            $this->userid = $return['data']['userId'];

            if (isset($return['data']['key'])) {
                $this->success = true;
                $this->success = true;
            } else $this->success = false;
        }
    }

    private function is_user_exist($return) {
        
        if(isset($return['code']) &&  $return['code'] == 101)
            return false;
        return true;
            
    }
    function logout() {
        $return = $this->endpoint("/users/authenticate", $this->key, "DELETE");
        return $return;
    }
    function userinfo() {
            return array(
                "name" => $this->name,
                "key" => $this->key,
                "userid" => $this->userid
                );
    }
    function endpoint($endpoint, $key, $type="POST", $data="") {
        $ch = curl_init($this->baseurl . $endpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'vine-session-id: ' . $key,
            'x-vine-client: vinewww/1.0'
        ));
        //return json_decode(curl_exec($ch), 1);

        $res = curl_exec($ch);

        
        $json = preg_replace('/:\s*(\-?\d+(\.\d+)?([e|E][\-|\+]\d+)?)/', ': "$1"', $res);
        $result = json_decode($json);
        return $result;
        
        // curl_close($tuCurl);
    }
    function self_profile() {
        
            $return = $this->endpoint("/users/me", $this->key, "GET");
            return $return;
    }
    function user_profile($id) {
        
        $return = $this->endpoint("/users/profiles/" . $id, $this->key, "GET");
        return $return;
    }
    function update_profile($description=null, $location=null, $locale=null, $private=null, $phoneNumber=null) {
        
        $string = array();
        if (!is_null($description)) {
            $string['description'] = $description;
        }
        if (!is_null($location)) {
            $string['location'] = $location;
        }
        if (!is_null($locale)) {
            $string['locale'] = $locale;
        }
        if (!is_null($private)) {
            $string['private'] = $private;
        }
        if (!is_null($phoneNumber)) {
            $string['phoneNumber'] = $phoneNumber;
        }
        
        $return = $this->endpoint("/users/" . $this->userid, $this->key, "PUT", http_build_query($string));
        return $return['success'];
    }
    function set_sensitive($bool) {
         if ($bool) {
            $return = $this->endpoint("/users/" . $this->userid . "/explicit", $this->key, "POST");
         }
         else {
             $return = $this->endpoint("/users/" . $this->userid . "/explicit", $this->key, "DELETE");
         }
        return $return['success'];
    }
    function follow($userID) {
            $return = $this->endpoint("/users/" . $userID . "/followers", $this->key);
            return $return;
    }
    function unfollow($userID) {
            $return = $this->endpoint("/users/" . $userID . "/followers", $this->key, "DELETE");
            return $return;
    }
    function block($userID) {
            $return = $this->endpoint("/users/" . $this->userid . "/blocked/" . $userID, $this->key);
            return $return;
    }
    function unblock($userID) {
            $return = $this->endpoint("/users/" . $this->userid . "/blocked/" . $userID, $this->key, "DELETE");
            return $return;
    }
    function notificationsCount() {
            $return = $this->endpoint("/users/" . $this->userid . "/pendingNotificationsCount", $this->key, "GET");
            return $return;
    }
    function notifications() {
            $return = $this->endpoint("/users/" . $this->userid . "/notifications", $this->key, "GET");
            return $return;
    }
    function getFollowers() {
            $return = $this->endpoint("/users/" . $this->userid . "/followers", $this->key, "GET");
            return $return;
    }
    function getFollowing() {
            $return = $this->endpoint("/users/" . $this->userid . "/following", $this->key, "GET");
            return $return;
    }
    function like($postID) {
        $return = $this->endpoint("/posts/" . $postID . "/likes", $this->key);
        return $return;
    }
    function unlike($postID) {
        $return = $this->endpoint("/posts/" . $postID . "/likes", $this->key, "DELETE");
        return $return;
    }
    function comment($postID, $comment) {
        $return = $this->endpoint("/posts/" . $postID . "/comments", $this->key, "POST", "comment=" . $comment);
        return $return;
    }
    function uncomment($postID, $commentID) {
        $return = $this->endpoint("/posts/" . $postID . "/comments/" . $commentID, $this->key, "DELETE");
        return $return;
    }
    function revine($postID) {
        $return = $this->endpoint("/posts/" . $postID . "/repost", $this->key);
        return $return;
    }
    function unrevine($postID, $revineID) {
        $return = $this->endpoint("/posts/" . $postID . "/repost/" . $revineID, $this->key, "DELETE");
        return $return;
    }
    function report($postID) {
        $return = $this->endpoint("/posts/" . $postID . "/complaints", $this->key);    
        return $return;
    }
    function getPost($postID) {
        $return = $this->endpoint("/timelines/posts/" . $postID, $this->key, "GET");
        return $return;
    }
    function getUser($userID) {
        $return = $this->endpoint("/timelines/users/" . $userID, $this->key, "GET");
        return $return;
    }
    function getUserLikes($userID) {
        $return = $this->endpoint("/timelines/users/" . $userID . "/likes", $this->key, "GET");
        return $return;
    }
    function getTag($tag) {
        $return = $this->endpoint("/timelines/tags/" . $tag, $this->key, "GET");
        return $return;
    }
    function mainTimeline() {
        $return = $this->endpoint("/timelines/graph", $this->key, "GET");
        return $return;
    }
    function popularTimeline() {
        $return = $this->endpoint("/timelines/popular", $this->key, "GET");
        return $return;
    }
    function onTheRiseTimeline() {
        $return = $this->endpoint("/timelines/trending", $this->key, "GET");
        return $return;
    }
    function editorsPickTimeline() {
        $return = $this->endpoint("/timelines/promoted", $this->key, "GET");
        return $return;
    }
    function channelTimeline($channelID) {
        $return = $this->endpoint("/timelines/channels/" . $channelID . "/popular", $this->key, "GET");
        return $return;
    }
    function channelRecentTimeline($channelID) {
        $return = $this->endpoint("/timelines/channels/" . $channelID . "/recent", $this->key, "GET");
        return $return;
    }
    function venueTimeline($venueID) {
        $return = $this->endpoint("/timelines/venues/" . $venueID . "/recent", $this->key, "GET");
        return $return;
    }
    function trendingTags() {
        $return = $this->endpoint("/tags/trending", $this->key, "GET");
        return $return;
    }
    function featuredChannels() {
        $return = $this->endpoint("/channels/featured", $this->key, "GET");
        return $return;
    }
    function searchUsers($query) {
        $return = $this->endpoint("/users/search/" . urlencode($query), $this->key, "GET");
        return $return;
    }
    function searchTags($query) {
        $return = $this->endpoint("/tags/search/" . urlencode($query), $this->key, "GET");
        return $return;
    }
}