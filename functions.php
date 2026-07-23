<?php

/**
 * Shortcuts functions and definitions
 */
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
