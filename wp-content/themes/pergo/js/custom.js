// JavaScript Document
jQuery(document).ready(function($) {

	/*----------------------------------------------------*/
	/*	Hero newsletter
	/*----------------------------------------------------*/

	jQuery('#hero-1 .es_subscription_form').addClass('newsletter-form newsletter-form-simple');
	jQuery('#hero-1 .es_subscription_form .es-field-wrap').addClass('input-group');
	jQuery('#hero-1 .es_subscription_form .es-field-wrap .ig_es_form_field_email').addClass('form-control');
	jQuery('#hero-1 .es_subscription_form .es-field-wrap .ig_es_form_field_email').attr('size',60);
	jQuery('#hero-1 .es_subscription_form .es_subscription_form_submit').addClass('btn btn-simple');

	/*----------------------------------------------------*/
	/*	Newsletter section
	/*----------------------------------------------------*/

	jQuery('#newsletter-1 .es_subscription_form').addClass('newsletter-form newsletter-form-simple');
	jQuery('#newsletter-1 .es_subscription_form .es-field-wrap').addClass('input-group');
	jQuery('#newsletter-1 .es_subscription_form .es-field-wrap .ig_es_form_field_email').addClass('form-control');
	jQuery('#newsletter-1 .es_subscription_form .es_subscription_form_submit').addClass('btn btn-simple');
		
	"use strict";

	$('table').addClass('table');
	$('blockquote').addClass('blockquote');
	$('.sidebar-div select, .footer-widget select, .orderby').selectize({
		create: false,
	});

	/*----------------------------------------------------*/
	/*	Mega menu script
	/*----------------------------------------------------*/
	function pergo_megamenu(){
		$('.pergo-megamenu').each(function(){
			var width, pos, left;

			if ( $(this).hasClass('megamenu-containerwidth') ) {
				var container = $(this).closest('.container');
				width = container.innerWidth();
				pos = $(this).offset();
				left = pos.left - (container.offset()).left;
				
			}
			if ( $(this).hasClass('megamenu-navbarwidth') ) {
				if( $(this).closest('header').hasClass('navbar-style2') )
					var container = $(this).closest('#navbarSupportedContent');
				else
					var container = $(this).closest('#navbarSupportedContent .navbar-nav');
				width = container.innerWidth();
				pos = $(this).offset();
				left = pos.left - (container.offset()).left;
			}
			$(this).find('.dropdown-menu').css({left : - left, minWidth: width, maxWidth: width,  });
			$(this).find('.dropdown-menu .caret').css( {'left' :  left+20 } );
		})
	}	

	$('.dropdown-menu').append('<span class="caret"></span>');
	

	$(window).on( 'resize', function(){
		if ( $(window).width() > 991 ) {
			pergo_megamenu();
		}else{
			$('.pergo-megamenu').find('.dropdown-menu').css({});
		}
	})

	
	$('.hero-class').each(function(){
		var section = $(this).closest('section');
		var sectionID = $(this).data('section_id');
		var sectionClass = $(this).data('class');
		
		if(section.hasClass('vc_section')){			
			if(!section.attr('id') || (section.attr('id') == '')){
				section.attr( 'id', sectionID );				
			}	
			section.addClass( sectionClass );	
			section.removeClass('wide-60');
		}else{
			$(this).closest('.vc_row').attr( 'id', sectionID );
			$(this).closest('.vc_row').addClass( sectionClass );
		}
	});

	$('.vc_row').each(function(){
    	 if($(this).children('.wpb_column').length > 1){
    	 	$(this).addClass('mul-cols');
	    	$(this).children('.wpb_column:last-child').addClass('last-column');
	    }
    });
	


	$(window).on('load', function() {

		//parallax scripts
         $('section.vc_parallax').each(function(){
            var opacity = $(this).data('opacity');
            var size = $(this).data('size');
            var position = $(this).data('position');
            var repeat = $(this).data('repeat');
            var attachment = $(this).data('attachment');
            var width = $(this).data('width');
            $(this).find('.vc_parallax-inner').css({
                opacity: opacity,
                backgroundSize: size,
                backgroundPosition: position,
                backgroundRepeat: repeat,
                backgroundAttachment: attachment,
                width: width
            });
        });
			/*----------------------------------------------------*/
		/*	Preloader
		/*----------------------------------------------------*/
		$('.content-3-img').css({opacity: 1});
		$("#loader").delay(100).fadeOut();
		$("#loader-wrapper").delay(100).fadeOut("fast");
				
		$(window).stellar({});
		
		pergo_megamenu();
		
	});
	

	$(window).on('scroll', function() {		
								
		/*----------------------------------------------------*/
		/*	Navigtion Menu Scroll
		/*----------------------------------------------------*/	
		
		var b = $(window).scrollTop();
		
		if( b > 72 ){		
			$(".navbar").addClass("scroll");
		} else {
			$(".navbar").removeClass("scroll");
		}				

	});


	/*----------------------------------------------------*/
	/*	Mobile Menu Toggle
	/*----------------------------------------------------*/

	if ( $(window).width() < 769 ) {
		$('.navbar-nav .nav-link').on('click', function() {	
			if(!$(this).closest('li').hasClass('menu-item-has-children'))	{		
				$('#navbarSupportedContent').css("height", "1px").removeClass("in").addClass("collapse");
				$('#navbarSupportedContent').removeClass("show");	
			}			
		});		
	}

	if ($(window).width() > 769) {
		$('.navbar.hover-menu .nav-item.dropdown > a').on('click', function() {
			if( this.href != '#' ){
				location.href = this.href;
			}	      	
	    });
	}


	/*----------------------------------------------------*/
	/*	Hero Fullscreen Slider
	/*----------------------------------------------------*/
	var $slides = $('#slides');
	var slidecount = $('#slides .hero-slide').length;
	// Pause Slider on Mouseover
	var sliderTimeout;

	$slides.superslides({
		play: 6000,
		animation: "fade",
		pagination: true,
		pause: true,
	});

	$slides.on('mouseenter', function() {
	   clearTimeout(sliderTimeout);
	   $(this).superslides('stop');
	});
	if(slidecount > 1){
		$slides.on('mouseleave', function() {
		   sliderTimeout = setTimeout(function() { $slides.superslides('start'); }, 5000);
		});		
	}else{
		$slides.superslides('stop');
	}


	/*----------------------------------------------------*/
	/*	Hero Text Rotator
	/*----------------------------------------------------*/

	$('.hero-slider').flexslider({
		animation: "fade",
		controlNav: true,
		directionNav: false,  
		slideshowSpeed: 5500,   
		animationSpeed: 1500,  
		rtl: $('body').hasClass('rtl')? true : false,
		start: function(slider){
			$('body').removeClass('loading');
		}
	});

	/*product-gallery-carousel*/
    $('.product-gallery-carousel').owlCarousel({
         margin: 15,
         nav: false,
         dots: true,
         items: 3,
         rtl: $('body').hasClass('rtl')? true : false,
    });

    /*------------------------------------------------
     Slik slider service section.
    -------------------------------------------------- */
    $('.product-slider').owlCarousel({
        margin: 30,
         nav: false,
         dots: true,
         items: 3,
         rtl: $('body').hasClass('rtl')? true : false,
	});

    
    /* count control */
    $('.count-control').on('click', function(){
    	var $quantity_input = $(this).closest('.quantity').find('.qty');
        var old = parseInt($quantity_input.val());
        if($(this).hasClass('plus')){
          if(parseInt($quantity_input.attr('max')) != -1 ){
            if( (parseInt($quantity_input.attr('max'))-1) >= old ){
             $quantity_input.val(old+1);
            }
          }else{
            $quantity_input.val(old+1);
          }             

        }else{
          if(old > 1){
            $quantity_input.val(old-1);
          }     
        }

        $(this).closest('form').find('button[type="submit"]').prop('disabled', false);
        return false;
    });


	/*----------------------------------------------------*/
	/*	OnScroll Animation
	/*----------------------------------------------------*/
	if(PERGO.animation == 'off'){
		$('.animated').addClass('visible');
    }else{
		$('.animated').appear(function() {

	        var elem = $(this);
	        var animation = elem.data('animation');

	        

	        if ( !elem.hasClass('visible') ) {
	        	var animationDelay = elem.data('animation-delay');
	            if ( animationDelay ) {
	                setTimeout(function(){
	                    elem.addClass( animation + " visible" );
	                }, animationDelay);

	            } else {
	                elem.addClass( animation + " visible" );
	            }
	        }
						
		});
	}


	/*----------------------------------------------------*/
	/*	Animated Scroll To Anchor
	/*----------------------------------------------------*/
	
	$('.header a[href^="#"], .page a.btn[href^="#"], .page a.internal-link[href^="#"]').on('click', function (e) {
		
		e.preventDefault();

		var target = this.hash,
			$target = jQuery(target);

		if($target.length > 0){	

			$('html, body').stop().animate({
				'scrollTop': $target.offset().top - 60 // - 200px (nav-height)
			}, 'slow', 'easeInSine', function () {
				window.location.hash = target;
			});
		}
		
	});
	
	
	/*----------------------------------------------------*/
	/*	ScrollUp
	/*----------------------------------------------------*/
	
	$.scrollUp = function (options) {

		// Defaults
		var defaults = {
			scrollName: 'scrollUp', // Element ID
			topDistance: 600, // Distance from top before showing element (px)
			topSpeed: 800, // Speed back to top (ms)
			animation: 'fade', // Fade, slide, none
			animationInSpeed: 200, // Animation in speed (ms)
			animationOutSpeed: 200, // Animation out speed (ms)
			scrollText: '', // Text for element
			scrollImg: false, // Set true to use image
			activeOverlay: false // Set CSS color to display scrollUp active point, e.g '#00FFFF'
		};

		var o = $.extend({}, defaults, options),
			scrollId = '#' + o.scrollName;

		// Create element
		$('<a/>', {
			id: o.scrollName,
			href: '#top',
			title: o.scrollText
		}).appendTo('body');
		
		// If not using an image display text
		if (!o.scrollImg) {
			$(scrollId).text(o.scrollText);
		}

		// Minium CSS to make the magic happen
		$(scrollId).css({'display':'none','position': 'fixed','z-index': '2147483647'});

		// Active point overlay
		if (o.activeOverlay) {
			$("body").append("<div id='"+ o.scrollName +"-active'></div>");
			$(scrollId+"-active").css({ 'position': 'absolute', 'top': o.topDistance+'px', 'width': '100%', 'border-top': '1px dotted '+o.activeOverlay, 'z-index': '2147483647' });
		}

		// Scroll function
		$(window).on('scroll', function(){	
			switch (o.animation) {
				case "fade":
					$( ($(window).scrollTop() > o.topDistance) ? $(scrollId).fadeIn(o.animationInSpeed) : $(scrollId).fadeOut(o.animationOutSpeed) );
					break;
				case "slide":
					$( ($(window).scrollTop() > o.topDistance) ? $(scrollId).slideDown(o.animationInSpeed) : $(scrollId).slideUp(o.animationOutSpeed) );
					break;
				default:
					$( ($(window).scrollTop() > o.topDistance) ? $(scrollId).show(0) : $(scrollId).hide(0) );
			}
		});

		// To the top
		$(scrollId).on('click', function(event){
			$('html, body').animate({scrollTop:0}, o.topSpeed);
			event.preventDefault();
		});

	};
	if (PERGO.backtotop == 'on') {
		$.scrollUp();
	}
	


	/*----------------------------------------------------*/
	/*	Video Background
	/*----------------------------------------------------*/
	if($('.video-play').length > 0){
		$('.video-play').each(function(){
			var poster = $(this).data('poster');
			var mp4 = $(this).data('mp4');
			var webm = $(this).data('webm');
			var ogv = $(this).data('ogv');
			var id = $(this).closest('section').attr('id');
			console.log(id);
			$(this).closest('section').vidbg({
					'poster': poster,
					'mp4': mp4,
				  	'webm': webm,
				  	'ogv': ogv
			}, {
            // Options
            muted: true,
            loop: true,
			overlay: true,
            overlayColor: '#000',
            overlayAlpha: 0.5,
          });
		})
		
	}


	/*----------------------------------------------------*/
	/*	Portfolio Masonry Grid
	/*----------------------------------------------------*/
		
	$('.grid').masonry({
	  itemSelector: '.grid-item',
	  columnWidth: '.grid-sizer',
	  percentPosition: true
	});

	var $gridcontainer = $('#portfolio-grid');
	$gridcontainer.imagesLoaded( function() {
			$gridcontainer.masonry({
			itemSelector: '.grid-item',
			columnWidth: '.grid-sizer',
			percentPosition: true
		});
	});


	/*----------------------------------------------------*/
	/*	Portfolio Masonry Grid
	/*----------------------------------------------------*/
		
	$('.product-grid').masonry({
	  itemSelector: '.grid-item',
	  columnWidth: '.grid-sizer',
	  percentPosition: true
	});

	var $gridcontainer = $('#product-grid');
	$gridcontainer.imagesLoaded( function() {
			$gridcontainer.masonry({
			itemSelector: '.grid-item',
			columnWidth: '.grid-sizer',
			percentPosition: true
		});
	});


	/*----------------------------------------------------*/
	/*	Filterable Portfolio
	/*----------------------------------------------------*/

	$("#portfolio-1 .row").mixitup({
		targetSelector: '.portfolio-item',
	});

	


	/*----------------------------------------------------*/
	/*	Single Image Lightbox
	/*----------------------------------------------------*/
			
	$('.image-link, .woocommerce-product-gallery__image a').magnificPopup({
	  type: 'image',
	  gallery:{
	    enabled:true
	  }
	});

	/*----------------------------------------------------*/
	/*	Video Link #1 Lightbox
	/*----------------------------------------------------*/
	$('.video-popup1').each(function(){		
		var videoUrl = $(this).attr( 'href' );
		$(this).magnificPopup({
		    type: 'iframe',
		  	  
				iframe: {
					patterns: {
						youtube: {
			   
							index: 'youtube.com',
							src: videoUrl
				
								}
							}
						}		  		  
		});
	});


	/*----------------------------------------------------*/
	/*	Video Link #2 Lightbox
	/*----------------------------------------------------*/
	$('.video-popup2').each(function(){
		var videoUrl = $(this).attr( 'href' );
		$(this).magnificPopup({
		    type: 'iframe',
		  	  
				iframe: {
					patterns: {
						youtube: {
			   
							index: 'youtube.com',
							src: videoUrl
				
								}
							}
						}		  		  
		});
	});


	/*----------------------------------------------------*/
	/*	Statistic Counter
	/*----------------------------------------------------*/

	$('.statistic-number').each(function () {
		$(this).appear(function() {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 4000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				}
			});
		},{accX: 0, accY: 0});
	});


	/*----------------------------------------------------*/
	/*	Animated Progress Bar
	/*----------------------------------------------------*/
	var delay = 500;
	$(".progress-bar").each(function(i){
	    $(this).delay( delay*i ).animate( { width: $(this).attr('aria-valuenow') + '%' }, delay );

	    $(this).prop('Counter',0).animate({}, {
	        duration: delay,
	        easing: 'swing',
	        step: function (now) {
	            $(this).text(Math.ceil(now)+'%');
	        }
	    });
	});


	/*----------------------------------------------------*/
	/*	Testimonials Rotator Slick Carousel
	/*----------------------------------------------------*/

	var reviews = $('#reviews-1 .center');
	var attr = reviews.attr('data-column_lg');
	if (typeof attr !== typeof undefined && attr !== false) {
	    var column_lg = parseInt(attr);
	}else{
		var column_lg = 3;
	}
	var attr = reviews.attr('data-column_md');
	if (typeof attr !== typeof undefined && attr !== false) {
	    var column_md = parseInt(attr);
	}else{
		var column_md = 1;
	}

	var attr = reviews.attr('data-loop');
	if (typeof attr !== typeof undefined && attr !== false) {
	    var loop = parseInt(attr);
	}else{
		var loop = 1;
	}

	var attr = reviews.attr('data-autoplay');
	if (typeof attr !== typeof undefined && attr !== false) {
	    var autoplay = parseInt(attr);
	}else{
		var autoplay = 1;
	}
	
	reviews.slick({
		rtl: $('body').hasClass('rtl')? true : false,
		centerMode: true,
		autoplay: autoplay,
		centerPadding: '0px',
		speed: 800,
		slidesToShow: column_lg,
		dots: true,
		responsive: [
			{
				breakpoint: 1199,
				settings: {
				arrows: false,
				centerMode: true,
				centerPadding: '0px',
				slidesToShow: column_lg
				}
			},
			{
				breakpoint: 991,
				settings: {
				arrows: false,
				centerMode: true,
				centerPadding: '0px',
				slidesToShow: column_lg
				}
			},
			{
				breakpoint: 990,
				settings: {
				arrows: false,
				centerMode: true,
				centerPadding: '0px',
				slidesToShow: column_md
				}
			},
			{
				breakpoint: 767,
				settings: {
				arrows: false,
				centerMode: true,
				centerPadding: '0px',
				slidesToShow: column_md
				}
			},
			{
				breakpoint: 648,
				settings: {
				arrows: false,
				centerMode: true,
				centerPadding: '0px',
				slidesToShow: column_md
				}
			}
		]
	});


	/*----------------------------------------------------*/
	/*	Testimonials Rotator Flexslider
	/*----------------------------------------------------*/
	
	$('.testimonials .flexslider').flexslider({
		animation: "fade",
		controlNav: true,
		directionNav: false,  
		rtl: $('body').hasClass('rtl')? true : false,
		slideshowSpeed: 5000,   
		animationSpeed: 2000, 
		pauseOnAction: true,            
		pauseOnHover: true,  
		start: function(slider){
			$('body').removeClass('loading');
		}
	});


	var owl = $('.post-slider');
		var attr = owl.attr('data-column_lg');
		if (typeof attr !== typeof undefined && attr !== false) {
		    var column_lg = parseInt(attr);
		}else{
			var column_lg = 3;
		}
		var attr = owl.attr('data-column_md');
		if (typeof attr !== typeof undefined && attr !== false) {
		    var column_md = parseInt(attr);
		}else{
			var column_md = 2;
		}

		var attr = owl.attr('data-loop');
		if (typeof attr !== typeof undefined && attr !== false) {
		    var loop = parseInt(attr);
		}else{
			var loop = 1;
		}

		var attr = owl.attr('data-autoplay');
		if (typeof attr !== typeof undefined && attr !== false) {
		    var autoplay = parseInt(attr);
		}else{
			var autoplay = 1;
		}

		var attr = owl.attr('data-dots');
		if (typeof attr !== typeof undefined && attr !== false) {
		    var dots = parseInt(attr);
		}else{
			var dots = 1;
		}
			owl.owlCarousel({
				rtl: $('body').hasClass('rtl')? true : false,
				items: column_lg,
				loop:loop,
				autoplay:autoplay,
				dots:dots,
				margin: 30,
				navBy: 1,
				autoplayTimeout: 4500,
				autoplayHoverPause: false,
				smartSpeed: 1500,
				responsive:{
					0:{
						items:1
					},
					767:{
						items:1
					},
					768:{
						items:column_md
					},
					991:{
						items:column_md
					},
					1000:{
						items:column_lg
					}
				}
		});

	var owl = $('.team-slider');
		var attr = owl.attr('data-column_lg');
		if (typeof attr !== typeof undefined && attr !== false) {
		    var column_lg = parseInt(attr);
		}else{
			var column_lg = 3;
		}
		var attr = owl.attr('data-column_md');
		if (typeof attr !== typeof undefined && attr !== false) {
		    var column_md = parseInt(attr);
		}else{
			var column_md = 2;
		}

		var attr = owl.attr('data-loop');
		if (typeof attr !== typeof undefined && attr !== false) {
		    var loop = parseInt(attr);
		}else{
			var loop = 1;
		}

		var attr = owl.attr('data-autoplay');
		if (typeof attr !== typeof undefined && attr !== false) {
		    var autoplay = parseInt(attr);
		}else{
			var autoplay = 1;
		}

		var attr = owl.attr('data-dots');
		if (typeof attr !== typeof undefined && attr !== false) {
		    var dots = parseInt(attr);
		}else{
			var dots = 1;
		}
			owl.owlCarousel({
				items: column_lg,
				loop:loop,
				autoplay:autoplay,
				dots:dots,
				margin: 30,
				navBy: 1,
				autoplayTimeout: 4500,
				autoplayHoverPause: false,
				smartSpeed: 1500,
				rtl: $('body').hasClass('rtl')? true : false,
				responsive:{
					0:{
						items:1
					},
					767:{
						items:1
					},
					768:{
						items:column_md
					},
					991:{
						items:column_md
					},
					1000:{
						items:column_lg
					}
				}
		});
	

	/*----------------------------------------------------*/
	/*	Bottom Quick Form
	/*----------------------------------------------------*/
	var bottomFormHeight = $('.bottom-form-holder').outerHeight();

	$('.bottom-form-header').parent().delay(1000).animate({bottom: -bottomFormHeight}, 1000, function(){
		$(this).find('.bottom-form-header').addClass('closed');
	}); 
	
	
	$('.bottom-form-header').on('click', function(){
		if ($(this).hasClass('closed')){
			$(this).next('.bottom-form-holder').css({display:'block'}).parent().animate({bottom: 0}, 1000, function(){
				$(this).find('.bottom-form-header').removeClass('closed');
			});
		} else {
			$(this).parent().animate({bottom: -bottomFormHeight}, 1000, function(){
				$(this).find('.bottom-form-header').addClass('closed');
			});
		}
		
		return false;
	});

	var preloader = $('#loader-wrapper'),
	loader = preloader.find('.loading-center');
	loader.fadeOut();
	preloader.delay(1500).fadeOut('slow');



});