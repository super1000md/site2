<?php


require_once get_template_directory() . '/inc/lib/tgmpa/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'udyama_register_required_plugins' );

function udyama_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'One Click Demo Import',
			'slug'      => 'one-click-demo-import',
		),
		array(
			'name'      => 'Elementor',
			'slug'      => 'elementor',
		),
	);

	$config = array(
		'id'           => 'udyama',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
