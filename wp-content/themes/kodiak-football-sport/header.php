<?php
/**
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kodiak-football-sport
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="mainWrapper">
		<header>
			<nav class="navbar navbar-default">
				<div class="container">
					<?php
					if ( function_exists( 'the_custom_logo' ) ) {
						if ( has_custom_logo() ) {
							echo '<div class="navbar-header navbar-logo">';
						} else {
							echo '<div class="navbar-header">';
						}
					}
					?>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">
							<?php esc_html_e( 'Toggle navigation', 'kodiak-football-sport' ); ?>
						</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<?php
					$site_name = get_bloginfo( 'name' );
					$description = get_bloginfo( 'description', 'display' );

					if ( function_exists( 'the_custom_logo' ) ) {
						if ( has_custom_logo() ) {
							the_custom_logo();
						} else {
							?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand" rel="home" itemprop="url" target="_self">
								<div class="site-title"><?php echo esc_html( $site_name ); ?></div>
								<small class="site-description"><?php echo ( $description ); ?></small>
							</a>
							<?php
						}
					}
					?>
				</div>
				<?php if ( has_nav_menu( 'top' ) ) : ?>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'top',
								'depth' => 5,
								'container' => false,
								'walker' => new Kodiak_Football_Sport_Bootstrap_Navwalker(),
							)
						);
						?>
					</div>
				<?php endif; ?>
			</div>
		</nav>
		<div class="clearfix"></div>
	</header>
	<div class="bodyMain">
		<div class="container">
			<?php
			if ( is_active_sidebar( 'top' ) ) {
				dynamic_sidebar( 'top' );
			}
			?>
			<div class="mainContent">
