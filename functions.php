<?php

/**
 * Shortcuts functions and definitions
 */
// Theme setup
function shortcuts_setup()
{
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
	add_theme_support('custom-logo', [
		'height'      => 40,
		'width'       => 120,
		'flex-height' => true,
		'flex-width'  => true,
	]);

	register_nav_menus([
		'primary'      => __('Primary Menu', 'shortcuts'),
		'footer-bottom' => __('Footer Bottom Links', 'shortcuts'),
	]);

// Enqueue scripts and styles
function shortcuts_enqueue_assets() {
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    $css_path = $theme_dir . '/build/css/app.css';
    $js_path  = $theme_dir . '/build/js/app.js';

    if ( file_exists( $css_path ) ) {
        wp_enqueue_style(
            'shortcuts-style',
            $theme_uri . '/build/css/app.css',
            array(),
            filemtime( $css_path )
        );
    }

    if ( file_exists( $js_path ) ) {
        wp_enqueue_script(
            'shortcuts-script',
            $theme_uri . '/build/js/app.js',
            array(),
            filemtime( $js_path ),
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'shortcuts_enqueue_assets' );
