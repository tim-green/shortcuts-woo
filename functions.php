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

	// WooCommerce support
	add_theme_support('woocommerce');
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'shortcuts_setup');

// Remove WooCommerce default styles
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// Remove default WooCommerce wrapper actions
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Register widget areas
function shortcuts_widgets_init()
{
	register_sidebar([
		'name'          => __('Footer Column 1', 'shortcuts'),
		'id'            => 'footer-1',
		'before_widget' => '<div id="%1$s" class="footer-col %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	]);
	register_sidebar([
		'name'          => __('Footer Column 2', 'shortcuts'),
		'id'            => 'footer-2',
		'before_widget' => '<div id="%1$s" class="footer-col %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	]);
	register_sidebar([
		'name'          => __('Footer Column 3', 'shortcuts'),
		'id'            => 'footer-3',
		'before_widget' => '<div id="%1$s" class="footer-col %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	]);
	register_sidebar([
		'name'          => __('Footer Column 4', 'shortcuts'),
		'id'            => 'footer-4',
		'before_widget' => '<div id="%1$s" class="footer-col %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	]);

	// Shop sidebar
	register_sidebar([
		'name'          => __('Shop Sidebar', 'shortcuts'),
		'id'            => 'shop-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	]);

	// Blog sidebar
	register_sidebar([
		'name'          => __('Blog Sidebar', 'shortcuts'),
		'id'            => 'blog-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	]);
}
add_action('widgets_init', 'shortcuts_widgets_init');

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
