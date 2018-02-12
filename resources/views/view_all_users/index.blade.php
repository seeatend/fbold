@extends('layouts.simple')
@section('content')
	<!-- Most Searched Users Main Div Starts -->
	<div id="most-searched-user" class="unique">
		<div class="container">

			<div class="row">
				<div class="col-md-12">
					<!-- Title Starts Here -->
					<div class="title"><h1>Verified users</h1></div>
					<!-- Title Ends Here -->
				</div>
			</div>
	
		<?php $i=0; ?>
		@foreach($users as $user)
			<?php 
				$type = strtolower(trim($user->type)); 
				$username = str_replace(" ","+",$user->name ); 
				$url = '/'. $username . '/redirect/FollowbackAcc/' . "?idf=" . $user->id . "&img=" . $user->image_url;
			?>
			@if($type != 'followback')
				<?php $url =  '/'.$username.'/'.trim($type).'/redirect/otherSocialAcc/' .'?idf='.$user->identifier.'&img='.$user->image_url;?>
			@endif
			
			<?php if($i == 0): ?>
			<div class="row">

				<div class="col-md-12">
					<!-- Users List Starts Here -->
					<div class="user-list">
						<ul class="searched-list">
			<?php endif; ?>

				<li>
					<a class="profile-post-link1"  target="_blank" href="<?php echo $url;?>" data-attr="<?php echo '/'.$username.'/'.trim($type);  ?>?idf={{$user->identifier}}&img={{$user->image_url}}" acc-type="{{ trim($type) }}" data-followback-href="<?php echo '/'.$username;  ?>?idf={{$user->identifier}}&img={{$user->image_url}}">
						<div class="user-image">
							{{ HTML::image($user->image_url, $alt="", $attributes = array('class' => 'view-user-background')) }} 
						</div>
						<div class="social-icon">
							{{ HTML::image("assets/images/homepage/carousel/$type.png", $alt="", $attributes = array()) }} 
						</div>
						<div class="user-name">
							<a href="#"> {{ $user->name }} </a>
						</div>
					</a>
				</li>

			<?php if($i == 5){ ?>				
						</ul>
					</div>					
					<!-- Users Lists Ends Here -->
				</div>
			</div>
		<?php $i=0; } 
			
		else{ $i++; } ?>
		@endforeach

		<!--  In case images are not multiple of 6..  we need to add following code -->
		<?php if($i != 5): ?>
					</ul>
				</div>					
					<!-- Users Lists Ends Here -->
				</div>
			</div>
		<?php endif; ?>
	<!-- Most Searched Users Main Div Starts -->
</div></div>
@stop