@extends('layouts.email')
@section('content')

	<p>We have just been notified from <strong>{{$bidUser}}</strong> that the social task <strong>{{$bidinstruction}}</strong> has still not been fulfilled.</p>
	
	<p>We will be looking into the matter to check if it has been completed within the next 24 hours. If it has been, please go to the bid in your received section and press the task completed button to speed up the process.</p> 

	<p>If, however, the social task has not been fulfilled, this social task will automatically get canceled and you can potentially be banned from using our services. Here at Followback, we believe that individuals should honor social tasks indefinitely. Unfortunately, we cannot guarantee that this will be the case. Therefore, we have a policy that social tasks must be continuously upheld for a minimum of thirty days in order to be credited with the completion of the social task. Any social task that is not honored by this policy will be issued a refund.</p>
	
	
@stop