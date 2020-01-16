<?php
	/**
	 * Welcome Page Initiation
	*/

	include get_template_directory() . '/inc/welcome/welcome.php';

	/** Plugins **/
	$plugins = array(
		// *** Companion Plugins
		'companion_plugins' => array(),

		// *** Required Plugins
		'required_plugins' => array(
			'operation-demo-importer' => array(
				'slug' => 'operation-demo-importer',
				'name' => esc_html__('Operation Demo Importer', 'opstore'),
				'filename' =>'operation-demo-importer.php',
				'host_type' => 'wordpress', // Use either bundled, remote, wordpress
				'class' => 'WOPDI',
				'info' => esc_html__('Adds ability to theme with one click demo import feature, which will help to publish your websies within few minutes.', 'opstore'),
			),
		
		),

		// *** Recommended Plugins
		'recommended_plugins' => array(
			// Free Plugins
			'free_plugins' => array(

				'ultra-companion' => array(
					'slug' 		=> 'ultra-companion',
					'filename' 	=> 'ultra-companion.php',
					'class' 	=> 'Ultra_Companion'
				),

				'elementor' => array(
					'slug' 		=> 'elementor',
					'filename' 	=> 'elementor.php',
					'class' 	=> 'Elementor\Plugin'
				),

				'wpop-elementor-addons' => array(
					'slug' 		=> 'wpop-elementor-addons',
					'filename' 	=> 'wpop-elementor-addons.php',
					'class' 	=> 'Wpop_El_Addons'
				),
				'salert' => array(
					'slug' 		=> 'salert',
					'filename' 	=> 'salert.php',
					'class' 	=> 'Salert'
				),
				'woocommerce' => array(
					'slug' 		=> 'woocommerce',
					'filename' 	=> 'woocommerce.php',
					'class' 	=> 'WooCommerce'
				),
				
				
			),

			// Pro Plugins
			'pro_plugins' => array(
			)
		),
	);

	$strings = array(
		// Welcome Page General Texts
		'welcome_menu_text' 		=> esc_html__( 'Opstore Setup', 'opstore' ),
		'theme_short_description' 	=> esc_html__( 'Fast &nbsp; | &nbsp; Light  &nbsp; | &nbsp; Powerful', 'opstore' ),

		// Plugin Action Texts
		'install_n_activate' 	=> esc_html__('Install and Activate', 'opstore'),
		'deactivate' 			=> esc_html__('Deactivate', 'opstore'),
		'activate' 				=> esc_html__('Activate', 'opstore'),

		// Recommended Plugins Section
		'pro_plugin_title' 			=> esc_html__( 'Pro Plugins', 'opstore' ),
		'pro_plugin_description' 	=> esc_html__( 'Take Advantage of some of our Premium Plugins.', 'opstore' ),
		'free_plugin_title' 		=> esc_html__( 'Free Plugins', 'opstore' ),
		'free_plugin_description' 	=> esc_html__( 'These Free Plugins might be handy for you.', 'opstore' ),

		// Demo Actions
		'activate_btn' 		=> esc_html__('Activate', 'opstore'),
		'installed_btn' 	=> esc_html__('Activated', 'opstore'),
		'demo_installing' 	=> esc_html__('Installing Demo', 'opstore'),
		'demo_installed' 	=> esc_html__('Demo Installed', 'opstore'),
		'demo_confirm' 		=> esc_html__('Are you sure to import demo content ?', 'opstore'),
		'pro_link'			=> 'https://wpoperation.com/themes/opstore-pro/',
		'doc_link'			=> 'https://wpoperation.com/wp-documentation/opstore/',

		//free vs pro
		'free_vs_pro' => array(

            'features' => array(
                'Preloader Options' => array('Simple','18+ Customizable'),
                'Live AJAX search' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                'Infinite Product Load with AJAX'=> array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                'Theme Option Panel'=> array('Customizer Based','Powerful Theme Panel'),
                'Custom Elementor Addons'=> array('5+','20+'),
                'Typography Style & Colors' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                'Unlimited Header and Footer Builder' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                'Lazy Load Images' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                'Newsletter Popup' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                'Maintenance Mode' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                'Unlimited Product Tabs' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                'WooCommerce Compatibility' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                'Social Sharings' => array('yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                'Hide Theme Credit Link' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                'Responsive Layout' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                'Translations Ready' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                'SEO' => array('Optimized', 'Optimized'),
                'Support' => array('Yes', 'High Priority Dedicated Support')
            ),
        ),


	);

	/**
	 * Initiating Welcome Page
	*/
	$my_theme_wc_page = new Opstore_Welcome( $plugins, $strings );
