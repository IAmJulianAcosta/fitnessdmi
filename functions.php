<?php

	define ('CSS_DIRECTORY_URL', get_template_directory_uri() . '/css/');
	define ('JAVASCRIPT_DIRECTORY_URL', get_template_directory_uri() . '/scripts/');

	function fitnessdmi_register_and_enqueue_styles() {
		wp_register_style ('home', CSS_DIRECTORY_URL . 'home.css');
		wp_enqueue_style ('home');
	}

	add_action('wp_enqueue_scripts', 'fitnessdmi_register_and_enqueue_styles');

	function fitnessdmi_register_and_enqueue_scripts() {
		wp_register_script ('home', JAVASCRIPT_DIRECTORY_URL . 'home.js', array ("jquery"));
		wp_enqueue_script ('home');
	}

	add_action('wp_enqueue_scripts', 'fitnessdmi_register_and_enqueue_scripts');


	require_once dirname( __FILE__ ) . '/tgmpa/class-tgm-plugin-activation.php';
	add_action( 'tgmpa_register', 'fitnessdmi_register_required_plugins' );
	function fitnessdmi_register_required_plugins() {
		$plugins = array (
			// This is an example of how to include a plugin bundled with a theme.
			array (
				'name'             => 'Types',
				'slug'             => 'types',
				'required'         => true,
				'force_activation' => true
			)
			array (
				'name'             => 'Advanced Custom Fields',
				'slug'             => 'advanced-custom-fields',
				'required'         => true,
				'force_activation' => true,
				'is_callable'      => 'acf'
			),
			array (
				'name'             => 'Category Order and Taxonomy Terms Order',
				'slug'             => 'taxonomy-terms-order',
				'required'         => true,
				'force_activation' => true,
			)
		);
		$config  = array (
			'id'           => 'tgmpa',
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true,
			'dismissable'  => false,
			'is_automatic' => true,
			'strings'      => array (
				'page_title'                      => __( 'Install Required Plugins', 'fitnessdmi' ),
				'menu_title'                      => __( 'Install Plugins', 'fitnessdmi' ),
				'installing'                      => __( 'Installing Plugin: %s', 'fitnessdmi' ),
				'oops'                            => __( 'Something went wrong with the plugin API.', 'fitnessdmi' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'fitnessdmi' ),
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'fitnessdmi' ),
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %1$s plugin.', 'Sorry, but you do not have the correct permissions to install the %1$s plugins.', 'fitnessdmi' ),
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'fitnessdmi' ),
				'notice_ask_to_update_maybe'      => _n_noop( 'There is an update available for: %1$s.', 'There are updates available for the following plugins: %1$s.', 'fitnessdmi' ),
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %1$s plugin.', 'Sorry, but you do not have the correct permissions to update the %1$s plugins.', 'fitnessdmi' ),
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'fitnessdmi' ),
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'fitnessdmi' ),
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %1$s plugin.', 'Sorry, but you do not have the correct permissions to activate the %1$s plugins.', 'fitnessdmi' ),
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'fitnessdmi' ),
				'update_link'                     => _n_noop( 'Begin updating plugin', 'Begin updating plugins', 'fitnessdmi' ),
				'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'fitnessdmi' ),
				'return'                          => __( 'Return to Required Plugins Installer', 'fitnessdmi' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'fitnessdmi' ),
				'activated_successfully'          => __( 'The following plugin was activated successfully:', 'fitnessdmi' ),
				'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'fitnessdmi' ),
				'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'fitnessdmi' ),
				'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'fitnessdmi' ),
				'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'tgmpa' ),
				'nag_type'                        => 'updated',
			),

		);

		tgmpa( $plugins, $config );
	}
