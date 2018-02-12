<?php

namespace Followback;

use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\DB;
use Sentry;

class User extends SentryUserModel implements AuthenticatableContract, CanResetPasswordContract {
    use Authenticatable, CanResetPassword;

    protected $presenter = 'SocialBid\Presenters\User';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'district_id',
        'activated'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function settings()
    {
        return $this->hasOne(UserSetting::class);
    }

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function bids()
    {
        return $this->hasMany(ServiceBid::class, 'bidder_id');
    }

    public function blockedUsers()
    {
        return $this->belongsToMany(
            User::class,
            'blocked_users',
            'user_id',
            'target_id'
        )->withPivot('id', 'created_at', 'updated_at');
    }
    /**
     * checks if user has specific social account type
     * @param  string $type
     * @return boolean
     */
    // public function hasSocialAccount($type)
    // {
    // 	$socialAccounts = $this->socialAccounts->fetch('type');
    // 	return $socialAccounts->search($type) !== false ? true : false;
    // }
    public function hasSocialAccount($type)
    {
        $identifier = $this->socialAccounts()->where('type', $type)->pluck(
            'identifier'
        );

        $account = DB::table('users_social_accounts')
            ->where('type', $type)
            ->where('identifier', $identifier)
            ->where('is_connected', 1)
            ->first();

        return !empty($account) ? true : false;
    }
    // public function disconnectSocialAccount($type)
    // {
    // 	$this->socialAccounts()->where('type', $type)->delete();
    // }
    public function deleteSocialAccount($type)
    {
        $this->socialAccounts()->where('type', $type)->delete();
    }

    public function disconnectSocialAccount($type)
    {
        $this->socialAccounts()->where('type', $type)->update(
            array('is_connected' => 0)
        );
    }

    public function firstTimeConnected($type)
    {

        $identifier = $this->socialAccounts()->where('type', $type)->pluck(
            'identifier'
        );

        $account = DB::table('users_social_accounts')
            ->where('type', $type)
            ->where('identifier', $identifier)
            ->first();

        return !empty($account) ? true : false;

    }

    public function updateSocialStatus($type)
    {
        $this->socialAccounts()->where('type', $type)->update(
            array('is_connected' => 1)
        );
    }

    public function getSocialAccountsTypes()
    {
        return $this->socialAccounts()->lists('type');
    }

    public function getSettings()
    {
        $settings = $this->settings()->first();
        if (!$settings) {
            $settings = $this->settings()->save(new UserSetting);
            return $this->settings()->first();
        }

        return $settings;
    }

    protected function queryBidsForMe()
    {
        $socialAccounts = $this->socialAccounts()->get();

        //Also remove those account which are in user_social_account but is_connect is 0
        foreach ($socialAccounts as $key => $value) {
            if ($socialAccounts[$key]->is_connected == 0) {
                unset($socialAccounts[$key]);
            }
        }

        $bids = new ServiceBid;
        $bids = $bids->where(
            function ($query) use ($socialAccounts, $bids) {
                foreach ($socialAccounts as $account) {

                    $query = $query->orWhere(
                        function ($query) use ($account) {
                            $query->where('service', $account->type)
                                ->where('identifier', $account->identifier)
                                ->orWhere('bidder_id', $account->identifier);
                        }
                    );
                }
                return $query;
            }
        );

        return $bids;
    }

    public function findBidsForMe($orderBy = 'updated_at')
    {
        $bids = $this->queryBidsForMe();

        $bids = $bids->orderBy($orderBy, 'desc')->with(
            'user',
            'user.socialAccounts'
        )->get();

        return $bids;
    }

    public function countPendingBidsForMe()
    {
        $bids = $this->queryBidsForMe();
        $pending_bids = $bids->where('status', 0)->where('bid_type', 'bid')->get();

        return count($pending_bids);
    }

    public function findBidForMeById($id)
    {
        $bids = $this->findBidsForMe();
        return $bids->find($id);
    }

    public function hasBlockedUser($userId)
    {
        $blockedUsers = $this->blockedUsers;
        foreach ($blockedUsers as $user) {
            if ($user->id == $userId) {
                return true;
            }
        }
        return false;
    }

    public function findMyBidById($id)
    {
        return $this->bids()->find($id);
    }

    public function isBlockedBySocialIdentifier($service, $identifier)
    {
        $socialAccount = SocialAccount::byTypeAndId($service, $identifier)
            ->first();
        if ($socialAccount) {
            return $socialAccount->user->blockedUsers()->where(
                'target_id',
                Sentry::getUser()->id
            )->first() !== null ? true : false;
        }
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return "remember_token";
    }

    public function getReminderEmail()
    {
        return $this->email;
    }
}
