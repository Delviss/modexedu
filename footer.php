<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

						// Widgets area inside page content
						studeon_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					studeon_create_widgets_area('widgets_below_page');

					$studeon_body_style = studeon_get_theme_option('body_style');
					if ($studeon_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$studeon_footer_style = studeon_get_theme_option("footer_style");
			if (strpos($studeon_footer_style, 'footer-custom-')===0) $studeon_footer_style = 'footer-custom';
			get_template_part( "templates/{$studeon_footer_style}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (studeon_is_on(studeon_get_theme_option('debug_mode')) && studeon_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(studeon_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>