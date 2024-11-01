jQuery( document ).ready(function($) {	
	// Initialize post slick slider
	$( '.wpbd-post-slider' ).each(function( index ) {
		var slider_id   = $(this).attr('id');
		var slider_conf = $.parseJSON( $(this).closest('.wpbd-post-slider-outter').find('.wpbd-slider-conf').text() );
		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {            
            jQuery('#'+slider_id).slick({
            	dots            : (slider_conf.dots) == "true" ? true : false,
            	infinite        : (slider_conf.loop) == "true" ? true : false,
            	arrows          : (slider_conf.arrows) == "true" ? true : false,
            	speed           : parseInt(slider_conf.speed),
            	autoplay        : (slider_conf.autoplay) == "true" ? true : false,
            	autoplaySpeed   : parseInt(slider_conf.autoplay_interval),
            	slidesToShow    : 1,
            	slidesToScroll  : 1,
            	rtl             : (Wpbd.is_rtl == 1) ? true : false, 
            	mobileFirst     : (Wpbd.is_mobile == 1) ? true : false,
                prevArrow: "<div class='slick-prev'><i class='fa fa-angle-left'></i></div>",
                nextArrow: "<div class='slick-next'><i class='fa fa-angle-right'></i></div>", 				
            });
        }
    });
	// Initialize post slick carousel
	$( '.wpbd-post-carousel' ).each(function( index ) {

		var slider_id   = $(this).attr('id');
		var slider_conf = $.parseJSON( $(this).closest('.wpbd-post-carousel-outter').find('.wpbd-slider-conf').text() );

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {		
            
            jQuery('#'+slider_id).slick({
            	dots            : (slider_conf.dots) == "true" ? true : false,
            	infinite        : (slider_conf.loop) == "true" ? true : false,
            	arrows          : (slider_conf.arrows) == "true" ? true : false,
            	speed           : parseInt(slider_conf.speed),
            	autoplay        : (slider_conf.autoplay) == "true" ? true : false,
            	autoplaySpeed   : parseInt(slider_conf.autoplay_interval),
            	slidesToShow    : parseInt(slider_conf.slide_post),
            	slidesToScroll  : parseInt(slider_conf.slide_scroll),
            	rtl             : (Wpbd.is_rtl == 1) ? true : false, 	
            	mobileFirst     : (Wpbd.is_mobile == 1) ? true : false,
                prevArrow: "<div class='slick-prev'><i class='fa fa-angle-left'></i></div>",
                nextArrow: "<div class='slick-next'><i class='fa fa-angle-right'></i></div>",
				responsive: [{
              breakpoint: 1023,
              settings: {
                slidesToShow  : (parseInt(slider_conf.slide_post) > 3) ? 3 : parseInt(slider_conf.slide_post),
                slidesToScroll  : 1
              }
            },{
              breakpoint: 640,
              settings: {
                slidesToShow  : (parseInt(slider_conf.slide_post) > 2) ? 2 : parseInt(slider_conf.slide_post),
                slidesToScroll  : 1
              }
            },{
              breakpoint: 479,
              settings: {
                slidesToShow  : 1,
                slidesToScroll  : 1
              }
            },{
              breakpoint: 319,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }]	
            });
        }
    });
    // Initialize vertical ticker for post and blogs widget
    $( '.wpbd-ticker-jcarousellite' ).each(function( index ) {
        var slider_id   = $(this).attr('id');
        var slider_conf = $.parseJSON( $(this).closest('.wpbd-widget-outter').find('.wpbd-slider-conf').text() );
        if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
            jQuery('#'+slider_id).vTicker({
                speed     : parseInt(slider_conf.speed),
                height    : parseInt(slider_conf.height),
                padding   : 5,
                pause     : parseInt(slider_conf.pause)
            });
        }
    });

    // Initialize vertical ticker for post and blogs
    $(window).bind("load", function() {
        $( '.wpbd-ticker-wrp' ).each(function( index ) {
            var ticker_id   = $(this).attr('id');          
            var ticker_conf = $.parseJSON( $(this).find('.wpbd-ticker-conf').text() );
            if( typeof(ticker_id) != 'undefined' && ticker_id != '' && ticker_conf != 'undefined' ) {
                $("#"+ticker_id).wpbdTicker({                    
                    effect      : ticker_conf.ticker_effect,
                    autoplay    : (ticker_conf.autoplay == 'false') ? false : true,
                    timer       : parseInt(ticker_conf.speed),
                    border      : true,
                    fontstyle   : ticker_conf.font_style,
                });
            }
        });
    });

    // post and blog Filter
    if( $('.wpbd-filtr-outter').length > 0) {
        jQuery('.wpbd-filtr-outter').filterizr({
            selector    : '.wpbd-filtr-outter',
            layout      : 'sameWidth',
        });
        
        $(document).on('click', '.wpbd-filtr-cat-list li', function(){
            $('.rpsw-filtr-cat-list').removeClass('rpsw-active-filtr-cat');
            $(this).addClass('rpsw-active-filtr-cat');
        });
    }
});