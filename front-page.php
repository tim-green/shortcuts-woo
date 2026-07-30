<?php get_header(); ?>

<!-- Hero/Slider ACF / Split Layout -->
<section class="hero-section" data-section="Hero/Slider">
	<?php include_once('acf/acf-slider.php'); ?>
</section>

<!-- Featured Categories-->
<section class="categories" data-section="Featured Categories">
	<div class="container">

	<?php
    $product_cats = get_terms([
        'taxonomy'   => 'product_cat',
        'number'     => 12,
    ]);
    if (!empty($product_cats) && !is_wp_error($product_cats)) :
        shuffle($product_cats);
    ?>
    <div class="categories-outline-row">
        <?php foreach ($product_cats as $cat) : ?>
            <a href="<?php echo esc_url(get_term_link($cat)); ?>" class="category-pill">
                <span class="cat-name"><?php echo esc_html($cat->name); ?></span>
            </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
	</div>
</section>

<!-- Featured Products -->
<section class="featured-products" id="featured-products" data-section="Featured Products">
	<div class="container">
		<div class="section-header">
			<div>
				<h2><?php esc_html_e('Featured Products', 'shortcuts'); ?></h2>
				<p><?php esc_html_e('The best of the best for this month', 'shortcuts'); ?></p>
			</div>
			<a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="view-all"><?php esc_html_e('View All', 'shortcuts'); ?>
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
			</a>
		</div>
		<div class="products-grid">
			<?php
			$featured_products = wc_get_products([
				'limit'  => 8,
				'status' => ['publish'],
				'orderby' => 'popularity',
				'order'   => 'DESC',
			]);
			$prod_delays = ['delay-1', 'delay-2', 'delay-3', 'delay-4'];
			$pi = 0;
			foreach ($featured_products as $product) :
				$product_id = $product->get_id();
				$prod_reveal = $prod_delays[$pi % count($prod_delays)];
				$pi++;
			?>
				<div class="product-card reveal <?php echo esc_attr($prod_reveal); ?>">
					<div class="product-card-image">
						<a href="<?php echo esc_url(get_permalink($product_id)); ?>">
							<?php if (has_post_thumbnail($product_id)) : ?>
								<?php echo get_the_post_thumbnail($product_id, 'medium'); ?>
							<?php else : ?>
								<img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" alt="<?php echo esc_attr($product->get_name()); ?>" />
							<?php endif; ?>
						</a>
						<?php if ($product->is_on_sale()) : ?>
								<span class="sale-badge-accent"><?php esc_html_e('Sale', 'shortcuts'); ?></span>
						<?php endif; ?>
					</div>
					<div class="product-card-body">
						<h3><a href="<?php echo esc_url(get_permalink($product_id)); ?>"><?php echo esc_html($product->get_name()); ?></a></h3>
						<span class="price"><?php echo $product->get_price_html(); ?></span>
						<a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="add-to-cart-btn add_to_cart_button ajax_add_to_cart" data-quantity="1" data-product_id="<?php echo esc_attr($product_id); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>" aria-label="<?php echo esc_attr($product->add_to_cart_description()); ?>">
							<?php esc_html_e('Add to cart', 'woocommerce'); ?>
						</a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Testimonials -->
<?php
$testimonial_query = new WP_Query([
	'posts_per_page' => 3,
	'category_name'  => 'testimonial',
	'ignore_sticky_posts' => true,
]);
if ($testimonial_query->have_posts()) :
?>
