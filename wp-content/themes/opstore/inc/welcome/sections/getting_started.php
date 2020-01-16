<div class="operation-theme-steps-list">
<div class="left-box-wrapper-outer">
<div class="op-box-wrapper operation-welcome-box-white">
	<div class="op-box-header"><?php esc_html_e('Links to Customizer Settings','opstore'); ?></div>
	<div class="op-box-content">
		<ul class="op-list clearfix">
			<?php
			 $url = admin_url( 'customize.php' );

	        $links = array(
	            array(
	                'label' => __( 'Logo & Site Identity', 'opstore' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'title_tagline' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-format-image',
	            ),
	            array(
	                'label' => __( 'Header Settings', 'opstore' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'panel' => 'opstore_header_settings_panel' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-align-center',
	            ),
	            array(
	                'label' => __( 'Breadcrumb Settings', 'opstore' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'opstore_page_banner' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-layout',
	            ),
	            array(
	                'label' => __( 'Template Colors', 'opstore' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'colors' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-admin-customizer',
	            ),
	            array(
	                'label' => __( 'General Settings', 'opstore' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'general_settings' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-admin-generic',
	            ),
	            array(
	                'label' => __( 'Sidebar Settings', 'opstore' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'opstore_sidebar_section' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-welcome-write-blog',
	            ),
	            array(
	                'label' => __( 'Social Icons', 'opstore' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'opstore_social_section' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-share',
	            ),
	            array(
	                'label' => __( 'Footer Settings', 'opstore' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'opstore_footer_section' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-admin-generic',
	            ),
	           
	        );

	        $links = apply_filters( 'arrival/dashboard/links', $links );
	        ?> 

			<?php foreach( $links as $l ) { ?>
                <li>
                	<span class="<?php echo esc_attr($l['icon'])?>"></span>
                    <a class="op-quick-setting-link" href="<?php echo esc_url( $l['url'] ); ?>" target="_blank"><?php echo esc_html( $l['label'] ); ?></a>
                </li>
            <?php } ?>
		</ul>
	</div>
</div>

<div class="op-box-wrapper operation-welcome-box-white">
	<div class="op-box-header"><?php esc_html_e('Welcome','opstore'); ?></div>
	<div class="box-content">
		<p><?php esc_html_e('Welcome and thank you for choosing Opstore. Please install and activate all recommended plugins.','opstore'); ?></p>
	</div>
</div>	
</div>


<?php $this->admin_sidebar_contents(); ?>

</div>