$(document).ready(function() {

    var url = BASE_PATH+'/bid/youtube/UCcp7Vgsn2pxvz8ogSh3oM_w/upload';//$(".form").attr("action");

    $("#bidUpload").fileapi({
        url: url,
        multiple: !1,
        autoUpload: !0,
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
        onComplete: function(a, b) {
            alert("Image has been uploaded.");
            var img = 'http://followback.dev/bids_images/7FCTSl0ihvn63VWaQSFElXkM.png';
            $('.b-thumb__preview').prepend('<img id="theImg" src="'+img+'" />')
            //"OK" == b.result.status ? window.location.replace(b.result.data.redirect) : toastr.error(b.result.errors[0])
        }
    })
});
//# sourceMappingURL=bidUpload.min.map