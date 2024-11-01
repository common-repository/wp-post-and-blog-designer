jQuery( document ).ready(function($) {

	// Initialize masonry
	jQuery('.wpbd-post-masonry').each(function( index ) {		
		var obj_id = jQuery(this).attr('id');
		
		// Creating object
		var masonry_param_obj = {itemSelector: '.wpbd-post-grid'};
		
		if( !$(this).hasClass('wpbd-effect-1') ) {
			masonry_param_obj['transitionDuration'] = 0;
		}		
		// jQuery
		jQuery('#'+obj_id).imagesLoaded(function() {
			$('#'+obj_id).masonry(masonry_param_obj);
		});
	});
	$(document).on('click', '.wpbd-load-more-btn', function(){


		var current_obj = $(this);
		var site_html 	= $('body');
		var masonry_obj = current_obj.closest('.wpbd-post-masonry-wrp').find('.wpbd-post-masonry').attr('id');

		var paged 		= (parseInt(current_obj.attr('data-paged')) + 1);
		var count 		= parseInt(current_obj.attr('data-count'));
		var shortcode_param = $.parseJSON(current_obj.parent().find('.wpbd-shortcode-param').text());
		
		$('.wpbd-info').remove();
		
		current_obj.addClass('wpbd-btn-active');
		current_obj.attr('disabled', 'disabled');
		// Creating object
		var shortcode_obj = {};

		// Creating object
		$.each(shortcode_param, function (key,val) {
			shortcode_obj[key] = val;
		});
		var data = {
                        action     	: 'wpbd_fetch_more_post',
                        paged 		: paged,
                        count 		: count,
                        shrt_param 	: shortcode_obj
                    };

        $.post(Wpbd.ajaxurl,data,function(response) {
			
			var result = $.parseJSON(response);

			if( result.sucess = 1 && (result.data != '') ) {

				current_obj.attr('data-paged', paged);
				current_obj.attr('data-count', result.count);

				var $content = $( result.data );
				$content.hide();
				$('#'+masonry_obj).append($content).imagesLoaded(function(){
					$content.show();
					$('#'+masonry_obj).append( $content ).masonry( 'appended', $content );

					current_obj.removeAttr('disabled', 'disabled');
					current_obj.removeClass('wpbd-btn-active');
				});				

			} else if(result.data == '') {
				
				current_obj.parent('.wpbd-ajax-btn-wrap').hide();
				var info_html = '<div class="wpbd-info">'+Wpbd.no_post_msg+'</div>';

				current_obj.parent().after(info_html);
				setTimeout(function() {
					$(".wpbd-info").fadeOut("normal", function() {
						$(this).remove();
				    });
				}, 2000 );

				current_obj.removeAttr('disabled', 'disabled');
				current_obj.removeClass('wpbd-btn-active');
			}
		});
	});	

});