$(function(){
	$('#search').focus(function(){
		$('.search').css('z-index', 1);
	}).blur(function(){
    	$('.search').css('z-index', 0);
  	})
});
$(function(){
	$('.select').select2(); 
});
$(document).ready(function(){  
     $('#mycarousel').everslider({  
        mode: 'carousel',  
        moveSlides: 1,
       navigation: true,
        ticker: true,
        mouseWheel: true,
        tickerTimeout: 1000,
    		itemWidth : 155,
      	itemHeight: 180,
      	itemMargin: 40 
     });  
});
