<?php get_header(); ?>

<section class="page-section" data-section="404">
	<?php shortcuts_page_banner(); ?>
	<div class="container">
    <div class="content-card content-card--narrow">
      <p class="error-404-message"><?php esc_html_e('It might have been moved or deleted. Try searching or head back to the homepage.', 'shortcuts'); ?></p>
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary"><?php esc_html_e('Back to Home', 'shortcuts'); ?></a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
