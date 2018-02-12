<?php

namespace Followback\Http\Controllers\Admin;
use View, Redirect, Input, DbConfig, Flash;
class SettingsController extends BaseAdminController{
	public function getIndex()
	{
		return View::make('admin.settings.index');
	}
	public function postPaymentSave()
	{
		$input = Input::only('client_id','secret','mode');
		foreach($input as $key=>$value){
			DbConfig::store('payments.paypal.'.$key, $value);
		}
		Flash::addSuccess('Settings changed.');
		return Redirect::route('admin_settings_index');
	}
	public function postBidSave()
	{
		$input = Input::only('maximum_bids');
		foreach($input as $key=>$value){
			DbConfig::store('bidServices.settings.'.$key, $value);
		}
		Flash::addSuccess('Settings changed.');
		return Redirect::route('admin_settings_index');
	}
}