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
