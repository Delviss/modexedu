<?php
/**
 * The style "alter" of the Testimonials
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

$args = get_query_var('trx_addons_args_sc_testimonials');

$query_args = array(
	'post_type' => TRX_ADDONS_CPT_TESTIMONIALS_PT,
	'post_status' => 'publish',
	'ignore_sticky_posts' => true,
);
if (empty($args['ids'])) {
	$query_args['posts_per_page'] = $args['count'];
	$query_args['offset'] = $args['offset'];
}
$query_args = trx_addons_query_add_sort_order($query_args, $args['orderby'], $args['order']);
$query_args = trx_addons_query_add_posts_and_cats($query_args, $args['ids'], TRX_ADDONS_CPT_TESTIMONIALS_PT, $args['cat'], TRX_ADDONS_CPT_TESTIMONIALS_TAXONOMY);
$query = new WP_Query( $query_args );
if ((int)$query->found_posts > 0) {
	if ($args['count'] > $query->found_posts) $args['count'] = $query->found_posts;
	$args['columns'] = (int)$args['columns'] < 1 ? $args['count'] : min($args['columns'], $args['count']);
	$args['columns'] = max(1, min(12, (int) $args['columns']));
	$args['slider'] = $args['slider'] > 0 && $args['count'] > $args['columns'];
	$args['slides_space'] = max(0, (int) $args['slides_space']);
	?><div class="sc_testimonials sc_testimonials_default sc_testimonials_<?php
			echo esc_attr($args['type']);
			if (!empty($args['class'])) echo ' '.esc_attr($args['class']); 
			?>"<?php
		if (!empty($args['css'])) echo ' style="'.esc_attr($args['css']).'"';
		?>><?php

		trx_addons_sc_show_titles('sc_testimonials', $args);
		
		if ($args['slider']) {
			trx_addons_sc_show_slider_wrap_start('sc_testimonials', $args);
		} else if ((int)$args['columns'] > 1) {
			?><div class="sc_testimonials_columns sc_item_columns <?php echo esc_attr(trx_addons_get_columns_wrap_class()); ?> columns_padding_bottom"><?php
		} else {
			?><div class="sc_testimonials_content sc_item_content"><?php
		}	

		set_query_var('trx_addons_args_sc_testimonials', $args);
			
		while ( $query->have_posts() ) { $query->the_post();
			if (($fdir = trx_addons_get_file_dir('cpt/testimonials/tpl.' . trx_addons_esc($args['type']) . '-item.php')) != '') { include $fdir; }
			else if (($fdir = trx_addons_get_file_dir('cpt/testimonials/tpl.alter-item.php')) != '') { include $fdir; }
		}

		wp_reset_postdata();
	
		?></div><?php

		if ($args['slider']) {
			trx_addons_sc_show_slider_wrap_end('sc_testimonials', $args);
		}

		trx_addons_sc_show_links('sc_testimonials', $args);

	?></div><!-- /.sc_testimonials --><?php
}
?>