<?php
namespace Followback;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model {
    protected $fillable = ['username'];
    protected $table = 'users_social_accounts';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeByTypeAndId($query, $type, $id)
    {
        return $query->where('type', $type)->where('identifier', $id);
    }

    public function scopeByUsername($query, $username)
    {
        return $query->where('username', $username);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}