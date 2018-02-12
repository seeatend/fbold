$(document).ready(function(){

	var hideLoader = function () {
	  $('.loader-contain').css('display', 'none');
	}

	var showLoader = function () {
	  $('.loader-contain').css('display', 'block');
	}

	$(".login-form-colorbox").colorbox({
    	inline:true,
    	href:".login-content",
    	width:"340px",
    	height:"420px",
    	maxWidth: "95%",
        maxHeight: "95%",
    	scrolling:false,
    	speed:5,
    	fixed:true,
    	onOpen:function(test,t){
    		$('.login-content').find('.help-block').remove();
			$(".has-error").removeClass("has-error");
			$(".input-search-text").blur();
			is_continue = 'NO';
    	}
    });

    $(".register-form-colorbox").colorbox({
    	inline:true,
    	href:".register-content",
    	width:"340px",
    	height:"550px",
    	maxWidth: "95%",
        maxHeight: "95%",
    	scrolling:false,
    	speed:5,
    	fixed:true,
    	onOpen:function(test,t){
    		$('.register-content').find('.help-block').remove();
    		$(".input-search-text").blur();
			$(".has-error").removeClass("has-error");
    	},

    });

    $(".colorbox-setting-link").colorbox({

    	width:"1150px",
    	height:"450px",
    	scrolling:true,
    });

    $(".accept-popup-donation").colorbox({
    	inline:true,
    	href:'#donation-container',
    	width:"1165",
    	height:"380",
    	maxWidth: "95%",
        maxHeight: "95%",
    	scrolling:false,
    	onComplete:function(test,t){
    		var accept_url = $(this).prev("a.hidden_bid_id:first").attr('href');

    		var bid_amount = $(this).next("input.hidden_bid_amount:first").val();
    		//alert(bid_id);
    		$('.donation-skip').attr('href',accept_url);
    		$('.bid-amoount').text(bid_amount);
    	}
    });
    $('.select-cherity-input').on('click', function() {
    	var charity_name = $(this).attr('data-src');
    	$('.donate-selected-charity').text(charity_name);
    })
    //Check Login Form functionality
    $("#login").submit(function( event ) {

	   var $this = $(this);
	   var email = $('#login').find('input[name="email"]').val().trim();
		var url   = $('form#login').attr('action');

	    $.ajax({
		    url : url,
		    type: "POST",
		    dataType: 'json',
		    beforeSend: function(request) {
		    	showLoader();
		        return request.setRequestHeader('X-CSRF-Token', $("meta[name='token']").attr('content'));
		    },
		    data: $('#login').serialize(),
		    success: function(data) {

		    	/**
		    	  * If user login successfully then set is_continue = 'YES'
		    	  * This is only used for profile page, When user click on Continue button
		    	*/
		    	is_continue = 'YES';

		    	hideLoader();
		     	if(data.success == true) {
		     		console.log("Auth Success"+data);

         			//Remove error message if previous exists
         			$('.auth-fail-error').hide();

         			//Update menu bar (only till redirect)
         			//$('.logout-menu-ajax').css('display', 'none');
         			$('.ajax-logout-menu,.signup').remove();
         			$('.ajax-login-menu').css('display', 'block');
         			//$('.login-menu-ajax').show();

         			//var disEmail = email.slice(0, 5)+'...@'+email.substr(email.indexOf("@") + 1);
         			//var disEmail = email.slice(0, 12);
         			//$('.menu-display-username').text(disEmail);


         			//update hidden field value to make continuee button work in profile page
         			$('#is_login').val('login');

         			$('.auth-success-message').css('display', 'block');

         			//Display bubble
         			var url = $('a.hide-bid-alert').attr('href');
				    $.ajax({
				        url: '/count-bubble',
				        success: function(res) {
				        		//alert(JSON.stringify(res));
				        	 	$('.Avatar .profile-avatar').css({'background-image':'url('+res.avatar+')'});
				        	 	$('.profile-username').html(res.username);
				            if (parseInt(res.totalReceieveCount) != 0) {
				            	$('.socialtask-num').html(res.totalReceieveCount);
				            } else {
				            	$('.socialtask-num').remove();
				            }
				        }
				    });

         			$('#login').hide();
         			$('.form-login-heading').hide();
         			$('.auth-success-message').text('You have been logged in successfully');
         			setTimeout(function() { $(".auth-success-message").hide(); }, 2500);
         			$('#login').find('input').val('');
         			setTimeout(parent.$.colorbox.close, 2500);

         			//Trigger submit to create bid form (It will work only in profile page)
         			if(typeof $('form.create-bid-form')[0] != 'undefined' && is_continue == 'YES') {
			    		$('form.create-bid-form')[0].submit();
			    	}
		     	} else {
		     		$('.auth-fail-error').css('display', 'block');
		     		$('.auth-fail-error').text(data.errors.login);
		     		$('#login').find('input[name="password"]').val('');
		     		return false;
		     	}
		    },
		});
		return false;
	});

	//Check Register Form functionality
    $("#register-form-box").submit(function( event ) {

	    var $this = $(this);
	    $this.find('input:text').each(function(){
            $(this).val($.trim($(this).val()));
       });
		 var url   = $('form#register-form-box').attr('action');


	    $.ajax({
		    url : url,
		    type: "POST",
		    dataType: 'json',
		    beforeSend: function(request) {
		    	showLoader();
		        return request.setRequestHeader('X-CSRF-Token', $("meta[name='token']").attr('content'));
		    },
		    data: $('#register-form-box').serialize(),
		    success: function(data) {

		    	/**
		    	  * If user register successfully then set is_continue = 'YES'
		    	  * This is only used for profile page, When user click on Continue button
		    	*/
		    	is_continue = 'YES';

		    	hideLoader();
		     	if(data.success == true) {
		     		console.log(data);
		     		//Remove previous error if any exist
		     		$('.error-email-address').hide();
		     		$('.error-password-match').hide();

		     		// $('.auth-success-message').css('display', 'block');
         		// $('.auth-success-message').text('You have been registered successfully. A confirmation link has been send to '+data.user.email+' from followback.com');
         		// setTimeout(function() { $(".auth-success-message").hide(); }, 3000)

         			/*  Hide Logout menu and display Login menu */
         			$('.ajax-logout-menu').remove();
         			$('.ajax-login-menu').css('display', 'block');

         			//Display Bubble Count
         			//Display bubble
         			var url = $('a.hide-bid-alert').attr('href');

				    $.ajax({
				        url: '/count-bubble',
				        success: function(res) {

				        	$('.Avatar .profile-avatar').css({'background-image':'url('+res.avatar+')'});
				        	$('.profile-username').html(res.username);
				            if (parseInt(res.totalReceieveCount) != 0) {
				            	$('.socialtask-num').html(res.totalReceieveCount);
				            } else {
				            	$('.socialtask-num').remove();
				            }
				        }
				    });

         			$('#register-form-box').find('input').val('');

         			$('.register-form-box').hide();
         			$('.register-image-box').show();
         			$('.register-image-box').find('#regProfileUpload').show();
         			$('.display-username').text(data.user.username);

         			//$('.register-success-msg').find('.show-followback-profile-link').attr('data-id', data.user.id);
         			//$('.register-success-msg').find('.show-followback-profile-link').attr('data-avatar', data.user.avatar);
         			$('.show-followback-profile-link').attr('data-id', data.user.id);
         			$('.show-followback-profile-link').attr('data-avatar', data.user.avatar);

         			//setTimeout(parent.$.colorbox.close, 3000);
		     	} else {

		     		if(typeof data.errors.email !== 'undefined') {

		     			$('.error-email-address-user').css('padding', '4px 5px');
		     			$('.error-email-address-user').show();
		     			$('.error-email-address-user').html(data.errors.email);

		     		}
		     		if(typeof data.errors.username !== 'undefined') {
		     			$('.error-email-address').show();
		     			$('.error-email-address').text(data.errors.username);
		     		}
		     		if(typeof data.errors.password !== 'undefined') {
		     			$('.error-email-address').show();
		     			$('.error-email-address').text(data.errors.password[0]);
		     		}
		     		$('#login').find('input[type="password"]').val('');
		     		return false;
		     	}

		    },
		    error: function(error) {
		    	console.log()
		    }

		});
		return false;
	});

	//Hide Registrer form box and move to next screen(Image Upload)
	$('.skip-register-image-box').on('click', function() {
		//$('#bidUpload').css('display', 'block !important');
		$('.register-image-box').hide();
		$('.register-sync-acc-box').show();
	});

	//Save Profile image while registration and move to next screen(Sync account)
	$('.save-reg-profile-img-btn').on('click', function(event) {

		var uploadImgUrl = $('form.save-reg-profile-img-form').attr('action');
		var myData = $('form.save-reg-profile-img-form').serialize();

		//console.log(uploadImgUrl);

		$.ajax({
		  type: "POST",
	      url: uploadImgUrl,
	      data: myData,
	      success: function(res) {
            	$('.register-image-box').hide();
				$('.register-sync-acc-box').show();
	      }
	    });
		event.preventDefault(); /*  Stops default form submit on click */
	});

	$('.skip-register-sync-acc-box').on('click', function() {
		//$('.register-sync-acc-box').hide();
		//$('.register-success-msg').show();
		//$('.auth-success-message').css('display', 'block');
	});

	//Close register popoup
	$('.reg-done-process').on('click', function() {
    	if(typeof $('form.create-bid-form')[0] != 'undefined' && is_continue == 'YES') {
    		$('form.create-bid-form')[0].submit();
    	}
    	setTimeout(parent.$.colorbox.close, 100);
    	//location.reload();
    });
	$('a.show-followback-profile-link').on('click', function() {
		setTimeout(parent.$.colorbox.close, 100);
        var url   = $('a.chk-user-social-acc').attr('href'),
        	type  = "followback",
        	id    = $(this).attr('data-id'),
        	image = $(this).attr('data-avatar');

	    $.ajax({
	      url: url,
	      data: {
	        type : type,
	        identifier : id
	      },
	      success: function(res) {
            var redirectUrl = '/' + res + "?idf=" + id + "&img=" + image;

            var hrefObj = PostLink.parseLink(redirectUrl);
	        console.log(hrefObj);
	        var $linkForm = PostLink.createPostForm(hrefObj);
	        $('body').append($linkForm);
	        $linkForm.submit();
	      }
	    });
	});
});