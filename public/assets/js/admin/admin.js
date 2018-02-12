$(document).ready(function(e){ 
	//view button
	$(".View").hover(function(){ $(this).find("div").fadeIn(); },function(){ $(this).find("div").hide(); });

if($(".StickyTable").length){	$(".StickyTable").stickyTableHeaders(); }
	
	
	//Confirm Box for hide bib in receive box
	$('a.admin-del-user').on('click', function(e) {
          var url = $(this).attr('href'); 
          //alert(url); return false;
          customConfirmWithParam('Are you sure ?', 'adminCofirmUserDel',url);   
          //var bool = confirm("Are you sure ?");
          // if(bool == true) {
          // 	return true;	
          // }
          return false;
          
      
  	});

  //Counter offer Confirmation
  $('.delete-bid').on('click', function() {
      var par = $(this).attr('href');
      customConfirmWithParamYesNo('Are you sure to delete this bid ?', 'adminDeleteBidConfirmDialog',par)    
      return false; 
  });

  	var messageTpl = '<div id="dialog-confirm" title="Copyright" style="display:none;">';
	messageTpl += '<p>Copyright has been obtained for these manuscripts exclusively for your internal training purposes and these are not to be disseminated to any other individual. By clicking \'OK\' you accept this provision and agree not to further disseminate any file. In the event that an external HCP desires a publication contained here, you may provide the full reference or may obtain and provide it to the HCP in accordance with Alcon or ThromboGenics copyright policy for such provision, based on your employer. <br/><br/>Please note that if you are opening the references using an iPad, we recommend that you use GoodReader.';
	messageTpl += '</p></div>';

  //Edit Followback Username in
  $('.admin-edit-followback-username').on('click', function(e) {
    var text = $(this).attr('data-attr'); 

    if(text == 'updateusername') {
        $(this).closest('td').find('.admin-display-username-followback').hide();
        $(this).closest('td').find('.admin-input-display-username-followback').show();
        $(this).attr('data-attr','save');
        $(this).find('.icon-edit').addClass('icon-check');
        $(this).find('.icon-edit').removeClass('icon-edit');
        //$(this).text('save');
      }

      if(text == 'save') {
        return true;
      }
      return false;

  });

    // $('.admin-change-userprofile-image').on('click', function() {
    //   $('.register-content').show();  
    // })
    
   $('.admin-edit-category').on('click', function(e) {
    var text = $(this).attr('data-attr'); 

    if(text == 'updatecats') {
        $(this).closest('td').find('.admin-display-category-followback').hide();
        $(this).closest('td').find('.admin-input-display-updatecats-followback').show();
        $(this).attr('data-attr','save');
        $(this).find('.fa-tags').addClass('icon-check');
        $(this).find('.fa-tags').removeClass('fa-tags');
        //$(this).text('save');
      }

      if(text == 'save') {
        return true;
      }
      return false;

  });
 
   $('.admin-edit-tags').on('click', function(e) {
    var text = $(this).attr('data-attr'); 

    if(text == 'updatecats') {
        $(this).closest('td').find('.admin-display-tags-followback').hide();
        $(this).closest('td').find('.admin-input-display-updatetags-followback').show();
        $(this).attr('data-attr','save');
        $(this).find('.fa-tags').addClass('icon-check');
        $(this).find('.fa-tags').removeClass('fa-tags');
        //$(this).text('save');
      }

      if(text == 'save') {
        return true;
      }
      return false;

  });
    

    $(".admin-change-userprofile-image").colorbox({
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
            //Show upload popup
            $('.register-content').show();  

            $('.register-content').find('.help-block').remove();
            $(".has-error").removeClass("has-error");

            var $img = $(this).attr('data-image');
            $('.reg-profile-image-container > img').attr('src', $img);
            $('button.admin-upload-followback-image').hide();
            
            var $id = $(this).attr('data-id');

            $('<input>').attr({
              type: 'hidden',
              name: 'userId',
              value: $id,
            }).appendTo('form.admin-append-followback-image');
        },
        onClosed:function(test,t){
          //Hide upload popup
          $('.register-content').hide();  
        }
    });
  

  //setTimeout( "$('.flash-errors').fadeOut();",5000 );


if($(".media").length){
	$('.media').media({ width: 300, height: 175, autoplay: false });
}

});
//Custom Confitm message dialog box (With Ok and Cancel)
function customConfirmWithParam(msg, callFunction, url) {

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
                window[callFunction](true,url);
            },
            Cancel: function () {
                ret = false;
                $(this).dialog("close");
                window[callFunction](false,url);
            }
        },
        create:function () {
            $(this).closest(".ui-dialog").css('background', '#ffffff').addClass("unique-dialog");
            $(this).closest(".ui-dialog").find(".ui-dialog-buttonset").find(':button').addClass("btn btn-default");
    
        }
    });
    return ret;
}
//Custom Confitm message dialog box (With Yes and No)
function customConfirmWithParamYesNo(msg, callFunction, param) {
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
            Yes: function () {
                ret = true;
                $(this).dialog("close");
                window[callFunction](true,param);
            },
            No: function () {
                ret = false;
                $(this).dialog("close");
                window[callFunction](false,param);
            }
        },
        create:function () {
            $(this).closest(".ui-dialog").css('background', '#ffffff').css('border', '1px solid #ccc').addClass("unique-dialog");
            $(this).closest(".ui-dialog").find(".ui-dialog-buttonset").find(':button').addClass("btn btn-default");
    
        }
    });
    return ret;
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
//confirmation before deleting admin-del-user
function adminCofirmUserDel(value,url) {
	if(value) {
	    $.ajax({
	        url: url,
	        success: function(res) {
                //console.log(res);
	            window.location.href = '/admin/users'; 
	        }
	    });
	} else {
	    return true;
	}
}

//Delete bid by Admin
function adminDeleteBidConfirmDialog(value,url) {
    if(value) {
      $.ajax({
          url: url,
          success: function(res) {
              window.location.href = '/'+res.redirect; 
          }
      });

    } else {
      return false;
    }
}