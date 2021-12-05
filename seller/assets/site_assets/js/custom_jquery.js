(function ($) {
	"use Strict";

	/*jQuery('.mobile-menu-area nav').meanmenu({
	    meanMenuContainer: '.mobile-menu',
	    meanScreenWidth: "991"
	});*/

	$(window).scroll(function() {
	if ($(this).scrollTop() >300){  
	    $('.header-sticky').addClass("sticky");
	  }
	  else{
	    $('.header-sticky').removeClass("sticky");
	  }
	});

	$('.rx-parent').on('click', function(){
	    $('.rx-child').slideToggle();
	    $(this).toggleClass('rx-change');
	});
	 
	$(".embed-responsive iframe").addClass("embed-responsive-item");
	$(".carousel-inner .item:first-child").addClass("active");
	//    category heading
	$('.category-heading').on('click', function(){
	    $('.category-menu-list').slideToggle(300);
	});	

	       
	
	/*==================================
	   Owl Carousel Active
	====================================*/  

	

	/* ---------------------------
		FAQ Accordion Active
	* ---------------------------*/ 
	  $('.panel-heading a').on('click', function() {
	    $('.panel-default').removeClass('active');
	    $(this).parents('.panel-default').addClass('active');
	  });
	  
	/*new WOW().init();*/

	/*==================================
	   All Toggle Active
	====================================*/
	$( '#showlogin' ).on('click', function() {
	    $( '#checkout-login' ).slideToggle(900);
	});    
	$( '#showcoupon' ).on('click', function() {
	    $( '#checkout_coupon' ).slideToggle(600);
	});

	 $( '#cbox' ).on('click', function() {
	    $( '#cbox_info' ).slideToggle(900);
	 });

	 $( '#ship-box' ).on('click', function() {
	    $( '#ship-box-info' ).slideToggle(1000);
	 });

	$(".payment_method_cheque-li").on('click', function(){

	  $(".payment_method_cheque").show(500);
	  $(".payment_method_paypal").hide(500);
	});
	$(".payment_method_paypal-li").on('click', function(){
	  $(".payment_method_paypal").show(500);
	  $(".payment_method_cheque").hide(500);
	});

	if($('#Instafeed').length) {
	    var feed = new Instafeed({
	        get: 'user',
	        userId: 7093388560,
	        accessToken: '7093388560.1677ed0.8e1a27120d5a4e979b1ff122d649a273',
	        target: 'Instafeed',
	        resolution: 'thumbnail',
	        limit: 6,
	        template: '<li><a href="{{link}}" target="_new"><img src="{{image}}" /></a></li>',
	    });
	    feed.run(); 
	}

	// for price filter
	$(function() {
	$( ".slider-range" ).slider({
	  range: true,
	  min: $( ".amount" ).data("min"),
	  max: $( ".amount" ).data("max"),
	  values: [ $( ".amount" ).data("min"), $( ".amount" ).data("max") ],
	  slide: function( event, ui ) {
		$( ".amount" ).val( $( ".amount" ).data("currency")+ " " + ui.values[ 0 ] + " - " +$( ".amount" ).data("currency")+ " " + ui.values[ 1 ] );
		$( ".price_filter" ).val(ui.values[ 0 ] +
	  " - " + ui.values[ 1 ]);
	  }
	});
	
});
	

	    

        
})(jQuery);