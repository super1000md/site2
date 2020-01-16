<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kodiak-football-sport
 */

?>

					<?php if ( is_active_sidebar( 'bottom' ) ) : ?>
						<?php dynamic_sidebar( 'bottom' ); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<div class="footerBg col-xs-12">
			<div class="footerCont">
				<div class="container">
					<div class="col-xs-12 col-sm-3 kfMenu">
						<div class="row-left">
							<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
								<?php dynamic_sidebar( 'footer-1' ); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-xs-12 col-sm-3 kfMenu">
						<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
							<?php dynamic_sidebar( 'footer-2' ); ?>
						<?php endif; ?>
					</div>
					<div class="col-xs-12 col-sm-3 kfMenu">
						<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
							<?php dynamic_sidebar( 'footer-3' ); ?>
						<?php endif; ?>
					</div>
					<div class="col-xs-12 col-sm-3 kfMenu">
						<div class="row-right">
							<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
								<?php dynamic_sidebar( 'footer-4' ); ?>
							<?php endif; ?>
						</div>
					</div>
					<span class="col-xs-12 cprght">
						<div class="row">
							<?php esc_html_e( 'Copyright &copy;', 'kodiak-football-sport' ); ?>
							<?php echo date( 'Y' ); ?>
							<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
						</div>
						<div class="row">
							<?php
							if ( get_theme_mod( 'themeby', 'ON' ) === 'ON' ) {
								esc_html_e( 'Theme: Kodiak Football Sport by ', 'kodiak-football-sport' );
								echo '<a href="https://joomsport.com" target="_blank" title=" ' . esc_attr__( 'The Best WordPress Sport Plugin for your league and club', 'kodiak-football-sport' ) . ' " rel="author"> ' . esc_html__( 'JoomSport team', 'kodiak-football-sport' ) . ' </a>';
							}
							?>
						</div>
						<div class="row">
							<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'kodiak-football-sport' ) ); ?>">
								<?php printf( __( 'Powered by %s', 'kodiak-football-sport' ), 'WordPress' ); ?>
							</a>
						</div>
					</span>
				</div>
			</div>
		</div>
	</footer>
	<div id="to-top" style="display: block;">
		<a href="#" rel="nofollow" class="clicktop"><?php esc_html_e( 'TO TOP', 'kodiak-football-sport' ); ?></a>
	</div>
	</div><!-- #page -->
	<?php wp_footer(); ?>
	</body>
</html>
