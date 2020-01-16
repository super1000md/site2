<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Azuma
 */

/**
 * Adds custom classes to the array of body classes
 *
 * @param array $classes Classes for the body element
 * @return array
 */
if ( !function_exists( 'azuma_body_classes' ) ) {
	function azuma_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		if ( get_theme_mod( 'header_textcolor' ) == 'blank' ) {
			$classes[] = 'title-tagline-hidden';
		}

		if ( post_password_required() ) {
			$classes[] = 'post-password-required';
		}

		$sidebar_position = get_theme_mod( 'sidebar_position' );
		if ( $sidebar_position == "left" ) {
			$classes[] = 'sidebar-left';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'azuma_body_classes' );


if ( !function_exists( 'azuma_primary_menu_fallback' ) ) {
	function azuma_primary_menu_fallback() {
		echo '<ul id="primary-menu" class="demo-menu">';
		wp_list_pages( array( 'depth' => 3, 'sort_column' => 'post_name', 'title_li' => '' ) );
		echo '</ul>';
	}
}


if ( !function_exists( 'azuma_footer_menu_fallback' ) ) {
	function azuma_footer_menu_fallback() {
		if ( function_exists( 'the_privacy_policy_link' ) ) {
			echo '<div class="site-info-right">';
			the_privacy_policy_link( '', '' );
			echo '</div>';
		}
	}
}


if ( !function_exists( 'azuma_custom_excerpt_length' ) ) {
	function azuma_custom_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		} else {
			return 20;
		}
	}
}
add_filter( 'excerpt_length', 'azuma_custom_excerpt_length', 999 );


if ( !function_exists( 'azuma_excerpt_more' ) ) {
	function azuma_excerpt_more( $more ) {
		return '&hellip;';
	}
}
add_filter( 'excerpt_more', 'azuma_excerpt_more' );


if ( !function_exists( 'azuma_archive_title_prefix' ) ) {
	function azuma_archive_title_prefix( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="author vcard">' . get_avatar( get_the_author_meta( 'ID' ), '80' ) . esc_html( get_the_author() ) . '</span>' ;
		}
		return $title;
	}
}
add_filter( 'get_the_archive_title', 'azuma_archive_title_prefix' );


if ( !function_exists( 'azuma_css_font_family' ) ) {
	function azuma_css_font_family( $font_family ) {
		if ( strpos( $font_family, ':' ) ) {
			$font_family = substr( $font_family, 0, strpos( $font_family, ':' ) );
			return 'font-family:\'' . $font_family . '\'';
		} else {			
			return 'font-family:' . $font_family;
		}
	}
}


if ( !function_exists( 'azuma_dynamic_style' ) ) {
	function azuma_dynamic_style( $css = array() ) {

		$font_content = get_theme_mod( 'font_content' );
		$font_headings = get_theme_mod( 'font_headings' );
		$font_site_title = get_theme_mod( 'font_site_title' );
		$font_nav = get_theme_mod( 'font_nav' );

		if ( $font_content ) {
			$font_site_title_on = 1;
			$font_nav_on = 1;
			$css[] = 'body,button,input,select,textarea{' . azuma_css_font_family( $font_content ) . ';}';
			if ( $font_site_title ) {
				$css[] = '.site-title{' . azuma_css_font_family( $font_site_title ) . ';}';
			} else {
				$css[] = '.site-title{font-family:\'Rajdhani\';}';
			}
			if ( $font_nav ) {
				$css[] = '#site-navigation{' . azuma_css_font_family( $font_nav ) . ';}';
			} else {
				$css[] = '#site-navigation{font-family:\'Rajdhani\';}';
			}
		} else {
			$font_site_title_on = 0;
			$font_nav_on = 0;
		}

		if ( $font_headings ) {
			$css[] = 'h1:not(.site-title),h2,h3,h4,h5,h6{' . azuma_css_font_family( $font_headings ) . ';}';
		}

		if ( $font_site_title && $font_site_title_on == 0 ) {
			$css[] = '.site-title{' . azuma_css_font_family( $font_site_title ) . ';}';
		}

		if ( $font_nav && $font_nav_on == 0 ) {
			$css[] = '#site-navigation{' . azuma_css_font_family( $font_nav ) . ';}';
		}
		
		$fs_site_title = get_theme_mod( 'fs_site_title', '44' );
		if ( $fs_site_title && $fs_site_title != '44' ) {
			$css[] = '.site-title{font-size:' . esc_attr($fs_site_title) . 'px;}';
		}
		$fw_site_title = get_theme_mod( 'fw_site_title', '700' );
		if ( $fw_site_title && $fw_site_title != '700' ) {
			$css[] = '.site-title{font-weight:' . esc_attr($fw_site_title) . ';}';
		}
		$ft_site_title = get_theme_mod( 'ft_site_title', 'uppercase' );
		if ( $ft_site_title && $ft_site_title != 'uppercase' ) {
			$css[] = '.site-title{text-transform:' . esc_html($ft_site_title) . ';}';
		}		
		$fl_site_title = get_theme_mod( 'fl_site_title', '2' );
		if ( $fl_site_title && $fl_site_title != '2' ) {
			$css[] = '.site-title{letter-spacing:' . esc_attr($fl_site_title) . 'px;}';
		}

		if ( class_exists( 'WooCommerce' ) ) {
			$woo_uncat_id = term_exists( 'uncategorized', 'product_cat' );
			if ( $woo_uncat_id != NULL ) {
				$woo_uncat_id = $woo_uncat_id['term_id'];
				$css[] = '#shop-filters .widget_product_categories li.cat-item-' . $woo_uncat_id . '{display:none;}';
			}
		}

		$container_width = get_theme_mod( 'container_width', '1920' );
		if ( $container_width && $container_width != '1920' ) {
			$css[] = '.container{max-width:' . esc_attr($container_width) . 'px;}';
		}

		$header_textcolor = get_theme_mod( 'header_textcolor', 'ffffff' );
		if ( $header_textcolor && $header_textcolor != 'ffffff' && $header_textcolor != 'blank' ) {
			$css[] = '.site-description,#primary-menu,#primary-menu li a,#primary-menu li.highlight.current-menu-item > a,#site-top-right,#site-top-right a,.toggle-nav,#masthead .search-form input[type="search"],#masthead .woocommerce-product-search input[type="search"],#masthead .search-form input[type="submit"]:after,#masthead .woocommerce-product-search button[type="submit"]:after{color:#' . esc_attr($header_textcolor) . ';}';
		}

		$hi_color = get_theme_mod( 'hi_color', '#ff7800' );
		if ( $hi_color && $hi_color != '#ff7800' ) {
			$hi_color = esc_attr($hi_color);
			$hi_color_rgb = azuma_hex2RGB($hi_color);
			
			$css[] = '.button,a.button,button,input[type="button"],input[type="reset"],input[type="submit"],#infinite-handle span button,#infinite-handle span button:hover,#infinite-handle span button:focus,#infinite-handle span button:active,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce a.added_to_cart,.woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt:disabled[disabled],.woocommerce #respond input#submit.alt:disabled[disabled]:hover,.woocommerce a.button.alt.disabled,.woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled,.woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt:disabled[disabled],.woocommerce a.button.alt:disabled[disabled]:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt:disabled[disabled],.woocommerce button.button.alt:disabled[disabled]:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt:disabled[disabled],.woocommerce input.button.alt:disabled[disabled]:hover,.bx-wrapper .bx-controls-direction a:hover,#primary-menu li.highlight > a,.featured-post:hover .featured-icon,#footer-menu a[href^="mailto:"]:before,.widget_nav_menu a[href^="mailto:"]:before,#footer-menu a[href^="tel:"]:before,.widget_nav_menu a[href^="tel:"]:before,.bx-wrapper .bx-pager.bx-default-pager a:hover,.bx-wrapper .bx-pager.bx-default-pager a.active{background:' . $hi_color . ';}';
			
			$css[] = '.woocommerce .sale-flash,.woocommerce ul.products li.product .sale-flash,#yith-quick-view-content .onsale,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle{background-color:' . $hi_color . ';}';
			
			$css[] = 'a,#masthead a.azuma-cart.items .azuma-icon-shopping-cart,#masthead a.azuma-cart.items .item-count,.site-title a,.site-title a:hover,.site-title a:active,.site-title a:focus,#primary-menu li.current-menu-item > a,.pagination a:hover,.pagination .current,.woocommerce nav.woocommerce-pagination ul li a:focus,.woocommerce nav.woocommerce-pagination ul li a:hover,.woocommerce nav.woocommerce-pagination ul li span.current,#wc-sticky-addtocart .options-button,#add_payment_method .cart-collaterals .cart_totals .discount td,.woocommerce-cart .cart-collaterals .cart_totals .discount td,.woocommerce-checkout .cart-collaterals .cart_totals .discount td,.infinite-loader{color:' . $hi_color . ';}';
			
			$css[] = '.top-search .mini-search,#masthead .top-account .mini-account,#masthead .top-cart .mini-cart,#primary-menu ul,.woocommerce-info,.woocommerce-message,.bx-wrapper .bx-pager.bx-default-pager a:hover,.bx-wrapper .bx-pager.bx-default-pager a.active{border-color:' . $hi_color . ';}';

			$css[] = '.featured-post:hover .featured-icon{box-shadow: 0px 0px 0px 4px rgba('.$hi_color_rgb['r'].','.$hi_color_rgb['g'].','.$hi_color_rgb['b'].',.5);}';

		}

		$hi_color2 = get_theme_mod( 'hi_color2', '#2d364c' );
		if ( $hi_color2 && $hi_color2 != '#2d364c' ) {
			$hi_color2 = esc_attr($hi_color2);
			$hi_color2_rgb = azuma_hex2RGB($hi_color2);
			
			$css[] = '.button:hover,a.button:hover,button:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,#infinite-handle span button:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce a.added_to_cart,.woocommerce a.added_to_cart:hover,#grid-loop article:hover,#main.infinite-grid .infinite-wrap article:hover,.woocommerce ul.products li.product:hover,.woocommerce-page ul.products li.product:hover,.single .entry-footer,aside,#site-usp,#shop-filters,.comment-navigation .nav-previous a,.comment-navigation .nav-next a,.top-search .mini-search,#masthead .top-account .mini-account,#masthead .top-cart .mini-cart,#home-hero-section .widget_media_image:before,#primary-menu ul,.posts-navigation,.post-navigation,.featured-post:hover,.featured-post .featured-icon{background:' . $hi_color2 . ';}';
			
			$css[] = '#masthead.not-full,#masthead.full.scrolled,#colophon{background-color:' . $hi_color2 . ';}';
			
			$css[] = '#grid-loop article:hover a.button:hover,#main.infinite-grid .infinite-wrap article:hover a.button:hover,.woocommerce ul.products li.product:hover a.button:hover,.woocommerce ul.products li.product:hover button.button:hover,.woocommerce ul.products li.product:hover input.button:hover,.woocommerce ul.products li.product:hover a.button.alt:hover,.woocommerce ul.products li.product:hover button.button.alt:hover,.woocommerce ul.products li.product:hover input.button.alt:hover,.woocommerce ul.products li.product:hover a.added_to_cart,.woocommerce ul.products li.product:hover a.added_to_cart:hover{color:' . $hi_color2 . ';}';
			
			$css[] = '.top-account p.mini-account-footer,#wc-sticky-addtocart{border-color:' . $hi_color2 . ';}';

			$css[] = '.sticky{border-top:5px solid ' . $hi_color2 . ';}';

			$css[] = '.comment-navigation .nav-next a:after{border-left:11px solid ' . $hi_color2 . ';}';

			$css[] = '.comment-navigation .nav-previous a:after{border-right:11px solid ' . $hi_color2 . ';}';

			$css[] = '.entry-header.with-image,.archive-header.with-image{background-color:rgba('.$hi_color2_rgb['r'].','.$hi_color2_rgb['g'].','.$hi_color2_rgb['b'].',.5);}';

			$css[] = '.entry-header .title-meta-wrapper,.archive-header .title-meta-wrapper{background:rgba('.$hi_color2_rgb['r'].','.$hi_color2_rgb['g'].','.$hi_color2_rgb['b'].',.7);}';

			$css[] = '.entry-header.with-image.full:before,.archive-header.with-image.full:before{background:rgba('.$hi_color2_rgb['r'].','.$hi_color2_rgb['g'].','.$hi_color2_rgb['b'].',.5);}';

			$css[] = '.featured-post .featured-icon{box-shadow: 0px 0px 0px 4px rgba('.$hi_color2_rgb['r'].','.$hi_color2_rgb['g'].','.$hi_color2_rgb['b'].',.5);}';

			$css[] = '@media only screen and (max-width: 1024px){#site-navigation{background:' . $hi_color2 . ';}}';
			
		}

		if ( get_theme_mod( 'header_search_off' ) ) {
			$css[] = '#masthead .top-search{display:none;}';
		}

		return implode( '', $css );

	}
}


if ( !function_exists( 'azuma_editor_dynamic_style' ) ) {
	function azuma_editor_dynamic_style( $mceInit, $css = array() ) {

		$font_content = get_theme_mod( 'font_content' );
		if ( $font_content ) {
			$css[] = 'body.mce-content-body{' . azuma_css_font_family( $font_content ) . ';}';
		}

		$font_headings = get_theme_mod( 'font_headings' );
		if ( $font_headings ) {
			$css[] = '.mce-content-body h1,.mce-content-body h2,.mce-content-body h3,.mce-content-body h4,.mce-content-body h5,.mce-content-body h6{' . azuma_css_font_family( $font_headings ) . ';}';
		}

		$hi_color = get_theme_mod( 'hi_color' );
		if ( $hi_color ) {
			$css[] = '.mce-content-body a:not(.button),.mce-content-body a:hover:not(.button),.mce-content-body a:focus:not(.button),.mce-content-body a:active:not(.button){color:' . esc_attr( $hi_color ) . '}';
		}

		$styles = implode( '', $css );

		if ( isset( $mceInit['content_style'] ) ) {
			$mceInit['content_style'] .= ' ' . $styles . ' ';
		} else {
			$mceInit['content_style'] = $styles . ' ';
		}
		return $mceInit;

	}
}
add_filter( 'tiny_mce_before_init', 'azuma_editor_dynamic_style' );


function azuma_block_editor_dynamic_style( $css = array() ) {

	$font_content = get_theme_mod( 'font_content', 'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i' );
	if ($font_content && $font_content != 'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i' ) {
		$css[] = '.editor-default-block-appender textarea.editor-default-block-appender__content,.editor-styles-wrapper p,.editor-styles-wrapper ul,.editor-styles-wrapper li{' . azuma_css_font_family( $font_content ) . ';}';
	}

	$font_headings = get_theme_mod( 'font_headings', 'Rajdhani:300,400,500,600,700' );
	if ($font_headings && $font_headings != 'Rajdhani:300,400,500,600,700' ) {
		$css[] = '.editor-post-title__block .editor-post-title__input,.editor-styles-wrapper h1,.editor-styles-wrapper h2,.editor-styles-wrapper h3,.editor-styles-wrapper h4,.editor-styles-wrapper h5,.editor-styles-wrapper h6{' . azuma_css_font_family( $font_headings ) . ';}';
	}

	$hi_color = get_theme_mod( 'hi_color' );
	if ($hi_color && $hi_color != "#ff7800") {		
		$css[] = '.editor-rich-text__tinymce a,.editor-rich-text__tinymce a:hover,.editor-rich-text__tinymce a:focus,.editor-rich-text__tinymce a:active{color:'.esc_attr($hi_color).'}';
	}

	return implode( '', $css );

}


if ( !function_exists( 'azuma_header_menu' ) ) {
	function azuma_header_menu() {
		?>
		<button class="toggle-nav"></button>
		<div id="site-navigation" role="navigation">
			<div class="site-main-menu">
			<?php wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'		=> 'primary-menu',
					'fallback_cb'	=> 'azuma_primary_menu_fallback',
				)
			); ?>
			</div>
		</div>
		<?php
	}
}


if ( !function_exists( 'azuma_header_content' ) ) {
	function azuma_header_content() {
		?>
			<div id="site-branding">
				<?php if ( get_theme_mod( 'custom_logo' ) ) {
						the_custom_logo();
					} else { ?>
					<?php if ( is_front_page() ) { ?>
						<h1 class="site-title"><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php } else { ?>
						<p class="site-title"><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php } 
					} ?>				
						<div class="site-description"><?php bloginfo( 'description' ); ?></div>
			</div><!-- #site-branding -->
		<?php
	}
}


if ( !function_exists( 'azuma_header_content_extra' ) ) {
	function azuma_header_content_extra() {
		?>
			<div id="site-top-right">
				<?php azuma_header_search() ?>
				<?php azuma_header_account(); ?>
				<?php azuma_header_wishlist(); ?>
				<?php azuma_header_cart(); ?>
			</div><!-- #site-top-right -->
		<?php
	}
}


if ( !function_exists( 'azuma_header_account' ) ) {
	function azuma_header_account() {
		if ( class_exists( 'WooCommerce' ) ) { ?>
			<div class="top-account">
			<?php $woo_account_page_id = get_option( 'woocommerce_myaccount_page_id' );
			if ( $woo_account_page_id ) {
				$woo_account_page_url = get_permalink( $woo_account_page_id ); ?>
				<a class="azuma-account" href="<?php echo get_permalink( $woo_account_page_id ); ?>" role="button"><span id="icon-user" class="icons azuma-icon-user"></span></a>
			<?php } else {
				$woo_account_page_url = wp_login_url( get_permalink() ); ?>
				<span class="azuma-account" role="button"><span id="icon-user" class="icons azuma-icon-user"></span></span>
			<?php } ?>
				<div class="mini-account">
				<?php if ( is_user_logged_in() ) {
					woocommerce_account_content();
					woocommerce_account_navigation();
				} else {
					wc_get_template( 'myaccount/form-login.php' );
				} ?>
				</div>
			</div>
		<?php }
	}
}


/**
 * Return translated post ID
 */
if(!function_exists( 'azuma_wpml_page_id' )){
	function azuma_wpml_page_id($id){
		if ( function_exists( 'wpml_object_id' ) ) {
			return apply_filters( 'wpml_object_id', $id, 'page' );
		} elseif ( function_exists( 'icl_object_id' ) ) {
			return icl_object_id( $id, 'page', true );
		} else {
			return $id;
		}
	}
}


/**
 * Return current page
 */
if ( !function_exists( 'azuma_current_page_url' ) ) {
	function azuma_current_page_url() {
		global $wp;
		if ( !$wp->did_permalink ) {
			$azuma_current_page_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
		} else {
			$azuma_current_page_url = home_url( add_query_arg( array(), $wp->request ) );
		}
		if ( is_404( $azuma_current_page_url ) ) {
			$azuma_current_page_url  = home_url( '/' );
		}
		return esc_url( $azuma_current_page_url );
	}
}


if ( !function_exists( 'azuma_header_search' ) ) {
	function azuma_header_search() {
		?>
		<div class="top-search">
			<a href="#" class="icons azuma-icon-search"></a>
			<div class="mini-search">
			<?php if ( class_exists( 'WooCommerce' ) ) {
				get_product_search_form();
			} else {
				get_search_form();
			} ?>
			</div>
		</div>
	<?php }
}


if ( !function_exists( 'azuma_header_wishlist' ) ) {
	function azuma_header_wishlist() {
		if ( class_exists( 'WooCommerce' ) ) {
			if ( class_exists( 'YITH_WCWL' ) ) { ?>
				<div class="top-wishlist"><a class="azuma-wishlist" href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>" role="button"><span class="icons azuma-icon-heart"></span><span class="wishlist_products_counter_number"><?php echo yith_wcwl_count_all_products(); ?></span></a></div>
			<?php } elseif ( class_exists( 'TInvWL' ) ) {
				echo do_shortcode( '[ti_wishlist_products_counter show_icon="off" show_text="off"]' );
			}
		}
	}
}


if ( !function_exists( 'azuma_update_wishlist_count' ) ) {
	function azuma_update_wishlist_count() {
		if( class_exists( 'YITH_WCWL' ) ){
			wp_send_json( array(
				'count' => yith_wcwl_count_all_products()
			) );
		}
	}
}
add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'azuma_update_wishlist_count' );
add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'azuma_update_wishlist_count' );


if ( !function_exists( 'azuma_header_cart' ) ) {
	function azuma_header_cart() {
		if ( class_exists( 'WooCommerce' ) ) {
			$cart_items = WC()->cart->get_cart_contents_count();
			if ( $cart_items > 0 ) {
				$cart_class = ' items';
			} else {
				$cart_class = '';
			} ?>
					<div class="top-cart"><a class="azuma-cart<?php echo $cart_class; ?>" href="<?php echo esc_url( wc_get_cart_url() ); ?>" role="button"><span class="icons azuma-icon-shopping-cart"></span><?php echo sprintf ( '<span class="item-count">%d</span>', $cart_items ); ?></a><div class="mini-cart"><?php woocommerce_mini_cart();?></div></div>
		<?php }
	}
}


/**
 * Update header mini-cart contents when products are added to the cart via AJAX
 */
if ( !function_exists( 'azuma_header_cart_update' ) ) {
	function azuma_header_cart_update( $fragments ) {
		$cart_items = WC()->cart->get_cart_contents_count();
		if ( $cart_items > 0 ) {
			$cart_class = ' items';
		} else {
			$cart_class = '';
		}
		ob_start();
		?>
					<div class="top-cart"><a class="azuma-cart<?php echo $cart_class; ?>" href="<?php echo esc_url( wc_get_cart_url() ); ?>" role="button"><span class="icons azuma-icon-shopping-cart"></span><?php echo sprintf ( '<span class="item-count">%d</span>', $cart_items ); ?></a><div class="mini-cart"><?php woocommerce_mini_cart();?></div></div>
		<?php	
		$fragments['.top-cart'] = ob_get_clean();	
		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'azuma_header_cart_update' );


if ( !function_exists( 'azuma_yith_wishlist_icon' ) ) {
	function azuma_yith_wishlist_icon() {
		if ( class_exists( 'YITH_WCWL' ) ) {
			echo do_shortcode( '[yith_wcwl_add_to_wishlist label="" product_added_text="" already_in_wishslist_text="" browse_wishlist_text=""]' );
		}
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'azuma_yith_wishlist_icon', 9 );


/**
 * Powered by WordPress
 */
if ( !function_exists( 'azuma_powered_by' ) ) {
	function azuma_powered_by() {
		?>
				<div class="site-info">
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'azuma' ) ); ?>"><?php printf( esc_html__( 'Powered by %s', 'azuma' ), 'WordPress' ); ?></a>
					<i class="fa fa-chevron-right sep"></i>
					<?php printf( esc_html__( 'Theme: %s', 'azuma' ), '<a href="https://uxlthemes.com/theme/azuma/" rel="designer">Azuma</a>' ); ?>
				</div>
		<?php
	}
}


/**
 * WooCommerce product sticky cart form 
 */
if ( !function_exists( 'azuma_wc_sticky_addtocart' ) ) {
	function azuma_wc_sticky_addtocart() {

		if ( get_theme_mod( 'disable_wc_sticky_cart' ) == 1 ) {
			return;
		}

		if ( class_exists( 'WooCommerce' ) && is_product() ) {
			echo '<div id="wc-sticky-addtocart">';
			the_post_thumbnail( 'woocommerce_thumbnail' );
			woocommerce_template_single_title();
			woocommerce_template_single_price();
			if ( in_array( 'product-type-variable', get_post_class() ) ) {
				echo '<div class="options-button">' . esc_html__( 'options', 'azuma' ) . '</div>';
			}
			woocommerce_template_single_add_to_cart();
			echo '</div>';
		}

	}
}


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

add_action( 'woocommerce_before_main_content', 'azuma_theme_wrapper_start', 10);
add_action( 'woocommerce_after_main_content', 'azuma_theme_wrapper_end', 10);
add_action( 'woocommerce_before_shop_loop', 'azuma_shop_filter_section', 15);

add_action( 'woocommerce_before_shop_loop_item', 'azuma_before_shop_loop_item', 0);
add_action( 'woocommerce_before_subcategory', 'azuma_before_shop_loop_item', 0);

add_action( 'woocommerce_shop_loop_item_title', 'azuma_before_shop_loop_item_title', 0);
add_action( 'woocommerce_after_shop_loop_item_title', 'azuma_after_shop_loop_item_title', 100);

add_action( 'woocommerce_shop_loop_subcategory_title', 'azuma_before_shop_loop_cat_title', 0);
add_action( 'woocommerce_shop_loop_subcategory_title', 'azuma_after_shop_loop_item_title', 100);

add_action( 'woocommerce_after_shop_loop_item', 'azuma_before_shop_loop_addtocart', 6);
add_action( 'woocommerce_after_shop_loop_item', 'azuma_after_shop_loop_addtocart', 100);
add_action( 'woocommerce_after_subcategory', 'azuma_after_subcategory', 100);


if ( !function_exists( 'azuma_before_shop_loop_item' ) ) {
	function azuma_before_shop_loop_item() {
		echo '<div class="product-wrap">';
	}
}


if ( !function_exists( 'azuma_before_shop_loop_item_title' ) ) {
	function azuma_before_shop_loop_item_title() {
		$product_excerpt = get_the_excerpt();
		if ( $product_excerpt ) {
			echo '<div class="product-excerpt-wrap">' . $product_excerpt . '</div>';
		}
		echo '<div class="product-detail-wrap">';
	}
}


if ( !function_exists( 'azuma_before_shop_loop_cat_title' ) ) {
	function azuma_before_shop_loop_cat_title() {
		echo '<div class="product-detail-wrap">';
	}
}


if ( !function_exists( 'azuma_after_shop_loop_item_title' ) ) {
	function azuma_after_shop_loop_item_title() {
		echo '</div>';
	}
}


if ( !function_exists( 'azuma_before_shop_loop_addtocart' ) ) {
	function azuma_before_shop_loop_addtocart() {
		echo '<div class="product-addtocart-wrap">';
	}
}


if ( !function_exists( 'azuma_after_shop_loop_addtocart' ) ) {
	function azuma_after_shop_loop_addtocart() {
		echo '</div></div>';
	}
}


if ( !function_exists( 'azuma_after_subcategory' ) ) {
	function azuma_after_subcategory() {
		echo '</div>';
	}
}


if ( !function_exists( 'azuma_shop_filter_section' ) ) {
	function azuma_shop_filter_section() {
		if ( !is_product() ) {
			get_sidebar( 'shop-filters' );
		}
	}
}


if ( !function_exists( 'azuma_theme_wrapper_start' ) ) {
	function azuma_theme_wrapper_start() {
		if ( !is_active_sidebar( 'azuma-sidebar-shop' ) || is_product() ) {
			$page_full_width = ' full-width';
		} else {
			$page_full_width = '';
		}
		echo '<div id="primary" class="content-area'.$page_full_width.'">
			<main id="main" class="site-main" role="main">';
	}
}


if ( !function_exists( 'azuma_theme_wrapper_end' ) ) {
	function azuma_theme_wrapper_end() {
		echo '</main><!-- #main -->
		</div><!-- #primary -->';
		if ( !is_product() ) {
			get_sidebar( 'shop' );
		}
	}
}


if ( !function_exists( 'azuma_change_prev_next' ) ) {
	function azuma_change_prev_next( $args ) {
		$args['prev_text'] = '<i class="fa fa-chevron-left"></i>';
		$args['next_text'] = '<i class="fa fa-chevron-right"></i>';
		return $args;
	}
}
add_filter( 'woocommerce_pagination_args', 'azuma_change_prev_next' );


if ( !function_exists( 'azuma_woocommerce_placeholder_img_src' ) ) {
	function azuma_woocommerce_placeholder_img_src() {
		return get_template_directory_uri().'/images/woocommerce-placeholder.png';
	}
}
if ( !get_option( 'woocommerce_placeholder_image', 0 ) ) {
	add_filter('woocommerce_placeholder_img_src', 'azuma_woocommerce_placeholder_img_src');
}


if ( !function_exists( 'azuma_upsell_products_args' ) ) {
	function azuma_upsell_products_args( $args ) {
		$col_per_page = esc_attr( get_option( 'woocommerce_catalog_columns', 4 ) );
		$args['posts_per_page'] = $col_per_page;
		$args['columns'] = $col_per_page;
		return $args;
	}
}
add_filter( 'woocommerce_upsell_display_args', 'azuma_upsell_products_args' );


if ( !function_exists( 'azuma_related_products_args' ) ) {
	function azuma_related_products_args( $args ) {
		$col_per_page = esc_attr( get_option( 'woocommerce_catalog_columns', 4 ) );
		$args['posts_per_page'] = $col_per_page;
		$args['columns'] = $col_per_page;
		return $args;
	}
}
add_filter( 'woocommerce_output_related_products_args', 'azuma_related_products_args' );


if ( !function_exists( 'azuma_woocommerce_gallery_thumbnail_size' ) ) {
	function azuma_woocommerce_gallery_thumbnail_size( $size ) {
		return 'woocommerce_thumbnail';
	}
}
add_filter( 'woocommerce_gallery_thumbnail_size', 'azuma_woocommerce_gallery_thumbnail_size' );


remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

add_action( 'woocommerce_before_shop_loop_item_title', 'azuma_before_loop_sale_flash', 7);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 8 );
add_action( 'woocommerce_before_shop_loop_item_title', 'azuma_after_loop_sale_flash', 9);

add_action( 'woocommerce_before_single_product_summary', 'azuma_before_loop_sale_flash', 9);
add_action( 'woocommerce_before_single_product_summary', 'azuma_after_loop_sale_flash', 11);


if ( !function_exists('azuma_before_loop_sale_flash') ) {
	function azuma_before_loop_sale_flash() {
		global $product;
		if ( $product->is_on_sale() ) {
			echo '<div class="sale-flash">';
		}
	}
}


if ( !function_exists('azuma_after_loop_sale_flash') ) {
	function azuma_after_loop_sale_flash() {
		global $product;
		if ( $product->is_on_sale() ) {			
			if ( ! $product->is_type( 'variable' ) && $product->get_regular_price() && $product->get_sale_price() ) {
				$discount_price = $product->get_regular_price() - $product->get_sale_price();
				if ( $discount_price > 0 ) {
					$max_percentage = ( $discount_price  / $product->get_regular_price() ) * 100;
				} else {
					$max_percentage = 0;
				}
			} else {
				$max_percentage = 0;				
				foreach ( $product->get_children() as $child_id ) {
					$variation = wc_get_product( $child_id );
					$price = $variation->get_regular_price();
					$sale = $variation->get_sale_price();
					$percentage = '';
					if ( $price != 0 && ! empty( $sale ) ) {
						$percentage = ( $price - $sale ) / $price * 100;
					}
					if ( $percentage > $max_percentage ) {
						$max_percentage = $percentage;
					}
				}
			}
			echo '<br /><span class="sale-percentage">-' . esc_attr( round($max_percentage) ) . '%</span>';
			echo '</div>';
		}
	}
}


/**
 * Available homepage WooCommerce sections
 */
if ( !function_exists( 'azuma_woo_home_tabs' ) ) {
	function azuma_woo_home_tabs() {
		$tabs = array();
		$tabs['services'] = array(
			'id'	   => 'services',
			'label'	=> esc_html__( 'Featured Services', 'azuma' ),
			'callback' => 'azuma_services',
			'shortcode'=> 'services',
		);
		$tabs['pagecontent'] = array(
			'id'	   => 'pagecontent',
			'label'	=> esc_html__( 'Page Content', 'azuma' ),
			'callback' => 'azuma_pagecontent',
			'shortcode'=> 'page_content',
		);

if ( class_exists( 'WooCommerce' ) ) {
		$tabs['categories'] = array(
			'id'		=> 'categories',
			'label'		=> esc_html__( 'Product Categories', 'azuma' ),
			'callback'	=> 'azuma_categories',
			'shortcode'	=> 'product_categories',
		);
		$tabs['recent'] = array(
			'id'		=> 'recent',
			'label'		=> esc_html__( 'New products', 'azuma' ),
			'callback'	=> 'azuma_recent',
			'shortcode'	=> 'recent_products',
		);
		$tabs['featured'] = array(
			'id'		=> 'featured',
			'label'		=> esc_html__( 'Featured products', 'azuma' ),
			'callback'	=> 'azuma_featured',
			'shortcode'	=> 'featured_products',
		);
		$tabs['sale'] = array(
			'id'		=> 'sale',
			'label'		=> esc_html__( 'On-sale products', 'azuma' ),
			'callback'	=> 'azuma_sale',
			'shortcode'	=> 'sale_products',
		);
		$tabs['best'] = array(
			'id'		=> 'best',
			'label'		=> esc_html__( 'Top sellers', 'azuma' ),
			'callback'	=> 'azuma_best',
			'shortcode'	=> 'best_selling_products',
		);
		$tabs['rated'] = array(
			'id'		=> 'rated',
			'label'		=> esc_html__( 'Top rated products', 'azuma' ),
			'callback'	=> 'azuma_rated',
			'shortcode'	=> 'top_rated_products',
		);
}

		return apply_filters( 'azuma_woo_home_tabs', $tabs );
	}
}


/**
 * Output the homepage sections without WooCommerce
 */
if ( !function_exists('azuma_home_nonwoo_section') ) {
	function azuma_home_nonwoo_section() {

		$woo_home_tabs = get_theme_mod( 'woo_home' );

		if ( !empty( $woo_home_tabs['tabs'] ) ) {

			echo '<div id="homepage-sections">';

			$woo_home = get_theme_mod( 'woo_home', true );

			$woo_tabs = azuma_woo_home_tabs();
	
			?>

			<?php
			$tabs = explode( ',', $woo_home['tabs'] );

			foreach ($tabs as $tab) {
				$tab = explode(":", $tab);
				$tab_id = $tab[0];
				$tab_active = $tab[1];
				$tab_shortcode = $woo_tabs[$tab_id]['shortcode'];

				if ( $tab_active == 1 ) {
					echo '<div id="section-'.$tab_id.'" class="section '.$tab_id.'">';
						if ( $woo_tabs[$tab_id]['shortcode'] == 'services' ) {
							azuma_homepage_features();
						} elseif ( $woo_tabs[$tab_id]['shortcode'] == 'page_content' ) {
							azuma_homepage_content();
						}
					echo '</div>';
				}

			}

			echo '</div>';

		}
	}
}


/**
 * Output the homepage sections with WooCommerce
 */
if ( !function_exists('azuma_home_woo_section') ) {
	function azuma_home_woo_section() {

		$woo_home_tabs = get_theme_mod( 'woo_home' );

		if ( !empty( $woo_home_tabs['tabs'] ) ) {

			echo '<div id="homepage-sections">';

			$woo_home = get_theme_mod( 'woo_home', true );

			$woo_tabs = azuma_woo_home_tabs();

			$woo_column_option = esc_attr( get_option( 'woocommerce_catalog_columns', 4 ) );
	
			?>

			<?php
			$tabs = explode( ',', $woo_home['tabs'] );

			foreach ($tabs as $tab) {
				$tab = explode(":", $tab);
				$tab_id = $tab[0];
				$tab_active = $tab[1];
				$tab_shortcode = $woo_tabs[$tab_id]['shortcode'];

				if ( $tab_active == 1 ) {
					echo '<div id="section-'.$tab_id.'" class="section '.$tab_id.'">';
						if ( $woo_tabs[$tab_id]['shortcode'] == 'services' ) {
							azuma_homepage_features();
						} elseif ( $woo_tabs[$tab_id]['shortcode'] == 'page_content' ) {
							azuma_homepage_content();
						} elseif ( $woo_tabs[$tab_id]['shortcode'] == 'product_categories' ) {
							echo '<h2 class="section-title">' . $woo_tabs[$tab_id]['label'] . '</h2>';
							echo do_shortcode('[product_categories number="0" parent="0" columns="' . $woo_column_option . '"]');
						} else {
							echo '<h2 class="section-title">' . $woo_tabs[$tab_id]['label'] . '</h2>';
							echo do_shortcode('[' . $tab_shortcode . ' limit="' . $woo_column_option . '" columns="' . $woo_column_option . '"]');
						}
					echo '</div>';
				}

			}

			echo '</div>';

		}
	}
}


if ( !function_exists('azuma_homepage_features') ) {
	function azuma_homepage_features() {


	$enable_featured_link = get_theme_mod( 'enable_featured_link', true);
?>
	<section id="featured-post-section" class="section">
		<div class="featured-post-wrap">
			<?php
			$featured_page_link1 = get_theme_mod( 'featured_page_link1' );
			if (!$featured_page_link1) {
			 	# display latest posts
				$azuma_recent_args = array(
					'numberposts' => '3',
					'orderby' => 'post_date',
					'order' => 'DESC',
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => false
					);
				$recent_posts = wp_get_recent_posts( $azuma_recent_args );
				$featured_post_number = 1;
				foreach( $recent_posts as $recent ){
					$featured_page_icon = get_theme_mod( 'featured_page_icon'.$featured_post_number, azuma_featured_icon_defaults($featured_post_number) );
					?>
					<div class="featured-post featured-post<?php echo $featured_post_number; ?>">
						<a href="<?php echo esc_url( get_permalink( $recent["ID"] ) ); ?>"><span class="featured-icon"><i class="<?php echo esc_attr( $featured_page_icon ); ?>"></i></span>
						<h4><?php echo wp_kses_post( get_the_title($recent["ID"]) ); ?></h4></a>
						<div class="featured-excerpt">
						<?php
						$featured_page_excerpt = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $recent["ID"] ) );
						if ( $featured_page_excerpt == '' ) {
							$featured_page_excerpt = wp_kses_post( '<p>' . wp_trim_words( strip_shortcodes( get_post_field( 'post_content', $recent["ID"] ) ), 15 ) . '</p>' );
						}
						if ( $featured_page_excerpt != '' && $featured_page_excerpt != '<p></p>' ) {
							echo $featured_page_excerpt;
						}
						if ( $enable_featured_link ) {
						?>
						<a href="<?php echo esc_url( get_permalink( $recent["ID"] ) ); ?>" class="button featured-readmore"><?php echo esc_html__( 'Read More', 'azuma' );?></a>
						<?php
						}
						?>
						</div>
					</div>
					<?php
					$featured_post_number++;
				}
				wp_reset_postdata();
			} else {
				# display selected pages
				for( $i = 1; $i < 4; $i++ ){
					$featured_page_icon = get_theme_mod( 'featured_page_icon'.$i, azuma_featured_icon_defaults($i) );
					$featured_page_link = azuma_wpml_page_id( get_theme_mod( 'featured_page_link'.$i) );					
					if($featured_page_link){
					?>
					<div class="featured-post featured-post<?php echo $i ;?>">
						<a href="<?php echo esc_url( get_page_link( $featured_page_link ) ); ?>"><span class="featured-icon"><i class="<?php echo esc_attr( $featured_page_icon ); ?>"></i></span>
						<h4><?php echo wp_kses_post( get_the_title($featured_page_link) ); ?></h4></a>
						<div class="featured-excerpt">
						<?php
						$featured_page_excerpt = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $featured_page_link ) );
						if ( $featured_page_excerpt == '' ) {
							$featured_page_excerpt = wp_kses_post( '<p>' . wp_trim_words( strip_shortcodes( get_post_field( 'post_content', $featured_page_link ) ), 15 ) . '</p>' );
						}
						if ( $featured_page_excerpt != '' && $featured_page_excerpt != '<p></p>' ) {
							echo $featured_page_excerpt;
						}
						if ( $enable_featured_link ) {
						?>
						<a href="<?php echo esc_url( get_page_link( $featured_page_link ) ); ?>" class="button featured-readmore"><?php echo esc_html__( 'Read More', 'azuma' );?></a>
						<?php
						}
						?>
						</div>
					</div>
				<?php
					}
				}
			}
			?>
		</div>
	</section>
<?php

	}
}


function azuma_featured_icon_defaults( $input ) {
	if ( $input == 1 ) {
		$output = 'fa fa-camera';
	} elseif ( $input == 2 ) {
		$output = 'fa fa-laptop';
	} elseif ( $input == 3 ) {
		$output = 'fa fa-rocket';
	} else {
		$output = 'fa fa-check';
	}
	return $output;
}


function azuma_hex2RGB( $hex ) {
	$hex = str_replace("#", "", $hex);

	preg_match("/^#{0,1}([0-9a-f]{1,6})$/i",$hex,$match);
	if ( !isset( $match[1] ) ) {
		return false;
	}

	if ( strlen( $match[1] ) == 6 ) {
		list($r, $g, $b) = array($hex[0].$hex[1],$hex[2].$hex[3],$hex[4].$hex[5]);
	}
	elseif ( strlen($match[1]) == 3 ) {
		list($r, $g, $b) = array($hex[0].$hex[0],$hex[1].$hex[1],$hex[2].$hex[2]);
	}
	elseif ( strlen($match[1]) == 2 ) {
		list($r, $g, $b) = array($hex[0].$hex[1],$hex[0].$hex[1],$hex[0].$hex[1]);
	}
	elseif ( strlen($match[1]) == 1 ) {
		list($r, $g, $b) = array($hex.$hex,$hex.$hex,$hex.$hex);
	}
	else {
		return false;
	}

	$color = array();
	$color['r'] = hexdec($r);
	$color['g'] = hexdec($g);
	$color['b'] = hexdec($b);

	return $color;
}


if ( !function_exists('azuma_homepage_content') ) {
	function azuma_homepage_content() {

		while ( have_posts() ) : the_post();

			get_template_part( 'content', 'front-page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

		endwhile; // End of the loop.

	}
}


/**
 * Array of Google fonts
 */
if ( !function_exists( 'azuma_google_fonts_array' ) ) {
	function azuma_google_fonts_array() {
	return array(
		'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
		'Impact, Charcoal, sans-serif' => 'Impact, Charcoal, sans-serif',
		'"Lucida Sans Unicode", "Lucida Grande", sans-serif' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
		'Tahoma, Geneva, sans-serif' => 'Tahoma, Geneva, sans-serif',
		'"Trebuchet MS", Helvetica, sans-serif' => '"Trebuchet MS", Helvetica, sans-serif',
		'Verdana, Geneva, sans-serif' => 'Verdana, Geneva, sans-serif',
		'Georgia, serif' => 'Georgia, serif',
		'"Palatino Linotype", "Book Antiqua", Palatino, serif' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
		'"Times New Roman", Times, serif' => '"Times New Roman", Times, serif',
		'' => '---------------',
		'Alegreya Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' => 'Alegreya Sans',
		'Arimo:400,400i,700,700i' => 'Arimo',
		'Arvo:400,400i,700,700i' => 'Arvo',
		'Asap:400,400i,700,700i' => 'Asap',
		'Bitter:400,400i,700' => 'Bitter',
		'Bree Serif:400' => 'Bree Serif',
		'Cabin:400,400i,500,500i,600,600i,700,700i' => 'Cabin',
		'Catamaran:300,400,600,700,800' => 'Catamaran',
		'Crimson Text:400,400i,600,600i,700,700i' => 'Crimson Text',
		'Cuprum:400,400i,700,700i' => 'Cuprum', 'Dosis:200,300,400,500,600,700,800' => 'Dosis',
		'Droid Sans:400,700' => 'Droid Sans',
		'Droid Serif:400,400i,700,700i' => 'Droid Serif',
		'Exo:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' => 'Exo',
		'Exo 2:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' => 'Exo 2',
		'Hind:300,400,500,600,700' => 'Hind',
		'Josefin Sans:100,100i,300,300i,400,400i,600,600i,700,700i' => 'Josefin Sans',
		'Lato:100,100i,300,300i,400,400i,700,700i,900,900i' => 'Lato',
		'Libre Franklin:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' => 'Libre Franklin',
		'Maven Pro:400,500,700,900' => 'Maven Pro',
		'Merriweather:300,300i,400,400i,700,700i,900,900i' => 'Merriweather',
		'Merriweather Sans:300,300i,400,400i,700,700i,800,800i' => 'Merriweather Sans',
		'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' => 'Montserrat',
		'Muli:300,300i,400,400i' => 'Muli',
		'Noto Sans:400,400i,700,700i' => 'Noto Sans',
		'Noto Serif:400,400i,700,700i' => 'Noto Serif',
		'Nunito:300,400,700' => 'Nunito',
		'Open Sans:300,300i,400,400i,600,600i,700,700i,800,800i' => 'Open Sans',
		'Orbitron:400,500,700,900' => 'Orbitron',
		'Oswald:300,400,700' => 'Oswald',
		'Oxygen:300,400,700' => 'Oxygen',
		'Playfair Display:400,400i,700,700i,900,900i' => 'Playfair Display',
		'Poppins:300,400,500,600,700' => 'Poppins',
		'PT Sans:400,400i,700,700i' => 'PT Sans',
		'PT Serif:400,400i,700,700i' => 'PT Serif',
		'Rajdhani:300,400,500,600,700' => 'Rajdhani',
		'Raleway:100,200,300,400,500,600,700,800,900' => 'Raleway',
		'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i' => 'Roboto',
		'Roboto Slab:100,300,400,700' => 'Roboto Slab',
		'Source Sans Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i' => 'Source Sans Pro',
		'Titillium Web:200,200i,300,300i,400,400i,600,600i,700,700i,900' => 'Titillium Web',
		'Ubuntu:300,300i,400,400i,500,500i,700,700i' => 'Ubuntu',
	);
	}
}
