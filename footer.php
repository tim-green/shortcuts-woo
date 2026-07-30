<!-- Footer -->
<?php if (!is_singular() || !get_post_meta(get_the_ID(), '_hide_footer', true)) : ?>
<footer data-section="Footer">
	<div class="footer-inner">
		<div class="container">
			<div class="footer-grid">
				<div class="footer-brand">
					<a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
						<?php
						$custom_logo_id = get_theme_mod('custom_logo');
						if ($custom_logo_id) :
							echo wp_get_attachment_image($custom_logo_id, 'thumbnail', false, ['class' => 'logo-image']);
						else :
						?>
							<span class="logo-icon">SC</span>
						<?php endif; ?>
						<?php bloginfo('name'); ?>
					</a>
					<p><?php esc_html_e( 'Your destination for brands. Discover items that inspire, inform, and transform.', 'shortcuts' ); ?></p>
					
				</div>

				<?php
				$footer_sidebars = ['footer-1', 'footer-2', 'footer-3', 'footer-4'];
				foreach ($footer_sidebars as $sidebar) {
					if (is_active_sidebar($sidebar)) {
						dynamic_sidebar($sidebar);
					}
				}
				?>
			</div>

			<div class="footer-bottom">
				<span>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'shortcuts'); ?></span>
				<?php if (has_nav_menu('footer-bottom')) :
					wp_nav_menu([
						'theme_location'  => 'footer-bottom',
						'container'       => false,
						'menu_class'      => 'footer-bottom-links',
						'depth'           => 1,
						'fallback_cb'     => false,
					]);
				else : ?>
				<div class="footer-bottom-links">
					<?php
						wp_nav_menu([
						'theme_location' => 'footer',
						'container'      => false,
						'fallback_cb'    => false,
						]);
					?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</footer>
	<button id="back-to-top" aria-label="<?php esc_html_e('Back to top', 'shortcuts'); ?>">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M11.9999 10.8284L7.0502 15.7782L5.63599 14.364L11.9999 8L18.3639 14.364L16.9497 15.7782L11.9999 10.8284Z"></path></svg>
	</button>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>