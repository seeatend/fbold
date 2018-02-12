@extends('layouts.email')
@section('content')

		<p>
		You accepted a social task from <b>{{$bidderUsername}}</b> to <b>{{str_replace('_',' ', $bid['service_type'])}}</b> for <b>${{$bid['offer_price']}}</b>. You have 24 hours to fulfill this social task or risk the possibility of being banned from using our services and the user will be refunded.
		</p>
		<p>
		Here at Followback, we believe that individuals should honor tasks for a lifetime. Unfortunately, we cannot guarantee this. Therefore, we have a policy that tasks must be continuously upheld for a minimum of thirty days in order to be credited with the completion of the task. Any task that is not honored by this policy will be issued a refund. Please note standard paypal fees do apply.
		</p>


@stop


