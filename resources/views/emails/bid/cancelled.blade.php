@extends('layouts.email')
@section('content')
		<p>Bid Cancelled</p>
			<p>You cancelled the bid for <b>{{$bid['username']}}</b> for <b>{{ucfirst($bid['service'])}}</b> account and <b>{{$bidDescription}}</b> (<b>${{$bid['offer_price']}}</b>).</p>


@stop