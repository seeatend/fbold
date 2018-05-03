//		Fixed menu=========================

$(document).scroll(function (e) {
		    var scrollTop = $(document).scrollTop();
		    if (scrollTop > 0) {
		        $('.main-header').removeClass('navbar-static-top').addClass('navbar-fixed-top');
		    } else {
		        $('.main-header').removeClass('navbar-fixed-top').addClass('navbar-static-top');
		    }
		});

//smooth scroll=========================================
		$(document).ready(function () {
		    // Add smooth scrolling to all links
		    $("a.ancor").on('click', function (event) {

		        // Make sure this.hash has a value before overriding default behavior
		        if (this.hash !== "") {
		            // Prevent default anchor click behavior
		            event.preventDefault();

		            // Store hash
		            var hash = this.hash;

		            // Using jQuery's animate() method to add smooth page scroll
		            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
		            $('html, body').animate({
		                scrollTop: $(hash).offset().top
		            }, 800, function () {

		                // Add hash (#) to URL when done scrolling (default click behavior)
		                window.location.hash = hash;
		            });
		        } // End if
		    });
		});

//Twitter carousel ================================
		$('.owl-carousel-1').owlCarousel({
		    nav: false,
		    dots: false,
		    autoplay: true,
		    autoplayHoverPause: false,
		    rewind: false,
		    navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
		    loop: true,
		    margin: 10,
		    responsiveClass: true,

		    responsive: {
		        0: {
		            items: 1
		        },
		        768: {
		            items: 4
		        }
		    }
		});
//Product Carosual =================================
		$('.subcategories-scroller-slider').owlCarousel({
		    nav: true,
		    dots: false,
		    autoplay: false,
		    autoplayHoverPause: false,
		    rewind: false,
		    navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
		    loop: false,
		    margin: 10,
		    responsiveClass: true,

		    responsive: {
		        0: {
		            items: 2,
		            nav: false,
		        },
		        480: {
		            items: 2,
		            nav: false,
		        },
		        768: {
		            items: 3,
		            nav: false,
		        },
		        992: {
		            items: 4,
		        },
		        1120: {
		            items: 5,
		            nav: true,
		        }
		    }
		});

//Home banner slider for pc ================================
		var images = ["banner-1.jpg", "banner--2.jpg", "banner-3.jpg", "banner-4.jpg","banner-5.jpg"];
		var holder = ["Search for someone to upload your music video on Instagram", "Search for someone to tweet about your website", "Search for someone to follow your brand on Instagram", "Search for someone to follow you on Twitter","Search for someone to upload your song to Soundcloud "];
		$(function () {
		    var i = 0;
		    $(".banner-background").css("background-image", "url(images/" + images[i] + ")");
		    $('.banner input').attr("placeholder", holder[i]).blur();
		    setInterval(function () {
		        i++;
		        if (i == images.length) {
		            i = 0;
		        }
		        $(".banner-background").fadeOut(500, function () {
		            $(this).css("background-image", "url(images/" + images[i] + ")");
		            $(this).fadeIn(500);
		            $('.banner input').attr("placeholder", holder[i]).blur();
		        });


		    }, 7000);
		});

//Home banner slider for phone=============================
		jQuery(document).ready(function () {
		    if ($(window).width() < 575) {
		        var images = ["banner-1.jpg", "banner--2.jpg", "banner-3.jpg", "banner-4.jpg"];
		        var holder = ["Search for someone to post", "Search for someone to tweet", "Search for someone to follow you", "Search for someone to like a post"];
		        $(function () {
		            var i = 0;
		            $(".banner-background").css("background-image", "url(images/" + images[i] + ")");
		            $('.banner input').attr("placeholder", holder[i]).blur();
		            setInterval(function () {
		                i++;
		                if (i == images.length) {
		                    i = 0;
		                }
		                $(".banner-background").fadeOut(500, function () {
		                    $(this).css("background-image", "url(images/" + images[i] + ")");
		                    $(this).fadeIn(500);
		                    $('.banner input').attr("placeholder", holder[i]).blur();
		                });


		            }, 7000);
		        });
		    }
		});
// Search Container
$('#home-search-input').focus(function () {
	$(this).val(" ");
    $('#search-container').fadeIn();
    $("#search-input").focus();
    $(".wrapper,#wrapper").hide();
    $gate == "open";
}).click(function(){
	$(this).val(" ");
	$gate = "close";
    $('#search-container').fadeIn();
    $("#search-input").focus();
    $(".wrapper,#wrapper").hide();
});

$(".ModalSignup").click(function(){
   $("#LoginModal").modal('hide');
});

$(document).on('a[data-target="#LoginModal"]', 'click', function (e) {
    $signupModal = $('#SignUpModal');
    if ($signupModal.hasClass('in')) {
        $('#LoginModal').css('zIndex', 9999)
    }
});
