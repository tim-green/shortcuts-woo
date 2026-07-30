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
