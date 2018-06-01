<div id="search-container" style="float: left; width: 100%; background-color: #FFF; padding: 0; margin-top: 0; clear: both;">
  <div id="topbar" class="container-fluid" style="width: 100%; float: left; margin-top: 0; padding-bottom: 5px; background-color: #FFF;">
    <div class="ui-widget ui-widget-content ui-widgets fb-home-search" style="background-color: #fff; border: medium none;   height: 58px; border-bottom-left-radius: 3px; border-top-left-radius: 3px; padding: 0 10px;">
      <div class="search-select">
      {{--
      	<a href="#" class="selected" title="Search by user or tags" data-type="users"><ins class="fa fa-users"></ins></a>
      	<a href="#" title="Search all of Followback"  data-type="all"><ins class="fa fa-star"></ins></a>
      --}}
      <a href="#" class="CloseSearch" title="Close">&times;</a>
      </div>
      <input id="search-input" class="tags input-search-text ui-autocomplete-input" type="text" autocomplete="off" placeholder="Search for a user to do a social media task" title="You can search by entering a username, a popular hashtag or the amount of followers.">
      <div class="loader-contain">
        <div class="search-loader"></div>
      </div>
      <div class="focusout-loader-contain" style="background:transparent;z-index:9999;positions:absolute;display:none; ">
        <div class="focusout-home-search-loader" style="right: 15px !important; top: 17px !important;">
        </div>
      </div>
    </div>
  </div>

	
 	<div class="container" id="search_results"></div>
	<div class="clearfix" style="height: 70px;"></div>
	
	<div class="columns" style="padding: 0 5px;">
		
	 		<h2 style="padding: 30px 0 5px; font-size: 20px; font-family: Helvetica; font-weight: 400;" class="text-center">
 	 			Trending Searches
 	 		</h2>



        <ul class="normal" style="padding-left: 0px;list-style: none; display: block; text-align: center; margin: 20px auto; line-height: 2.15em;">
            <li><a href="/sort/musician">#musician</a></li>
            <li><a href="/NickiMinaj">Nicki Minaj</a></li>
            <li><a href="/sort/tv">#tv</a></li>
            <li><a href="/KhloeKardashian">Khloe Kardashian</a></li>
            <li><a href="/followers/10M+">10 Million+ Followers</a></li>
            <li><a href="/Lala">Lala</a></li>
            <li><a href="/sort/athlete">#athlete</a></li>
            <li><a href="/FloydMayweather">Floyd Mayweather</a></li>
            <li><a href="/followers/5-10M">5-10 Millions+ Followers</a></li>
            <li><a href="/DJKhaled">DJ Khaled</a></li>
            <li><a href="/followers/1-5M">1-5 Millions+ Followers</a></li>
        </ul>

        <ul class="default" style="padding-left: 0px;list-style: none; display: block; text-align: center; margin: 20px auto; line-height: 2.15em;">
            <li><a href="/sort/musician">Musicians</a></li>
            <li class="health"><a href="/sort/radio">Radio host</a></li>
            <li class="video"><a href="/sort/tv">Tv persoanlities</a></li>
            <li class="video"><a href="/sort/dj">djs</a></li>
            <li class="health"><a href="/sort/model">models</a></li>
            <li><a href="/sort/athlete">athletes</a></li>

        </ul>

 	</div>
	
	
	{{--
	<div id="search-options" class="row" style="display: none;"> 
		<div class="columns" style="padding: 0 5px;">
		
		<div id="follower-count">
 	 		<h2 style="padding: 0 5px;"><a href="#" class="info" style="color: #000 !important;">Number of Followers <span style="top: 20px;">View users by the amount of followers they have on social media.</span><ins class="fa fa-question-circle"></ins></a></h2>

		<div class="count-columns">
			<a href="/followers/1-500">
			  <div class="panel panel-default">
				 <div class="panel-footer">1-500</div>
			  </div>
			</a>
		 </div>	 		
 		
		<div class="count-columns">
			<a href="/followers/500-1K">
			  <div class="panel panel-default">
				 <div class="panel-footer">500-1K</div>
			  </div>
			</a>
		 </div>	 		
 		
 		<div class="count-columns">
			<a href="/followers/1-5K">
			  <div class="panel panel-default">
				 <div class="panel-footer">1-5K</div>
			  </div>
			</a>
		 </div>	
 		
		<div class="count-columns">
			<a href="/followers/5-10K">
			  <div class="panel panel-default">
				 <div class="panel-footer">5-10K</div>
			  </div>
			</a>
		 </div>	 		
 		
		<div class="count-columns">
			<a href="/followers/50-100K">
			  <div class="panel panel-default">
				 <div class="panel-footer">50-100K</div>
			  </div>
			</a>
		 </div>	
		
		<div class="count-columns">
			<a href="/followers/100-500K">
			  <div class="panel panel-default">
				 <div class="panel-footer">100-500K</div>
			  </div>
			</a>
		 </div>	
 		
		<div class="count-columns">
			<a href="/followers/500K-1M">
			  <div class="panel panel-default">
				 <div class="panel-footer">500K-1M</div>
			  </div>
			</a>
		 </div>	 		
 		
		<div class="count-columns">
			<a href="/followers/1-5M">
			  <div class="panel panel-default">
				 <div class="panel-footer">1-5M</div>
			  </div>
			</a>
		 </div>	
		
		<div class="count-columns">
		  <a href="/followers/5-10M">
			 <div class="panel panel-default">
				<div class="panel-footer">5-10M</div>
			 </div>
		  </a>
		</div>
		 
		<div class="count-columns">
			<a href="/followers/10M+">
			  <div class="panel panel-default">
				 <div class="panel-footer">10M+</div>
			  </div>
			</a>
		</div>
	
	</div><!-- END: follower-count -->
		
		<div class="clearfix" style="height: 15px;"></div>
	<hr>
<div class="clearfix" style="height: 10px;"></div>


 	<div id="tag-search">
 		
 	 		<h2><a href="#" class="info">Popular Tags <span style="text-transform: none; top: 20px;">View popular users by the hashtag they are associated with.</span><ins class="fa fa-question-circle"></ins></a></h2>

	<div class="clearfix" style="height: 10px;"></div>
 		@include('partials._listing-tags')
 	</div>
 	<div class="clearfix" style="height: 70px;"></div>


 </div>
	</div> 
  --}}
</div>

<div id="network">

  <?php echo Form::open(
    [
      'route' => 'search_users_without_auth',
      'method' => 'GET',
      'class' => 'form-search-users'
    ]
  ); ?>

  {{ csrf_field() }}
    <!-- <div class="all-networks">All Networks</div> -->
  <?php  $social_icons = \Config::get('conservices'); ?>

  <label for="SearchBox" class="choose-net" style="font-size:18px;margin-top: 0px;margin-left:8px;">
    Followback Search
  </label>
{{-- <input id="SearchType" type="hidden" name="searchtype" value="all"> --}}
  <input id="SearchType" type="hidden" name="searchtype" value="users">
  <select id="SearchBox" class="network select-q-type" style="float:right;">
    <option value="">&nbsp; </option>
    <option value="all" data-imagesrc="" data-description="" class="all-network-background" selected>All</option>
  </select>
  <?php echo Form::close(); ?>
</div>