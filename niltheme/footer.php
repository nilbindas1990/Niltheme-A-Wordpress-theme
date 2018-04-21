			<footer class="site-footer">

				<?php if(get_theme_mod('ntheme_footer_callout_display') == "Yes") { ?>
					<div class="footer-callout clearfix">
						<div class="footer-callout-img">
							<img src="<?php echo wp_get_attachment_url(get_theme_mod('ntheme_footer_callout_img')) ?>">
						</div>

						<div class="footer-callout-text">
							<h2>
								<a href="<?php echo get_permalink(get_theme_mod( 'ntheme_footer_callout_link' )) ?>">
									<?php echo get_theme_mod( 'ntheme_footer_callout_headline' ) ?>	
								</a>
							</h2>
							<?php echo wpautop(get_theme_mod( 'ntheme_footer_callout_text' )) ?>
						</div>
					</div>
				<?php } ?>

				<div class="footer-widget clearfix">

					<?php for ($i=1; $i <= 4 ; $i++) {
					if (is_active_sidebar( 'footer'.$i )) : ?>
						<div class="footer-widget-box"><?php dynamic_sidebar( 'footer'.$i ); ?></div>
					<?php endif; } ?>
				
				</div>
				<nav class="site-nav">
					
					<?php
						$args = array(
						'theme_location' => 'footer'
						);
					?>
					<?php wp_nav_menu();  ?>
				
				</nav>
				<p><?php bloginfo('name');?> - &copy;<?php echo date('Y');?></p>
			
			</footer>
			
			<?php wp_footer();?>

		</div><!-- Container class-->
	</body>
</html>