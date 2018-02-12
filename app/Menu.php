<?php
namespace Followback;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model {

    protected $table = 'menus';

    public static function getList()
    {
        return DB::table('menus')->get();
    }
}