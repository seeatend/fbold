<?php
namespace Followback;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MostSearchUser extends Model {

    protected $fillable = ['username'];
    protected $table = 'most_search_users';

    public function MostSearchUser()
    {

    }

    public static function getListWith($fieldName)
    {
        return DB::table('most_search_users')
            ->orderBy('display_order', 'ASC')
            ->lists($fieldName);
    }

    public static function getList()
    {
        return DB::table('most_search_users')
            ->orderBy('display_order', 'ASC')
            ->get();
    }
}