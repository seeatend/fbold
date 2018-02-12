<?php

namespace Followback\Http\Controllers\Admin;

use Followback\ServiceBid;
use View, Input, Redirect;
use Flash;
use Followback\User;
use Followback\SocialAccount;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;

class BidController extends BaseAdminController {
    public function __construct(ServiceBid $bid)
    {
        $this->bid = $bid;
    }

    public function getIndex()
    {

        $bids = $this->bid->paginateWith(30, ['user', 'orders']);
        return View::make('admin.bids.index')->with(compact('bids'));
    }

    public function doDeleteBid($id)
    {

        $bid = DB::table('service_offer')->where('id', $id)->first();
        if ($bid) {
            DB::table('service_offer')->where('id', $id)->delete();
            Flash::addSuccess('Bid has been deleted.');
        } else {
            Flash::addError('Bid not found.');
        }

        if (\Request::ajax()) {
            return \Response::json(
                ['success' => true, 'redirect' => 'admin/bids'],
                200
            );
        }
        return Redirect::route('admin_bids_index');

    }
}
