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

// Add type="module" to the script tag
function shortcuts_add_module_type( $tag, $handle, $src ) {
    if ( 'shortcuts-script' === $handle ) {
        $tag = '<script type="module" src="' . esc_url( $src ) . '" id="' . $handle . '-js"></script>';
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'shortcuts_add_module_type', 10, 3 );

function my_Modify_script_tags($tag, $handle, $src) {
    if ('my-module' === $handle) {
        return '<script type="module" src="' . esc_url($src) . '"></script>';
    }
    return $tag;
}
add_filter('script_loader_tag', 'my_modify_script_tags', 10, 3);

// WooCommerce: Cart fragment update (AJAX)
function shortcuts_cart_fragments($fragments)
{
	$fragments['.cart-count'] = '<span class="cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
	return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'shortcuts_cart_fragments');

// WooCommerce: Number of products per row in shop
function shortcuts_loop_columns()
{
	return 4;
}
add_filter('loop_shop_columns', 'shortcuts_loop_columns');

// WooCommerce: Number of products per page
function shortcuts_products_per_page()
{
	return 12;
}
add_filter('loop_shop_per_page', 'shortcuts_products_per_page');

// WooCommerce: Custom placeholder image
function shortcuts_placeholder_img_src($src)
{
	return get_template_directory_uri() . '/assets/images/placeholder.png';
}
add_filter('woocommerce_placeholder_img_src', 'shortcuts_placeholder_img_src');

// WooCommerce: Remove breadcrumbs
add_action('init', function () {
	remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
});

// WooCommerce: Remove default sidebar
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// WooCommerce: Remove default checkout button (using custom one in cart)
// add_action('init', function() {
// 	remove_action('woocommerce_proceed_to_checkout', 'woocommerce_output_wc_proceed_to_checkout', 10);
// });

// Move notices from top of page into .cart-frame
remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);

// Remove default add-to-cart button in loop (theme has custom one in overlay)
add_action('init', function () {
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
});

// WooCommerce: Add to cart button text
function shortcuts_add_to_cart_text()
{
	return _t('Add to cart', 'Thêm vào giỏ hàng');
}
add_filter('woocommerce_product_add_to_cart_text', 'shortcuts_add_to_cart_text');

// Buy Now redirect to checkout
add_filter('woocommerce_add_to_cart_redirect', function ($url) {
	if (isset($_REQUEST['buy_now']) && $_REQUEST['buy_now']) {
		return wc_get_checkout_url();
	}
	return $url;
});


// WooCommerce: Ensure cart page gets correct template
function shortcuts_woocommerce_template_overrides($template, $template_name, $template_path)
{
	global $woocommerce;
	$_template = $template;
	if (!$template_name) return $template;
	$template_path = 'woocommerce';
	$plugin_path = $woocommerce->plugin_path() . '/templates/';
	$template = locate_template([$template_path . '/' . $template_name, $template_name]);
	if (!$template && file_exists($plugin_path . $template_name)) {
		$template = $plugin_path . $template_name;
	}
	if (!$template) {
		$template = $_template;
	}
	return $template;
}
add_filter('woocommerce_locate_template', 'shortcuts_woocommerce_template_overrides', 10, 3);

// Stock availability text
add_filter('woocommerce_get_availability_text', function ($text, $product) {
	if ($product->is_in_stock() && $product->managing_stock()) {
		$qty = (int) $product->get_stock_quantity();
		if ($qty > 0) {
			return sprintf(__('%d available', 'woocommerce'), $qty);
		}
	}
	return $text;
}, 10, 2);

// Use password from form instead of auto-generating
add_filter('woocommerce_registration_generate_password', '__return_false', 999);

add_filter('woocommerce_registration_errors', function ($errors, $username, $email) {
	if (isset($_POST['password2']) && $_POST['password'] !== $_POST['password2']) {
		$errors->add('password_mismatch', __('Passwords do not match.', 'mytheme'));
	}
	return $errors;
}, 10, 3);

// Meta box: Hide Header / Hide Footer / Hide Banner
add_action('add_meta_boxes', function () {
  add_meta_box('page_options_meta', 'Page Options', function ($post) {
    wp_nonce_field('page_options_nonce', 'page_options_nonce_field');
    $hide_header = get_post_meta($post->ID, '_hide_header', true) ? 'checked' : '';
    $hide_footer = get_post_meta($post->ID, '_hide_footer', true) ? 'checked' : '';
    $hide_banner = get_post_meta($post->ID, '_hide_banner', true) ? 'checked' : '';
    echo '<label style="display:block;margin-bottom:8px"><input type="checkbox" name="_hide_header" ' . $hide_header . '> Hide Header</label>';
    echo '<label style="display:block;margin-bottom:8px"><input type="checkbox" name="_hide_banner" ' . $hide_banner . '> Hide Banner</label>';
    echo '<label style="display:block"><input type="checkbox" name="_hide_footer" ' . $hide_footer . '> Hide Footer</label>';
  }, 'page', 'normal', 'default');
});

add_action('save_post', function ($post_id) {
  if (!isset($_POST['page_options_nonce_field']) || !wp_verify_nonce($_POST['page_options_nonce_field'], 'page_options_nonce')) return;
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
  if (!current_user_can('edit_post', $post_id)) return;

  update_post_meta($post_id, '_hide_header', isset($_POST['_hide_header']) ? 1 : 0);
  update_post_meta($post_id, '_hide_banner', isset($_POST['_hide_banner']) ? 1 : 0);
  update_post_meta($post_id, '_hide_footer', isset($_POST['_hide_footer']) ? 1 : 0);
});

