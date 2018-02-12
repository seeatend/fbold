@extends('layouts.simple')
@section('content')
<div class="container" style="padding-top:30px;" >
<p>
<!-- A verification email was sent to {{$user->email}} from followback.com please click on the link to activate your account. You will not be able to use any of the functions until you do so. -->
You have been registered successfully. A confirmation link has been sent to {{$user->email}} from followback.com.
</p>
</div>
@stop