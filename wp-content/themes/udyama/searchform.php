<form role="search" method="get" class="searchform udyama-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
		<input type="text" class="s form-control" name="s" placeholder="<?php esc_attr_e( 'Search&hellip;', 'udyama' ); ?>" value="<?php the_search_query(); ?>">
		<div class="input-group-append">
			<button class="btn btn-light-bg" type="submit"><span class="dashicons dashicons-search"></span></button>
		</div>
	</div>
</form>
