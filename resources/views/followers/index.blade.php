<?php

$pageTitle = $users[0]->reach." Followers";

$keywords = "tweet,pin,like,post,comment,follow,social,back,social,task, share, musicians," . $pageTitle . "," . "popstars,artists,actors, social,task,djs,joutnalist,stars,celebs";


$title = $pageTitle;
$description = "View all verified members categorized as " . $pageTitle . " on Followback.";

?>


@extends('layouts.simple')
  @section('content')

  <div class="container search_results" style="margin-bottom: 40px;">

  
    <div class="row">

      <?php $i = 0; ?>
      @foreach($users as $user)
      
      <?php

        $username = trim($user->username);
        $category = trim($user->category);
        $name = $user->name;
        $url = '/' . $username;
        $type = "followback";
		  $realname = !empty($name) ? $name : $username; 
		  $verified = DB::table('verified_users')->where('identifier',$user->id)->first();
        $social = DB::table('users_social_accounts')->where('user_id',$user->id)->pluck('reach');
        
$category = str_replace("-", " ", $category);
        
if ($category == "actors actresses") {
  $category = "actors";
}

if($category == "ceos"){ $category = "CEOs"; }
     	  
     	  
      ?>


      <a class="profile-result <?php if( $verified != NULL ) { ?> verified <?php } ?>"  href="/{{ $username }}">
     		<span class="profile-container" style="position: relative;">
        	 	<span class="loader profile-avatar" style="background: url({{ $user->avatar }}) top center no-repeat;">
            	<img src="/assets/images/profile-placeholder.png" class="img-circle" alt="{{ $username }}"><ins class="profile_verified" style="border-radius: 300px; left: 63px; top: 55px; float: left; width: 20px; height: 20px; position: absolute; z-index: 20;"></ins>	
         	</span>
         	<span class="profile-name"  @if(trim($category) == '')style="padding-top: 10px;" @else style="padding-top: 1px;" @endif>{{ $realname }} <br>
         
         	<span class="profile-category" style="line-height: 1.35em; margin: 0 0 0 0;"> 
         	@if( $category != "")#{{ $category }}  @if( $social != "")<br>@endif @endif
         	@if( $social != ""){{ $social }} Followers @endif
         	</span></span>
         
         
         </span>
      </a> 
      
      


     
      @endforeach

    </div>
   </div>




@stop