<?php
/**
 * The template to display the Author bio
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */
?>

<div class="author_info scheme_default author vcard" itemprop="author" itemscope itemtype="//schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<?php 
		$studeon_mult = studeon_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 200*$studeon_mult );
		?>
	</div><!-- .author_avatar -->

	<div class="author_description">
		<h4 class="author_title" itemprop="name"><?php echo wp_kses_data(sprintf(__('About %s', 'studeon'), '<span class="fn">'.get_the_author().'</span>')); ?></h4>

		<div class="author_bio" itemprop="description">
			<?php echo wpautop(get_the_author_meta( 'description' )); ?>
			<div class="sc_item_button sc_button_wrap">
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="sc_button sc_button_default sc_button_accent  sc_button_size_normal sc_button_icon_left" rel="author"><span class="sc_button_text"><span class="sc_button_title"><?php echo esc_html__('Read More', 'studeon'); ?></span></span></a>
			</div>
		</div><!-- .author_bio -->

	</div><!-- .author_description -->

</div><!-- .author_info -->
