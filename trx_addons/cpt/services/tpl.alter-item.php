<?php
/**
 * The style "alter" of the Services
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4
 */

$args = get_query_var('trx_addons_args_sc_services');

$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
$link = get_permalink();
$featured_position = !empty($args['featured_position']) ? $args['featured_position'] : 'top';
$svg_present = false;

if ($args['slider']) {
	?><div class="swiper-slide"><?php
} else if ((int)$args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}
?>
<div class="sc_services_item<?php
	echo isset($args['hide_excerpt']) && $args['hide_excerpt'] ? ' without_content' : ' with_content';
	echo empty($args['featured']) || $args['featured']=='image' 
					? ' with_image' 
					: ($args['featured']=='icon' ? ' with_icon' : ' with_number');
	echo ' sc_services_item_featured_'.esc_attr($featured_position);
?>">
	<?php
	// Featured image or icon
	if ( has_post_thumbnail() && (empty($args['featured']) || $args['featured']=='image')) {
		set_query_var('trx_addons_args_featured', apply_filters('trx_addons_filter_args_featured', array(
			'class' => 'sc_services_item_thumb',
			'hover' => 'zoomin',
			'thumb_size' => apply_filters('trx_addons_filter_thumb_size', trx_addons_get_thumb_size((int)$args['columns'] > 2 ? 'medium' : 'big'), 'services-default')
		), 'services-default'));
		if (($fdir = trx_addons_get_file_dir('templates/tpl.featured.php')) != '') { include $fdir; }
	} else if ($args['featured']=='icon' && !empty($meta['icon'])) {
		$svg = '';
		if (!empty($args['icons_animation']) && (int)$args['icons_animation'] > 0 && ($svg = trx_addons_get_file_dir('css/svg-icons/'.trx_addons_esc($meta['icon']).'.svg')) != '') {
			$svg_present = true;
		}
		?><a href="<?php echo esc_url($link); ?>"
			 id="<?php echo esc_attr($args['id'].'_'.trim($meta['icon'])); ?>"
			 class="sc_services_item_icon <?php echo empty($svg) ? esc_attr($meta['icon']) : 'sc_icon_type_svg'; ?>"
			 ><?php
			if (!empty($svg)) {
				echo trim(trx_addons_get_svg_from_file($svg));
			}
		?></a><?php
	} else {
		?><span class="sc_services_item_number"><?php
			$number = get_query_var('trx_addons_args_item_number');
			printf("%02d", $number);
		?></span><?php
	}
	?>	
	<div class="sc_services_item_info">
		<div class="sc_services_item_header">
			<h4 class="sc_services_item_title"><a href="<?php echo esc_url($link); ?>"><?php the_title(); ?></a></h4>
		</div>
		<?php if (!isset($args['hide_excerpt']) || (int)$args['hide_excerpt']==0) { ?>
			<div class="sc_services_item_content"><?php the_excerpt(); ?></div>
			<div class="sc_services_item_button"><a href="<?php echo esc_url($link); ?>"><i class="icon icon-more-button-of-three-dots"></i></a></div>
		<?php } ?>
	</div>
</div>
<?php
if ($args['slider'] || (int)$args['columns'] > 1) {
	?></div><?php
}
if (trx_addons_is_on(trx_addons_get_option('debug_mode')) && $svg_present) {
	wp_enqueue_script( 'vivus', trx_addons_get_file_url('shortcodes/icons/vivus.js'), array('jquery'), null, true );
	wp_enqueue_script( 'trx-addons-sc-icons', trx_addons_get_file_url('shortcodes/icons/icons.js'), array('jquery'), null, true );
}
?>