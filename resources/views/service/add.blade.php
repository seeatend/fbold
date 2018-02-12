@extends('layouts.frontend')
@section('content')
<div class="row">
	<h1>Create Service</h1>
	<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		{{Form::open(['route' => ['create_service']])}}
		{{Form::field([
			'name' => 'title',
			'label' => 'Title',
			'placeholder' => true,
            'type' => 'text'
			])}}
        {{Form::label('type', 'Service Type ');}}
        {{Form::select('type', $service_type);}}

        {{Form::label('connect_type', 'For ');}}
        {{Form::select('connect_type', $connect_type);}}

		{{Form::field([
			'name' => 'description',
			'label' => 'Description',
			'placeholder' => true,
			'type' => 'textarea'
			])}}
		{{Form::field([
			'name' => 'price',
			'label' => 'Price',
			'placeholder' => true,
			'type' => 'text'
		])}}

        {{Form::field([
        'name' => 'min_bid_price',
        'label' => 'Minimum bid price',
        'placeholder' => true,
        'type' => 'text'
        ])}}
			<button type="submit" class="btn btn-success pull-right">Create</button>
		{{Form::close()}}
	</div>
</div>

@stop