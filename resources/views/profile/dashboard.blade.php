@extends('layouts.simple')
@section('content')

@include('partials._searchbar')
@stop

@section('js_inline')
<script>
$(document).ready(function(){
	$('select[name=type]').on('change', function(){
		val = $(this).val();
		var end = (val=='instagram' || val =='twitter') ? ' Usernames' : '';
		$('label[for=q]').html('Search '+val.charAt(0).toUpperCase() + val.slice(1)+end);
	});
})
</script>
@stop