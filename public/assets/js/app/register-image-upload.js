$(document).ready(function() {

   var url = '/settings/upload-profile-pic';

    $("#regProfileUpload").fileapi({
        url: url,
        multiple: !1,
        autoUpload: !0,
        imageAutoOrientation: true,
        imageTransform: {
					rotate: 'auto' ,
					maxWidth: 400,
        			maxHeight: 400,
        			type: 'image/jpeg',
    				quality: 0.70 
   			},
        elements: {
            size: ".js-size", 
            progress: ".search-loader"
        },
        accept: "image/*",
        headers: {
            "X-CSRF-Token": $("input[name=_token]").attr("value")
        },
        onProgress : function(a, b) {
            $('.register-loader-contain').show();
            $('.js-browse').show();
            //console.log("On Progress Register");
        },
        onComplete: function(a, b) {
            
             //Display Upload button which is used in admin panel
            $('.admin-upload-followback-image').show();
            var img = '/bids_images/'+b.result;
            $('.upload-image img:eq(0)').attr('src',img).remove();
            $('.js-browse').css('margin-top', '5');
            $('#theImg').hide();
            $('.reg-profile-image-container > img').attr('src', img);
            $('.register-loader-contain').hide();
            
            //Remove border error is added
            $('#profile .profile-box .comment-container .upload-image').css('border', '1px solid #fff !important');
            $('form.save-reg-profile-img-form').find("input[name='avatar']").val(img); 
           
            //Append input field set its value image name(b.result)
            // $('<input>').attr({
            //   type: 'hidden',
            //   name: 'file_temp_name',
            //   value: img,
            // }).appendTo('form.save-reg-profile-img-form');

           $('a.remove-profile-pic').css('display', 'block !important');  
           
          
           

           //Remove Disable attibut from register's NEXT form
           $("button.save-reg-profile-img-btn").removeAttr('disabled');
        }

    })

    $('.remove-profile-pic').on('click', function() {
        //$('img#theImg').remove(); 
        $('.prof-pic').children('img').attr('src', '/assets/images/homepage/default-user.png');
        $(this).hide();
    });
});
