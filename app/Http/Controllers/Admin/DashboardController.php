<?php

namespace Followback\Http\Controllers\Admin;

use View, Redirect;

class DashboardController extends BaseAdminController {
    public function getDashboard()
    {
        return View::make('admin.dashboard');
    }
}
