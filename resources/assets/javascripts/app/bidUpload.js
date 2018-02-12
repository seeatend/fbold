$(document).ready(function(){

    // var formUrl = $('.form').attr('action');
    var formUrl = 'http://followback.dev/bid/youtube/UCwZt4_krQTUg2bb4WNwaHww/upload';

    console.log($('#bidUpload'));
    $('#bidUpload').fileapi({
        url: formUrl,
        multiple: false,
        autoUpload: true,
        elements: {
            size: '.js-size',
            active: { show: '.js-upload', hide: '.js-browse' },
            progress: '.js-progress'
        },
        accept: "image/*,video/*,video/mp4",
        headers: {
            "X-CSRF-Token": $('input[name=_token]').attr('value')
        },
        onComplete:function(evt, uievt){
            if(uievt.result.status == 'OK'){
               // window.location.replace(uievt.result.data.redirect);
            }
            else{
                toastr.error(uievt.result.errors[0]);
            }
        }
    });
});