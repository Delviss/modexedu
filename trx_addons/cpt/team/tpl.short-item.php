<?php
/**
 * The style "short" of the Team
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4.3
 */

$args = get_query_var('trx_addons_args_sc_team');

$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
$link = get_permalink();

if ($args['slider']) {
	?><div class="swiper-slide"><?php
} else if ((int)$args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}
?>
<div class="sc_team_item">
	<?php
	// Featured image
	set_query_var('trx_addons_args_featured', apply_filters('trx_addons_filter_args_featured', array(
		'allow_theme_replace' => false,
		'singular' => false,
		'class' => 'sc_team_item_thumb',
		'hover' => !empty($meta['socials']) ? 'info' : 'zoomin',
		'thumb_size' => apply_filters('trx_addons_filter_thumb_size', trx_addons_get_thumb_size('avatar'), 'team-short'),
		'post_info' => !empty($meta['socials']) 
							? '<div class="trx_addons_hover_content"><div class="sc_team_item_socials trx_addons_hover_info">'.trim(trx_addons_get_socials_links_custom($meta['socials'])).'</div></div>'
							: ''
	), 'team-short'));
	if (($fdir = trx_addons_get_file_dir('templates/tpl.featured.php')) != '') { include $fdir; }
	?>
	<div class="sc_team_item_info">
		<div class="sc_team_item_header">
			<h5 class="sc_team_item_title"><a href="<?php echo esc_url($link); ?>"><?php the_title(); ?></a></h5>
			<div class="sc_team_item_subtitle"><?php echo trim($meta['subtitle']);?></div>
		</div>
	</div>
</div>
<?php
if ($args['slider'] || (int)$args['columns'] > 1) {
	?></div><?php
}
?>