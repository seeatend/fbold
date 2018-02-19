var PostLink = {
	createPostForm: function(hrefObj) {
        var linkForm = document.createElement("form");
        $linkForm = $(linkForm);
        if (hrefObj.url && hrefObj.url.length > 0) {
            $linkForm.attr("action", hrefObj.url);
        }
        $linkForm.attr("method", "post");
        var thisDate = new Date();
        $linkForm.attr("id", "postlinkForm_" + thisDate.getTime());
        var counter=0;
        for (var parmKey in hrefObj.keyPairs) {
            var input = document.createElement("input");
            var $input = $(input);
            $input.attr("id", "postlink_hidden_" + parmKey + counter + "_input");
            $input.attr("type", "hidden");
            $input.attr("name", parmKey);
            $input.attr("value", hrefObj.keyPairs[parmKey]);
            $linkForm.append($input);
        }
        return $linkForm;
    },
	parseLink: function(linkHref) {
        var hrefObj = {
            url: null,
            keyPairs: {}
        };
        if ( linkHref.match(/\?/) ) {
            var urlParts = linkHref.split('?');
            if (urlParts[0] !== "" || urlParts[0] > 0) {
                hrefObj.url = urlParts[0];
            }
            var queryString = urlParts[1];
            var hrefKeyPairs = queryString.split('&');
            while (hrefKeyPairs.length > 0) {
                var keyPair = hrefKeyPairs.shift().split('=');
                hrefObj.keyPairs[decodeURIComponent(keyPair[0])] = decodeURIComponent(keyPair[1]);
            }
        } else {
            hrefObj.url = linkHref;
        }
        return hrefObj;
    }
};

(function($){
	$.fn.postlink = function(options) {
        var defaults = {
            enabled: true,
            debug: true
        };

        var options = $.extend(defaults, options);

        return this.each(function() {
            var $obj = $(this);
            if ( $obj[0].tagName != "A") {
                return;
            }
            $obj.click(function(clickEvent) {
                clickEvent.preventDefault();
                var $link=$(this);
                var href=$link.attr("href");
                var hrefObj = PostLink.parseLink(href);
                var $linkForm = PostLink.createPostForm(hrefObj);
                $('body').append($linkForm);
                $linkForm.submit();
            });
        });        
    };
})(jQuery);