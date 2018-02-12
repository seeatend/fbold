@extends('layouts.admin')
@section('main_header', 'Change Password')
@section('content')


		{{ HTML ::ul($errors->all(), array('class'=>'errors')) }}
		{{Form::open(['route' => 'do_admin_change_password', 'class'=>''])}}
			<div class="form-group">
				<label>Old Password</label>
				<div class="controls">
					{{ Form::password('old_password', array('class'=>'form-control', 'placeholder'=>'Old Password')) }}
				</div>
				
			</div>
			<div class="form-group">
				<label>New Password</label>
				<div class="controls">
					{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'New Password')) }}
				</div>
			</div>
			<div class="form-group">
				<label>Confirm Password</label>
				<div class="controls">
					{{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm New Password')) }}

				</div>
			</div>
			<button class="btn btn-primary" type="submit">Save</button>
		{{ Form::close() }}

@stop


