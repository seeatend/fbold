@extends('layouts.admin')
@section('main_header', 'Settings')
@section('content')
<h2>Payments</h2>
<?php echo Form::open(['route' => 'do_admin_settings_payment_save']); ?>

<?php echo Form::field([
	'name' => 'client_id',
	'label' => 'PayPal Client Id',
	'placeholder' => true,
	'value' => DbConfig::get('payments.paypal.client_id')
]); ?>
<?php echo Form::field([
	'name' => 'secret',
	'label' => 'PayPal Secret Key',
	'placeholder' => true,
	'value' => DbConfig::get('payments.paypal.secret')
]); ?>
<?php echo Form::field([
	'name' => 'mode',
	'label' => 'PayPal Mode',
	'placeholder' => true,
	'type' => 'select',
	'options' => ['live'=>'live', 'sandbox'=>'sandbox'],
	'selected' => DbConfig::get('payments.paypal.mode')
]); ?>
<button type="submit" class="btn btn-success">Save</button>
<?php echo Form::close(); ?>
<hr/>
<h2>Bids</h2>
<?php echo Form::open(['route'=>'do_admin_settings_bid_save']); ?>
<?php echo Form::field([
	'name' => 'maximum_bids',
	'label' => 'Maximum bids limit for one person',
	'placeholder' => true,
	'value' => DbConfig::get('bidServices.settings.maximum_bids')
]); ?>
<button type="submit" class="btn btn-success">Save</button>
<?php echo Form::close(); ?>

@stop