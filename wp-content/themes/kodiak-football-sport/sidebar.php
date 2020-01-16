<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kodiak-football-sport
 */

?>
<?php
$kodiak_football_sport_sqrcontent = '';

if ( get_theme_mod( 'square_content' ) == 'item_2' ) {
	$kodiak_football_sport_sqrcontent = 'square';
}
?>
<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
	<div class="col-xs-12 col-md-3 rightCol <?php echo esc_attr( $kodiak_football_sport_sqrcontent ); ?>">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
	<?php
}
?>
