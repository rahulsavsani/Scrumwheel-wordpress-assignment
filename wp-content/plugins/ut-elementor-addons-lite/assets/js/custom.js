(function($){
  'use strict';


    var rtoleft = false;
    if($('body').hasClass('rtl')){
        var rtoleft = true;
    }

/**
* Blog Grid Carousel
*/
var UtalBlogGrid = function( $scope, $){
    if($('.utal-blog-grid .slick-slider').length>0){
        $('.utal-blog-grid .slick-slider').each(function (){
            var slick_pager, slick_nav, slick_slides, slick_slides_tablet, slick_slides_mobile, slick_auto, slick_autospeed, slick_transition,slick_loop, slick_pauseOnHover, slick_swipe;
            slick_nav = $(this).attr('data-arrows');
            slick_pager = $(this).attr('data-dots');
            slick_auto = $(this).attr('data-autoplay');
            slick_autospeed = $(this).attr('data-autoplay_speed');
            slick_slides = $(this).attr('data-slidesToShow');
            slick_slides_tablet = $(this).attr('data-slidesToShow-tablet');
            slick_slides_mobile = $(this).attr('data-slidesToShow-mobile');
            slick_swipe = $(this).attr('data-swipe');
            slick_loop = $(this).attr('data-infinit_loop');
            slick_pauseOnHover = $(this).attr('data-pauseOnHover');
            if(slick_nav == 'yes'){
                slick_nav = true;
            }
            else{
                slick_nav = false;
            }
            if(slick_pager == 'yes'){
                slick_pager = true;
            }
            else{
                slick_pager = false;
            }
            if(slick_auto == 'yes'){
                slick_auto = true;
            }
            else{
                slick_auto = false;
            }
            if(slick_swipe == 'yes'){
                slick_swipe = true;
            }
            else{
                slick_swipe = false;
            }
            if(slick_loop == 'yes'){
                slick_loop = true;
            }
            else{
                slick_loop = false;
            }
            if(slick_pauseOnHover == 'yes'){
                slick_pauseOnHover = true;
            }
            else{
                slick_pauseOnHover = false;
            }
             $(this).not('.slick-initialized').slick({
                infinite: slick_loop,
                slidesToShow: slick_slides,
                autoplay: slick_auto,
                autoplaySpeed: slick_autospeed,
                arrows: slick_nav,
                rtl: rtoleft,
                dots: slick_pager,
                pauseOnHover: slick_pauseOnHover,
                swipe: slick_swipe,
                responsive: [
                {
                breakpoint: 768,
                settings: {
                    slidesToShow: slick_slides_tablet,
                }
                },
                {
                breakpoint: 500,
                settings: {
                    slidesToShow: slick_slides_mobile,
                }
                }
            ]
            });
        }); 
    }
}

/**
*  Slider
*/
var UtalSlider = function( $scope, $){
    if($('.utal-slider .slick-slider').length>0){
        $('.utal-slider .slick-slider').each(function (){
            var slick_pager, slick_nav, slick_slides, slick_slides_tablet, slick_slides_mobile, slick_auto, slick_autospeed, slick_transition,slick_loop, slick_pauseOnHover, slick_swipe;
            slick_nav = $(this).attr('data-arrows');
            slick_pager = $(this).attr('data-dots');
            slick_auto = $(this).attr('data-autoplay');
            slick_autospeed = $(this).attr('data-autoplay_speed');
            slick_swipe = $(this).attr('data-swipe');
            slick_loop = $(this).attr('data-infinit_loop');
            slick_pauseOnHover = $(this).attr('data-pauseOnHover');
            if(slick_nav == 'yes'){
                slick_nav = true;
            }
            else{
                slick_nav = false;
            }
            if(slick_pager == 'yes'){
                slick_pager = true;
            }
            else{
                slick_pager = false;
            }
            if(slick_auto == 'yes'){
                slick_auto = true;
            }
            else{
                slick_auto = false;
            }
            if(slick_swipe == 'yes'){
                slick_swipe = true;
            }
            else{
                slick_swipe = false;
            }
            if(slick_loop == 'yes'){
                slick_loop = true;
            }
            else{
                slick_loop = false;
            }
            if(slick_pauseOnHover == 'yes'){
                slick_pauseOnHover = true;
            }
            else{
                slick_pauseOnHover = false;
            }
            $(this).not('.slick-initialized').slick({
                infinite: slick_loop,
                slidesToShow: 1,
                autoplay: slick_auto,
                autoplaySpeed: slick_autospeed,
                arrows: slick_nav,
                rtl: rtoleft,
                dots: slick_pager,
                pauseOnHover: slick_pauseOnHover,
                swipe: slick_swipe,
            });
        }); 
    }
}
/**
*  Testimonial Slider
*/
var UtalTestimonial = function( $scope, $){
   if($('.utal-testimonial .slick-slider').length>0){
    $('.utal-testimonial .slick-slider').each(function (){
        var slick_pager, slick_pager_tablet, slick_pager_mobile, slick_nav, slick_nav_tablet, slick_nav_mobile, slick_slides, slick_slides_tablet, slick_slides_mobile, slick_auto, slick_autospeed, slick_transition,slick_loop, slick_pauseOnHover, slick_swipe;
        slick_nav = $(this).attr('data-arrows');
        slick_nav_tablet = $(this).attr('data-arrows-tablet');
        slick_nav_mobile = $(this).attr('data-arrows-mobile');
        slick_pager = $(this).attr('data-dots');
        slick_pager_tablet = $(this).attr('data-dots-tablet');
        slick_pager_mobile = $(this).attr('data-dots-mobile');
        slick_auto = $(this).attr('data-autoplay');
        slick_autospeed = $(this).attr('data-autoplay_speed');
        slick_slides = $(this).attr('data-slidesToShow');
        slick_slides_tablet = $(this).attr('data-slidesToShow-tablet');
        slick_slides_mobile = $(this).attr('data-slidesToShow-mobile');
        slick_swipe = $(this).attr('data-swipe');
        slick_loop = $(this).attr('data-infinit_loop');
        slick_pauseOnHover = $(this).attr('data-pauseOnHover');
        
        if(slick_nav == 'yes'){
            slick_nav = true;
        }
        else{
            slick_nav = false;
        }
        if(slick_pager == 'yes'){
            slick_pager = true;
        }
        else{
            slick_pager = false;
        }
        if(slick_pager_tablet== 'yes'){
            slick_pager_tablet = true;
        }else{
            slick_pager_tablet = false;
        }
        if(slick_pager_mobile== 'yes'){
            slick_pager_mobile = true;
        }else{
            slick_pager_mobile = false;
        }
        if(slick_auto == 'yes'){
            slick_auto = true;
        }
        else{
            slick_auto = false;
        }
        if(slick_swipe == 'yes'){
            slick_swipe = true;
        }
        else{
            slick_swipe = false;
        }
        if(slick_loop == 'yes'){
            slick_loop = true;
        }
        else{
            slick_loop = false;
        }
        if(slick_pauseOnHover == 'yes'){
            slick_pauseOnHover = true;
        }
        else{
            slick_pauseOnHover = false;
        }
        if(slick_nav_tablet== 'yes'){
            slick_nav_tablet = true;
        }else{
            slick_nav_tablet = false;
        }
        if(slick_nav_mobile== 'yes'){
            slick_nav_mobile = true;
        }else{
            slick_nav_mobile = false;
        }
        
        $(this).not('.slick-initialized').slick({
            infinite: slick_loop,
            slidesToShow: slick_slides,
            autoplay: slick_auto,
            autoplaySpeed: slick_autospeed,
            arrows: slick_nav,
            rtl: rtoleft,
            dots: slick_pager,
            pauseOnHover: slick_pauseOnHover,
            swipe: slick_swipe,
            
            responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: slick_slides_tablet,
                arrows: slick_nav_tablet,
                dots: slick_pager_tablet,
              }
            },
            {
              breakpoint: 500,
              settings: {
                slidesToShow: slick_slides_mobile,
                arrows: slick_nav_mobile,
                dots: slick_pager_mobile,
              }
            }
          ]
        });
    }); 
   }
}

/**
*  Ticker Slider
*/
var UtalTickerSlider = function( $scope, $){
    //var slider_elem = $scope.find('.utal-ticker-wrapper .ticker-content-container').eq(0);
    if($('.utal-ticker-wrapper .ticker-content-container').length > 0){
       
        $('.utal-ticker-wrapper .ticker-content-container').each(function (){
            var slick_pager,  slick_direction,  slide_animation, slide_animation_speed, slick_nav, slick_nav_tablet, slick_nav_mobile, slick_slides, slick_slides_tablet, slick_slides_mobile, slick_auto, slick_autospeed, slick_transition,slick_loop, slick_pauseOnHover, slick_swipe;
            var slidesToScroll, vertical, variableWidth, initialSlide, fade;
            slick_nav = $(this).attr('data-arrows');
            slick_nav_tablet = $(this).attr('data-arrows-tablet');
            slick_nav_mobile = $(this).attr('data-arrows-mobile');
            slick_direction = $(this).attr('data-direction');
            slick_auto = $(this).attr('data-autoplay');
            slick_autospeed = $(this).attr('data-autoplay_speed');
            slick_slides = $(this).attr('data-slidesToShow');
            slick_slides_tablet = $(this).attr('data-slidesToShow-tablet');
            slick_slides_mobile = $(this).attr('data-slidesToShow-mobile');
            slick_swipe = $(this).attr('data-swipe');
            slick_loop = $(this).attr('data-infinit_loop');
            slick_pauseOnHover = $(this).attr('data-pauseOnHover');
            slide_animation=$(this).attr('data-animation');
            slide_animation_speed=$(this).attr('data-animation-speed');
            if(slick_nav == 'yes'){
                slick_nav = true;
            }
            else{
                slick_nav = false;
            }
            
            if(slick_auto == 'yes'){
                slick_auto = true;
            }
            else{
                slick_auto = false;
            }
            if(slick_swipe == 'yes'){
                slick_swipe = true;
            }
            else{
                slick_swipe = false;
            }
            if(slick_loop == 'yes'){
                slick_loop = true;
            }
            else{
                slick_loop = false;
            }
            if(slick_pauseOnHover == 'yes'){
                slick_pauseOnHover = true;
            }
            else{
                slick_pauseOnHover = false;
            }
            if(slick_nav_tablet== 'yes'){
                slick_nav_tablet = true;
            }else{
                slick_nav_tablet = false;
            }
            if(slick_nav_mobile== 'yes'){
                slick_nav_mobile = true;
            }else{
                slick_nav_mobile = false;
            }
            
            if(slick_direction=='ltr'){               
                initialSlide= 1;
                rtoleft=true;
            }else{
                rtoleft=false;
            }
            //var vertical
            if(slick_direction=='btt'){
                vertical= true;
                slidesToScroll= 1;            
            }
            // if(slick_direction=='ttb'){
            //     vertical= true;
            //     //slidesToScroll= -1;
            //     //initialSlide= 1; 
            //     //rtoleft=true;           
            // }
            if(slide_animation=='default'){
                variableWidth= false;
                slick_slides=slick_slides;
            }
            if(slide_animation=='marquee'){
                variableWidth= true;
                slick_slides=1;
                vertical=false;
                initialSlide= 1;
                slick_autospeed=0;
                slidesToScroll= 1
            }else{
                variableWidth= false;
                slick_slides=slick_slides;
            }
            if(slide_animation=='fade'){
                fade= true;
                vertical=false;
            }else{
                fade= false;
            }
            $(this).not('.slick-initialized').slick({
                speed: slide_animation_speed,
                slidesToShow: slick_slides,            
                infinite: slick_loop,            
                autoplay: slick_auto,
                autoplaySpeed: slick_autospeed,
                arrows: slick_nav,
                rtl: rtoleft,            
                pauseOnHover: slick_pauseOnHover,
                swipe: slick_swipe,
                slidesToScroll: slidesToScroll,
                vertical:vertical,
                variableWidth:variableWidth,
                initialSlide: initialSlide,
                centerMode: false, 
                fade:fade,                    
                cssEase: 'linear',
                responsive: [
                {
                breakpoint: 768,
                settings: {
                    slidesToShow: slick_slides_tablet,
                    arrows: slick_nav_tablet,
                }
                },
                {
                breakpoint: 500,
                settings: {
                    slidesToShow: slick_slides_mobile,
                    arrows: slick_nav_mobile,
                }
                }
            ]
            });
        }); 
    }
    
}
var UtalSearch = function($scope, $){
    var $search_icon = $scope.find('.utal-search-icon').eq(0);
    $search_icon.on('click',function(){
        $(this).find('.utal-search-container').toggleClass('show');
    });
}

    $(window).on('elementor/frontend/init', function () {
        const addHandler = ( $element ) => {
            elementorFrontend.elementsHandler.addHandler( WidgetHandlerClass, {
                $element,
            } );
        };
        elementorFrontend.hooks.addAction('frontend/element_ready/utal-search.default', UtalSearch);
        elementorFrontend.hooks.addAction('frontend/element_ready/utal-blog-grid.default', UtalBlogGrid);
        elementorFrontend.hooks.addAction('frontend/element_ready/utal-slider.default', UtalSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/utal-testimonial.default', UtalTestimonial);
        elementorFrontend.hooks.addAction('frontend/element_ready/utal-content-ticker.default', UtalTickerSlider);
    });

    function menuAdd(){
        $('.menu-toggle').addClass('is-triggered');
        $('.custom-menu').addClass('is-active');
        $('.custom-menu .close').addClass('open');
    }
    function menuRemove(){
        $('.menu-toggle').removeClass('is-triggered');
        $('.custom-menu').removeClass('is-active');
        $('.custom-menu .close').removeClass('open');
    }
    if($(window).width() < 992){

        $('.custom-menu').prepend('<span class="close">&times;</span>');

        $('.custom-menu .close').on('click', function(){
            menuRemove();
        });
    

        $('.menu-toggle').on('click', function(e) {
            
            e.preventDefault(); // stops link from making page jump to the top
            e.stopPropagation(); // when you click the button, it stops the page from seeing it as clicking the body too
            menuAdd();
            
        });
        
        $('.menu-toggle').on('click', function(e) {
            e.stopPropagation(); // when you click within the content area, it stops the page from seeing it as clicking the body too
        });
        $('.custom-menu').on('click', function(e) {
            e.stopPropagation(); // when you click within the content area, it stops the page from seeing it as clicking the body too
        });
        
        $('body').on('click', function() {
            menuRemove();
        });


        $('.custom-menu .menu-item-has-children').append('<span class="next-menu">></span>');

        $('.custom-menu .menu-item-has-children>.next-menu').on('click', function(){
            $(this).prev().addClass('slide');
        });

        $('.custom-menu ul.sub-menu').prepend('<li class="prev-menu">< Back</li>');

        $('.custom-menu ul.sub-menu>.prev-menu').on('click', function(){
            $(this).parent().removeClass('slide');
        });

    }
})(jQuery);