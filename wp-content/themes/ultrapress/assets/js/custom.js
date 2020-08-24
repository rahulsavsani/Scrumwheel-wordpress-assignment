jQuery(document).ready(function ($) {
	var $body = $('body');
	$body.on('added_to_cart', function(){
		$('.off-canvas-cart').addClass('show');
	});

	$('.mini-cart a.offcanvas').on('click keypress touchstart', function(e) {
		e.preventDefault();
		$('.off-canvas-cart').addClass('show');
	});
	$('.off-canvas-close').on('click keypress touchstart', function() {
		$('.off-canvas-cart').removeClass('show');
	});

	$(window).scroll(function(){ 
		if ($(this).scrollTop() > 200) { 
			$('.scroll-to-top').fadeIn(); 
		} else { 
			$('.scroll-to-top').fadeOut(); 
		} 
	}); 

	$('.scroll-to-top').click(function(){ 
		$("html, body").animate({ scrollTop: 0 }, 700); 
		return false; 
	}); 

	$( "#ultrapress-main-menu" ).find( "ul" ).first().addClass('navbar-nav');
	$( "#ultrapress-main-menu" ).find( "ul.children" ).addClass('sub-menu');
	$( "#ultrapress-main-menu" ).find( "li.page_item_has_children" ).addClass('menu-item-has-children');
	$( "#ultrapress-main-menu" ).find( "li" ).addClass('menu-item');
	if($("#ultrapress-recent-post-slider-holder").length){
		$("#ultrapress-recent-post-slider-holder").slick({
			dots: false,
			infinite: true,
			autoplay:true,
			arrows: true,
			speed: 300,
			slidesToShow: 1,
			slidesToScroll: 1,
			adaptiveHeight: true
		});
	}

	if($("#ultrapress-recent-product-slider-holder").length){ 
		$("#ultrapress-recent-product-slider-holder").slick({
			dots: false,
			infinite: true,
			autoplay:true,
			arrows: true,
			speed: 300,
			slidesToShow: 1,
			slidesToScroll: 1,
			adaptiveHeight: true
		});
	}

	if($('.sticky-header').length){
		$(window).on('scroll', function(){
			if($(this).scrollTop() > 100){
				$('.ultrapress-default-header').addClass('is-sticky');
			}
			else{
				$('.ultrapress-default-header').removeClass('is-sticky');
			}
		});
	}

	$(".navbar-toggler").on('click keypress',function(event) {
		$(".ultrapress-main-menu").toggleClass("show");
		event.stopPropagation();
	});
	
	$(document).on('click keypress',function(event){
		if (!$(event.target).hasClass('ultrapress-main-menu')) {
			$(".ultrapress-main-menu").removeClass("show");
		}
	});
	
	$('.ultrapress-main-menu').on('click keypress',function(event){
		event.stopPropagation();
	});
	$(".navbar-toggler").on('click keypress',function(event) {
		$(".navbar-toggler").toggleClass("active");
		event.stopPropagation();
	});
	
	$(document).on('click keypress',function(event){
		if (!$(event.target).hasClass('navbar-toggler')) {
			$(".navbar-toggler").removeClass("active");
		}
	});
	
	$('.navbar-toggler').on('click keypress',function(event){
		event.stopPropagation();
	});
	$(".search-icon svg").on('click keypress',function(event) {
		$(".search-container").toggleClass("show");
		event.stopPropagation();
	});
	
	$(document).click(function(event){
		if (!$(event.target).hasClass('search-container')) {
			$(".search-container").removeClass("show");
		}
	});
	
	$('.search-container').on('click keypress',function(event){
		event.stopPropagation();
	});

	$(window).resize(function() {
	  var width = $(window).width();
	  if (width < 767){
	    $('li.menu-item-has-children a').click(function() {
	        return false;
	    }).dblclick(function() {
	        window.location = this.href;
	        return false;
	    });
	  }
	});

	if (window.matchMedia('(max-width: 1024px)').matches){
		$("ul.sub-menu").prepend(
		    '<li class="back"><i class="fa fa-angle-left"></i> Back</li>'
		  );
		$(".menu-item-has-children>a").on("click keypress touchstart", function(e) {
	      e.preventDefault();
	      $(this).next().toggleClass("is-open");
	    });
	    $("ul.sub-menu").on("click keypress touchstart", ".back", function() {
	      $(this)
	        .parent(".sub-menu")
	        .removeClass("is-open");
	    });
	}  
});