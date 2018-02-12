<div class="register-content" style="display:none;">
	
	<div class="loader-contain">
		<div class="search-loader"></div>
	</div>
	<div class="row container login-container" style="width:100%;text-align:center;"> 

		<div class="register-image-box col-md-4" style="padding:15px 0;width:100%;">
			<?php echo Form::open(
				[
					'route' => ['do_update_profile_image'], 
					'class' => 'save-reg-profile-img-form admin-append-followback-image'
				]); ?>
										
				<div class="reg-profile-image-container">
					<img style="height:140px; width:140px; border-radius:50%;" src="/assets/images/homepage/default-user.png">
					<div class="register-loader-contain" style="background:transparent;z-index:9999;positions:absolute">
				        <div class="reg-img-search-loader"></div>
				    </div>
				</div>
				<p style="text-align:center;"><span class="display-username"></span></p>
				
				<div class="col-md-12 right-col js-fileapi-wrapper btn-large upload-image" id="regProfileUpload" style="padding:0px;display:block;">
				                            
	                <div class="js-browse" style="text-align:center;">
	                    <input class="click-pic custom-browse-button btn btn-blue" title="Add profile photo" type="file" name="file">
	                </div>

	            </div> 

				<input type="hidden" name="avatar" value="{{ Config::get('otherconstants')['FOLLOWBACK_DEFAULT_IMAGE'] }}">
				<button class="btn btn-primary admin-upload-followback-image" style="display:none">Upload</button>
			<?php echo Form::close() ?>	
		</div>
	</div>
	
	
	
</div>

