<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

function enqueue_scripts()
{
	wp_enqueue_script('go-bootstrap', get_template_directory_uri() . '/src/js/bootstrap.min.js', array('jquery'), '3', true);
	// wp_enqueue_script('go-parsley', get_template_directory_uri() . '/src/js/bootstrap.min.js', array('jquery'), '3', true);
	wp_enqueue_script('go-parsley', get_template_directory_uri() . '/src/js/parsley.min.js', array('jquery'), '3', true);
	wp_enqueue_script('go-main', get_template_directory_uri() . '/src/js/go-main.js', array('jquery'), '3', true);
}

add_action('wp_enqueue_scripts', 'enqueue_scripts');
