<?php
namespace Followback;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Sentry;
use SocialBid\Presenters\PresentableTrait;

class ServiceBid extends Model {

    use PresentableTrait;

    const STATUS_NEW = 0;
    const STATUS_DENIED = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_COUNTERED_BY_RECEIVER = 4;
    const STATUS_COUNTERBID_ACCEPTED = 5;
    const STATUS_COUNTERBID_DENIED = 6;
    const STATUS_COUNTERED_BY_CREATOR = 7;
    const STATUS_TASK_NOT_COMPLETED = 8;
    const STATUS_BID_CANCELLED = 9;

    protected $presenter = 'SocialBid\Presenters\ServiceBid';

    public static $price_rules = array(
        'offer_price' => 'required|numeric'
    );

    public static $comment_rules = array(
        'comment' => 'required'
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_offer';
    protected $guarded = ['id', 'bidder_id', 'created_at', 'updated_at'];

    public function scopeForCurrentUser($query)
    {
        return $query->where('bidder_id', Sentry::getUser()->id);
    }

    public function setOfferPriceAttribute($value)
    {
        $this->attributes['offer_price'] = $value;
    }

    public function getOfferPriceAttribute()
    {
        return number_format((float) $this->attributes['offer_price'], 2);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'bidder_id');
    }

    public function orders()
    {
        return $this->hasOne(Order::class, 'bid_id');
    }

    /**
     * Get the id for the files.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * searches for social accounts of the user who placed a bid
     * @return mixed
     */
    public function findCreatorSocialAccount()
    {
        $socialAccounts = $this->user->socialAccounts;
        foreach ($socialAccounts as $account) {
            if ($account->type === $this->service) {
                return $account;
            }
        }
        return null;
    }

    public function firstById($id)
    {
        return $this->find($id);
    }

    public function paginateWith($paginate, array $with)
    {
        return $this->with($with)->paginate($paginate);
    }

    public function uploadFile($input)
    {
        $filepath = App::make('SocialBid\FileUpload\BidFileUpload')->upload(
            $input
        );
        return $filepath;
    }

    public function zendcodeFile($file)
    {
        $filepath = App::make('SocialBid\FileUpload\Zencoder')
            ->encode($file);

        return $filepath;
    }

    /*public function uploadFile($input)
    {
        $filepath = App::make('SocialBid\FileUpload\BidFileUpload')->upload($input);
        return $filepath;
    }*/

    public function countLeftBidsForSocialAccount($service, $identifier)
    {
        return \DbConfig::get('bidServices.settings.maximum_bids', 3) -
        $this->where('service', $service)
            ->where('identifier', $identifier)
            ->where('bidder_id', \Sentry::getUser()->id)
            ->where('status', self::STATUS_NEW)
            ->where('bid_type', 'bid')
            ->count();
    }

    public function findCreatorSocialUsername()
    {
        $socialAccount = $this->findCreatorSocialAccount();
        return $socialAccount ? $socialAccount->username : null;
    }

    public function findReceiverSocialUsername()
    {
        return $this->username;
    }

    public function findCreatorAvatar()
    {
        return !empty($this->user->avatar) ? $this->user->avatar :
            '/assets/images/homepage/facebook-avatar.png';
    }

    public function findCreatorFollowbackUsername()
    {
        if (isset($this->user->username)) {
            return $this->user->username;
        } else {
            return '';
        }
        
    }

    public function findCreatorFollowbackName()
    {
        if (!$this->user->name) {
            return $this->user->username;
        }
        return $this->user->name;
    }

    public function createOrder()
    {
        $order = new Order;
        $order->bid_id = $this->id;
        $order->user_id = \Sentry::getUser()->id;
        $order->customer_email = $this->user->email;
        $order->total = $this->offer_price;
        $order->payment_method = 'paypal';
        $order->currency = 'USD';
        $order->status = 'created';
        $order->save();
        return $order;
    }

    public function delete()
    {
        if (!empty($this->file)) {
            File::delete(\Config::get('paths.bid_file') . '/' . $this->file);
        }
        parent::delete();
    }

    public function getCreatorSocialUrl()
    {

        $creatorSocialAccount = $this->findCreatorSocialAccount();

        if ($creatorSocialAccount) {
            switch ($this->service) {
                case 'facebook':
                    return 'https://facebook.com/' .
                    $creatorSocialAccount->identifier;
                    break;
                case 'twitter':
                    //return 'https://twitter.com/account/redirect_by_id/'.$creatorSocialAccount->identifier;
                    //return 'https://twitter.com/intent/user?user_id='.$creatorSocialAccount->identifier;
                    return 'https://twitter.com/' .
                    $creatorSocialAccount->screen_name;
                    break;
                case 'instagram':
                    return 'https://instagram.com/' .
                    $creatorSocialAccount->username;
                    break;
                case 'vine':
                    return 'http://vine.co/' . $creatorSocialAccount->username;
                    break;
                case 'youtube':
                    return 'http://www.youtube.com/channel/' .
                    $creatorSocialAccount->identifier;
                    break;
            }
        }
        return "";
    }

    public static function userSocialUrlForAdmin(
        $type,
        $identifier,
        $username,
        $screen_name,
        $image
    ) {

        if ($type) {
            switch ($type) {
                case 'facebook':
                    return 'https://facebook.com/' . $identifier;
                    break;
                case 'twitter':
                    return 'https://twitter.com/' . $screen_name;
                    break;
                case 'instagram':
                    return 'https://instagram.com/' . $username;
                    break;
                case 'vine':
                    //return 'http://vine.co/'. $username;
                    return 'http://vine.co/u/' . $identifier;
                    break;
                case 'youtube':
                    return 'http://www.youtube.com/channel/' . $identifier;
                    break;
                case 'followback':
                    return '/' . $username . '/redirect/FollowbackAcc/' .
                    "?idf=" . $identifier . "&img=" . $image;
                    break;
            }
        }
        return "";

    }

    /**
     * Get Followback's Profile URL
     * @return Profile URL
     */
    public function getSenderFollowbackProfileUrl()
    {
        $userId = DB::table('users_social_accounts')
            ->where('user_id', $this->user->id)
            ->orderBy('type', 'followback')
            ->pluck('user_id');

        $userInfo = User::find($userId);
        //$url = '/' . $userInfo->username . "?idf=" . $userInfo->id . "&img=" . $userInfo->avatar;
        if (isset($userInfo->username)) {
            $url = '/' . $userInfo->username . '/redirect/FollowbackAcc/' .
            "?idf=" . $userInfo->id . "&img=" . $userInfo->avatar;
        } else {
            $url = "Can't Find Followback Profile URL";
        }
        
        return $url;
    }

    public function getCreatorAnySocialUrl()
    {

        $socialAccList = DB::table('users_social_accounts')
            ->where('user_id', $this->user->id)
            ->orderBy('id', 'ASC')
            ->first();

        if ($socialAccList) {
            switch ($socialAccList->type) {
                case 'facebook':
                    return 'https://facebook.com/' . $socialAccList->identifier;
                    break;
                case 'twitter':
                    //return 'https://twitter.com/account/redirect_by_id/'.$creatorSocialAccount->identifier;
                    //return 'https://twitter.com/intent/user?user_id='.$creatorSocialAccount->identifier;
                    return 'https://twitter.com/' . $socialAccList->screen_name;
                    break;
                case 'instagram':
                    return 'https://instagram.com/' . $socialAccList->username;
                    break;
                case 'vine':
                    return 'http://vine.co/' . $socialAccList->username;
                    break;
                case 'youtube':
                    return 'http://www.youtube.com/channel/' .
                    $socialAccList->identifier;
                    break;
            }
        }
        return "";
    }

    public function getCreatorAnySocialUsername()
    {

        $socialAccLists = DB::table('users_social_accounts')
            ->where('user_id', $this->user->id)
            ->orderBy('id', 'ASC')
            ->first();

        if ($socialAccLists) {
            return $socialAccLists->username;
        }
        return '';

    }

    public function getReceiverSocialUrl()
    {
        switch ($this->service) {
            case 'facebook':
                return 'https://facebook.com/' . $this->identifier;
                break;
            case 'twitter':
                return 'https://twitter.com/account/redirect_by_id/' .
                $this->identifier;
                break;
            case 'instagram':
                return 'https://instagram.com/' . $this->username;
                break;
            case 'vine':
                return 'http://vine.co/' . $this->username;
                break;
            case 'youtube':
                return 'http://www.youtube.com/channel/' . $this->identifier;
                break;
        }
        return "";
    }
}
