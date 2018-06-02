<?php

        if(isset($title)){
            $pageTitle = $title;
        }else{
            $pageTitle = str_replace("-", " ", $users[0]->category);

        }
$keywords = "tweet,pin,like,post,comment,follow,social,back,social,task, share, musicians," . $pageTitle . "," . "popstars,artists,actors, social,task,djs,joutnalist,stars,celebs";

if ($pageTitle == "actors actresses") {
  $pageTitle = "actors";
}

if($pageTitle == "ceos"){ $pageTitle = "CEOs"; }

$title = "#".$pageTitle;
$description = "View all verified members categorized as " . $pageTitle . " on Followback.";

?>


@extends('layouts.simple')
  @section('content')

  <div class="container search_results" style="margin-bottom: 40px;">


  <div id="topbar_logo" class="container-fluid">
   {{-- <a class="main_logo" href="/">&nbsp;</a> --}}
  </div>
  
    <div class="row">

      <?php $i = 0; ?>
      @foreach($users as $user)
      
      <?php

        $username = $user->username;
        $name = $user->name;
        $url = '/' . $username;
        $type = "followback";
		    $realname = !empty($name) ? $name : $username; 
		    $verified = DB::table('verified_users')->where('identifier',$user->id)->first();
        $social = DB::table('users_social_accounts')->where('user_id',$user->id)->pluck('reach');
      
      ?>


      <a class="profile-result <?php if( $verified != NULL ) { ?> verified <?php } ?>"  href="/{{ $username }}">
     		<span class="profile-container" style="position: relative;">
        	 	<span class="loader profile-avatar" style="background: url({{ $user->avatar }}) top center no-repeat;">
            	<img src="/assets/images/profile-placeholder.png" class="img-circle" alt="{{ $username }}"><ins class="profile_verified" style="border-radius: 300px; left: 63px; top: 55px; float: left; width: 20px; height: 20px; position: absolute; z-index: 20;"></ins>	
         	</span>
         	<span class="profile-name"  @if( $pageTitle != '' && $social != '') style="padding-top: 3px;" @endif>{{ $realname }} <br>
         
         	<span class="profile-category" style="line-height: 1.35em; margin: 0 0 0 0;"> 
         	@if( $pageTitle != "")#{{ $pageTitle }}  @if( $social != "")<br>@endif @endif
         	@if( $social != ""){{ $social }} Followers @endif
         	</span></span>
         
         
         </span>
      </a> 
      
      


     
      @endforeach
      @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator )

         {!! $users->render() !!}

      @endif

    </div>
   </div>




@stop