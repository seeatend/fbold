<?php
namespace Followback\Http\Controllers;

class MostSearchUserController extends BaseController {

    public function getIndex()
    {
        $users = DB::table('most_search_users')
            ->orderBy('display_order', 'ASC')
            ->get();
        return View::make('view_all_users.index')->with('users', $users);
    }
}



