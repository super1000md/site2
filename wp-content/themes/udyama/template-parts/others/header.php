<header id="masthead" class="site-header">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-4">
				<div class="site-branding">
					<div>
						<?php
						the_custom_logo();
						if ( is_front_page() && is_home() ) :
							?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php
						else :
							?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
						endif;
						$udyama_description = get_bloginfo( 'description', 'display' );
						if ( $udyama_description || is_customize_preview() ) :
							?>
							<p class="site-description"><?php echo esc_html( $udyama_description ); /* WPCS: xss ok. */ ?></p>
						<?php endif; ?>
					</div>
				</div><!-- .site-branding -->
			</div>

			<div class="col-md-8 text-right header-right-widget-area">
				<?php dynamic_sidebar( 'header-right' ); ?>
			</div>
		</div>
	</div>

	<div class="udyama-navbar">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav id="site-navigation" class="main-navigation">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						) );
						?>
					</nav><!-- #site-navigation -->
				</div>
			</div>
		</div>
	</div>
</header><!-- #masthead -->
