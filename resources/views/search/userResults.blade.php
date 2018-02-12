<div class="row search-results-grid">
  @if($results['valid'])
	
	{{-- 
	<div id="search_results_message" class="container">
    <p>
    	@if( count($results['data']) == 1 ) {{ count($results['data']) }} match for @endif
      @if( count($results['data']) > 1 ) {{ count($results['data']) }} matches for @endif
   	&#8220;<span id="search-query"></span>&#8221;&nbsp;</p>
   </div>
	--}}

    @foreach($results['data'] as $result)

      <?php
      $routeData = $result;
      $routeData['avatar'] = 'avatar.png';
      $realname = !empty($result['name']) ? $result['name'] : $result['username']; 
      $category =  !empty($result['category']) ? $result['category'] : '';
      /* print_r($results); */
      
      if($category == "actors-actresses"){ $category = "actors"; }
      if($category == "ceos"){ $category = "CEOs"; }
      $verified = DB::table('verified_users')->where('identifier',$result['identifier'])->first();
      $social = DB::table('users_social_accounts')->where('user_id',$result['identifier'])->pluck('reach');
      ?>

     	<a class="profile-result <?php if( $verified != NULL ) { ?> verified <?php } ?>" href="/{{$result['username']}}">
     		<span class="profile-container"  style="position: relative;">
        	 	<span class="loader profile-avatar" style="background: url({{$result['avatar']}}) top center no-repeat;">
            	<img src="/assets/images/profile-placeholder.png" class="img-circle"><ins href="#" class="profile_verified" style="border-radius: 300px; left: 63px; top: 55px; float: left; width: 20px; height: 20px; position: absolute; z-index: 20;"></ins>
         	</span>
         	<span class="profile-name" @if( trim($category) != '' && $social != '') style="padding-top: 3px;" @endif>{{ $realname }} <br>
         	<span class="profile-category" style="line-height: 1.35em; margin: 0 0 0 0;"> 
         	@if( trim($category) != "")#{{ $category }}  @if( $social != "")<br>@endif @endif
         	@if( $social != ""){{ $social }} Followers @endif
         	</span></span>
         </span>
      </a> 

    @endforeach
  @else


		<div id="search_results_message" class="container">
   	 <p>No user found.</p>
   	</div>

 

  @endif
</div>
<div class="clearfix" style="height: 10px;"></div>