<?php
namespace Followback;

use Illuminate\Database\Eloquent\Model;
use DB;
class VerifyUser extends Model {

    protected $fillable = ['username'];
    protected $table = 'verified_users';

    public function MostSearchUser()
    {

    }

    public static function getListWith($fieldName)
    {
        //return DB::table('most_search_users')->orderBy('display_order', 'ASC')->lists($fieldName);
        return DB::table('verified_users')->orderBy('id', 'ASC')->lists(
            $fieldName
        );
    }

    public static function getList()
    {
        //return DB::table('most_search_users')->orderBy('display_order', 'ASC')->get();
        return DB::table('verified_users')
            ->orderBy('display_order', 'ASC')
            ->get();
    }
}