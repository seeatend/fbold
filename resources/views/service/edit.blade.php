@extends('layouts.frontend')
@section('content')
<div class="row">
	<h1>Update Service</h1>
	<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		{{Form::open(['route' => ['update_service']])}}
		{{Form::field([
			'name' => 'title',
			'label' => 'Title',
			'placeholder' => true,
            'type' => 'text',
            'value' => $service->title
			])}}
        {{Form::label('type', 'Service Type ');}}
        {{Form::select('type',  $service_type, $service->type);}}

        {{Form::label('connect_type', 'For ');}}
        {{Form::select('connect_type', $connect_type, $service->connect_type);}}

		{{Form::field([
			'name' => 'description',
			'label' => 'Description',
			'placeholder' => true,
			'type' => 'textarea',
        'value' => $service->description
			])}}
		{{Form::field([
			'name' => 'price',
			'label' => 'Price',
			'placeholder' => true,
			'type' => 'text',
        'value' => $service->price
		])}}

        {{Form::field([
        'name' => 'min_bid_price',
        'label' => 'Minimum bid price',
        'placeholder' => true,
        'type' => 'text',
        'value' => $service->min_bid_price
        ])}}

        {{Form::field([
        'name' => 'id',
        'type' => 'hidden',
        'value' => $service->id
        ])}}
			<button type="submit" class="btn btn-success pull-right">Create</button>
		{{Form::close()}}
	</div>
</div>

@stop