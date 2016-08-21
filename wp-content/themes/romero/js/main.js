/**
 * main.js v1
 * Created by Ben Gillbanks <http://www.binarymoon.co.uk/>
 * Available under GPL2 license
 */

;(function($){

	function is_touch_device() {
		return (('ontouchstart' in window) || (navigator.MaxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0));
	}

	$(document).ready(function(){

		if ( $.isFunction( $.fn.responsiveNavigation ) ) {
			$( 'ul#nav' ).responsiveNavigation({
				breakpoint: 549
			});
		}

		// attachment page navigation
		if ( $( 'body' ).hasClass( 'attachment' ) ) {

			$( document ).keydown( function( e ) {

				if ( $( 'textarea, input' ).is( ':focus' ) ) {
					return;
				}

				var url = false;

				switch( e.which ) {
					// left arrow key (previous attachment)
					case 37:
						url = $( '.image-previous a' ).attr( 'href' );
						break;

					// right arrow key (next attachment)
					case 39:
						url = $( '.image-next a' ).attr( 'href' );
						break;

				}

				if ( url ) {
					window.location = url;
				}
			} );

		}


		// add css class so that the search field can grow in size
		$( '.masthead .search-field' ).on( 'focus', function() {
			$( '.masthead .secondary' ).addClass( 'search-active' );
		});

		$( '.masthead .search-field' ).on( 'blur', function() {
			$( '.masthead .secondary' ).removeClass( 'search-active' );
		});


		// effects for form labels
		$( '#respond input, #respond textarea' ).on( 'focus', function() {
			$( this ).parent().addClass( 'selected' );
		} ).on( 'blur', function() {
			$( this ).parent().removeClass( 'selected' );
		} );

		// make the menu widgets appear
		$( '#sidebar-menu-toggle' ).on( 'click', function() {
			$( '#sidebar-menu' ).slideToggle( 'fast' );
		});

		// prepare masonry
		$( window ).load( function() {

			if ( $.isFunction( $.fn.masonry ) ) {
				$( '.sidebar-footer .container' ).imagesLoaded( function() {
					$( '.sidebar-footer .container' ).masonry({
						itemSelector: '.widget',
						gutter: 0,
						isOriginLeft: ! $( 'body' ).is( '.rtl' )
					});
				});

				$( 'body.archive .testimonials' ).imagesLoaded( function() {
					$( 'body.archive .testimonials' ).masonry({
						itemSelector: '.testimonial',
						gutter: 0,
						isOriginLeft: ! $( 'body' ).is( '.rtl' )
					});
				});
			}

		});

		$( '.menu-toggle' ).on( 'click', function() {
			$( this ).parent().toggleClass( 'menu-on' );
		} );

		$( '.menu' ).find( 'a' ).on( 'focus blur', function() {
			$( this ).parents().toggleClass( 'focus' );
		} );

		$( 'body' ).addClass( is_touch_device() ? 'device-touch' : 'device-click' );

	});

})(jQuery);