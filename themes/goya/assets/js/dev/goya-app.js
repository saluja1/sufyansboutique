(function ($) {
	'use strict';

	var GOYA = GOYA || {};
	
	GOYA = {
		init: function() {
			var self = this,
					obj;

			self.defaultConfig();
			self.bindEvents();

		},

		defaultConfig: function() {

			"use strict";
			var self = this;

			self.$document = $(document);
			self.$window = $(window);
			self.$html = $('html');
			self.$body = $('body');
			// Touch support checker
			self.$isTouch = (self.$html.hasClass('touch')) ? true : false;
			// WP admin bar
			self.$adminbar = $('#wp-toolbar').parent();
			// Admin bar height
			self.$adminbarHeight = (self.$adminbar.length) ? self.$adminbar.outerHeight()  : 0;
			// Top bar
			self.$topBar = $('#top-bar');
			// Global notice
			self.$campaignBar = $('.et-global-campaign');
			// Main header
			self.$header = $('#header');
			// Header height
			self.$headerHeight = self.$header.outerHeight();
			// Header spacer
			//self.$headerSpacer = $('.header-spacer');
			// Global site wrapper
			self.$wrapper = $('#wrapper');
			// Overlay to close panels
			self.$clickCapture = $('.click-capture');
			// Floating Labels
			self.$floatingLabels = (self.$body.hasClass('floating-labels')) ? true : false;
			// Header transparent
			self.$headerIsTransparent = (self.$body.hasClass('page-header-transparent')) ? true : false;
			// Fixed header
			self.$headerIsFixed = (self.$body.hasClass('header-sticky')) ? true : false;
			// Product Header
			self.$productIsFixed = (self.$body.hasClass('fixed-product-bar')) ? true : false;
			self.$productFixedTop = (self.$body.hasClass('fixed-product-bar-top')) ? true : false;
			// Login/Register popup
			self.$isLoginPopup = (self.$body.hasClass('et-login-popup')) ? true : false;
			// Main shop wrapper
			self.$shopWrap = $('#shop-products');
			// Check main shop 
			self.$isShop = (self.$shopWrap.length) ? true : false;
			// Single product container
			self.$singleProductWrap = $('.et-product-detail');
			// Check single product
			self.$isProduct = (self.$singleProductWrap.length) ? true : false;
			// Product Showcase
			self.$productShowcase = self.$singleProductWrap.find('.showcase-active');
			self.$isProductShowcase = (self.$productShowcase.length) ? true : false;
			// Distraction Free Checkout
			self.$isCheckout = (self.$body.hasClass('woocommerce-checkout')) ? true : false;
			self.$isBareCheckout = (self.$body.hasClass('checkout-distraction-free')) ? true : false;
			// Button to open cart panel
			self.$quickCartBtn = $('.quick_cart');
			// Cart Panel Widget Ajax
			self.miniCartAjax = null;
			// Mobile menu panel
			self.ajaxMiniCart = (theme_vars.settings.cart_icon == 'mini-cart') ? true : false;
			self.miniCartAuto = (self.ajaxMiniCart == true && theme_vars.settings.minicart_auto == true) ? true : false;
			//self.$mobileMenu = $('#mobile-menu');
			// Button to open mobile menu
			self.$menuToggle = $('.mobile-toggle');
			self.$fullscreenToggle = $('.fullscreen-toggle');
			// Shop filters Panel
			self.$sideFilters = $('#side-filters');
			// Side panels CLOSE button
			self.$cc_close = $('.et-close');
			// Detect mobile device
			self.$mobileDet = new MobileDetect(window.navigator.userAgent);
			// Product Gallery Zoom
			self.$zoomEnabled = (!self.$isTouch && $('.product-showcase .product-gallery').hasClass('zoom-enabled'));
			// Shop filters on top
			self.$shopFiltersTop = $('.shop-container').hasClass('shop-sidebar-header') ? true : false;
			// Show variations on product listing
			self.$showListVariations = $('.et-main-products').hasClass('et-shop-show-variations') ? true : false;
			// Show additional product image on hover
			self.$showHoverImage = $('.et-main-products').hasClass('et-shop-hover-images') ? true : false;
			// Product details accordion
			self.$prodAccordion = $('.woocommerce-tabs').hasClass('tabs-accordion') ? true : false;

		},

		/**
		 *	Bind scripts
		 */
		bindEvents: function() {
			"use strict";

			var self = this;

			/* Document.Ready */
			//self.headerPlaceholder(); //Disabled

			self.preloadOverlay();

			self.animation();

			if (self.$mobileDet.mobile()) {
				self.fixVH();
			}

			if (self.$floatingLabels) self.formStyling();
			
			self.slickCarousel();
			
			if (self.$isShop) {
				if (self.$shopFiltersTop) self.shopFiltersHeader();
				self.shopCatSeparator();
				self.shopFilterWidgets();
				self.shopDisplaySwitch();
				self.shopInfiniteScrolling();
			}
			if (self.$isProduct) {
				
				if (self.$prodAccordion) self.productDetAccordion();
				
				self.productFeaturedVideo();
				if (self.$isProductShowcase) self.singleProductShowcase();
				self.productCommentForm();
				if (self.$zoomEnabled) self.productZoomGallery();
				self.productPswp();
			}

			self.quantityButtons();
			
			if (self.$isCheckout) {
				self.checkoutOrder();
				if (theme_vars.settings.checkoutTermsPopup == true) self.termsPopup();
			}

			if ( ! (self.$isCheckout && self.$isBareCheckout) ) {

				// Don't execute on checkout
				if (self.$headerIsFixed) self.stickyHeader();
				self.megaMenu();
				self.sidePanels();
				self.customScrollBars();
				
				self.ajaxAddToCart();
				self.miniCartSetup();
				self.shopCartUpdate();
				
				self.productQuickView();
				self.masonryLayout();
				
				self.relatedProductsSlider();
				
				if (self.$isLoginPopup) self.loginPopup();
				self.loginForm();

				self.instrinsicRatioVideos();

				if (self.$showListVariations) self.productListVariations();
				self.singleProductVariations();

				self.blogInfiniteScrolling();
				self.magnificInline();
				self.mfpLightbox();
				self.ajaxSearch();
				self.countdownTimer();
				self.campaignBar();
				self.toggleFooterWidgets();

			}

			self.wishlistCounter();
			self.toTopBtn();

		
			/* Window.Load */
			self.$window.on( 'load', function() {

				
				self.mfpGallery();
				self.mfpAutomatic();

				// Sticky product bar
				if (self.$isProduct) {	
					if (self.$productIsFixed) self.stickyProductBar();
				}

			});


			/* Window.Resize */
			self.$window.on('resize', _.debounce(function() {
				//self.headerPlaceholder();
				self.$headerHeight = self.$header.outerHeight();
				self.$adminbarHeight = self.$adminbar.outerHeight();
			}, 10)).trigger('resize');


			/* Window.Scroll */
			self.$window.scroll( function() {
				self.fixedContent();
			});

			
			/* Window.OrientationChange Tablets */
			self.$window.on( 'orientationchange', function() {

			});

		},

		/* Page Loading Overlay */
		preloadOverlay: function() {
			var self = this;

			if (theme_vars.settings.pageLoadTransition == true) {

				var showOverlay = $('html').data('showOverlay') || 'yes';

				self.isIos = navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPhone/i);

				// Don't show on # links or downloads
				$('a').on('click', function(event) {
					if ($(this).hasClass('download-on-click') || $(this).attr('href') == '#') {
						$('html').data('showOverlay', 'no' );
						showOverlay = 'no';	
					} else {
						$('html').data('showOverlay', 'yes' );
						showOverlay = 'yes';	
					}
					
				});

				if (!self.isIos) {
					self.$window.on('beforeunload', function(e) {

				    if( showOverlay === 'yes' ){
						self.$html.removeClass('et-page-loaded');
				    }
				    else {
				    	$('html').data('showOverlay', 'yes' );
				    	showOverlay = 'yes';
				    }

					});

				}

				// Hide loading overlay
				if ('onpagehide' in window) {
					window.addEventListener('pageshow', function() {
						setTimeout(function() {
							self.$html.addClass('et-page-loaded'); 
						}, 200);
					}, false);
				} else {
					setTimeout(function() {
						self.$html.addClass('et-page-loaded'); 
					}, 200);
				}

				self.$body.removeClass('et-preload');
			}

		},

		/* Campaign Bar */
		campaignBar: function() {
			var self = this,
					$closeButton = $('.remove', self.$campaignBar);

			// Close bar
			$closeButton.on('click', function(e) {
				e.preventDefault();
				// Adjust product showcase
				if (self.$isProductShowcase) self.singleProductShowcase(true);

				self.$campaignBar.slideUp('400', function() {
					self.$campaignBar.remove();
					self.$body.removeClass('has-campaign-bar');
					// Set cookie
					$.cookie('et-global-campaign', '1', { expires: 1, path: '/' });
				});
				
			});

		},

		/* Sticky Header */
		stickyHeader: function() {
			var self = this,
				headerTopSpace = 0,
				stick = 'header_on_scroll';

			stickyHeaderTask();

			self.$window.on('scroll.sticky_header', function(){

				// for the customizer preview
				if ( !self.$body.hasClass('header-sticky') && !self.$body.hasClass('megamenu-active') ) {
					self.$body.removeClass(stick);
					return;
				}
				
				stickyHeaderTask();

			}).trigger('scroll.sticky_header');

			self.$window.on('resize', _.debounce(function(){
				stickyHeaderTask();
			}, 10)).trigger('resize');

			function stickyHeaderTask () {

				var hasTopBar = (self.$topBar.length && !self.$topBar.parent().hasClass('site-header') && self.$topBar.is(':visible')) ? true : false,
						hasCampaignBar = (self.$campaignBar.length && self.$campaignBar.is(':visible')) ? true : false,
						hasAdminBar = (self.$adminbar.length) ? true : false,
						topBarHeight = hasTopBar ? self.$topBar.outerHeight(true) : 0,
						headerTopSpace = hasCampaignBar ? topBarHeight + self.$campaignBar.outerHeight(true) : topBarHeight;

				if ( hasAdminBar && $(window).width() < 601) {
					headerTopSpace = headerTopSpace + self.$adminbarHeight;					
				}

				if (self.$document.scrollTop() > headerTopSpace) {
					if(!self.$body.hasClass(stick)) {
						self.$body.addClass(stick);
					}
					self.$body.removeClass('megamenu-active');
				} else if (self.$document.scrollTop() < headerTopSpace && (self.$document.scrollTop() > 0) && !self.$body.hasClass('megamenu-active')) {
					if(self.$body.hasClass(stick)) {
						self.$body.removeClass(stick);
					}
				} else {
					if (!self.$body.hasClass('megamenu-active')) {
						self.$body.removeClass(stick);
					}
				}
			}

		},

		/* Mega Menu */
		megaMenu: function() {
			var self = this;

			// Megamenu full width activates sticky mode with transparent headers
			if (!self.$body.hasClass('megamenu-fullwidth') && !self.$body.hasClass('page-header-transparent'))
				return;

			var hasTopBar = (self.$topBar.length && !self.$topBar.parent().hasClass('site-header') && self.$topBar.is(':visible')) ? true : false,
					hasCampaignBar = (self.$campaignBar.length && self.$campaignBar.is(':visible')) ? true : false,
					topBarHeight = hasTopBar ? self.$topBar.outerHeight(true) : 0,
					headerTopSpace = hasCampaignBar ? topBarHeight + self.$campaignBar.outerHeight(true) : topBarHeight,
					stick = 'header_on_scroll',
					$megamenu = $('.et-header-menu > li.menu-item-mega-parent');
					
			self.$body.removeClass(stick);

			$megamenu.on({
		    mouseenter: function () {
		      if (!self.$body.hasClass('megamenu-active') && !self.$body.hasClass(stick) ) {
						self.$body.addClass('megamenu-active').addClass(stick);
  				}
		    }
			});
			$megamenu.parent('.et-header-menu').on({
		    mouseleave: function () {
		    	if (self.$body.hasClass('megamenu-active') && (self.$document.scrollTop() <= headerTopSpace)) {
  					self.$body.removeClass(stick).removeClass('megamenu-active');
  				}
		    }
			});

		},

		stickyProductBar: function() {
			var self = this,
					$stickyBar = $('.sticky-product-bar'),
					$proDetail = $('.et-product-detail'),
					$varForm = $('.product-information').find('form.cart'),
					$trigger = $('.sticky-bar-trigger').offset().top,
					stick = 'product_on_scroll';

					if ($proDetail.hasClass('et-product-gallery-column') || $proDetail.hasClass('et-product-gallery-grid') || self.$productShowcase.length == true ) {
						if ($('.full_description').length) {
							$trigger = $('.full_description').offset().top;
						} else {
							$trigger = $('.woocommerce-tabs').offset().top - 90;;
						}
					}

			// Product bar visibility
			self.$window.scroll(_.debounce(function(){
				if (self.$window.scrollTop() > $trigger) {
					$stickyBar.addClass('active');
					self.$body.addClass('product-bar-visible');
					if (!self.$body.hasClass(stick)) {
						self.$body.addClass(stick);
					}
				} else {
					$stickyBar.removeClass('active');
					self.$body.removeClass('product-bar-visible');
					if(self.$body.hasClass(stick)) {
						self.$body.removeClass(stick);
					}
				}
			}, 20));

			// Click on Select Options button
			$('.sticky_add_to_cart').on('click', function(e) {
				e.preventDefault();

				$('html, body').animate({'scrollTop': $varForm.offset().top - self.$headerHeight - self.$adminbarHeight  - 20 }, 200);
				return false;

			});

		},

		/* Slick Carousel */
		slickCarousel: function(el) {
			var self = this,
					// Add .slick class to element to load correct styling
					$sliders = el ? el.addClass('slick') : $('.slick');

			$sliders.each(function() {
				var $slider = $(this),
						$columns = ($slider.data('columns') ? $slider.data('columns') : 1),
						$mobile_cols = ($slider.data('mobile-columns') ? $slider.data('mobile-columns') : false),
						$scroll = ($slider.data('slides-to-scroll') ? $slider.data('slides-to-scroll') : 1),
						$infinite = ($slider.data('infinite') === false ? false : true),
						$navigation = ($slider.data('navigation') === true ? true : false),
						$speed = ($slider.data('speed') ? $slider.data('speed') : 600),
						$autoplay = ($slider.data('autoplay') === true ? true : false),
						$autoplaySpeed = ($slider.data('autoplay-speed') ? $slider.data('autoplay-speed') : 2500),
						$pagination = ($slider.data('pagination') === true ? true : false),
						$adaptiveHeight = ($slider.data('adaptive-height') === true ? true : false),
						$center = ($slider.data('center') ? $slider.data('center') : false),
						$disablepadding = ($slider.data('disablepadding') ? $slider.data('disablepadding') : false),
						$fade = ($slider.data('fade') === true ? true : false),
						$vertical = ($slider.data('vertical') === true ? true : false),
						$asNavFor = $slider.data('asnavfor'),
						$rtl = self.$body.hasClass('rtl'),
						$pause = ($slider.data('pause') === true ? true : false);
				
				var $args = {
						dots: $pagination,
						arrows: $navigation,
						adaptiveHeight: $adaptiveHeight,
						infinite: $infinite,
						speed: $speed,
						centerMode: $center,
						slidesToShow: $columns,
						slidesToScroll: $scroll,
						rtl: $rtl,
						autoplay: $autoplay,
						centerPadding: ($disablepadding ? 0 : '10%'),
						autoplaySpeed: $autoplaySpeed,
						pauseOnHover: $pause,
						edgeFriction: 0,
						touchThreshold: 30,
						rows: 0,
						vertical: $vertical,
						verticalSwiping: $vertical,
						focusOnSelect: true,
						fade: $fade,
						prevArrow: '<a class="slick-prev">'+ theme_vars.icons.prev_arrow +'</a>',
						nextArrow: '<a class="slick-next">'+ theme_vars.icons.next_arrow +'</a>',
						// Responsive breakpoints
						responsive: [
							{
								breakpoint: 1441,
								settings: {
									slidesToShow: ($columns < 6 ? $columns : ($vertical ? $columns-1 : 6)),
									slidesToScroll: ( ($scroll > 1 && $columns < 6 && $scroll == $columns) ? $columns : ( ($scroll > 1 && $vertical && $scroll == $columns) ? $columns-1 : ( ($scroll != $columns) ? $scroll : 1 ) ) ),
									centerPadding: ($disablepadding ? 0 : '40px')
								}
							},
							{
								breakpoint: 1200,
								settings: {
									slidesToShow: ($columns < 4 ? $columns : ($vertical ? $columns-1 : 4)),
									slidesToScroll: ( ($scroll > 1 && $columns < 4 && $scroll == $columns) ? $columns : ( ($scroll > 1 && $vertical && $scroll == $columns) ? $columns-1 : ( ($scroll != $columns) ? $scroll : 1 ) ) ),
									centerPadding: ($disablepadding ? 0 : '40px')
								}
							},
							{
								breakpoint: 992,
								settings: {
									slidesToShow: ($columns < 3 ? $columns : ($vertical ? $columns-1 : 3)),
									slidesToScroll: ( ($scroll > 1 && $columns < 3 && $scroll == $columns) ? $columns : ( ($scroll > 1 && $vertical && $scroll == $columns) ? $columns-1 : ( ($scroll != $columns) ? $scroll : 1 ) ) ),
									centerPadding: ($disablepadding ? 0 : '40px')
								}
							},
							{
								breakpoint: 768,
								settings: {
									slidesToShow: ($columns < 3 ? $columns : ($vertical ? $columns-1 : 2)),
									slidesToScroll: ( ($scroll > 1 && $columns < 2 && $scroll == $columns) ? $columns : ( ($scroll > 1 && $vertical && $scroll == $columns) ? $columns-1 : ( ($scroll != $columns) ? $scroll : 1 ) ) ),
									centerPadding: ($disablepadding ? 0 : '40px')
								}
							},
							{
								breakpoint: 576,
								settings: {
									slidesToShow: ($mobile_cols > 1 ? $mobile_cols : 1),
									slidesToScroll: 1,
									centerPadding: ($disablepadding ? 0 : '15px')
								}
							}
						]
					};

				if($slider.data('slick')) {
					$args = $slider.data('slick');
				}

				// Navigation for another slider
				if ($asNavFor && $($asNavFor).is(':visible')) {
					$args.asNavFor = $asNavFor; 
				}
				// Add wrapper to banner slider
				if ($slider.hasClass('et-banner-slider')) {
					$slider.children().wrap('<div></div>');

					$slider.on('init', function() {
						// Add new animation
						bannerAddAnimation($slider, $slider.find('.slick-track .slick-active'));
					});

					$slider.on('afterChange', function(event, slick, currentSlide) {
						if ($slider.slideIndex != currentSlide) {
							$slider.slideIndex = currentSlide;
							
							// Remove previous animation
							if ($slider.$bannerContent) {
								$slider.$bannerContent.removeClass($slider.bannerAnimation);
							}
							bannerAddAnimation($slider, $slider.find('.slick-track .slick-active'));
						}
					});

					$slider.on('setPosition', function(event, slick) {
						var $currentSlide = $(slick.$slides[slick.currentSlide]),
							$currentBanner = $currentSlide.children('.et-banner');
						
						if ($currentBanner.hasClass('has-alt-image')) {
							if ($currentBanner.children('.et-banner-alt-image').is(':visible')) {
								$slider.addClass('alt-image-visible');
							} else {
								$slider.removeClass('alt-image-visible');
							}
						} else {
							$slider.removeClass('alt-image-visible');
						}
					});

				}
				// Use centerMode for products sliders
				if ($slider.hasClass('et-main-products')) {
					$args.responsive[4].settings.slidesToShow = 2;
					/*$args.responsive[4].settings.centerMode = true;
					$args.responsive[4].settings.centerPadding = '30px';*/
				}

				// WC Gallery: check if it's thumbnails list
				if ($slider.hasClass('product-thumbnails')) {
					// Drag to any slide position
					$args.swipeToSlide = true;
					$args.responsive[1].settings.slidesToShow = 6;
				}

				if ($slider.hasClass('et_location_list')) {
					// Drag to any slide position
					$args.swipeToSlide = true;
					$args.responsive[2].settings.slidesToShow = 3;
					$args.responsive[3].settings.vertical = false;
					$args.responsive[4].settings.vertical = false;
				}
				
				// VC image slider
				if ($slider.hasClass('et-image-slider')) {
					$slider.on('init', function() {
						_.delay(function(){
							$slider.slick('setPosition');
						}, 150);
					});
				}
				
				if ($center) {
					$slider.on('init', function() {
						$slider.addClass('centered');
					});
				}

				// Animations
				$slider.on('beforeChange', function(event, slick, currentSlide, nextSlide){
					if (slick.$slides) {
						_.delay(function(){
							self.$window.trigger('scroll.et-animation');
						}, 150);
					}
				});

				$slider.on('breakpoint', function(event, slick, breakpoint){
					slick.$slides.data('et-animated', false);
					self.$window.trigger('scroll.et-animation');
				});

				$slider.on('afterChange', function(event, slick, currentSlide, nextSlide){
					if (slick.$slides) {
						self.$window.trigger('scroll.et-animation');
					}
				});

				$slider.on('setPosition', function(event, slick) {
					if (slick.$slides) {
						self.$window.trigger('scroll.et-animation');
					}
				});

				// Initialize Slick
				$slider.not('.slick-initialized').slick($args);

			});

			function bannerAddAnimation ($slider, $slideActive) {
				$slider.$bannerContent = $slideActive.find('.et-banner-text-inner');
				$slider.$bannerItem = $slideActive.find('.et-banner');
				
				if ($slider.$bannerContent.length) {
					$slider.bannerAnimation = $slider.$bannerContent.data('animate');
					$slider.$bannerContent.addClass($slider.bannerAnimation);
				}

				// Check active banner color mode
				$slider.removeClass('banner-light');
				if (($slider.$bannerItem).hasClass('text-color-light')) {
					$slider.addClass ('banner-light');
				}
			};

		},

		/* Side Panels: mobile menu, cart, side/mobile filters */
		sidePanels: function() {
			var self = this,
					$mobileMenu = $('#mobile-menu-container'), 
					$expandSub = $mobileMenu.find('li:has(".sub-menu")>a').next('.et-menu-toggle');

			// FullScreen Menu
			function fullscreenMenuAction($action) {
				if ($action == 'play') {
					self.$wrapper.addClass('open-menu');
					self.$html.css('width', 'auto').css('overflow', 'hidden');
					self.$fullscreenToggle.addClass('clicked');
				} else {
					self.$wrapper.removeClass('open-menu');
					self.$html.css('width', '').css('overflow', '');
					self.$fullscreenToggle.removeClass('clicked');
				}
			}

			// Mobile Menu
			function mobileMenuAction($action) {
				if ($action == 'play') {
					self.$wrapper.addClass('open-menu');
					self.$html.css('width', 'auto').css('overflow', 'hidden');
					self.$menuToggle.addClass('clicked');
				} else {
					self.$wrapper.removeClass('open-menu');
					self.$html.css('width', '').css('overflow', '');
					self.$menuToggle.removeClass('clicked');
				}
			}

			// Search Panel
			function searchPanelAction($action) {
				if ($action == 'play') {
					self.$wrapper.addClass('open-search');
					self.$html.css('width', 'auto').css('overflow', 'hidden');
					$('.search-panel .search-field').focus();
				} else {
					self.$wrapper.removeClass('open-search');
					self.$html.css('width', '').css('overflow', '');
				}
			}
			
			// Side Cart Panel
			function cartPanelAction($action) {
				if ($action == 'play') {
					self.$wrapper.addClass('open-cart');
					mobileMenuAction('reverse');
					self.$html.css('width', 'auto').css('overflow', 'hidden');
				} else {
					self.$wrapper.removeClass('open-cart');
					self.$html.css('width', '').css('overflow', '');
				}
			}
			
			// Filter Panel
			function filterPanelAction($action) {
				if ($action == 'play') {
					self.$sideFilters.removeAttr('style'); // Because desktop filters add display:none
					self.$wrapper.addClass('open-filters');
					self.$html.css('width', 'auto').css('overflow', 'hidden');
					mobileMenuAction('reverse');
				} else {
					self.$wrapper.removeClass('open-filters');
					self.$html.css('width', '').css('overflow', '');
				}
			}

			// Open FullScreen Menu
			self.$header.on('click', '.fullscreen-toggle', function() {
				if (self.$menuToggle.hasClass('clicked')) {
					fullscreenMenuAction('reverse');
				} else {
					fullscreenMenuAction('play');
				}
				return false;
			});

			$('.big-menu > li').first().addClass('active-big');
			
			$('.big-menu > li').on({
		    mouseenter: function () {
		    	$(this).siblings().removeClass('active-big');
		    	$(this).addClass('active-big');
		    }
			});

			//Make sure panel is closed on pageload
			mobileMenuAction('reverse');
		
			// Open Mobile Menu
			self.$header.on('click', '.mobile-toggle', function() {
				if (self.$menuToggle.hasClass('clicked')) {
					mobileMenuAction('reverse');
				} else {
					mobileMenuAction('play');
				}
				return false;
			});

			// Open Search Panel
			$('#wrapper').on('click', '.quick_search', function() {
				searchPanelAction('play');
				return false;
			});

			if ($mobileMenu.children().hasClass('menu-sliding')) {

				// Sliding submenus
				$mobileMenu.slidingMenu({
					className : 'mobile-menu',
			    transitionDuration : 200,
			    dataJSON : false,
			    initHref : false,
			    backLabel: true  //To use 'Back' text replace with: backLabel: theme_vars.l10n.back,
				});

			} else {
				
				// Collapsible submenus
				$expandSub.on('click', function(e){
					var $that = $(this),
							$parent = $that.closest('li'),
							$subMenu = $that.next('.sub-menu');
					
					if ($parent.hasClass('active')) {
						$subMenu.removeClass('open');
						$subMenu.slideUp('100', function() {
							$parent.removeClass('active');
						});
					} else {
						$subMenu.addClass('open');
						$subMenu.slideDown('100', function() {
							$parent.addClass('active');
						});
					}
					e.stopPropagation();
					e.preventDefault();
				});

			}

			// Open Mini Cart
			self.$body.on('click', '.quick_cart', function() {
				if (theme_vars.settings.is_cart || theme_vars.settings.is_checkout || theme_vars.settings.cart_icon != 'mini-cart' ) {
					return true;
				} else {
					cartPanelAction('play');
					self.customScrollBars();
					return false;
				}
			});

			//Refresh cart fragments
			self.$body.on('wc_fragments_refreshed added_to_cart', function() {
				$('.et-close').on('click', function() {
					cartPanelAction('reverse');
					filterPanelAction('reverse');
					return false;
				});
			});

			// Open Side Filters (mobile included)
			self.$wrapper.on('click', '#et-shop-filters', function() {
				var $filterTitle = self.$sideFilters.find('.et-widget-title');
				// Collapse widgets on mobile filter
				if($(window).width()<768){
					if(!$filterTitle.hasClass('active')){
						$filterTitle.trigger('click');
					}
				}
				filterPanelAction('play');
				return false;
			});
			
			// Close panels
			self.$clickCapture.add(self.$cc_close).on('click', function() {
				mobileMenuAction('reverse');
				cartPanelAction('reverse');
				searchPanelAction('reverse');
				filterPanelAction('reverse');
				return false;
			});

			self.$wrapper.on('click', '.action-icons a', function() {
				mobileMenuAction('reverse');
				//return false;
			});

		},

		/* Header Placeholder */
		headerPlaceholder: function() {
			var self =  this;

			// update header height value
			self.$headerHeight = self.$header.outerHeight();

			var headerSpacerHeight = parseInt(self.$headerSpacer.css('height'));

			if (self.$headerHeight !== headerSpacerHeight) {
				$('.header-spacer, .product-header-spacer').css('height', self.$headerHeight+'px');
			}

		},

		/* Masonry items */
		masonryLayout: function() {

			var self = this,
					$masonry = $('.masonry');

			if( $masonry.length == 0 )
				return;

			Outlayer.prototype._setContainerMeasure = function( measure, isWidth ) {
				if ( measure === undefined ) {
					return;
				}
				var elemSize = this.size;
				if ( elemSize.isBorderBox ) {
					measure += isWidth ? elemSize.paddingLeft + elemSize.paddingRight +
						elemSize.borderLeftWidth + elemSize.borderRightWidth :
						elemSize.paddingBottom + elemSize.paddingTop +
						elemSize.borderTopWidth + elemSize.borderBottomWidth;
				}
				measure = Math.max( measure, 0 );
				measure = Math.floor( measure );
				this.element.style[ isWidth ? 'width' : 'height' ] = measure + 'px';
			};

			$('.masonry').each(function() {
				var $thisGrid = $(this),
						layoutMode = $thisGrid.data('layoutmode') ? $thisGrid.data('layoutmode') : 'masonry',
						$filters = $('#'+$thisGrid.data('filter')+''),
						loadmore = $($thisGrid.data('loadmore')),
						scrollMasonry = false,
						$masonryLoadControls = loadmore.closest('.et-masonry-infload-controls'),
						page = 2,
						large_items = $('.masonry-large', $thisGrid),
						tall_items = $('.masonry-vertical', $thisGrid),
						small_items = $('.masonry-small', $thisGrid),
						wide_items = $('.masonry-horizontal', $thisGrid),
						once = false,
						is_loading = false;
				
				$thisGrid.imagesLoaded( function() {
					var iso = $thisGrid.isotope({
						layoutMode: layoutMode,
						percentPosition: true,
						itemSelector : '.item',
						transitionDuration : '0.3s',
						masonry: {
							columnWidth: '.item'
						},
						hiddenStyle: {
							opacity: 0,
							transform: 'translateY(30px)'
						},
						visibleStyle: {
							opacity: 1,
							transform: 'translateY(0px)'
						},
						isInitLayout: false // Disable initial layout
					});

					/* Load More */
					loadmore.on('click', function(){
						var masonry_id = loadmore.data('masonry-id'),
								text = loadmore.text(),
								portAjax = ('goya_portfolio_ajax_'+ masonry_id),
								animation = window[portAjax].animation,
								aspect = window[portAjax].aspect,
								columns = window[portAjax].columns,
								style = window[portAjax].style,
								category = window[portAjax].category,
								masonry = window[portAjax].masonry,
								count = window[portAjax].count;
						
						if (is_loading === false) {
							is_loading = true;
							$masonryLoadControls.addClass('et-loader');

							$.ajax( theme_vars.ajaxUrl, {

							method : 'POST',
							data : {
								action: 'goya_portfolio_ajax',
								columns: columns,
								aspect: aspect,
								animation: animation,
								masonry: masonry,
								style: style,
								count: count,
								category: category,
								page: page,
							},
							error: function(XMLHttpRequest, textStatus, errorThrown) {
							},
							complete: function() {
								// Hide 'loader'
								is_loading = false;
								$masonryLoadControls.removeClass('et-loader');
							},

							success: function(data){
								is_loading = false;
								
								page++;

								var $response = $('<div>' + data + '</div>'),
										dataPosts = $response.find('.item'), 
										items = dataPosts ? dataPosts.length : 0;
								
								if( data === '' || data === 'undefined' || data === 'No More Posts' || data === 'No $args array created') {

									$masonryLoadControls.addClass('hide-btn');
									$masonryLoadControls.off('click');

								} else {
									var added = $(dataPosts);
									added.imagesLoaded(function() {
										added.appendTo($thisGrid).hide();
										
										// Set masonry size
										large_items = $('.masonry-large', $thisGrid);
										tall_items = $('.masonry-vertical', $thisGrid);
										small_items = $('.masonry-small', $thisGrid);
										wide_items = $('.masonry-horizontal', $thisGrid);
										
										$thisGrid.isotope( 'appended', added );

										// Resize elements according to defined size
										self.$window.trigger('resize.masonry');

										// Run animation for new items
										var $animate = $(dataPosts).find('.animation').length ? $(dataPosts).find('.animation') : $(dataPosts);
										self.animation($animate);
										
										added.show();
										$thisGrid.isotope('layout');

										if (items < count) {
											$masonryLoadControls.addClass('hide-btn');
											$masonryLoadControls.off('click');
										}

									});
								}
							}
								
							});
						}

						return false;
					}); // end Load More

					iso.on('layoutComplete', function() {
						resizeMasonryItems();

						// Re-position grid elements
						if( once == true ) {
							setTimeout(function(){
								$thisGrid.isotope('layout');
								once = false;
							}, 200);
						}
						
						// Hide preloader once complete
						$thisGrid.removeClass('et-loader');
						$thisGrid.addClass('grid-complete');
					});

					// Manually trigger initial layout
					$thisGrid.isotope();

					scrollMasonry = _.debounce(function(){
						$thisGrid.isotope('layout'); // Re-position grid elements
					}, 30);

					self.$window.on('scroll', scrollMasonry);
					
				});

				self.$window.on('resize.masonry', function(){
					resizeMasonryItems();
					once = true;
				});

				

				// Resize items
				var getGutter =  function() {
					var ml = parseInt($thisGrid.css('marginLeft'), 10);
					return Math.abs(ml);
				}
				var resizeMasonryItems =  function() {
					var gutter = getGutter(),
							once = true,
							imgselector = '.wp-post-image';					
					
					if (large_items.length && !large_items.hasClass('d-none')) {
						
						large_items.find( imgselector ).height(function() {
							var height = parseInt(large_items.eq(0).find(imgselector).outerWidth(), 10);
							return height + 'px';
						});
						
						if (tall_items.length) {
							tall_items.find( imgselector ).height(function() {
								var height = large_items.eq(0).find(imgselector).outerWidth();
								return height + 'px';
							});
						}
						if (small_items.length) {
							small_items.find( imgselector ).height(function() {
								var height = ( large_items.eq(0).find(imgselector).outerWidth() / 2 ) - gutter;
								return height + 'px';
							});
						}
						if (wide_items.length) {
							wide_items.find( imgselector ).height(function() {
								var height = ( large_items.eq(0).find(imgselector).outerWidth() / 2 ) - gutter;
								return height + 'px';
							});
						}
					} else if (tall_items.length && !tall_items.hasClass('d-none')) {
						
						tall_items.find( imgselector ).height(function() {
							var height = ( tall_items.eq(0).find(imgselector).outerWidth() * 2 ) + gutter * 2;
							return height + 'px';
						});

						if (small_items.length) {
							small_items.find( imgselector ).height(function() {
								var height = tall_items.eq(0).find(imgselector).outerWidth();
								return height + 'px';
							});
						}
						if (wide_items.length) {
							wide_items.find( imgselector ).height(function() {
								var height = tall_items.eq(0).find(imgselector).outerWidth();
								return height + 'px';
							});
						}
					} else if (wide_items.length && !wide_items.hasClass('d-none')) {
							
						wide_items.find( imgselector ).height(function() {
							var height = small_items.eq(0).find(imgselector).parent().outerWidth();
							return height + 'px';
						});

						if (small_items.length) {
							small_items.find( imgselector ).height(function() {
								var height = small_items.eq(0).find(imgselector).outerWidth();
								return height + 'px';
							});
						}
					}	
				}

				/* Filters */
				if ($filters.length) {
		
					$filters.find('a').on('click', function(e) {
						
						e.preventDefault();
						
						var $this = $(this);

						if ($this.hasClass('active')) {
							return;
						} else {
							// Set "active" link
							$filters.find('.active').removeClass('active');
							$this.parent('li').addClass('active');
						}

						var $thisItems = $thisGrid.children('.item'),
							filterSlug = $this.data('filter');

						// Show/hide elements
						if (filterSlug) {
							var $item;
							$thisItems.each(function() {
								$item = $(this);
								if ($item.hasClass(filterSlug)) {
									$thisGrid.isotope('unignore', $item[0]); // Packery - un-ignore element
									
									$item.removeClass('d-none');
								} else {
									$thisGrid.isotope('ignore', $item[0]);
									
									$item.addClass('d-none');
								}
							});
						} else {
							$thisItems.each(function() {
							$thisGrid.isotope('unignore', $(this)[0]);
							});
							
							$thisItems.removeClass('d-none'); // Show all items
						}

						once = true;
						$thisGrid.isotope('layout'); // Re-position grid elements

						return false;
					
					});

				} // end filters

			});

		},

		/* Set fixed height to prevent jumping on scroll */
		fixVH: function(el) {
			var self = this,
					$vh_el = el ? el : $('.vh-height');

			if ( !$vh_el.length )
				return;
			
			fixHeight($vh_el);

			window.addEventListener( 'resize', function() {
				fixHeight($vh_el);
			}.bind( this ) );

			function fixHeight(vh_el) {
				vh_el.each(function() {
					vh_el.css({ height: $(this).innerHeight() });
				});
			}
		},

		/* twentytwenty: resize videos to fit */
		instrinsicRatioVideos: function() {
			
			makeFit();

			window.addEventListener( 'resize', function() {
				makeFit();
			}.bind( this ) );

			function makeFit() {
				document.querySelectorAll( 'iframe, object, video' ).forEach( function( video ) {
					var ratio, iTargetWidth,
						container = video.parentNode;

					// Skip videos we want to ignore
					if ( video.classList.contains( 'intrinsic-ignore' ) || video.parentNode.classList.contains( 'intrinsic-ignore' ) ) {
						return true;
					}

					if ( ! video.dataset.origwidth ) {
						// Get the video element proportions
						video.setAttribute( 'data-origwidth', video.width );
						video.setAttribute( 'data-origheight', video.height );
					}

					iTargetWidth = container.offsetWidth;

					// Get ratio from proportions
					ratio = iTargetWidth / video.dataset.origwidth;

					// Scale based on ratio, thus retaining proportions
					video.style.width = iTargetWidth + 'px';
					video.style.height = ( video.dataset.origheight * ratio ) + 'px';
				} );
			}
		},

		/* Blog: Ajax load posts */
		blogInfiniteScrolling: function() {
			var self = this,
					blogContainer = $('.blog-infload'),
					is_loading = false,
					scrollFunction = false,
					scrollLock = false,
					$bloginfLoadControls = $('.et-blog-infload-controls'),
					page = 2,
					count = theme_vars.settings.posts_per_page;

			if($bloginfLoadControls.hasClass('button-mode')) {

				$('.et-blog-infload-btn').on('click', function(e){
					var _this = $(this);

					e.preventDefault();

					if ( is_loading === false ) {
						$bloginfLoadControls.addClass('et-loader');						
						loadBlogPosts(_this, blogContainer);
					}

				});

			} else if ($bloginfLoadControls.hasClass('scroll-mode')){

				scrollFunction = _.debounce(function(){

					if (scrollLock) return;
					else if ( (is_loading === false ) && ( (self.$window.scrollTop() + self.$window.height() + 150) >= (blogContainer.offset().top + blogContainer.outerHeight()) ) ) {

						$bloginfLoadControls.addClass('et-loader');
						loadBlogPosts(false, blogContainer, true);
					}
				}, 30);

				self.$window.on('scroll', scrollFunction);

			}

			// Load new posts
			var loadBlogPosts = function(button, blogContainer, infinite) {

				var blogAjax = ('goya_blog_ajax_params'),
						category_id = window[blogAjax].category_id,
						blog_style = window[blogAjax].blog_style;

				$.ajax( theme_vars.ajaxUrl, {
					method : 'POST',
					data : {
						action: 'goya_blog_ajax',
						blog_style: blog_style,
						category_id: category_id,
						page : page++
					},
					beforeSend: function() {
						is_loading = true;

						if (infinite) {
							self.$window.off('scroll', scrollFunction);   
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
					},
					complete: function() {
						// Hide 'loader'
						is_loading = false;
						$bloginfLoadControls.removeClass('et-loader');
					},
					success : function(data) {
						is_loading = false;

						var $response = $('<div>' + data + '</div>'),
								dataPosts = $response.find('.blog-post'), 
								items = dataPosts ? dataPosts.length : 0;

						if( data === '' || data === 'undefined' || data === 'No More Posts' || data === 'No $args array created') {
							// No more posts: disable button and scroll
							$bloginfLoadControls.addClass('hide-btn');
							$bloginfLoadControls.off('click');
							if(infinite) self.$window.off('scroll', scrollFunction);
						} else {
							//Append new posts
							$(dataPosts).appendTo(blogContainer).hide().imagesLoaded(function() {
								if (blogContainer.data('isotope')) {
									blogContainer.isotope('appended', $(dataPosts));
								}
								$(dataPosts).show();

								var $animate = $(dataPosts).find('.animation').length ? $(dataPosts).find('.animation') : $(dataPosts);
								self.animation($animate);

							});
							
							if (items >= count) {
								if(infinite) self.$window.on('scroll', scrollFunction);
							} else {
								$bloginfLoadControls.addClass('hide-btn');
								$bloginfLoadControls.off('click');
								if(infinite) self.$window.off('scroll', scrollFunction);
							}
						}
						if ($(dataPosts).find('.slick')) {
							setTimeout(function(){
								self.slickCarousel($(dataPosts).find('.slick'));
							}, 100);
						}

					}
				});
			};

		},

		/* Keep element fixed when scrolling */
		fixedContent: function(el, offset) {
			var self = this,
					$fixedEl = el ? el : $('.et-fixed'),
					$offset = 0 + self.$adminbarHeight;

			if (self.$isProduct) {
				var $topTitle = $('.product-showcase.product-title-top .product_title'),
						$topTitleHeight = $topTitle.length ? $topTitle.outerHeight() : 0,
						$topBarHeight = (self.$topBar.length && self.$topBar.is(':visible')) ? self.$topBar.outerHeight(true) : 0,
						$campaignBarHeight = (self.$campaignBar.length && self.$campaignBar.is(':visible')) ? self.$campaignBar.outerHeight(true) : 0,
						$fixedEl = $('.product-showcase .summary'),
						$showcase = $('.et-product-layout-showcase');

				if ($showcase.length && $showcase.hasClass('et-product-gallery-carousel')) {
					return;
				}
				
				offset = $fixedEl.offset().top - $('.woocommerce-breadcrumb').outerHeight() - $topTitleHeight - $topBarHeight - $campaignBarHeight;

				if (! self.$headerIsFixed) {
					offset = offset - self.$headerHeight;
				}

			}

			if (offset){
				$offset = offset;
			} else {
				if ( ! (self.$isProduct && self.$productIsFixed && self.$productFixedTop) ) {
					$offset += self.$headerHeight;
				}
			}
			
			if (!self.$mobileDet.mobile()) {
				$fixedEl.each(function() {
					var _this = $(this);
					
					_this.stick_in_parent({
						offset_top: $offset,
						spacer: false,
						recalc_every: 50
					});
				});
				
				self.$window.on('resize', _.debounce(function(){
					$(document.body).trigger("sticky_kit:recalc");
				}, 30));

			}

		},

		/* Add scrollbars and limit container size */
		customScrollBars: function(el) {
			var self = this,
					$scrollBars = el ? el : $('.custom_scroll, #side-cart .woocommerce-mini-cart');
				
				$scrollBars.each(function() {
					var that = $(this);
					that.perfectScrollbar({
						wheelPropagation: false,
						suppressScrollX: true
					});
				});
				
				self.$window.resize(function() {
					resize($scrollBars);
				});

			var resize = function(container) {
				container.perfectScrollbar('update');
			};
		},

		/* Login form tabs */
		loginForm: function() {
			var $loginContainer = $('.et-overflow-container'),
					$links = $('.register-link,.login-link');
			
			$links.on('click', function(e) {
				e.preventDefault();
				var _this = $(this);

				_this.closest('.login-page-tabs').find('li').removeClass('active');
				_this.parent('li').addClass('active');

				if (_this.hasClass('register-link')) {
					$('.et-form-container', $loginContainer).addClass('register-active');
				} else {
					$('.et-form-container', $loginContainer).removeClass('register-active');
				}

			});

		},

		/* Back to top button */
		toTopBtn: function() {
			var self = this,
					$toTop = $('#scroll_to_top');
				
			$toTop.on('click', function(){
				$('html, body').animate({'scrollTop': 0 }, 400);
				return false;
			});

			self.$window.scroll(_.debounce(function(){
				if (self.$window.scrollTop() > 100) {
					$toTop.addClass('active');
				} else {
					$toTop.removeClass('active');
				}
			}, 20));
		
		},

		/* Start element animations */
		animation: function(el) {
			var self = this,
					$animationEl = el ? el : $('.animation, .et-counter, .et-autotype');
				
				$('.animation.bottom-to-top-3d, .animation.top-to-bottom-3d').parent(':not(.slick-track)').addClass('perspective-wrap');

				animationCtrl($animationEl, true);

				// WP Bakery tabs
				$('.vc_tta-tab a').on('click', function() {
					var $tab = $(this).attr('href'),
							$tab_el = $($tab).find('.animation');

					if($tab_el.length) {
						animationCtrl($tab_el, false);
					} 
				});

				$('.et-portfolio-filter a').on('click', function() {
					animationCtrl($animationEl, false);
				});
				
				self.$window.on('scroll.et-animation', function(){
					animationCtrl($animationEl, true);
				}).trigger('scroll.et-animation');

			function animationCtrl (element, filter) {
				var t = 0,
						delay = (!self.$mobileDet.mobile()) ? 50 : 0;
						el = filter ? element.filter(':in-viewport') : element;

				if ( element.hasClass('animation') && element.parent().parent().hasClass('products') && self.$mobileDet.mobile() ) {
					el = element;
				}
				
				el.each(function() {
					var _this = $(this);

					if (_this.hasClass('et-counter')) {
						self.counter(_this);
					} else if (_this.hasClass('et-autotype')) {
						self.autoType(_this);
					}

					if (_this.data('et-animated') !== true ) {
						
						_this.data('et-animated', true);

						setTimeout(function() {
							_this.addClass('animated');
						}, delay * t);

					}

					t++;
				});
			};
		
		},

	
		/** Shop Related Functions **/

		/* Quick View modal */
		productQuickView: function() {

			var self = this,
					$qvWrap = $('#et-quickview'),
					$qvOverlay = $('<div id="et-quickview-overlay" class="mfp-bg et-mfp-fade-in"><div class="dot3-loader"></div></div>'),
					$qvSlider = '',
					qvIsSlider = false,
					productId;
					

			self.$body.on('click', '.et-quickview-btn', function(e) {
				e.preventDefault();
				
				productId = $(this).data('product_id');

				var data = {
							product_id: productId,
							action: 'goya_product_ajax'
						},
						ajaxUrl = wc_add_to_cart_params ? wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'goya_product_ajax' ) : theme_vars.ajaxUrl;
				
				if (productId) {
					self.$html.css('width', 'auto').css('overflow', 'hidden');
					
					$qvOverlay.appendTo(self.$body);
					$qvOverlay.addClass('show mfp-ready show-loader');

					window.qv_open_product = $.ajax({
						type: 'POST',
						url: ajaxUrl,
						data: data,
						dataType: 'html',
						cache: false,
						headers: {'cache-control': 'no-cache'},
						beforeSend: function() {
							if (typeof window.qv_open_product === 'object') {
								window.qv_open_product.abort();
							}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {				
							self.$html.css('width', '').css('overflow', '');
							$qvOverlay.removeClass('mfp-ready mfp-removing').remove();
						},
						success: function(response) {
							$qvWrap.html(response);

							openQuickView();
						}
					});

				}
			});
			
			/* Show quick view modal */
			var openQuickView = function() {

				var $qvProduct = $qvWrap.children('#product-' + productId),
						$qvForm = $qvProduct.find('form.cart'),
						$qvSlider = ($('#et-quickview-slider').length) ? $('#et-quickview-slider') : $('.et-qv-product-image [data-slick]:not(.woo-variation-gallery-thumbnail-slider)');

				if ($qvSlider.length) {
					// Show current image variable product
					if ($qvProduct.hasClass('product-variable')) {
						$qvForm.wc_variation_form().find('.variations select:eq(0)').change();
						$qvForm.on('woocommerce_variation_select_change', function() {
							if (qvIsSlider) {
								$qvSlider.slick('slickGoTo', 0, false);
							}
						});
					}

					// Remove gallery loader
					setTimeout(function() {
						$qvSlider.closest('.loading-gallery').removeClass('loading-gallery');
					}, 600);

				}

				self.quantityButtons();

				// Open lightbox
				$.magnificPopup.open({
					mainClass: 'mfp et-mfp-quickview et-mfp-zoom-in',
					removalDelay: 280,
					closeMarkup: '<button title="%title%" class="mfp-close scissors-close"></button>',
					items: {
						src: $qvWrap,
						type: 'inline'
					},
					callbacks: {
						open: function() {
							$qvOverlay.removeClass('show-loader');
							quickViewCarousel();

							$qvOverlay.one('touchstart.qv', function() {
								$.magnificPopup.close();
							});
						},
						beforeClose: function() {
							$qvOverlay.addClass('mfp-removing');
						},
						close: function() {
							self.$html.css('width', '').css('overflow', '');
							$qvOverlay.removeClass('mfp-ready mfp-removing').remove();
						}
					}
				});
			};

			
			/* carousel gallery */
			var quickViewCarousel = function() {
				qvIsSlider = false;
				$qvSlider = ($('#et-quickview-slider').length) ? $('#et-quickview-slider') : $('.et-qv-product-image [data-slick]:not(.woo-variation-gallery-thumbnail-slider)');
					
				if ($qvSlider.length) {
					if ($qvSlider.children().length > 1) {
						qvIsSlider = true;

						self.slickCarousel($($qvSlider));
						setTimeout(function() {
							$qvSlider.slick('setPosition');
						}, 100);

					}
				}
				self.customScrollBars();
			};

		},

		/* Check if Quick View is visible */
		quickViewIsOpen: function() {
			return $('#et-quickview').is(':visible');

		},

		/* Filter widgets actions */
		shopFilterWidgets: function(isAjax) {
			var self = this,
					$sidebarFilters = $('#side-filters'),
					$activeFilters = $sidebarFilters.find('.wcapf-active-filters a'),
					$activeFiltersCount = $('.et-active-filters-count'),
					filtersCount = '';

			// Add loader dot when clicking on any filter link
			$sidebarFilters.on('click', 'li > a, .wcapf-active-filters > a', function() {
				$sidebarFilters.addClass('ajax-loader');
			});

			// Disable # links
			$('a[href="#"]').click(function(e) {
	      e.preventDefault();
	    });

			// Toggle widgets
			self.toggleWidgets($sidebarFilters);

			// Update filters count
			if ($activeFilters.length) {
				filtersCount = $activeFilters.length - 1;
				$activeFiltersCount.addClass('active');
			} else {
				$activeFiltersCount.removeClass('active');
			}
			$activeFiltersCount.html(filtersCount);
			
			 $('.widget_layered_nav span.count, .widget_product_categories span.count, .widget_tag_cloud .tag-link-count, .widget .wcapf-layered-nav ul li .count').each(function(){
				var count = $.trim($(this).html());
				count = count.substring(1, count.length-1);
				$(this).html(count);
			}); 

			// If no ajax request run the loop checker
			if ( isAjax != true ) { 
				self.shopLoopChecker();
			}

		},

		toggleFooterWidgets: function() {
			var self = this,
					$widgetsArea = $('.footer-toggle-widgets');

			if( $widgetsArea.length == 0 )
					return;

			self.toggleWidgets($widgetsArea);
		},

		toggleWidgets: function(sidebar) {
			var self = this,
					$widgetsArea = sidebar;

			/* Toggle side/mobile filter widgets */
			$widgetsArea.find('.widget').each(function() {
				var that = $(this),
						$widgetTitle = $(this).find('>h6'),
						$widgetToggle = $widgetTitle.find('span');
				
				// Add span to title
				if (!$widgetToggle.length) {
					$widgetTitle.append($('<span/>'));
				}

				if (($widgetsArea).hasClass('footer-widgets')) {
					setTimeout(function() {
						$widgetTitle.trigger('click');
					}, 10);
				}
				// Toggle state
				$widgetTitle.on('click', function() {
					$widgetTitle.toggleClass('active');
					$widgetTitle.next().animate({
						height: "toggle",
						opacity: "toggle"
					}, 300);
				});
			});
		},

		/* Shop loop checker for ajax updates */
		shopLoopChecker: function() {
			var self = this;

			$('#shop-products').arrive('.et-main-products', function() {
				// Restore display mode
				$('#shop-display-' + localStorage.getItem('display')).trigger('click');

				if (self.$showListVariations) self.productListVariations(true);
				self.animation();
				self.shopFilterWidgets(true);
				//self.shopInfiniteScrolling('filtered');
				self.customScrollBars( $('#side-filters .et-shop-widget-scroll') );

				$('#side-filters').removeClass('ajax-loader');

			});
		},


		/* Filters in Shop Header */
		shopFiltersHeader: function() {
			var self = this,
					$shopFilters = $('.shop-sidebar-header'),
					$shopSidebar = $('#side-filters'),
					$filterButton = $('#et-shop-filters-header');

			$filterButton.on('click', function(e) {
				e.preventDefault();

				var isOpen = $shopSidebar.is(':visible'),
						offset = self.$headerHeight;

				if (self.$adminbar.css('position') == 'fixed') {
					offset += self.$adminbarHeight ;
				}

				$shopSidebar.slideToggle(200, function() {
					// Show filters after sliding-down if sidebar is hidden
					if (!isOpen) {
						$shopSidebar.addClass('fade-in');
						// Make filters visible scrolling to top
						setTimeout(function() {
							$('html, body').animate({'scrollTop': $filterButton.offset().top - offset - 15 }, 200);
						}, 200);
						$filterButton.addClass('filter-visible');
						$('#side-filters .et-shop-widget-scroll').perfectScrollbar('update');
					} else {
						$shopSidebar.removeClass('fade-in');
						$filterButton.removeClass('filter-visible');
					}
				});

			});

			// Restore filter icon is the side filter panel is closed
			$('#side-filters .et-close').on('click', function(e) {
				$shopSidebar.removeClass('fade-in');
				$filterButton.removeClass('filter-visible');
			});
			
		},

		/* Grid/List view */
		shopDisplaySwitch: function() {
			var self = this,
					$displayBtn = $('.shop-display'),
					autoTrigger = false;

			$displayBtn.on('click', function(e) {
				var _this = $(this),
						itemDisplay = _this.data('display'),
						itemClass = _this.data('class'),
						$shopFilters = $('.shop_bar .shop-filters'),
						$shopContainer = $('#shop-products').find('.et-main-products'),
						$items = $shopContainer.find('.product').children('div'),
						offset = self.$headerHeight;

				if (self.$adminbar.css('position') == 'fixed') {
					offset += self.$adminbarHeight ;
				}

				$displayBtn.removeClass('active');
				_this.addClass('active');

				// Save new value to local storage
				localStorage.setItem('display', itemDisplay);

				$shopContainer.removeClass('shop_display_grid shop_display_small shop_display_list').addClass('shop_display_' + itemDisplay);

				// Move to the list start 
				if ( autoTrigger == false ) {
					if ($shopFilters.css('position') != 'fixed') {
						offset += $displayBtn.outerHeight() + 10;
					}
					$('html, body').animate({'scrollTop': $shopContainer.offset().top - offset - 25 }, 200);
				}

				// Restart product animation
				if ($items.hasClass('animation')) {
					$items.each(function() {
						$(this).data('et-animated', false);
						$(this).removeClass('animated');
						$items.removeAttr('style');
					});
					setTimeout(function() {
						self.animation($items);
					}, 200);
				}
				
				autoTrigger = false;

			});

			// Default display mode
			if ( localStorage.getItem('display') == 'list' || localStorage.getItem('display') == 'small' ) {
				autoTrigger = true;
				$('#shop-display-' + localStorage.getItem('display')).trigger('click');
			}

		},

		/* Add separator after last category in Shop */
		shopCatSeparator: function() {
			var self = this,
					$lastCategory = $('.products .product-category').last();

			$('<div class="category-separator clearfix"></div>').insertAfter($lastCategory);

			$('.woocommerce-ordering select').select2({
				minimumResultsForSearch: Infinity,
				width: 'auto',
				dropdownCssClass: 'woocommerce-ordering-dropdown',
				dropdownParent: $('.woocommerce-ordering'),
			});
			
		},
		
		/* Mini Cart Panel */
		miniCartSetup: function() {
			var self = this;

			if (!self.ajaxMiniCart) return;

			self.miniCartAjax = null;

			// Quantity inputs
			$('#side-cart').on('blur', 'input.qty', function() {	
				var $qtyInput = $(this),
						qty_val = parseFloat($qtyInput.val()),
						max	= parseFloat($qtyInput.attr('max'));
				
				if (qty_val === '' || qty_val === 'NaN') { qty_val = 0; }
				if (max === 'NaN') { max = ''; }
				
				// Max/Min validations
				if (qty_val > max) { 
					$qtyInput.val(max);
					qty_val = max;
				};
				if (qty_val > 0) {
					self.miniCartUpdate($qtyInput);
				}
			});
			
			self.$document.on('goya_quantity_change', function(event, qtyInput) {
				if ( self.$wrapper.hasClass('open-cart') ) {
					self.miniCartUpdate($(qtyInput));
				}
			});
		},

		/* Mini Cart - Update Quantity */
		miniCartUpdate: function($qtyInput) {
			var self = this;
			
			if (self.miniCartAjax) {
				self.miniCartAjax.abort();
			}
			
			// Show loader
			$qtyInput.closest('ul').addClass('loading');
			$qtyInput.closest('li').addClass('loading-item');
			
			// Ajax data
			var $miniCartForm = $('#ajax-minicart-form'),
					$miniCartNonce = $miniCartForm.find('#_wpnonce'),
					dataForm = {};
			
			if ( !$miniCartNonce.length )
				return;
			
			dataForm[$qtyInput.attr('name')] = $qtyInput.val();
			dataForm['update_cart'] = '1';
			dataForm['minicart_qty_update'] = '1';
			dataForm['_wpnonce'] = $miniCartNonce.val();
			
			self.miniCartAjax = $.ajax({
				type: 'POST',
				url: $miniCartForm.attr('action'),
				data: dataForm,
				dataType: 'html',
				beforeSend: function() {
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// Hide loader
					$('#side-cart .cart_list').removeClass('loading');
					$('#side-cart .cart_list').children('.loading-item').removeClass('loading-item');
				},
				success:  function(response) {
					// Replace fragments
					$(document.body).trigger('wc_fragment_refresh').trigger('updated_cart_totals');
				},
				complete: function(response) {
					self.miniCartAjax = null;
				}
			});
		},

		/* Ajax Add to Cart */
		ajaxAddToCart: function() {
			var self = this;

			// Shop: Add to cart buttons
			self.$body.on('click', '.add_to_cart_button', function(e) {
				var _this = $(this);
				
				_this.closest('.product.type-product').addClass('cart-clicked');

				// Return if add to cart redirect is enabled
				if (typeof wc_add_to_cart_params == 'undefined' || wc_add_to_cart_params.cart_redirect_after_add == 'yes')
					return;
				
				self.$body.on( 'added_to_cart', function(){
					setTimeout(function() {
						_this.next('.added_to_cart').addClass('button');
						_this.next('.added_to_cart').html('<span class="text">' + theme_vars.l10n.view_cart + '</span><span class="icon">' + theme_vars.icons.checkmark + '</span>');
					}, 100)
          
        });

			});

			// Single: Add to cart 
			if (theme_vars.settings.ajaxAddToCartSingle == true) {
				
				self.$body.on('click', 'button.single_add_to_cart_button', function(e) {
					var $singleBtn = $(this),
							$productDetail = $('.et-product-detail');

					// One Click chat to Order: wa-order-button
					// Custom Product Boxes: cpb_add_to_cart_button
					if ( $singleBtn.is('.disabled') || $singleBtn.hasClass('wa-order-button') || $singleBtn.hasClass('cpb_add_to_cart_button') )
						return;

					// Add loader
					$singleBtn.addClass('et-loader');

					// Return if add to cart redirect is enabled or if it's external
					if (typeof wc_add_to_cart_params == 'undefined' || wc_add_to_cart_params.cart_redirect_after_add == 'yes' || $productDetail.hasClass('product-type-external')) {
						return;
					}

					e.preventDefault();

					$singleBtn.attr('disabled', 'disabled');

					var $productForm = $singleBtn.closest('form');
					
					if (!$productForm.length)
						return;
					
					var data = {
						product_id: $productForm.find("[name*='add-to-cart']").val(),
						product_variation_data: $productForm.serialize()
					};

					self.$body.trigger('adding_to_cart', [$singleBtn, data]);

					submitForm($singleBtn, data);
					
				});
			}

			/* Submit form */
			var submitForm = function($singleBtn, data) {
				
				if (!data.product_id)
					return;

				var addUrl = wc_add_to_cart_params.wc_ajax_url.toString().replace( 'wc-ajax=%%endpoint%%', 'add-to-cart=' + data.product_id + '&single-ajax-add-to-cart=1' );

				$.ajax({
					type: 'POST',
					url: addUrl,
					data: data.product_variation_data,
					dataType: 'html',
					cache: false,
					headers: {'cache-control': 'no-cache'},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
					},
					success: function(response) {

						var $response = $('<div>' + response + '</div>'),
								$messages = $response.find('#woo-notices-wrapper'),
								errorMsg = ($messages.find('.woocommerce-error').length) ? true : false,
								cartHash = '';

						var fragments = {
							'#woo-notices-wrapper': $messages.prop('outerHTML'),
							'#minicart-panel': $response.find('#minicart-panel').prop('outerHTML'),
							'.minicart-counter': $response.find('.minicart-counter').prop('outerHTML')
						};

						$.each(fragments, function(el, fragment) {
							if ($(fragment).length) {
								$(el).replaceWith($(fragment));
							}
						});

						setTimeout(function() {
							$('.quick_cart').find('.minicart-counter').addClass('do-animation');
						}, 200)

						self.$body.trigger('added_to_cart', [fragments, cartHash]);

						$singleBtn.removeAttr('disabled').removeClass('et-loader');
						
						if(self.quickViewIsOpen()) {

							$.magnificPopup.close();
							
							if (errorMsg && self.$isShop) {
								setTimeout(function() {
									$('html, body').animate({'scrollTop': $('.header').outerHeight()}, 200);
								}, 200)
							} else if (self.miniCartAuto && self.$quickCartBtn.length) {
								setTimeout(function() {
									$('.quick_cart').trigger('click');
								}, 350);
							}

						} else {
							
							if (errorMsg) {
								setTimeout(function() {
									$('.click-capture').trigger('click');

									setTimeout(function() {
										$('html, body').animate({'scrollTop': $('.header').outerHeight()}, 200);
									}, 200);

								}, 500);
							} else if (!self.miniCartAuto) {
								setTimeout(function() {
									$('html, body').animate({'scrollTop': $('.header').outerHeight()}, 200);
								}, 200);
							}

						}
						
						$response.empty();
					}
				});

			};

		},


		/* Update Minicart Contents */
		shopCartUpdate: function() {
			var self =  this;

			// Check if redirect to cart is disabled
			if (typeof wc_add_to_cart_params !== 'undefined' && wc_add_to_cart_params.cart_redirect_after_add !== 'yes') {
				self.$body.on('added_to_cart', function(event, fragments, cartHash) {
					if (self.miniCartAuto && !self.quickViewIsOpen()) {  
						$('.quick_cart').trigger('click');
					}
					self.cartResetScroll('added');
				});
			
			} else {
				self.$document.off( 'click', '.add_to_cart_button' );
			}

			// Refresh scroll if quantity is changed
			self.$body.on('wc_fragments_refreshed', function() {
				self.cartResetScroll('updated');
			});

			// Refresh scroll if product removed from cart
			self.$body.on('removed_from_cart', function(event, fragments, cartHash) {
				self.cartResetScroll('removed');
			});
			
		},

		cartResetScroll: function($action) {
			var self =  this;

				// $action, used for logs
				setTimeout(function() {
					self.customScrollBars( $('#side-cart').find('.woocommerce-mini-cart') );
				}, 200);
		},


		/* Product Details in Acordion */
		productDetAccordion: function() {

			var $accordion = $('.tabs-accordion'),
					$tabs = $accordion.find('.tab-title'),
					$firstOpen = $('.first-tab-open');

			$accordion.each(function() {

				$tabs.find('a').on('click', function(e) {
					e.preventDefault();

					var $tabP = $(this).parent(),
							tabId = $tabP.attr('aria-controls');
				
					if ($tabP.hasClass('opened')) {
						// Close current pane
						$('#' + tabId).slideUp('50', function() {
							$tabP.removeClass('opened')
						});
					} else {
						
						$($accordion).find('.opened').removeClass('opened').next().hide();

						// Open clicked pane
						$('#' + tabId).slideDown('50', function() {
							$tabP.addClass('opened')
						});
					}

				});

			});

			// Open the first tab
			if ($firstOpen.length) {
				$('#tab-title-desc_tab a').trigger('click');
			}

		},

		/* Show quantity buttons */
		quantityButtons: function() {
			var self = this;
				
			// Quantity buttons
			self.$body.off('click.qtyBtn').on('click.qtyBtn','.plus, .minus', function() {
				
				var $qty    = $( this ).closest( '.quantity' ).find( '.qty' ),
					qty_val  = parseFloat( $qty.val() ),
					max     = parseFloat( $qty.attr( 'max' ) ),
					min     = parseFloat( $qty.attr( 'min' ) ),
					step    = $qty.attr( 'step' );
		
				if ( ! qty_val || qty_val === '' || qty_val === 'NaN' ) {
					qty_val = 0;
				}
				if ( max === '' || max === 'NaN' ) {
					max = '';
				}
				if ( min === '' || min === 'NaN' ) {
					min = 0;
				}
				if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) {
					step = 1;
				} else {
				  step = parseFloat(step);
				}
		
				// Update values
				if ( $( this ).is( '.plus' ) ) {
					if ( max && ( max === qty_val || qty_val > max ) ) {
						$qty.val( max );
					} else {
						$qty.val( qty_val + parseFloat( step ) );
					}
				} else {
					if ( min && ( min === qty_val || qty_val < min ) ) {
						$qty.val( min );
					} else if ( qty_val > 0 ) {
						$qty.val( qty_val - parseFloat( step ) );
					}
				}

				self.quantityTriggerChange($qty);

				return false;
			});

		},

		/* trigger events */
		quantityTriggerChange: function($qty) {
			var self = this;
			
			$qty.trigger('change');
			self.$document.trigger('goya_quantity_change', $qty);
		},
						

		/* Shop loop: show variations */
		productListVariations: function(ajaxloadlist) { 
			var self = this,
					$listinVariations = $('.et-shop-show-variations'),
					$ajaxLoadProduct = ajaxloadlist ? ajaxloadlist : '',
					$hasVariableProducts = $listinVariations.find('.type-product.product-type-variable');

			if ($hasVariableProducts.length) {

				$hasVariableProducts.each(function() {

					var $variationForm = $(this).find('form.variations_form'),
							$product = $(this),
							$productImage = $(this).find('img.main-image'),
							$shopOriginalImage = $(this).find('img.main-image').attr('src'),
							$shopOriginalSrcset = $(this).find('img.main-image').attr('srcset'),
							$shopPriceContainer = $('span.price', $(this)).eq(0),
							$shopOriginalPrice = $shopPriceContainer.html(),
							$selectBox = $variationForm.find('select:not(.woo-variation-raw-type-color):not(woo-variation-raw-type-image)');

							if($(this).find('img.main-image').attr('data-src')) {
								$shopOriginalImage = $(this).find('img.main-image').attr('data-src');
							}

					// If no default option defined choose the first one
					if($selectBox.length) {
						$selectBox.each( function() {
							if ( $(this).prop('selectedIndex') == 0 ) {
								$(this).prop('selectedIndex', 1);
							}
						});
					}

					if( $ajaxLoadProduct ) {
						$(this).find('form.variations_form:not(.wvs-loaded)').wc_variation_form();
					}

					$variationForm.on("show_variation", function(e, variation) {

						if (variation.hasOwnProperty("image") && variation.image.thumb_src && variation.image.thumb_src != $productImage.attr('src')) {

							$product.addClass('hover-image-loading');

							// Bind image 'load' event
							$productImage.load(function() {
								var that = $(this);
								
								that.unbind('load');
								$product.removeClass('hover-image-loading');
							});
							
							// Load image
							$productImage.attr('src', variation.image.thumb_src);
							$productImage.attr( 'srcset', '');
							$productImage.attr( 'sizes', variation.image.catalog_sizes );
						}

					}).on('reset_image', function () {
						// Reload original image/price
						$shopPriceContainer.html($shopOriginalPrice);
						$productImage.attr('src', $shopOriginalImage);
						$productImage.attr( 'srcset', '');

					});

				});

			};

		},

		/* Single Product: Swap variation image  */
		singleProductVariations: function() { 

			var self = this,
				$variationsCont = $('.summary form.variations_form'),
				$slider = $('#product-images'),
				$thumbnails = $('#product-thumbnails'),
				$firstImage = $('.woocommerce-product-gallery__image', $slider).eq(0).find('img'),
				$firstThumb = $('.woocommerce-product-gallery__image', $thumbnails).eq(0).find('img'),
				origImage = $firstImage.attr('src'),
				origThumb = $firstThumb.attr('src');

				if ( $firstImage.attr('data-src') || $firstThumb.attr('data-src') ) {
					origImage = $firstImage.attr('data-src');
					origThumb = $firstThumb.attr('data-src');
				}

			$variationsCont.on("show_variation", function(e, variation) {
				
				if (variation.hasOwnProperty("image") && variation.image.src && variation.image.src != $firstImage.attr('src')) {

					// Update first image with new source
					$firstImage.attr("src", variation.image.src).attr("srcset", "");
					$firstThumb.attr("src", variation.image.src).attr("srcset", "");

					if ($slider.hasClass('slick-initialized')) {
						$slider.slick('slickGoTo', 0);	
					}
				}
			}).on('reset_image', function () {
				// Restore original images
				$firstImage.attr("src", origImage).attr("srcset", "");
				$firstThumb.attr("src", origThumb).attr("srcset", "");
			});

			$variationsCont.on('woocommerce_variation_select_change',function() {
				if (self.$zoomEnabled) {
					self.singleProductZoomRefresh();
				}
			});
		
		},

		/* Easyzoom Gallery */
		productZoomGallery: function() {
			var self =  this;

			if (self.$zoomEnabled) {
				self.$window.load(function() { 
					var $productGalleryImages = $('.woocommerce-product-gallery__image');
					$productGalleryImages.easyZoom();
				});
			}

		},

		/* Update zoom (on variation image change) */
		singleProductZoomRefresh: function() {
			var $gallery = $('.woocommerce-product-gallery'),
					$firstGalImage = $('.woocommerce-product-gallery__image', '.woocommerce-product-gallery__wrapper').eq(0),
					firstGalImageUrl = $firstGalImage.children('a').attr('href');

			if (!self.$isTouch && $gallery.closest('.woocommerce-product-gallery-parent').hasClass('zoom-enabled')) {
				if (firstGalImageUrl && firstGalImageUrl.length > 0) {
					// Get the zoom plugin API for the first gallery image
					var zoomApi = $firstGalImage.data('easyZoom');
					// Swap/update zoom image url
					if (zoomApi) {
						zoomApi.swap(firstGalImageUrl);
					}
				}
			}
		},

		/* Adjust options and cart button on Showcase products */
		singleProductShowcase: function($reinit) {
			var self = this,
					$productDetail = $('.et-product-detail'),
					$cartWrapper = $productDetail.find('form.cart'),
					$barsMargin = 0,
					$offset = 0;

			if (! self.$headerIsTransparent) {
				$offset += $('.product-header-spacer').outerHeight();
			}
			if (self.$adminbar.length) {
				$offset += self.$adminbar.outerHeight(true);
				$barsMargin += self.$adminbar.outerHeight(true);
			}
			if (self.$topBar.length) {
				$offset += self.$topBar.outerHeight(true);
				$barsMargin += self.$topBar.outerHeight(true);
			}
			if (self.$campaignBar.length && self.$campaignBar.is(':visible') && !$reinit) {
				$offset += self.$campaignBar.outerHeight(true);
				$barsMargin += self.$campaignBar.outerHeight(true);
			}

			if ($offset > 0){
				$('.et-product-detail.et-product-layout-no-padding:not(.et-product-gallery-column):not(.et-product-gallery-grid) .product-showcase').css('height', 'calc(100vh - ' + $offset + 'px').css('min-height','auto');
				$('.page-header-transparent .et-product-detail.et-product-layout-no-padding .showcase-active .entry-summary').css('height', 'calc(90vh - ' + $offset + 'px');
			} else {
				$('.et-product-detail.et-product-layout-no-padding:not(.et-product-gallery-column):not(.et-product-gallery-grid) .product-showcase').css('height', '');
				$('.page-header-transparent .et-product-detail.et-product-layout-no-padding .showcase-active .entry-summary').css('height', '');
			}
			setTimeout(function() {
				$('.showcase-active.showcase-fixed').addClass('ready');
			}, 20);
		},

		/* Featured product video */
		productFeaturedVideo: function() {
			var self = this,
					$videoBtn = $('.et-feat-video-btn');
				
			if ($videoBtn.length) {
				
				$videoBtn.on('click', function(e) {
					e.preventDefault();
					
					var mfpSettings = {
							mainClass: 'et-feat-video-popup et-mfp-fade-in',
							closeMarkup: '<button title="%title%" class="mfp-close scissors-close mfp-close-outside"></button>',
							removalDelay: 180,
							type: 'iframe',
							patterns: {
								youtube: {
									index: 'youtube.com',
									pattern: /v=([^\?\=\&]+)/i,
									src: '//www.youtube.com/embed/%id%?autoplay=1'
								},
								vimeo: {
									index: 'vimeo.com',
									pattern: /\/([^\/]+)$/i,
									src: '//player.vimeo.com/video/%id%?autoplay=1'
								}
							},
							closeOnContentClick: true,
							closeBtnInside: false
						};
									
					// Open video modal
					$videoBtn.magnificPopup(mfpSettings).magnificPopup('open');
				});
			}
		},

		/* Toggle product comment form */
		productCommentForm: function() {
			var self = this,
					$reviews = $('.woocommerce-Reviews'),
					$toggleBtn = $reviews.find('#reply-title'),
					$commentForm = $reviews.find('#commentform');

			$toggleBtn.on('click', function(e){
				if (!$commentForm.hasClass('opened')) {
					setTimeout(function() {
						$('html, body').animate({'scrollTop': $commentForm.offset().top - self.$headerHeight - self.$adminbarHeight  - 20 }, 300);
					}, 200);
					$commentForm.slideDown('100', function() {
						$commentForm.addClass('opened');
					});
				} else {
					$commentForm.slideUp('100', function() {
						$commentForm.removeClass('opened');
					});
				}
			});
		},

		/* Photoswipe */
		productPswp: function() {
			var self = this;

			// Prevent the PSWP close button to trigger cart icon
			self.$document.on('touchstart click', '.pswp__button--close', function(event){

		    $('.header .quick_cart').bind('click', false);
		    setTimeout(function(){
		    	$('.header .quick_cart').unbind('click', false);
		    },1000);

				if(event.handled === false) return
				event.stopPropagation();
				event.preventDefault();
				event.handled = true;
				
			});

		},

		/* Show Related/Upsells in carousel mode */
		relatedProductsSlider: function() {
			var self = this;

			if ( theme_vars.settings.related_slider != true )
				return; 

			var $related = $('.related.products ul.et-main-products'),
					$upsell = $('.up-sells ul.et-main-products'),
					$cross = $('.cross-sells ul.et-main-products');

			if ($upsell.children().length > 1) self.slickCarousel($upsell);
			if ($cross.children().length > 1) self.slickCarousel($cross);
			if ($related.children().length > 1) self.slickCarousel($related);

		},

		/* Move checkout order review upwards */
		checkoutOrder: function() {
			var self = this,
					$checkoutOpt = $('.before-checkout'),
					$checkoutForm = $('form.woocommerce-checkout'),
					$orderReview = $checkoutForm.find('#order_review'),
					spacerOrig = $checkoutOpt.height(),
					divHeight = spacerOrig,
					refreshIntervalId;
					
			if( $orderReview.length == 0 || $checkoutForm.hasClass('argmc-form') ) {
				return;
			} 

			self.fixedContent( $orderReview, 0);

			self.$body.on('click', '#ship-to-different-address,.woocommerce-account-fields', function(e) {
				$(document.body).trigger("sticky_kit:recalc");
				$('html, body').animate({'scrollTop': self.$window.scrollTop() - 10 }, 10);
			});

			self.$body.on('payment_method_selected updated_checkout', function(){
				setTimeout(function(){ 
					$(document.body).trigger("sticky_kit:recalc");
				}, 200);
			});

			// Resize checkout spacer
			set_heights();

			self.$window.on('resize', $checkoutOpt, function(e) {
				set_heights();
			});

			self.$body.on('click', '.showcoupon, .showlogin', function(e) {
				refreshIntervalId = setInterval(function(){  set_heights(); }, 50);

				setTimeout(function(){
					if (spacerOrig == divHeight) {
						clearInterval(refreshIntervalId);
					}
				}, 2000);

			});

			$('.et-checkout-coupon').arrive('.woocommerce-error', function() {
				refreshIntervalId = setInterval(function(){  set_heights(); }, 50);
			});

			// Move notices
			$(document.body).on( 'init_checkout updated_checkout payment_method_selected', function( event, data  ) {

				$('form.checkout').arrive('.woocommerce-NoticeGroup', function() {
					$( '.et-woocommerce-NoticeGroup' ).append($( '.woocommerce-NoticeGroup' ).html());
					$( '.woocommerce-NoticeGroup' ).remove();
				});
					
			});

			// Scroll back to top if error
			$(document.body).on( 'checkout_error', function( event, data  ) {
				$('html, body').animate({'scrollTop': $('#header').outerHeight() }, 200);
			});

			function set_heights(){
				var divHeight = $checkoutOpt.height(); 
				$('#checkout-spacer').css('min-height', divHeight+'px');
				$checkoutOpt.addClass('ready');
			}


		},

		/* Show Terms & Conditions popup */
		termsPopup: function() {
			var self = this;

			$(document.body).off('click', 'a.woocommerce-terms-and-conditions-link');
			
			self.$body.on('click', '.woocommerce-terms-and-conditions-link', function(e) {
				e.preventDefault();

				$.magnificPopup.open({
					mainClass: 'checkout-terms-popup et-mfp-fade-in',
					closeBtnInside: true,
					closeOnBgClick: true,
					closeMarkup: '<button title="%title%" class="mfp-close scissors-close"></button>',
					removalDelay: 180,
					items: {
						src: $('.woocommerce-terms-and-conditions'),
						type: 'inline'
					}
				});
			});
			
		},

		/* Show Login popup box */
		loginPopup: function() {
			var self = this;
			
			self.$body.on('click', '.et-menu-account-btn', function(e) {

				if (theme_vars.settings.is_checkout) {
					return true;
				}

				e.preventDefault();

				$.magnificPopup.open({
					mainClass: 'et-mfp-login-popup et-mfp-fade-in',
					alignTop: false,
					closeBtnInside: true,
					closeOnBgClick: false,
					closeMarkup: '<button title="%title%" class="mfp-close scissors-close"></button>',
					removalDelay: 180,
					items: {
						src: $('#et-login-popup-wrap'),
						type: 'inline'
					}
				});
			});
			
		},

		// Ajax search lightbox
		ajaxSearch: function() {
			var self = this,
					$search = $('.goya-search .woocommerce-product-search');

			$search.each(function() {

				var $searchField = $(this).find('.search-field'),
						$searchClear = $(this).find('.search-clear'),
						$searchBtn = $(this).find('.search-button-group'),
						$category = $(this).find('.wc-category-select'),
						$autoWrapper = $(this).find('.autocomplete-wrapper');

				$searchField.on('change paste keyup', function(e) {
					if ($searchField.val().length > 0) {
						$searchBtn.addClass('text-changed');
					} else {
						$searchBtn.removeClass('text-changed');
						if (theme_vars.settings.ajaxSearchActive == true) {
							$searchField.devbridgeAutocomplete('hide');
						}
						$searchBtn.removeClass('et-loader');
					}
				});			

				$searchClear.on('click', function(e) {
					$searchField.val('');
					$searchBtn.removeClass('text-changed');
					if (theme_vars.settings.ajaxSearchActive == true) {
						$searchField.devbridgeAutocomplete('hide');
					}
					$searchBtn.removeClass('et-loader');
				});
			
				if (theme_vars.settings.ajaxSearchActive == true) {

					$searchField.devbridgeAutocomplete({
						minChars: 3,
						appendTo: $autoWrapper,
						containerClass: 'product_list_widget',
						triggerSelectOnValidInput: false,
						serviceUrl: theme_vars.ajaxUrl + '?action=goya_search_products_ajax',
						params: { 
							category_slug: function () { 
								return $category.val(); 
							}
						},

						onSearchStart: function() {
							$searchBtn.addClass('et-loader');
						},
						formatResult: function(suggestion, currentValue) {
							if (suggestion.id == -1) {
								return '<span class="no-results">'+suggestion.url+'</span>';
							} else if (suggestion.id == -2) {
								return '<button type="submit" class="button outlined btn-sm view-all" value="'+suggestion.value+'">'+suggestion.url+'</button>';
							} else {
								return '<a href="'+suggestion.url+'">'+suggestion.thumbnail+'<span class="product-title">'+suggestion.value+'</span>'+suggestion.price+'</a>';
							}
						},
						onSelect: function(suggestion) {
							if (suggestion.id !== -1 || suggestion.id !== -2) {
								self.$window.location.href = suggestion.url;
							}
						},
						onSearchComplete: function (query, suggestions) {
							$searchBtn.removeClass('et-loader');
						}
					});

				}

			});

		},

		/* Magnific Popup: Inline */
		magnificInline: function() {
			$('[rel="inline"]').each(function() {
				var _this = $(this), 
						eclass = (_this.data('class') ? _this.data('class') : ''),
						ebuttonInside = (_this.data('button-inside') ? true : false );

				_this.magnificPopup({
					type:'inline',
					midClick: true,
					mainClass: 'et-mfp-fade-in mfp entry-content ' + eclass,
					removalDelay: 180,
					closeBtnInside: ebuttonInside,
					closeOnBgClick: true,
					overflowY: 'scroll',
					closeMarkup: '<button class="mfp-close scissors-close"></button>',
					callbacks: {
						open: function() {
							var that = this;
							if (eclass === 'quick-search') {
								$('#wrapper').removeClass('open-menu');
								$('.mobile-toggle').removeClass('clicked');
								$('side-menu').css({ marginTop: '0px' });
								setTimeout(function(){ 
									$(that.content[0]).find('.search-field').focus(); 
								}, 100);
							}
						}
					}
				});
			});
		
		},

		/* Shop ajax load products */
		shopInfiniteScrolling: function(aFilter) {
			
			var self = this,
					is_loading = false,
					scrollInfinite = false,
					href = false,
					scrollLock = false,
					shopContainer = $('#shop-products').find('.shop-products-col'),
					$nextPageLink =  shopContainer.find('.woocommerce-pagination a.next'),
					$type = theme_vars.settings.shop_infinite_load;

			if (self.shopAjax) return false;

			if ($nextPageLink.length && self.$body.is('.woocommerce.archive')) {

				// Load with button click
				if ($type === 'button') {

					self.$body.on('click', '.et-shop-infload-btn', function(e) {
						var _this = $(this),
								$nextPageLink = shopContainer.find('.woocommerce-pagination a.next');

						e.preventDefault();
						
						if ( is_loading === false && $nextPageLink.length ) {
							href = $nextPageLink.attr('href');
							$('.et-shop-infload-controls').addClass('et-loader');
							loadProducts(_this, shopContainer);
						}
						return false;
					});

				// Autoload on scrolling
				} else if ($type === 'scroll') {

					scrollInfinite = _.debounce(function(){

						if (scrollLock) return;
						else if ( (is_loading === false ) && ( (self.$window.scrollTop() + self.$window.height() + 150) >= (shopContainer.offset().top + shopContainer.outerHeight()) ) ) {

							var $nextPageLink = shopContainer.find('.woocommerce-pagination a.next');

							if ($nextPageLink.length) {
								href = $nextPageLink.attr('href');
								$('.et-shop-infload-controls').addClass('et-loader');
								loadProducts(false, shopContainer, true);
							} else {
								return false;
							}
							
						}
					}, 30);

					self.$window.on('scroll', scrollInfinite);

				}

			} else {

				// No more pages to load
				$('.et-shop-infload-controls').addClass('pagination-empty');
				return false;
			
			}

			/* Load Results */
			var loadProducts = function(button, shopContainer, infinite) {
				
				self.shopAjax = $.ajax({
					url: href,
					dataType: 'html',
					method: 'GET',
					cache: false,
					headers: {'cache-control': 'no-cache'},
					beforeSend: function() {
						is_loading = true;
						
						if (infinite) {
							self.$window.off('scroll', scrollInfinite);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
					},
					complete: function() {
						is_loading = false;
						$('.et-shop-infload-controls').removeClass('et-loader');
					},
					success: function(response) {
						
						var $newItems = $(response).find('.et-main-products li.type-product'); 

						// Find pagination
						$('.woocommerce-pagination').html($(response).find('.woocommerce-pagination').html());

						if( !$(response).find('.woocommerce-pagination .next').length ) {
							$('.et-shop-infload-controls').addClass('hide-btn');
						} else {
							if (infinite) self.$window.on('scroll', scrollInfinite);
						}

						if ($newItems.length) {

							var $productsContainer = shopContainer.find('.et-main-products'),
									$newVariations = $(response).find('form.variations_form').addClass('new-swatches');

							// Append new items
							$newItems.appendTo($productsContainer);

							// Compatibility with YITH Wishlist Pro
							setTimeout( function(){
								$(document).trigger( 'yith_infs_added_elem' );
							}, 1000 );

							window.history.pushState( null, '', href );

							// Restart product animation
							var $animate = $newItems.find('.animation');
							if ($animate.length) {
								self.animation($animate);
							}

							// Re-init variations
							if (self.$showListVariations) {
							setTimeout(function(){
								self.productListVariations(true);
							}, 10);
							}
							
						}

						scrollLock = false;
						self.shopAjax = false;
						
					}
				});
			};

		},

		/* Update Wishlist counter */
		wishlistCounter: function() {
			var self = this,
					$wishlistIcon = $('.quick_wishlist');

			if( $wishlistIcon.length == 0 )
				return;

			self.$document.on( 'added_to_wishlist removed_from_wishlist', function(){
				var counter = $('.et-wishlist-counter');

				$.ajax({
					url: yith_wcwl_l10n.ajax_url,
					data: {
						action: 'yith_wcwl_update_wishlist_count'
					},
					dataType: 'json',
					success: function( data ){
						if (data.count > 0) {
							counter.addClass('active').html( data.count );	
						} else {
							counter.removeClass('active').html('');	
						}
					},
					beforeSend: function(){
						counter.block();
					},
					complete: function(){
						counter.unblock();
					}
				});
			});
		},


		/** Page Builder (Visual Composer) **/

		/* VC: Countdown Timer */
		countdownTimer: function() {

			$('.et-countdown').each(function() {

				var $thisCountdown = $(this),
						date = $thisCountdown.data('date'),
						offset = $thisCountdown.attr('utc');
				
				$thisCountdown.downCount({
					date: date,
					offset: offset
				});
				
			});

		},

		/* VC: Counter */
		counter: function(el) {
			var self = this,
					$counterEl = el ? el : $('.et-counter');

			$counterEl.each(function() {
				var $thisCounter = $(this),
						el = $thisCounter.find('.h1'),
						counter = el[0],
						count = el.data('count'),
						speed = el.data('speed'),
						od = new Odometer({
							el: counter,
							value: 0,
							duration: speed,
							theme: 'minimal'
						});

				// Don't target elements already initialized
				if( $thisCounter.data('et-in-viewport') === undefined ) {
					$thisCounter.data('et-in-viewport', true);
					
					setTimeout(function(){
						$thisCounter.css('visibility','visible');
						od.update(count);
					}, 0.05);
				}
			});
		},

		/* VC: Automatic typing text */
		autoType: function(el) {
			var self = this,
					$autoTypeEl = el ? el : $('.et-autotype');

			$autoTypeEl.each(function() {
				var $type = $(this);
				autoCtrl($type, 0.15);
			});

			function autoCtrl (element, delay, skip) {
				if ( ( element.data('et-in-viewport') === undefined ) || skip) {
					element.data('et-in-viewport', true);
						
					var _this = element,
							entry = _this.find('.et-animated-entry'),
							strings = entry.data('strings'),
							speed = entry.data('speed') ? entry.data('speed') : 50,
							loop = entry.data('et-loop') === 1 ? true : false,
							cursor = entry.data('et-cursor') === 1 ? true : false;

					var typed = new Typed('#'+_this.attr('id')+ ' .et-animated-entry',{
						strings: strings,
						loop: loop,
						showCursor: cursor,
						cursorChar: '|',
						contentType: 'html',
						typeSpeed: speed,
						backSpeed: 20,
						startDelay: 1000,
						backDelay: 1000,
					});
				}
			}
		
		},

		/* VC: Lightbox */
		mfpLightbox: function() {
			var self = this;

			$('.et-lightbox').each(function() {
				self.$body.on('click', '.et-lightbox', function(e) {
					var _this = $(this),
							type = _this.data('mfp-type'),
							mainClass = _this.data('mfp-class'),
							btnInside = _this.data('mfp-btn-inside'),
							params;

					params = {
						mainClass: mainClass,
						closeMarkup: '<button title="%title%" class="mfp-close scissors-close"></button>',
						removalDelay: 180,
						type: type,
						closeBtnInside: btnInside,
						image: {
							titleSrc: 'data-mfp-title',
							verticalFit: false
						}
					};

					params.closeOnContentClick = (type == 'inline') ? false : true;

					_this.magnificPopup(params).magnificPopup('open');

				});
			});
		},

		/* Gallery Lightbox */
		mfpGallery: function() {
			$('.mfp-gallery,.wp-gallery-popup .gallery,.wp-gallery-popup .wp-block-gallery,.wp-gallery-popup .wp-block-image').each(function() {
				var _this = $(this),
						params;

				params = {
					mainClass: 'et-wp-gallery-popup et-mfp-zoom-in',
					closeMarkup: '<button title="%title%" class="mfp-close scissors-close"></button>',
					removalDelay: 250,
					delegate: 'a',
					type: 'image',
					gallery: {
						enabled: true,
						arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%">'+ theme_vars.icons.prev_arrow +'</button>',
						navigateByImgClick: true,
						preload: [0,1]
					},
					image: {
						verticalFit: true,
						titleSrc: function(item) {
							return item.img.attr('alt');
						}
					},
					closeBtnInside: true,
					overflowY: 'scroll',
				};

				if ( _this.hasClass('gallery') ) {
					params.delegate = '.gallery-icon > a';
				} else if ( _this.hasClass('wp-block-gallery') ) {
					params.delegate = '.blocks-gallery-item > figure > a';
				} else if ( _this.hasClass('et-image-slider') ) {
					params.delegate = '.gallery-item > a';
				}

				_this.magnificPopup(params);

			});
		
		},

		mfpAutomatic: function() {
			var self = this;

			$('.mfp-automatic').each(function() {
				var _this = $(this),
						eclass = (_this.data('class')) ? _this.data('class') : '',
						delayOpen = (_this.data('delay')) ? _this.data('delay') : 0,
						target = '#'+ _this.attr('id');

				setTimeout(function() {
					
					$.magnificPopup.open({
						type:'inline',
						items: {
							src: target,
							type: 'inline'
						},
						midClick: true,
						mainClass: 'et-mfp-zoom-in mfp ' + eclass,
						removalDelay: 180,
						closeBtnInside: true,
						overflowY: 'scroll',
						closeMarkup: '<button title="%title%" class="mfp-close scissors-close"></button>',
						callbacks: {
							beforeOpen: function() {
								if(eclass == 'goya-popup') {
									self.$html.css('width', 'auto').css('overflow', 'hidden');
								}
							},
							beforeClose: function() {
								self.$html.css('width', '').css('overflow', '');
							},
							close: function() {
								$.cookie('goya_popup', '1', { 
									expires: theme_vars.settings.popup_length, 
									path: theme_vars.settings.cookie_path
								});
							}
						}
					});

				}, delayOpen);

			});
			
		},

		formStyling: function() {
			var self = this,
					wpFormsEl = '.form-row input[type=text], .form-row input[type=password], .form-row input[type=email], .form-row input[type=number], .form-row input[type=tel], .form-row input[type=date], .form-row textarea, .form-row select, .comment-form textarea, .comment-form input[type=text], .comment-form input[type=password], .comment-form input[type=email]';
			
			$(wpFormsEl).each(function() {

				/// Skip some inputs
				if ( $(this).attr("id") == 'rating' || ( $(this).parents('form.cart').length && !$(this).hasClass('wc-pao-addon-field') ) || $(this).parents('.woocommerce-checkout-payment').length )
					return false;

				// Add form-row if not exist
				if (! $(this).parent().hasClass('form-row') && ! $(this).parents().hasClass('woocommerce-input-wrapper') ) {
					$(this).parent().addClass('form-row');
				}

				$(this).parents('.form-row').addClass('float-label');

				var $placeholder = $(this).attr('placeholder'),
						$label = $(this).parents('.form-row').find('label'),
						$val = $(this).val();

				$placeholder = ($placeholder == 'undefined') ? '' : $placeholder;

				// WC Add-ons plugin
				if ($(this).hasClass('wc-pao-addon-field')) {

					if ($(this).hasClass('wc-pao-addon-image-swatch-select')) return;

					$label = $(this).parent('.form-row').siblings('label.wc-pao-addon-name');
					if ($label.length) {
						$label.insertAfter($(this));
					}

				} else {

					$(this).insertBefore($label);

					if(! $label.length) {
						$(this).after('<label for="'+$(this).attr('name')+'" class="fl-label">'+ $placeholder+'</label>');
					} else {
						$label.addClass('fl-label');
					}
				}

				// Always floating for select boxes
				if ($val || $(this).is('select')) { $(this).parent('.form-row').addClass('has-val'); }

			});

			// Open select2 elements
			self.$body.on( 'click', '.fl-label', function() {
				$(this).parent().find('.select2-hidden-accessible').select2('open');
			});

			self.$body.on( 'blur change', wpFormsEl, function() {
				var $val = $(this).val();

				validateFields($(this));

				// Check for autofilled fields in checkout
				if ($(this).closest('form').hasClass('checkout')) {
					validateFields( $('.checkout .form-row input[type=text]'));
				}

			});
		
			function validateFields (element) {
				element.each(function() {
					var $val = $(this).val();

				if ($val || $(this).is('select')) { 
					$(this).parent('.form-row').addClass('has-val'); 
				} else {
					$(this).parent('.form-row').removeClass('has-val');
				}
			});
			}

			// Ninja Forms
			var ninjaFormsEl = '.nf-field-element input[type=text], .nf-field-element input[type=password], .nf-field-element input[type=email], .nf-field-element input[type=number], .nf-field-element input[type=tel], .nf-field-element input[type=date], .nf-field-element textarea, .nf-field-element select';

			self.$document.on( 'nfFormReady', function( e, layoutView ) {
				
				$(ninjaFormsEl).each(function() {
					$(this).parents('.field-wrap').addClass('float-label');
					var $val = $(this).val();
					
					if ($val || $(this).is('select')) { $(this).parents('.field-wrap').addClass('has-val'); }
					
				});

			});

			self.$body.on( 'change', ninjaFormsEl, function() {
				var $val = $(this).val();
				if ($val) { $(this).parents('.field-wrap').addClass('has-val'); } else { $(this).parents('.field-wrap').removeClass('has-val'); }
			});

			self.$body.on( 'focus', ninjaFormsEl, function() {
				$(this).parents('.field-wrap').addClass('field-focused');
			});

			self.$body.on( 'blur', ninjaFormsEl, function() {
				$(this).parents('.field-wrap').removeClass('field-focused');
			});

			self.$body.on( 'updated_cart_totals', function(){
				jQuery('input#coupon_code').each(function() {
					$(this).parents('.form-row').addClass('deplace');
					var $label = $(this).parents('.form-row').find('label');
					$(this).insertBefore($label);
					var $val = $(this).val();
					if ($val) { $(this).parent('.form-row').addClass('has-val'); }
				});
			});

		},

	};
	
	$(document).ready(function() {
		if ($('#vc_inline-anchor').length) {
			$(window).on('vc_reload', function() {
				GOYA.init();
			});
		} else {
			GOYA.init();
		}
	});

})(jQuery);