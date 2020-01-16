<?php
/**
 * The template for displaying searchform
 *
 * @package Kodiak-football-sport
 */

?>
<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
	<div class="search input-group form-group">
		<input class="inputbox form-control" type="text" placeholder="<?php esc_attr_e( 'Search ...', 'kodiak-football-sport' ); ?>" value="<?php echo get_search_query(); ?>" name="s" id="s" />
		<span class="input-group-btn">
			<button name="Search" type="submit" class="btn btn-default" title="<?php esc_attr_e( 'Search', 'kodiak-football-sport' ); ?>">
				<span class="fa fa-search"></span>
			</button>
		</span>
	</div>
</form>
