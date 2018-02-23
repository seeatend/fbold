@extends('layouts.admin')
@section('main_header', 'Users')
@section('content')
  @include('admin.users.partials.searchBar')

  <table class="table table-striped" style="font-size:12px;">
    <thead>
      <tr>
        <td></td>
        <td>Email</td>
        <td>Image</td>
        <td>Username</td>
        <td>Category</td>
        <td>Tags (separate by comma)</td>
        <td>Followers</td>
        <td>PayPal Email</td>
        <td>Activated</td>
        <td>Email Confirmed</td>
        <td>Created</td>
        <td>Actions</td>
      </tr>
    </thead>
    <tbody>

      <?php
      $page = 0;
      if (isset($_GET['page'])) {
        $page = ($_GET['page'] - 1) * 50;
      }
      $i = 1 + $page;
      ?>
      @foreach($users as $user)

        <tr>
          <td>
            <?php echo $i++; ?>
          </td>
          <td>{{$user->email}}</td>
          <td style="text-align:center;">
            <?php $image = ($user->avatar) ? $user->avatar : $user->avatar; ?>


            <a href="#" style="background: #CCC url(/assets/images/homepage/facebook-avatar.png) center no-repeat; background-size: contain; border-radius: 100px; float: left; height: 50px; width: 50px; overflow: hidden;" class="admin-change-userprofile-image" title="" data-image="{{ $user->avatar }}" data-id="{{ $user->id }}">
            <?php echo HTML::image(
              $user->avatar,
              '',
              array('class' => 'admin_most_search_thumb')
            ); ?>
          </td>
          </a>

          <td>
           <a href="/{{ $user->username }}" target="UserProfile">{{ $user->username }} ({{ $user->id }})</a>
    
            
            
             <?php echo Form::open(['route' => 'do_admin_change_username', 'class'=>'admin-change-username-form']); ?>
                <input class="admin-input-display-username-followback" type="text" value="{{$user->username}}" name="username" style="display:none;width:65px;">
                <input type="hidden" name="userId" value="{{ $user->id }}"/>
                <button class="admin-edit-followback-username btn-normal" data-attr="updateusername">
                  <i class="icon-edit"></i></button>

                <!-- <a class="admin-edit-followback-username" href="#">Edit</a> -->
                <?php echo Form::close(); ?>
              
            
            
            
          </td>
          <td>
            <span class="admin-display-category-followback"><?php echo $user->category; ?></span>

            <?php echo Form::open(['route' => 'do_change_category', 'class'=>'change-category']); ?>
            <select name="category" class="admin-input-display-updatecats-followback" style="display: none;">
              <option value=" ">Select a Category</option>
              <option value="actor">Actor</option>
              <option value="athlete">Athlete</option>
              <option value="brand">Brand</option>
              <option value="ceo">CEO</option>
              <option value="designer">Designer</option>
              <option value="dj">DJ</option>
              <option value="model">Model</option>
              <option value="musician">Musician</option>
              <option value="radio">Radio</option>
              <option value="tv">TV Celebs</option>
              <option value="website">Website</option>
              <option value="writer">Writer</option>
            </select>
            <input type="hidden" name="userId" value="{{ $user->id }}"/>
            <button class="admin-edit-category btn-normal" data-attr="updatecats"><i class="icon-edit"></i></button>

            <?php echo Form::close(); ?>


          </td>
          <td>
            <span class="admin-display-tags-followback"><?php echo $user->tags; ?></span>

            <?php echo Form::open(['route' => 'do_change_tags', 'class'=>'change-tags']); ?>
            <textarea class="admin-input-display-updatetags-followback" name="tags" style="display: none;">
								{{$user->tags}}
							</textarea>
            <input type="hidden" name="userId" value="{{ $user->id }}"/>
            <button class="admin-edit-tags btn-normal" data-attr="updatecats">
              <i class="fa fa-tags"></i></button>

            <?php echo Form::close(); ?>


          </td>
          
    			<td>
    			
    			@foreach($user->socialAccounts as $item)
    			@if(isset($user->socialAccounts))
    			
            <span class="admin-display-category-followback">
           
            
 					{{ $item->reach }} @if($item->reach) Followers @endif
            	
            </span>

            <?php echo Form::open(['route' => 'do_change_reach', 'class'=>'change-reach']); ?>
            <select name="reach" class="admin-input-display-updatecats-followback" style="display: none;">
									<option value="">Select number range</option>
                  			<option value="1-500" 	@if($item->reach == "1-500") selected @endif>1-500</option>
                  			<option value="500-1K" 	@if($item->reach == "500-1K") selected @endif>500-1K</option>
                  			<option value="1-5K" 	@if($item->reach == "1-5K") selected @endif>1-5K</option>
                  			<option value="5-10K" 	@if($item->reach == "5-10k") selected @endif>5-10k</option>
                  			<option value="10-50k" 	@if($item->reach == "10-50k") selected @endif>10-50k</option>
                  			<option value="50-100k" 	@if($item->reach == "50-100k") selected @endif>50-100k</option>
                  			<option value="100-500k" 	@if($item->reach == "100-500k") selected @endif>100-500k</option>
                  			<option value="500K-1M" 	@if($item->reach == "500K-1M") selected @endif>500K-1M</option>
                  			<option value="1-5M" @if($item->reach == "1-5M") selected @endif>1-5M</option>
                  			<option value="5-10M" @if($item->reach == "5-10M") selected @endif>5-10M</option>
                  			<option value="10M+" @if($item->reach == "10M+") selected @endif>10M+</option>
            </select>
            <input type="hidden" name="userId" value="{{ $user->id }}"/>
            <button class="admin-edit-category btn-normal" data-attr="updatecats"><i class="icon-edit"></i></button>

            <?php echo Form::close(); ?>

				@endif
				 @endforeach

          </td>      
          
          
          
          <td>{{$user->paypal_email}}</td>
          <td>{{$user->activated ? 'Yes': 'No'}}</td>
          <td>{{$user->email_verified ? 'Yes': 'No'}}</td>

          <td>{{ date('n/j/Y', strtotime ($user->created_at)) }}</td>
          <td>
            <a class='btn btn-danger admin-del-user' href="{{route('admin_user_delete', $user->id)}}">Delete</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  @include('admin.users.partials.imageUploadPopup')

  {!! $users->render() !!}
@stop

@section('js_include')
  {{asset_javascript('plugins/jquery.fileapi.min.js')}}
  {{asset_javascript('app/register-image-upload.js')}}
@stop
