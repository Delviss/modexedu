<?php
/**
 * The style "alter" of the Testimonials
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4.3
 */

$args = get_query_var('trx_addons_args_sc_testimonials');

$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
			
if ($args['slider']) {
	?><div class="swiper-slide"><?php
} else if ((int)$args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}
?>
<div class="sc_testimonials_item">
	<div class="sc_testimonials_item_content"><?php
		if (has_excerpt())
			the_excerpt();
		else
			the_content();
	?></div>
	<div class="sc_testimonials_item_author">
		<div class="sc_testimonials_item_author_data">
			<h4 class="sc_testimonials_item_author_title"><?php the_title(); ?></h4>
			<div class="sc_testimonials_item_author_subtitle"><?php echo trim($meta['subtitle']);?></div>
		</div>
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="sc_testimonials_item_author_avatar"><?php the_post_thumbnail( apply_filters('trx_addons_filter_thumb_size', trx_addons_get_thumb_size('tiny'), 'testimonials-alter'), array('alt' => the_title_attribute( array( 'echo' => false ) )) ); ?></div>
		<?php } ?>
	</div>
</div>
<?php
if ($args['slider'] || (int)$args['columns'] > 1) {
	?></div><?php
}
?>