    <!--    /*====================== main-footer  =============================*/-->
    <footer class="main-footer">
        <div class="footer-top">
            <div class="container">
                <div class="row flex">
                    <div class="col-md-3 col-sm-6 col-ss-6 col-xs-12">
                        <div class="widget">
                            <h3>Categories</h3>
                            <ul class="list">
                                <li><a href="/sort/musician">Musicians</a></li>
                                <li><a href="/sort/radio">Radio Hosts</a></li>
                                <li><a href="/sort/tv">TV Personalities</a></li>
                                <li><a href="/sort/dj">DJs</a></li>
                                <li><a href="/sort/athlete">Athletes</a></li>
                                <li><a href="/sort/model">Models</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-ss-6 col-xs-12">
                        <div class="widget">
                            <h3>Support</h3>
                            <ul class="list">
                                <li><a href="javascript:void(0);" onclick="olark('api.box.expand')">Contact Support</a></li>
                                <li><a href="/trust">Trust & Safety</a></li>
                                <li><a href="/verify">How to get Verified</a></li>
                                <li><a href="/buyer-faq"> Requesting FAQ</a></li>
                                <li><a href="/seller-faq">Monetizing FAQ</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-ss-6 col-xs-12">
                        <div class="widget">
                            <h3>Company</h3>
                            <ul class="list">
                                <li><a href="/about">About Us</a></li>
                                <li><a href="#">Press & News</a></li>
                                <li><a href="/terms-of-service">Terms of Services</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-ss-6 col-xs-12">
                        <div class="widget">
                            <h3>Community</h3>
                            <ul class="list">
                               <li><a href="become-seller">Become a Monetizer </a></li>
                                <li><a href="http://blog.followback.com" target="_blank">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--        /*====================== footer-bottom  =============================*/-->
        <div class="footer-bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="footer-logo">
                            <a href="#" class="logo"><img src="images/footer-logo.png" alt=""></a>
                            <span class="copy">&copy; Followback, Inc.</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12 text-right footer-icon">
                        <a target="_blank" href="http://instagram.com/followback_com"><i class="fab fa-instagram"></i></a>
                        <a target="_blank" href="http://twitter.com/followback"><i class="fab fa-twitter"></i></a>
                        <a target="_blank" href="http://snapchat.com/add/followback.com"><i class="fab fa-snapchat-ghost"></i></a>
                        <a target="_blank" href="http://linkedin.com/company/followback"><i class="fab fa-linkedin"></i></a>
                        <a target="_blank" href="http://giphy.com/followback"><i class="far fa-file"></i></a>
                        <a target="_blank" href="http://medium.com/@followback"><i class="fab fa-medium"></i></a>
                        <a target="_blank" href="https://dribbble.com/Followback"><i class="fab fa-dribbble"></i></a>
                        <a target="_blank" href="https://www.uplabs.com/followback"><img src="images/up.png" alt=""></a>
                        <a  target="_blank"href="https://www.producthunt.com/@followback"><img src="images/p.png" alt=""></a>
                        <a target="_blank" href="https://www.buzzfeed.com/followback"><img src="images/buz.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="/marketing/js/jquery.js" type="text/javascript"></script>
    {{-- <script src="/marketing/js/bootstrap.min.js" type="text/javascript"></script> --}}
    <script src="/marketing/js/owl.carousel.min.js" type="text/javascript"></script>
    <script src="/marketing/js/custom.js?v=1.2" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('assets/js/site.js')}}?v=1.4"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/main.js')}}"></script>
    <script>
        function show_menu(){
            $('.menudown').toggle();
        }
        function show_menu_mobile(){
            $('.logout_i').toggle();
        }

        function searchModal(type){
                $(this).val(" ");
                $('#search-container').fadeIn();
                $("#search-input").focus();
                $(".wrapper,#wrapper").hide();
                $(".main-footer").hide();

                    $('.default').show();

                    $('.normal').hide();
                if(type === "video"){
                    $('.video').hide();
                }else{
                    $('.video').show();
                }
            if(type === "health"){
                $('.health').hide();
            }else{
                $('.health').show();
            }


        }
    </script>

    <script>
        $(".remove-alert").on('click', function () {
            $(".flash-errors").hide();
        });

    </script>

</body>

</html>