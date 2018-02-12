$(document).ready(function(){



   var $ = jQuery;

    // Handle Settings page tabs
    var $toggles = $('#settings-toggle [role="tab"]');
    $toggles.on('click', function (e) {
       var $this = $(this);
        var container = $this.data('toggle');
        $toggles.removeClass('active');
        $this.addClass('active');
        $('#settings-tab, #blocked-tab').hide();
        $('#' + container).fadeIn();
    });

    // Handle bids instructions modal
    $('.show-instructions').on('click', function (e) {
        e.preventDefault();
        var $instructions = $(this).closest('.task_inner').find('.hidden-social-tasks');
        var $trigger = $('#instructions-modal-trigger');
        var $modalContent = $('#ins-modal-content');

        $modalContent.html($instructions.html());
        $trigger.trigger('click');
    });

    $('.accept').on('click', function (e) {
        var $this = $(this);
        var href = $(this).attr('href');
        var $message = $(this).attr('data-message');
        if ($message != "" && $message != null) {
            var param = [href, $this];
            customConfirmWithParamYesNo($message, 'passObjectAndParam', param);
            return false;
        } else {
            return;
        }
    });

if(sessionStorage.getItem("email") == "sent"){
	$(".resend-confirmation-message").hide();
}

$(".SendMail").click(function(){
	sessionStorage.setItem("email","sent");
	$(".resend-confirmation-message").fadeOut(600);

});
	
$('#homepage_video_play_btn').on('click', function (e) {
	e.preventDefault();
	jQuery('#video_overlay,#video_thumbnail').fadeOut(300,function () {
	jQuery('#homepage_video .embed-responsive video').get(0).play()
});

});

$(".embed-responsive-item").on('click', function (e) {
	e.preventDefault();
	jQuery('#video_overlay,#video_thumbnail').fadeIn(300,function () {
	jQuery('#homepage_video .embed-responsive video').get(0).pause()
});

});


$('#mobile_profileTabs').on('change', function (e) {
    jQuery('.nav.nav-tabs li a').eq(jQuery(this).val()).tab('show'); 
});

$(".profile_verified").click(function(){
	
	$(".popup-overlay").fadeIn(300);
	return false;

});

$(".popup-close").click(function(){
	
	$(".popup-overlay").fadeOut(300);
	return false;

});

	

/*  Remove Modal Window on Click 
-------------------------------------------------*/

	$(".ModalSignup").click(function(){
		$("#LoginModal").modal('hide');
	});

	$(".ModalLogin").click(function(){
		$("#SignUpModal").modal('hide');
	});
	


/*  Sing Up and Login buttons 
-------------------------------------------------*/

function clickThrottled(fn) {
  var click = true;
  return function () {
    if(click) {
      click = false;
      fn.apply(this, arguments);
      setTimeout(function () { click = true;   $('#sign_up .btn-primary').html("Sign up");  }, 1000);
    } else {

   	 $('#sign_up .btn-primary').html("checking...");
    
    }
  };
}

$('#sign_up .btn-primary').click(clickThrottled(function () {
	 $('#sign_up .btn-primary').html("checking...");
 	$('#sign_up').submit();
}));

function clickThrottleLogin(fn) {
  var click = true;
  return function () {
    if(click) {
      click = false;
      fn.apply(this, arguments);
      setTimeout(function () { click = true;   $('#login .btn-primary').html("Log in");  }, 1000);
    } else {
    
   	 $('#login .btn-primary').html("logging in...");
    
    }
  };
}

$('#login .btn-primary').click(clickThrottleLogin(function () {
	 $('#login .btn-primary').html("logging in...");
 	$('#login').submit();
}));

$(".profile-headline").focus(function(){
	$("#about-actions").fadeIn();
	$id = $(this).find("input[type=text]").attr("data-id");
	$(this).parent().find(".checker").html("<input type='hidden' name='id' value='"+$id+"'>");
	$(".btn-about_cancel").click(function(){ $("#about-actions").fadeOut(); return false; });
	return false;
});

$(".profile-headline").focus(function(){
	$("#about-actions").fadeIn();
	$id = $(this).attr("data-id");
	$value = $(this).attr("data-value").trim();
	$(this).parent().find(".checker").html("<input type='hidden' name='id' value='"+$id+"'>");
	$(".btn-about_cancel").click(function(){ 
		$("#about-actions").fadeOut(); 
		$(".profile-headline").val($value);
		return false;
	 });
	return false;

});
 
 $(".profile-reach-select").on("change",function(){
 	$id = $(this).attr("data-id");
 	$value = $(this).attr("data-value").trim();
 	
 	if($value != $(".profile-reach-select").find("option:selected").val()){
 		$("#reach-actions").fadeIn();
		$(this).parent().find(".checker").html("<input type='hidden' name='id' value='"+$id+"'>");
 		$(".btn-reach_cancel").click(function(){  $(".profile-reach-select").val($value).change(); $("#reach-actions").fadeOut(); return false; });
	} else {
		$("#reach-actions").fadeOut(); 
	}
	return false;
 });
 
 $(".info").on("mouseover",function(){

 	$(this).find("span").show();
 	
 }).on("mouseleave",function(){ $(this).find("span").hide(); });

if($('.profile-headline').length){
 	//show inital value on page load
	$('.profile-headline').keyup(function() {
		 countChar(this, 100, '.charNum'); //set up on keyup event function
	});
}
 
function countChar(inobj, maxl, outobj) {
    var len = inobj.value.trim().length;
    var msg = '';
    if (len >= maxl) {
        inobj.value = inobj.value.substring(0, maxl);
        $(outobj).text(0 + msg);
    } else {
        $(outobj).text(maxl - len + msg);
    }
}

 
 /* Social Media Update 
 -----------------------------*/
if( $(".social-update").length ){
 $(".social-update").on("submit",function(){
  	$data = $(this).find("input[type=text]").attr("data-value");
  	$newdata =  $(this).find("input[type=text]").val();
 	$id = $(this).find("input[type=text]").attr("data-id");
	$(this).find(".checker").html("<input type='hidden' name='id' value='"+$id+"'>");
 	if($data != $newdata) { 
 		$form = $(this).parent();
 		if($form.find("input[type=text]").attr("data-gate") == "submit"){
 			return true;
 		} else {
 		$form.find(".social-confirm").fadeIn();
 		$form.find(".social-confirm .social-yes").on("click",function(){ 
 			$form.find("input[type=text]").attr("data-gate","submit");
 			$form.find("form").submit(); 
 			$form.find(".social-confirm").hide();
 			$form.find(".social-save").removeClass("active");
 			return true; 
 		});
 		$form.find(".social-confirm .social-cancel").on("click",function(){ 
 			$form.find(".social-confirm").hide(); 
 			$form.find("input[type=text]").val($data);
 			return false; 
 		}); 		
 		return false; 
 		}
 	} else { return false; }
 });
 $.mask.definitions['x'] = "[A-Za-z0-9_-]";
 $.mask.definitions['a'] = "";
 $(".do_update_twitter input").mask("https://www.twitter.com/xx?xxxxxxxxxxxxxxxxx",{placeholder:" "}).focus(function(){
	$(this).attr("placeholder","https://www.twitter.com/username");
}).blur(function(){
	$(this).attr("placeholder","twitter");
});
$(".do_update_googleplus input").mask("https://plus.google.com/+xx?xxxxxxxxxxxxxxxxx",{placeholder:" "}).focus(function(){
	$(this).attr("placeholder","https://plus.google.com/+username/posts");
}).blur(function(){
	$(this).attr("placeholder","google+ url");
});
 $(".do_update_instagram input").mask("https://www.instagram.com/xx?xxxxxxxxxxxxxxxxx",{placeholder:" "}).focus(function(){
	$(this).attr("placeholder","https://www.instagram.com/username");
}).blur(function(){
	$(this).attr("placeholder","instagram");
});
$(".do_update_linkedin input").mask("https://www.linkedin.com/in/xx?xxxxxxxxxxxxxxxxx",{placeholder:" "}).focus(function(){
	$(this).attr("placeholder","https://www.linkedin.com/in/username");
}).blur(function(){
	$(this).attr("placeholder","linkedin");
});
$(".do_update_youtube input").mask("https://www.youtube.com/user/xx?xxxxxxxxxxxxxxxxx",{placeholder:" "}).focus(function(){
	$(this).attr("placeholder","https://www.youtube.com/user/username");
}).blur(function(){
	$(this).attr("placeholder","youtube");
});
$(".do_update_facebook input").mask("https://www.facebook.com/xx?xxxxxxxxxxxxxxxxx",{placeholder:" "}).focus(function(){
	$(this).attr("placeholder","https://www.facebook.com/username");
}).blur(function(){
	$(this).attr("placeholder","facebook");
});
$(".do_update_soundcloud input").mask("https://soundcloud.com/xx?xxxxxxxxxxxxxxxxx",{placeholder:" "}).focus(function(){
	$(this).attr("placeholder","https://soundcloud.com/username");
}).blur(function(){
	$(this).attr("placeholder","soundcloud");
});
$(".do_update_web input").focus(function(){
	$(this).attr("placeholder","http://www.yourdomain.com/");
}).blur(function(){
	$(this).attr("placeholder","website url");
});


$(".social-update").find("input[type=text]").keypress(function(){
	$data = $(this).attr("data-value");
  	$newdata =  $(this).val();
  	$id = $(this).attr("data-id");
  	if($data != $newdata) { 
  		$(this).parent().find(".social-save").addClass("active");
  	} else {
  		$(this).parent().find(".social-save").removeClass("active");  	
  	}

});

$(".social-save").on("click",function(){

	return false;
	
});

$(".social-update").find("input[type=text]").on("blur",function(){
 	$data = $(this).attr("data-value");
  	$newdata =  $(this).val();
  	$id = $(this).attr("data-id");
  	if($data != $newdata) { 
  		//alert($data+" "+$newdata);
  		$(this).parent().find(".social-confirm").fadeIn();
  		$(this).parent().find(".social-save").addClass("active");
  		$form = $(this).parent();
  		//alert($form.attr("class"));
  		$form.find(".social-confirm .social-yes").on("click",function(){ 
 			$form.find("input[type=text]").attr("data-gate","submit");
 			$form.submit(); 
 			$form.find(".social-confirm").hide();
 			$form.find(".social-save").addClass("active");
 			return true; 
 		});
 		$form.find(".social-confirm .social-cancel").on("click",function(){ 
 			$form.find(".social-confirm").hide();
 			$form.find(".social-save").removeClass("active") 
 			$form.find("input[type=text]").val($data);
 			return false; 
 		}); 		
  		
  		return false; 
  	} else { 
  		$(this).parent().find(".social-save").removeClass("active");
  		return false; 
  	}
 
 });
}

$(".submenu").click(function(){

	if($(this).hasClass("on")){
		$(this).removeClass("on");
		$(".submenu-item").removeClass("on");
		
		
	} else {
	
		$(this).addClass("on");
		$(".submenu-item").addClass("on");
		
	
	}
	return false;

});



});



