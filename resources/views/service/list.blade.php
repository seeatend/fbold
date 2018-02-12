@extends('layouts.frontend')
@section('content')
<div class="row">
	<h1>Services <a href="{{ URL::route('add_service') }}">Add new </a></h1>
	<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <table class="table table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th class="col-lg-1">Title</th>
                <th class="col-lg-1">Type</th>
                <th class="col-lg-1">Price</th>
                <th class="col-lg-1">Min bid Price</th>
                <th class="col-lg-1">Service for</th>
                <th class="col-lg-1">Status</th>
                <th class="col-lg-1">Date added</th>
                <th class="col-lg-1">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($services as $sv)

            <tr>
                <td>&nbsp;{{ $sv->title }}</td>
                <td>&nbsp;{{ $sv->type }}</td>
                <td>&nbsp;${{ $sv->price }}</td>
                <td>&nbsp;${{ $sv->min_bid_price }}</td>
                <td>&nbsp;{{ $sv->connect_type }}</td>
                <td>&nbsp;{{ ($sv->active==1)?'Active':'Completed' }}</td>
                <td>&nbsp;{{ $sv->created_at }}</td>
                <td>&nbsp;<a href="{{ URL::route('edit_service', array('id'=>$sv->id)) }}">Edit </a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
	</div>
</div>

@stop