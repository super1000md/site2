/*!
 * Custom v1.0
 * Contains handlers for the different site functions
 *
 * Copyright (c) 2013-2019 DesignOrbital.com
 * License: GNU General Public License v2 or later
 * http://www.gnu.org/licenses/gpl-2.0.html
 */

/* global enquire:true */

( function( $ ) {
	var anther = {

		// Menu
		menuInit: function () {
			// Superfish Menu
			$( 'ul.sf-menu' ).superfish( {
				delay: 1500,
				animation: { opacity: 'show', height: 'show' },
				speed: 'fast',
				autoArrows: false,
				cssArrows: true,
			} );
		},

		// Responsive Videos
		responsiveVideosInit: function () {
			$( '.entry-content, .sidebar' ).fitVids();
		},

		// Responsive Menu
		responsiveMenuInit: function () {
			// Clone the Header Menu and remove classes from clone to prevent css issues
			var $headerMenuClone = $( '.header-menu' ).clone().removeAttr( 'class' ).addClass( 'header-menu-responsive' );
			$headerMenuClone.removeAttr( 'style' ).find( '*' ).each( function( i, e ) {
				$( e ).removeAttr( 'style' );
			} );

			// Insert the cloned menu before the site header menu
			$( '<div class="site-header-menu-responsive" />' ).insertBefore( '.site-header-menu' );
			$headerMenuClone.prepend( '<li class="menu-item menu-item-type-close"><button class="header-menu-responsive-close">&times;</button></li>' );
			$headerMenuClone.appendTo( '.site-header-menu-responsive' );

			// Add dropdown toggle that display child menu items.
			$( '.site-header-menu-responsive .page_item_has_children > a, .site-header-menu-responsive .menu-item-has-children > a' ).append( '<button class="dropdown-toggle" aria-expanded="false"/>' );
			$( '.site-header-menu-responsive .dropdown-toggle' ).off( 'click' ).on( 'click', function( e ) {
				e.preventDefault();
				$( this ).toggleClass( 'toggle-on' );
				$( this ).parent().next( '.children, .sub-menu' ).toggleClass( 'toggle-on' );
				$( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			} );
		},

		// Open Slide Panel - Responsive Mobile Menu
		slidePanelInit: function () {
			// Elements
			var menuResponsive = $( '.site-header-menu-responsive' );
			var overlayEffect = $( '.overlay-effect' );
			var menuResponsiveClose = $( '.header-menu-responsive-close' );

			// Responsive Menu Slide
			$( '.toggle-menu-control' ).off( 'click' ).on( 'click', function( e ) {
				// Prevent Default
				e.preventDefault();
				e.stopPropagation();

				// ToggleClass
				menuResponsive.toggleClass( 'show' );
				overlayEffect.toggleClass( 'open' );

				// Add Body Class
				if ( overlayEffect.hasClass( 'open' ) ) {
					$( 'body' ).addClass( 'has-responsive-menu' );
				}
			} );

			// Responsive Menu Close
			menuResponsiveClose.off( 'click' ).on( 'click', function() {
				anther.slidePanelCloseInit();
			} );

			// Overlay Slide Close
			overlayEffect.off( 'click' ).on( 'click', function() {
				anther.slidePanelCloseInit();
			} );
		},

		// Close Slide Panel
		slidePanelCloseInit: function () {
			// Elements
			var menuResponsive = $( '.site-header-menu-responsive' );
			var overlayEffect = $( '.overlay-effect' );

			// Slide Panel Close Logic
			if ( overlayEffect.hasClass( 'open' ) ) {
				// Remove Body Class
				$( 'body' ).removeClass( 'has-responsive-menu' );

				// For Menu
				if ( menuResponsive.hasClass( 'show' ) ) {
					menuResponsive.toggleClass( 'show' );
				}

				// Toggle Overlay Slide
				overlayEffect.toggleClass( 'open' );
			}
		},

		siteSearchHeaderInit: function () {
			// Responsive Menu Slide
			$( '.toggle-site-search-header-control' ).off( 'click' ).on( 'click', function( e ) {
				// Prevent Default
				e.preventDefault();
				e.stopPropagation();

				// Elements
				var siteSearchHeader = $( '.site-search-header-form-wrapper' );

				// ToggleClass
				siteSearchHeader.toggleClass( 'show' );
			} );
		},

		// Widget Logic
		widgetLogicInit: function () {
			// Social Menu Widget
			$( '.widget_nav_menu > div[class^="menu-social-"] > ul > li > a' ).wrapInner( '<span class="screen-reader-text"></span>' );

			// Custom Menu Widget
			$( '.widget_nav_menu .menu-item-has-children > a' ).append( '<span class="custom-menu-toggle" aria-expanded="false"></span>' );
			$( '.widget_nav_menu .custom-menu-toggle' ).off( 'click' ).on( 'click', function( e ) {
				e.preventDefault();
				$( this ).toggleClass( 'toggle-on' );
				$( this ).parent().next( '.sub-menu' ).toggleClass( 'toggle-on' );
				$( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			} );

			// Pages Widget
			$( '.widget_pages .page_item_has_children > a' ).append( '<span class="page-toggle" aria-expanded="false"></span>' );
			$( '.widget_pages .page-toggle' ).off( 'click' ).on( 'click', function( e ) {
				e.preventDefault();
				$( this ).toggleClass( 'toggle-on' );
				$( this ).parent().next( '.children' ).toggleClass( 'toggle-on' );
				$( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			} );

			// Categories Widget
			$( '.widget_categories' ).find( '.children' ).parent().addClass( 'category_item_has_children' );
			$( '.widget_categories .category_item_has_children > a' ).append( '<span class="category-toggle" aria-expanded="false"></span>' );
			$( '.widget_categories .category-toggle' ).off( 'click' ).on( 'click', function( e ) {
				e.preventDefault();
				$( this ).toggleClass( 'toggle-on' );
				$( this ).parent().next( '.children' ).toggleClass( 'toggle-on' );
				$( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			} );
		},

		// Media Queries
		mqInit: function () {
			enquire.register( 'screen and ( max-width: 991px )', {
				deferSetup: true,
				setup() {
					// Responsive Menu
					anther.responsiveMenuInit();
				},
				match() {
					// Sliding Panels for Menu
					anther.slidePanelInit();

					// Responsive Tables
					$( '.entry-content, .sidebar' ).find( 'table' ).wrap( '<div class="table-responsive"></div>' );
				},
				unmatch() {
					// Responsive Menu Close
					anther.slidePanelCloseInit();

					// Responsive Tables Undo
					$( '.entry-content, .sidebar' ).find( 'table' ).unwrap( '<div class="table-responsive"></div>' );
				},
			} );
		},

	};

	// Document Ready
	$( document ).ready( function() {
		// Menu
		anther.menuInit();

		// Responsive Videos
		anther.responsiveVideosInit();

		// Sliding Panels for Menu and Sidebar
		anther.slidePanelInit();

		// Site Search Header
		anther.siteSearchHeaderInit();

		// Widget Logic
		anther.widgetLogicInit();

		// Media Queries
		anther.mqInit();
	} );

	// Document Keyup
	$( document ).keyup( function( e ) {
		// Escape Key
		if ( e.keyCode === 27 ) {
			// Make the escape key to close the slide panel
			anther.slidePanelCloseInit();

			// Make the search header toggle
			var siteSearchHeader = $( '.site-search-header-form-wrapper' );
			if ( siteSearchHeader.hasClass( 'show' ) ) {
				siteSearchHeader.toggleClass( 'show' );
			}
		}
	} );
}( jQuery ) );
