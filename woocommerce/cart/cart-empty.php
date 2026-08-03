<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_cart');
?>

<div class="cart-empty-message">
	<div class="cart-empty-icon remix-icon">
		<i class="ri-shopping-bag-3-line"></i>
	</div>

	<h2><?php esc_html_e('Your cart is empty', 'woocommerce'); ?></h2>
	<p><?php esc_html_e('Looks like you haven\'t added any products yet. Start exploring all of our product collections!', 'woocommerce'); ?></p>

	<?php if (wc_get_page_id('shop') > 0) : ?>
		<a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn-primary">
			<i class="ri-arrow-left-s-line"></i>
			<?php esc_html_e('Browse Products', 'woocommerce'); ?>
		</a>
	<?php endif; ?>

	<?php do_action('woocommerce_after_cart'); ?>
</div>
