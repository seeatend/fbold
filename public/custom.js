/* 
$(window).load(function(){

    $('.input-search-text').autocomplete("destroy");
    $(".window-loader").fadeOut("slow");

    $('#select2-drop').css({'display':'block'});
    $('#service_type').attr('size',5);

    $('.addthis_button_more').hide();
    $(window.location.hash).show();
    $(window).scrollTop(0);
});
$(document).ready(function(e){ 

	$(".offer-price-focus").keydown(function(event) {
    // Allow only backspace and delete
    if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 ) {
        // let it happen, don't do anything
    }
    else {
        // Ensure that it is a number and stop the keypress
        if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
            event.preventDefault(); 
        }   
    }
});


  $('.top-network').css('display', 'none');
  
  //Bootstrap select2 for select dropdown opion and also autoopen 
  $('#auto-open-select-container .select').select2().one('select2-focus', select2Focus).on("select2-blur", function () {
    $(this).one('select2-focus', select2Focus)
  }).trigger("select2-focus");

  //Bootstrap select2 for select dropdown opion 
  // $('.select').select2();
  $('.select-option').select2()

  
  if (location.hash) {
    setTimeout(function() {

      window.scrollTo(0, 0);
    }, 1);
  }

  $( "#accordion" ).accordion();
  var windowWidth = $(window).width();
  if(windowWidth <= 480)
  {
    $(".accordion").css('display','block'); 
  }  
  $('.help').hover(function(){
    $(this).css('cursor','pointer').tooltip('show');  
  });
  $("body").css({'position':'relative','min-height':'100%'});


  // $('.profile-networks').on('click', function(){
      
  //     var $a = $(this).find('a').attr('href');
  //     alert($a);
  //     return false;
  // }); 
  // for the account sync with.
  var syncHolder = $(".act-sync-with");
  if(syncHolder.length > 0){
     profileSync();
  }

    // for the homepage most search users.
    if($('a.profile-post-link').length > 0){
        $('a.profile-post-link').postlink();
    }
});

// profile sync.
function profileSync(){
    var syncHolder = $(".act-sync-with");
    var url = syncHolder.find(".hold-url").text();
    var connTpl = $("#tpl-sync").html();

    // check profile exists or not.
    var xhr = $.ajax({
        url: url,
        dataType: 'json',
        success: function(res) {
          // on success.
          var user = res.user,
            services = res.services,
            objLen = Object.keys(services).length,
            $html = "";

          if(user > 0 && objLen > 0){
            $.each(services, function($ser, $rec){
              var $href = $className = "";
              if($rec.connected == 1){
                $href = "/" + $ser + "/" + $rec.username + "?idf=" + $rec.identifier +"&img=" + $rec.image;
                $className =  'active';
                $(".icon-sync-"+$ser).attr("href", $href).removeClass('active').addClass($className);
              }
              
              
            });
          }

            //post link
            syncHolder.find('.profile-networks').find('a').postlink();
            // calling again.
            setTimeout(profileSync, 5000);
        }
    });
}

function select2Focus() {
    var select2 = $(this).data('select2');
    setTimeout(function() {
      if (!select2.opened()) {
        select2.open();
      }
    }, 0);  
  }
/* My Chanages */

$(function(e){

  //$('ul.dd-options li:first').css('background', 'red !important');
  //$('ul.dd-options').hide();
  // for search
  $('#search').on('click', function(){
    $('.search').css('z-index', 1);

    $('.search-box .input-header-search-text').css('width', '100%'); 
    $('.search-field').css('width','345px');
    $('.search i').css('color', '#676767');

    $('.search-box').css({'border':'1px solid #cdcdcd', 'overflow': 'visible'});
    $('.search-box .dd-container').css('z-index', 1);
    $('.search-box .dd-container, .search-box .dd-select, .search-box .dd-options, .search-box .header-search-bar').css('width', '120px');
    $('.search-box .dd-container').css('display','inline-block');
    $('.search-box .header-search-bar').css('display','inline-block');
    $('.search-box .header-search-bar').css('width', '120px');
  });

    $('#edit-paypal-email').on('click', function() {
    var text = $(this).attr('data-attr'); 

    if(text == 'edit') {
    
      //$('.paypal-enable-email').prop("disabled", false); 
      $(this).attr('data-attr', 'save');
      
      $('.display-update-email').css('display', 'none');
      $('.paypal-input-box').css('display', 'block !important');
      $('.paypal-input-box').focus();
      
      $(this).text('Save');
      return false;
    } 

  });



  // search contianer

  //search contianer

  $(document).on("click", function (e){ 
      var container = $("#search");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
       
        //if($('#header-network .focusout-loader-contain:hidden').length != 0)
        //{
          $('.search').css('z-index', 0);
          $('.search-box .form-control').css('width', 0);

          $('.search i').css('color', 'inherit');
          $('.search-box').css('background', 'transparent');

          $('.search-field').css('width','26px');
          $('.search i').css('color', 'inherit');
          $('.search-box').css({'border':'1px solid transparent', 'overflow': 'hidden'});

          $('.search-box .dd-container').css('z-index', 0);
          $('.search-box .dd-container, .search-box .dd-select, .search-box .dd-options').css('width', 0);
          $('.search-box .header-search-bar').css('width', 0);
          $('.search-box .dd-container').css('display','none');
          $('.search-box .header-search-bar').css('width', 0);
        //}
      }

      //Hide Container
      
  });
 
  //for switch 
  // $("input[type=checkbox]").switchButton({
  //  on_label: 'Bid',
  //  off_label: 'Pay Now',
    
  // });
  
  //Select active menu tab
  
  // var bidCount = 0 ;
  // $('.bid-btn span').each(function(){
  //     if (this.hasClass('on'))
  //         bidCount++;
  // });

  $('.price-bid-btn').siblings('.form-group').css('height', '40');

  $('.switch-button-label').click(function(){
    var checked  = $(this).find("input").prop('checked', true);
    var bidType = $(this).find("input").attr('data-attr');
    var priceInput = $(this).parents('.bid-col').find('.min-price-input-field');

    var priceInputInEdit = $(this).parents('.bid-col').find('.hide-price-input');

    if($(this).hasClass('on')) {
        //$(this).parents('.bid-col').find('.min-price-input-field').hide();
       
       //Slide back input field
        priceInput.removeClass('display-min-price-input-field');
        priceInput.stop().dequeue().animate({width:0},1000);
        priceInput.val("");
        
        $(this).find("input").prop('checked', false);
        $(this).addClass('off').removeClass("on");
    } else {
        
        //Slide right input field
        priceInput.stop().dequeue().animate({width:280},1000);
        priceInput.addClass('display-min-price-input-field');
        priceInput.focus();
        priceInput.attr('placeholder', 'Your minimum '+bidType+' price');
  
        $(this).parent().find("span").removeClass("on").addClass("off");
        $(this).addClass('on').removeClass("off");
    }

    var $offBtns = $(this).parent().find('span.switch-button-label.off');
    if($offBtns.length > 1) {
        priceInputInEdit.val("");
    }

  });
  //Edit min price input field
  $('.min-price-edit-icon').on('click', function() {
      $(this).closest('.min-price-flat-bar').css('display', 'none');
      var cuurentEditInput = $(this).parent().parent().find('input.hide-price-input');
      cuurentEditInput.removeClass('hide-price-styling');
      cuurentEditInput.focus();
  });

  $('.switch-button-label').addClass('btn');
  // for select.
  // $('.select').select2().on("select2-open", function(e) {
  //   alert("loaded (data property omitted for brevitiy)");
  // });

  $('#network .choose-net').click(function(){
    // $("#network").find(".dd-select").trigger("click");
    // alert("Hellow");
    // $(".dd-pointer .dd-pointer-down").trigger("click");
  });
 
  //$('.notification-checkbox').on('click', function() {

   $('.notification-checkbox').change(function() {
      if($(this).is(":checked")) {
          var a = $(this).attr('data-link');
          //alert(a);
          $('input.notification-checkbox').not(this).prop('checked', false);  
      }
     
  });

 // })
  // $('#network').toggle(function(){
  //  // $(this).find('.dd-click-off-close').css('display', 'block');
  //  // $(this).find('.dd-click-off-close').css('width', '230px');
  // })
  // $('#network').click(function(){
  //  $(this).find('.dd-click-off-close').css('display', 'block');
  //  $(this).find('.dd-click-off-close').css('width', '230px');  
  // });

  // for tab
  $('price-tabs').tab();

  $('#mycarousel').everslider({
    mode: 'carousel',
    itemWidth: 180,
    itemHeight: 250,
    itemMargin: 10,
    moveSlides: 1,
    mouseWheel: true,
    ticker: true,
    tickerTimeout: 2000
  });

  $('.network').ddslick({
    'width' : '180px;',
    'imagePosition': 'left',
   	onSelected: function(data){
    	getHomeSearch($(".input-search-text"));
    }
  });

  $('.top-network').ddslick({
    'width' : '0px',
    'imagePosition': 'left',
    onSelected: function(data){
    	$(".input-header-search-text").trigger('keypress');
    	//$(".focusout-header-search-loader").trigger('click');
    	//getHeaderSearch($(".input-header-search-tex"));
    }
  });

  $('.profile-pic img, .profile-banner').mouseenter(function(){
    $('.tool-tip').css('display','block');
  });
  $('.profile-pic img, .profile-banner').mouseout(function(){
    $('.tool-tip').css('display','none');
  });

  $('.sitemap').click(function(e) {
    e.preventDefault();
    if($(this).text() == 'Sitemap' ) {
      $('.sitemap').html('<span>Close Sitemap</span>');    
    }
    else {
      $('.sitemap').html('<span>Sitemap</span>');       
    }

    $('#sitemap').slideToggle('400', function() {
      adjustFooter();
          // Animation complete.
        });

    $("html, body").animate({ scrollTop: $(document).height() }, 1000);
    adjustFooter();

  });

  // function slimscroll($elm) {

  //   // reset slim scroll.

  //   $elm.slimscroll({
  //     height:'305px',
  //     width:'100%',
  //     disableFadeOut: true,
  //   });
  // }

  $('.dd-option').click(function(){
    
   
    var allNetworkText = $('.dd-selected-text').text();
    if(allNetworkText == 'All'){
     // $('.choose-net').text('');
      //$('.dd-selected-text').text('');
      //$('.dd-selected').css('background-image', 'url(assets/images/icons/network-icon.png)')
      $('.dd-selected-text').text('All');
      $('.choose-net').css('font-size', '11px');
      $('.choose-net').css('margin-top', '12px');
      $('.choose-net').html('&nbsp;');
      $('.choose-net').addClass('add-back-network-image');
      $('.dd-select a').addClass('back-text');
      
    } else {
      $('.choose-net').css('margin-top', '4px');
      $('.choose-net').removeClass('add-back-network-image');
      $('.dd-select a').removeClass('back-text');
      $('.dd-selected').addClass('dd-selected-val');
      $('.choose-net').css('font-size', '11px');

      $('.dd-selected').addClass('temp-setting-ddselected');

      $('.choose-net').text(' ');  
    }
  });
  $('#header-network .dd-option').click(function(){
    
   
    var allNetworkText1 = $('.dd-selected-text').text();
    if(allNetworkText1 == 'All'){
     // $('.choose-net').text('');
      //$('.dd-selected-text').text('');
      //$('.dd-selected').css('background-image', 'url(assets/images/icons/network-icon.png)')
      $('.dd-selected-text').text('All');
      // $('.choose-net').css('font-size', '11px');
      // $('.choose-net').css('margin-top', '12px');
      // $('.choose-net').html('&nbsp;');
      $('.choose-net').addClass('add-back-network-image');
      $('.dd-select a').addClass('back-text');
      
    } else {
      // $('.choose-net').css('margin-top', '4px');
      $('.choose-net').removeClass('add-back-network-image');
      $('.dd-select a').removeClass('back-text');
      $('.dd-selected').addClass('dd-selected-val');
      // $('.choose-net').css('font-size', '11px');

      $('.dd-selected').addClass('temp-setting-ddselected');

      $('.choose-net').text(' ');  
    }
  });

  // Extend the autocomplete widget, using our own application namespace.
  $.widget( "app.autocomplete", $.ui.autocomplete, {

      // The _renderItem() method is responsible for rendering each
      // menu item in the autocomplete menu.
      _renderItem: function( ul, item ) {

        // We want the rendered menu item generated by the default implementation.
        //var result = this._super( ul, item );
        var img;
        if(item.label == "checkUserExistStatus" && item.value == "checkUserExistStatus"){
            return $("<li></li>")
              .data("item.autocomplete", item)
              .append("<label class='no-user-found-auto'>No users found</label>")
              .appendTo(ul);
        }
        else{
          if(item.verified == 1) {
            //img =  "<img src='http://localfollowback.com/assets/images/homepage/logo/home-logo.png' />";
            icon = '<span class="icon-small icon-verified-circle fa fa-check-circle" title="Verified" data-toggle="tooltip" data-placement="right">&nbsp;</span>&nbsp;&nbsp;';
          } else {
            icon = '';
          }
          return $("<li></li>")
          .data("item.autocomplete", item)
          .append("<a><span autosearch-icon class='icon-small1 icon-" + item.type + "'>&nbsp;</span>&nbsp;&nbsp;<img src='" + item.image + "' /><div class='longer-text'>" + item.label + "</div>&nbsp;&nbsp;&nbsp;"+icon+"</a>")
          // .append("<a>" + item.label + "</a>")
          .appendTo(ul);
        }
      }
  });
 
 $("form.stop-submit").submit(function(e) {
    e.preventDefault();
 });
 

  $('.input-search-text').keypress(function(e){

     $('.focusout-loader-contain').removeClass('display-loader-focusout'); 
     var $this = $(this);
     if(e.which == 13) {
        getHomeSearch($this);
     }
     getHomeSearch($this);
  })
 .focusout(function() {
      var input = $('.input-search-text').val();
      if(input.length > 0) {
        //alert("helloo");
         $('.loader-contain').hide();
         $('.loader-contain').removeClass('display-loader-focusout');
         $('.focusout-loader-contain').addClass('display-loader-focusout');
      }     
  });

  //Search for Header
  $('.input-header-search-text').keypress(function(e){

     $('.focusout-loader-contain').removeClass('display-loader-focusout');  
     var $this = $(this);
     if(e.which == 13) {
        getHeaderSearch($this);
     }
     getHeaderSearch($this);
  })
  .focusout(function() {
      
      $('.loader-contain-header').hide();
      $('.slimScrollDiv').hide();
      var input = $('.input-header-search-text').val();
      if(input.length > 0) {
         
         $('#header-network .loader-contain-profile').hide();
         $('#header-network .loader-contain-profile').removeClass('display-loader-focusout');
         $('#header-network .focusout-loader-contain').addClass('display-loader-focusout');
      }     
  });

  //Search for profile page
  $('.input-profile-search-text').keypress(function(e){
     $('.focusout-loader-contain').removeClass('display-loader-focusout'); 
     var $this = $(this);
     if(e.which == 13) {
          getProfileSearch($this);
     }
     getProfileSearch($this);
  })
  .focusout(function() {

      //$('.slimScrollDiv').hide();
      var input = $('.input-profile-search-text').val();
      if(input.length => 0) {
         //alert("helloo");
         $('#profile-network .loader-contain-profile').hide();
         $('#profile-network .loader-contain-profile').removeClass('display-loader-focusout');
         $('#profile-network .focusout-loader-contain').addClass('display-loader-focusout');
      }     
  });

  $('.focusout-home-search-loader').on('click', function() {

      $('.focusout-loader-contain').removeClass('display-loader-focusout');
      var $this = $('.input-search-text');
      $this.focus();
      getHomeSearch($this);
  });

  $('.focusout-profile-search-loader').on('click', function() {

      $('#profile-network .focusout-loader-contain').removeClass('display-loader-focusout');
      var $this = $('.input-profile-search-text');
      $this.focus();
      getProfileSearch($this);
  });

  $('.focusout-header-search-loader').on('click', function(e) {
      
      e.stopPropagation(); // This is the preferred method.

      $('#search').trigger( "click" );
      $('#header-network .focusout-loader-contain').removeClass('display-loader-focusout');
      var $this = $('.input-header-search-text');
      $this.focus();
      getHeaderSearch($this);
  });
  
  $("body").on('click', function() {
      //()'slimScrollDiv'
      $('.slimScrollBar').fadeOut(1);
      //$('.slimScrollBar').hide();
  });

  // for supporting statements references.
  var messageTpl = '<div id="dialog-confirm" title="Copyright" style="display:none;">';
  messageTpl += '<p>Copyright has been obtained for these manuscripts exclusively for your internal training purposes and these are not to be disseminated to any other individual. By clicking \'OK\' you accept this provision and agree not to further disseminate any file. In the event that an external HCP desires a publication contained here, you may provide the full reference or may obtain and provide it to the HCP in accordance with Alcon or ThromboGenics copyright policy for such provision, based on your employer. <br/><br/>Please note that if you are opening the references using an iPad, we recommend that you use GoodReader.';
  messageTpl += '</p></div>';

  if (!$("#dialog-confirm").length)
        $('body').append(messageTpl);

  //Call custom confirm dialog on profile page email change     
  $('.edit-profile-email-button').on('click', function() {  
    var text = $(this).attr('data-attr'); 
    if(text == 'updateemail') {
      var a = customConfirm('Your will be logout after changing E-mail. Are you sure ?', 'profileConfirmDialog')    
    }
    if(text == 'save'){
      return true;
    }
    return false; 
  }) 

  //Custom confirm on price change
  $('.price-reset-btn').on('click', function() {

      customConfirm('This action will be reset your price. Are you sure ?', 'profileResetConfirmDialog')    
      return false; 
     
  }); 
  //Change Password
  $('.change-password-button').on('click', function() {
      var text = $(this).attr('data-attr'); 
      //alert(text); return false;
      if(text == 'changepassword') {
        customConfirm('Your need to logout after changing Password. Are you sure ?', 'profileChangePasswordDialog'); 
      } 

      if(text == 'password'){
        return true;
      }
      return false; 
  });

  //Confirm Box for hide bin in receive box
  $('a.hide-bid-alert').on('click', function(e) {
      //customAlert('Are you sure to hide this bid?', '400');

      var text = $(this).attr('data-attr'); 
      
      if(text == 'stopBidForMe') {
          customConfirm('Are you sure to remove this bid ?', 'booleanCustomCofirm');   
          return false;
      }
  })
  //Validation to check if all fields are empty in Service price and user try to submit
  $('.check-empty-input').click(function(e) {

    var service = $(this).attr('data-attr');
        var isValid = true;
        var i=0;
        $('#'+service+' input[type="text"]').each(function() {
            if ($.trim($(this).val()) != '') {
                i++;  
            } 
        });

        if(i == 0) {
          //alert('Please set a price at least for one task.');
          customAlert('Please set a price at least for one task', '400');
          e.preventDefault(); 
        }
    });    

    
  setTimeout( "$('.flash-errors').fadeOut();",4000 );
  setTimeout( "$('.receive-email-success').fadeOut();",2500 );
  
});

adjustFooter();
$(window).resize(function(){
  adjustFooter();
});

/*****************  Start Custom Message Alert and Condfirm Box *******************/
// function to custom confirm dialog
function customConfirm(msg, callFunction) {
    var ret = false;
    callFunction = callFunction;
    var fun_name = callFunction;
    //alert(fun_name);
    setDialogMsg(msg);
    $("#dialog-msg-container").dialog({
        resizable: true,
        title:'Confirm Message',
        width: 530,
        modal: true,
        zIndex: 1102,
        buttons: {
            OK: function () {
                ret = true;
                $(this).dialog("close");
                window[callFunction](true);
            },
            Cancel: function () {
                ret = false;
                $(this).dialog("close");
                window[callFunction](false);
            }
        },
        create:function () {
            $(this).closest(".ui-dialog").css('background', '#ffffff').addClass("unique-dialog");
            $(this).closest(".ui-dialog").find(".ui-dialog-buttonset").find(':button').addClass("btn btn-default");
    
        }
    });
    return ret;
}

function profileConfirmDialog(value) {

  if(value) {
    $('.display-update-email').css('display', 'none');
    $('.input-email-field').css('display', 'block');
          
    $('.input-email-field').focus();
    $('.edit-profile-email-button').css('margin-top', '0 !important');
    $('.edit-profile-email-button').attr('data-attr', 'save');
    $('.edit-profile-email-button').text('Save');
  } 
  return false;  
}
function profileChangePasswordDialog(value) {

  if(value) {

    $('.edit-password-input-field').css('display', 'block');
              
    $('.edit-password-input-field').focus();
    $('.change-password-button').attr('data-attr', 'password');

  } 
  return false;  
}
function profileResetConfirmDialog(value) {
    if(value) {

      var resetFor = $('.price-reset-btn').attr('data-attr');
      $('<input>').attr({
          type: 'hidden',
          name: 'reset',
          value: 'reset',
      }).appendTo('form.set-min-price-form');

      $('<input>').attr({
          type:  'hidden',
          name:  'reset_type',
          value: resetFor,
      }).appendTo('form.set-min-price-form');
      
      $('form.set-min-price-form')[0].submit();   
    }else {
      return false;
    }

}

function booleanCustomCofirm(value) {
  if(value) {
    
    var url = $('a.hide-bid-alert').attr('href'); 
    $.ajax({
        url: url,
        success: function(res) {
            window.location.href = '/received'; 
        }
    });
    
  } else {
    return true;
  }
  
}
function profileConfirmDialog1(value) {

  if(value) {
    $('.display-update-email').css('display', 'none');
    $('.input-email-field').css('display', 'block');
          
    $('.input-email-field').focus();
    $('.edit-profile-email-button').attr('data-attr', 'save');
    $('.edit-profile-email-button').text('Save');
  } 
  return false;  
}
function confirmBoxCallback(value) {
    if (value) 
        return true;
    return false;;
}
function confirmBoxCallback(value) {
    if (value) 
        return true;
    return false;;
}
// function to close confirmation box.
function closeConfirm() {
    $("#dialog-msg-container").dialog("close");
}
// function for custom alert dialog
function customAlert(msg, width) {
    if(typeof(width)==='undefined') width = 530;

    setDialogMsg(msg);
    $("#dialog-msg-container").dialog({
        resizable: true,
        title:'Alert Message',
        width: width,
        modal: true,
        zIndex: 1102,
        buttons: {
            "OK": function () {
                $(this).dialog("close");
            }
        },
        create:function () {
            $(this).closest(".ui-dialog").css('background', '#ffffff').addClass("unique-dialog");
            $(this).closest(".ui-dialog").find(".ui-dialog-buttonset").find(':button').addClass("btn btn-default");
    
        }
    });
}
// function to set message.
function setDialogMsg(msg) {
    // for supporting statements references.
    $("#dialog-msg-container").remove();
    var messageTpl = '<div id="dialog-msg-container" style="display:none;">';
    messageTpl += '<p>' + msg;
    messageTpl += '</p></div>';
    $('body').append(messageTpl);
}
/**************  End Custom Message Alert and Condfirm Box *******************/
function adjustFooter(){
  if($(window).height() > $('#container').height()  ){
    $('#container').height($(window).height());
    $('#footer').addClass('footer2');
  }else{
    $('#container').css('height','100%');
    $('#footer').removeClass('footer2');
  }
}

function hideLoader() {
  $('.loader-contain').css('display', 'none');
}
function showLoader() {
  $('.loader-contain').css('display', 'block');
}

function hideInnerPageLoader() {
  $('.loader-contain-header').css('display', 'none');
}
function showInnerPageLoader() {
  $('.loader-contain-header').css('display', 'block');
}
function hideProfilePageLoader() {
  $('.loader-contain-profile').css('display', 'none');
}
function showProfilePageLoader() {
  $('.loader-contain-profile').css('display', 'block');
}

function slimscroll($elm) {

  // reset slim scroll.

  $elm.slimscroll({
    height:'305px',
    width:'100%',
    disableFadeOut: true,
  });
}

function getHomeSearch(object) {
  $this = object,
        searchType = $("#network").find('.dd-selected-value').val().toLowerCase(),
        searchURL = $(".form-search-users").attr('action');

      // reset slim scroll.
      var slimScrollDiv = $this.parent().find('.slimScrollDiv');
      if(slimScrollDiv.length > 0){
          //slimScrollDiv.remove();
          slimScrollDiv.hide();
      }


      //$this.autocomplete({
        $this.autocomplete({
            close: function(){
              
              // reset for result.
              $this.autocomplete("destroy");
              $('.slimScrollBar').hide();
              //$this.data().autocomplete.term = null;
            },
            source: function( request, response ) {


              var searchTerm = $this.val().toLowerCase();
              
              if(searchType == 0 || searchType == ""){
                  searchType = 'all';
              }

              var jqXHR = $this.data('jqXHR');
              if(jqXHR)
                jqXHR.abort();

              if(searchType != '' && searchTerm != ''){
                var searchIcon = getSearchIcon(searchType);
                

                // show throbber.
                showLoader();

                $this.data('jqXHR', $.ajax({
                  url: searchURL,
                  data: {q:searchTerm, type:searchType},
                  dataType: 'json',
                  localCache: true,
                  cacheTTL: 1,
                  cacheKey: 'search-' + searchType + '-' + searchTerm,
                  success: function(res) {
                    
                    if(res.valid == true && res.data.length > 0){
                    
                        var data = res.data;
                        response( $.map( data, function( item ) {
                          return {
                            label: item.username,
                            image: item.avatar,
                            id: item.identifier,
                            username: item.username,
                            verified: item.verified,
                            type: item.type
                          }
                        }));
                       

                      var resContainer = $this.parent().find('.ui-autocomplete:first');
                      resContainer.addClass('ui-menu ui-widget ui-widget-content ui-corner-all');
                      
                      slimscroll(resContainer);

                      // for the tool tip.
                      $('[data-toggle="tooltip"]').tooltip();

                    }else{
                      response({
                            label: 'checkUserExistStatus',
                        });
                    }
                    hideLoader();
                  },
                  complete: function(){
                      $this.removeData('jqXHR');
                      hideLoader();
                  }
                }));
              }
            },
            select: function(event, ui){
              
              var item = ui.item;
              if(item != null){
                
                var redirectUrl = '/' + item.type + '/' + item.username + "?idf=" + item.id + "&img=" + item.image;
                var hrefObj = PostLink.parseLink(redirectUrl);
                var $linkForm = PostLink.createPostForm(hrefObj);
                $('body').append($linkForm);
                $linkForm.submit();

                // redirecting to the view bid page.
                //window.location.href = redirectUrl;
              }
            },
            appendTo: '.fb-home-search'
        })
        .autocomplete('search', $this.val()); 

}


function getHeaderSearch(object) {
      $this = object,
          searchType = $("#header-network").find('.dd-selected-value').val().toLowerCase(),
          searchURL = $(".form-search-users").attr('action');

      // reset slim scroll.
      var slimScrollDiv = $this.parent().find('.slimScrollDiv');
      if(slimScrollDiv.length > 0){
          //slimScrollDiv.remove();
          slimScrollDiv.hide();
      }

      $this.autocomplete({
        close: function(){
          // reset for result.
          $this.autocomplete("destroy");
        },
        source: function( request, response ) {

          var searchTerm = $this.val().toLowerCase();
          
          if(searchType == 0 || searchType == ""){
             
              searchType = 'all';
          }

          var jqXHR = $this.data('jqXHR');
          if(jqXHR)
            jqXHR.abort();

          if(searchType != '' && searchTerm != ''){
            var searchIcon = getSearchIcon(searchType);
            

            // show throbber.
            showInnerPageLoader();

            $this.data('jqXHR', $.ajax({
              url: searchURL,
              data: {q:searchTerm, type:searchType},
              dataType: 'json',
              localCache: true,
              cacheTTL: 1,
              cacheKey: 'search-' + searchType + '-' + searchTerm,
              success: function(res) {
                // on success.

                if(res.valid == true && res.data.length > 0){
                   
                    var data = res.data;
                    response( $.map( data, function( item ) {
                      return {
                        label: item.username,
                        image: item.avatar,
                        id: item.identifier,
                        username: item.username,
                        verified: item.verified,
                        type: item.type
                      }
                    }));
                    

                  var resContainer1 = $this.parent().find('.ui-autocomplete');
                  //$this.parent().addClass('inner-search-header');
                  //var resContainer1 = $this.find('#ui-widget-header .ui-autocomplete');
                  //var resContainer1 = $this.closest('.ui-widget-header').find('.ui-autocomplete');
                  resContainer1.addClass('ui-menu ui-widget ui-widget-content ui-corner-all');
                  slimscroll(resContainer1);

                   $('[data-toggle="tooltip"]').tooltip();

                }else{
                  response({
                      label: 'checkUserExistStatus',
                  });
                }
                hideInnerPageLoader();
              },
              complete: function(){
                  $this.removeData('jqXHR');
                  hideInnerPageLoader();
              }
            }));
          }
        },
        select: function(event, ui){
          var item = ui.item;
          if(item != null){
            /*var redirectUrl = '/bid/' + searchType + '/' + item.id +'?avatar=' + item.image + '&username=' + item.value + '&identifier=' + item.id;*/

            //var redirectUrl = '/bid/' + searchType + '/' + item.id +'?avatar=avatar.png' + '&username=' + item.value + '&identifier=' + item.id;
              var redirectUrl = '/' + item.type + '/' + item.username + "?idf=" + item.id + "&img=" + item.image;
              var hrefObj = PostLink.parseLink(redirectUrl);
              var $linkForm = PostLink.createPostForm(hrefObj);
              $('body').append($linkForm);
              $linkForm.submit();
            // redirecting to the view bid page.
            //window.location.href = redirectUrl;
          }
        },
        appendTo: '.ui-widget'
    })
    .autocomplete('search', $this.val()); 
}

function getProfileSearch(object) {

    $this = object,
      searchType = 'instagram',
      searchURL = $(".form-search-users").attr('action');

      
  // reset slim scroll.
  var slimScrollDiv = $this.parent().find('.slimScrollDiv');
  if(slimScrollDiv.length > 0){
      //slimScrollDiv.remove();
      slimScrollDiv.hide();
  }

  $this.autocomplete({
    close: function(){
      // reset for result.
      $this.autocomplete("destroy");
      $('.slimScrollBar').hide();
    },
    source: function( request, response ) {

      var searchTerm = $this.val().toLowerCase();
      
      if(searchType == 0 || searchType == ""){
          searchType = 'all';
      }

      var jqXHR = $this.data('jqXHR');
      if(jqXHR)
        jqXHR.abort();

      if(searchType != '' && searchTerm != ''){
        var searchIcon = getSearchIcon(searchType);
        

        // show throbber.
        showProfilePageLoader();

        $this.data('jqXHR', $.ajax({
          url: searchURL,
          data: {q:searchTerm, type:searchType},
          dataType: 'json',
          localCache: true,
          cacheTTL: 1,
          cacheKey: 'search-' + searchType + '-' + searchTerm,
          success: function(res) {
            // on success.

            if(res.valid == true && res.data.length > 0){
             
                var data = res.data;
                response( $.map( data, function( item ) {
                  return {
                    label: item.username,
                    image: item.avatar,
                    id: item.identifier,
                    username: item.username,
                    verified: item.verified,
                    type: item.type
                  }
                }));
             


              //$('form.temp-add-class').closest()
              var resContainer = $this.parent().find('.ui-autocomplete:first');
              resContainer.addClass('ui-menu ui-widget ui-widget-content ui-corner-all');
              slimscroll(resContainer);

               $('[data-toggle="tooltip"]').tooltip();

            }else{
              response({
                 label: 'checkUserExistStatus',
              });
            }
            hideProfilePageLoader();
          },
          complete: function(){
              $this.removeData('jqXHR');
              hideProfilePageLoader();
          }
        }));
      }
    },
    select: function(event, ui){
      
      var item = ui.item;
      if(item != null){
          $('<input>').attr({
              type: 'hidden',
              name: 'followed_identifier',
              value: item.id,
          }).appendTo('form.create-bid-form');

          $('<input>').attr({
              type: 'hidden',
              name: 'followed_avatar',
              value: item.image,
          }).appendTo('form.create-bid-form');

          $('<input>').attr({
              type: 'hidden',
              name: 'followed_type',
              value: item.type,
          }).appendTo('form.create-bid-form');

          $('<input>').attr({
              type: 'hidden',
              name: 'follow_user_name',
              value: item.username,
          }).appendTo('form.create-bid-form');
      }
    },
    appendTo: '.profile-followback-search'
  })
  .autocomplete('search', $this.val()); 

}
// function to get search icon.
var getSearchIcon = function(type){

  var $res = 'defalut-icon';

  switch(type){
    case 'facebook':
    $res = 'facebook-icon';
    break;
    case 'instagram':
    $res = 'instagram-icon';
    break;
    case 'youtube':
    $res = 'youtube-icon';
    break;
    case 'twitter':
    $res = 'twitter-icon';
    break;
    case 'vine':
    $res = 'vine-icon';
    break;
  }

  return $res;
}

var h = new Image;
h.onload = function(){
   // var flag ='';
    var flag = document.getElementById('flag');
   // console.log(flag); 

    if(flag != null){
      var amp = 10;
      flag.width  = h.width;
      flag.height = (h.height) + amp*2;
      flag.getContext('2d').drawImage(h,0,amp,h.width,h.height);
      // flag.style.marginLeft = (flag.width/2)+'px';
      // flag.style.marginTop  = (flag.height/2)+'px';
      var timer = waveFlag( flag, h.width/3, amp );
    }
};
h.src = '/assets/images/homepage/charity-tag-bg.png';

function waveFlag( canvas, wavelength, amplitude, period, shading, squeeze ){
    if (!squeeze)    squeeze    = 0;
    if (!shading)    shading    = 50;
    if (!period)     period     = 500;
    if (!amplitude)  amplitude  = 10;
    if (!wavelength) wavelength = canvas.width/10;

    var fps = 30;
    var ctx = canvas.getContext('2d');
    var   w = canvas.width, h = canvas.height;
    var  od = ctx.getImageData(0,0,w,h).data;
    // var ct = 0, st=new Date;
    return setInterval(function(){
        var id = ctx.getImageData(0,0,w,h);
        var  d = id.data;
        var now = (new Date)/period;
        for (var y=0;y<h;++y){
            var lastO=0,shade=0;
            var sq = (y-h/2)*squeeze;
            for (var x=0;x<w;++x){
                var px  = (y*w + x)*4;
                var pct = x/w;
                var o   = Math.sin(x/wavelength-now)*amplitude*pct;
                var y2  = y + (o+sq*pct)<<0;
                var opx = (y2*w + x)*4;
                shade = (o-lastO)*shading;
                d[px  ] = od[opx  ]+shade;
                d[px+1] = od[opx+1]+shade;
                d[px+2] = od[opx+2]+shade;
                d[px+3] = od[opx+3];
                lastO = o;
            }
        }
        ctx.putImageData(id,0,0);        
        // if ((++ct)%100 == 0) console.log( 1000 * ct / (new Date - st));
    },5/fps);
}

function footer_height(){
  var hei = $('footer').height();
  $('#wrapper').css('padding-bottom', hei);
}

$(window).resize(function(){
  footer_height();
});
$(document).ready(function(){
  footer_height();
});
