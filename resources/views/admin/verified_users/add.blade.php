@extends('layouts.admin')
@section('main_header', 'Verify User')
@section('content')

<div class="row">
	<div class="col-xs-12 padding-20">
		<?php echo Form::open(['route'=>'admin_verify_user','method'=>'GET']); ?>
		<?php $social_icons = Config::get('conservices'); ?>


		<div class="form-group ">
			<div class="controls">
				<label class="control-label" for="type">Social Network Platform</label>

			 	<select class="network form-control" name="type">
	            	@if(!empty($social_icons))
	                     @foreach($social_icons as $social_icon)
	                        <option value="<?php echo $social_icon['identifier']; ?>" <?php echo ($type == $social_icon['identifier']) ? 'selected="selected"' : ""; ?> ><?php echo $social_icon['name']; ?></option>
	                     @endforeach
	                @endif
	            </select>
			</div>
		</div>

		<?php echo Form::field([
			'name' => 'q',
			'label' => 'Search '.$type,
			'placeholder' => 'Account name...',
			'value' => $q
			]); ?>
			<div class="form-group">
				<div class="controls">
					<button class="btn btn-primary" type="submit">Search</button>

				</div>
			</div>
		<?php echo Form::close(); ?>
	</div>
</div>

@if(!empty($results))
	<div class="row">
		<div class="col-xs-12 mlr30">

			@if($results['valid'])

					<?php echo Form::open(['route'=>'admin_post_verify_user', 'class'=> 'post_verify_user']); ?>
					@foreach($results['data'] as $result)

					<div class="admin_most_user_list_and_add_button_conainer">
						<div class="admin_most_user_list_container">
							<?php
								$routeData = $result;
								$routeData['avatar'] = 'avatar.png';
							?>
							<a href="{{route('bid_create',[strtolower($type),$result['identifier']]).'?'.http_build_query($routeData)}}">
								<div class="row user-search-result">
									<div class="admin_most_user_list_avatar"><img src="{{$result['avatar']}}" alt="image" height="60" width="60"></div>
									<div class="description">
										<div class="admin_most_user_name">
											{{{$result['username']}}}
										</div>
										<div class="social-label">
											<span class="{{$type}}-icon search-result-icon"></span>
											{{ucfirst($type)}}
										</div>
									</div>
									<div class="right-arrow"></div>
								</div>
							</a>
						</div>
						<div class="most_user_add_button_container">
							<?php $extClass = (in_array($result['identifier'], $userIdList)) ? 'disabled' : '';	?>
							<button type="button" class="add_verify_user btn btn-primary <?php echo $extClass; ?>" data-id="{{$result['identifier']}}"  data-type="{{ $type }} " data-image="{{ $result['avatar'] }}" data-name="{{$result['username'] }}">Verify </button>
						</div>
					</div>
				@endforeach
				<?php echo Form::close(); ?>
			@else
			No users found.
			@endif
		</div>
	</div>
	@endif

<!-- Most Search User -->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	$('button.add_verify_user').on('click', function() {
		var $this = $(this),
		type = $(this).attr('data-type'),
		image = $(this).attr('data-image'),
		name = $(this).attr('data-name'),
		identifier = $(this).attr('data-id'),
		url = $('.post_verify_user').attr( "action" );

		$.ajax({
		    url : url,
		    type: "POST",
		    data : {
		    	'type'  : type,
		    	'image' : image,
		    	'name'  : name,
		    	'identifier' : identifier,
		    },
		    success: function(res, textStatus, jqXHR)
		    {
		    	if(res.success == 1) $this.addClass('disabled');

		        alert(res.msg);
		    },
		    error: function (jqXHR, textStatus, errorThrown)
		    {
		 		console.log("error");
		    }
		});
	})
})
</script>
@stop


