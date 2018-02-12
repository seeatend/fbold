$(document).ready(function() {

    var url = '/'+service+'/'+identifier+'/upload';


    $("#bidUpload").fileapi({
        url: url,
        multiple: !1,
        autoUpload: !0,
        imageAutoOrientation: true,
        imageTransform: {
					rotate: 'auto' 
   			},
        maxSize: FileAPI.MB*100,
        elements: {
            size: ".js-size",
            active: {
                show: ".js-upload",
                hide: ".js-browse"
            },
            progress: ".js-progress"
        },
        accept: "image/*,video/*",
        headers: {
            "X-CSRF-Token": $("input[name=_token]").attr("value")
        },
        onSelect: function (evt, data){
           $('img#theImg').remove(); 
           $('.bid-video').remove();
       },
        onProgress : function(a, b) {
            //disable upload button while processing 
            $('.upload-disable-btn').attr('disabled','disabled');
        },
        onComplete: function(a, b) { 
						//alert(b.files[0].type);
            //var img = '/bids_images/'+b.result;
            if( b.files[0].size > 104857600) {
                $('.error-help').text('Size is too large');
            }
            else if($.inArray(b.files[0].type,['image/jpg','image/png','image/gif','image/jpeg','video/mp4','video/quicktime','video/mpeg','video/flv','video/x-flv']) == -1 ) {
                $('.error-help').text('This format is not supported');   
            }
            else{
                $('.error-help').text('');
                $('.upload-disable-btn').removeAttr('disabled');
                $('#bidUpload .js-browse .btn-txt').css('display','none');
                $('#bidUpload .js-browse .click-pic').css('display','none');
                var img_or_video = '/bids_images/'+b.result;

                //Set array of vaiablr for Image and Video
                var img = [ 'jpg', 'png', 'gif', 'jpeg' ];
                var vid = [ 'mp4', 'mov', 'mpg', 'flv' ];

                //Get File Extention
                var fileName = b.result;
                var fileExtension = fileName.substr((fileName.lastIndexOf('.') + 1));


                $('.profile-box .upload-image img:eq(0)').attr('src',img_or_video).remove();
                $('.js-browse').css('margin-top', '5');

                //Check if extention is image then display Image otherwise Display Video
                if ($.inArray(fileExtension, img) !== -1) { 
                    $('.profile-box .upload-image').prepend('<img id="theImg" src="'+img_or_video+'" height="105"/>')
                } else if($.inArray(fileExtension, vid) !== -1) { 
                
                		
$('.profile-box .upload-image').prepend('<a href="'+img_or_video+'" class="bid-video mediaupload">');
$('.mediaupload').media({ width: 300, height: 175, autoplay: false });

                   
                     
                }
                 
                //Append Input field in crete bid form
                $('<input>').attr({
                  type: 'hidden',
                  name: 'file_temp_name',
                  value: b.result,
                }).appendTo('form.create-bid-form');
                
                //Remove border error is added
                $('#profile .profile-box .comment-container .upload-image').css('border', '1px solid #fff !important');

                

              $('.profile-box .profile-remove-media').css('display', 'block !important');  
          }
        }

    })

    $('.profile-remove-media').on('click', function() {
        $('img#theImg').remove(); 
        $('.bid-video').remove();
        $('#bidUpload .js-browse .btn-txt').css('display','block');
        $('#bidUpload .js-browse .click-pic').css('display','block');
         $('.js-browse').css('margin-top', '78px');
        $('form.create-bid-form').find('input[name="file_temp_name"]').attr('value','');
        $(this).hide();
    });
     
});

