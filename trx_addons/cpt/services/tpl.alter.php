<?php
/**
 * The style "alter" of the Services
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4
 */

$args = get_query_var('trx_addons_args_sc_services');
$query_args = array(
	'post_type' => TRX_ADDONS_CPT_SERVICES_PT,
	'post_status' => 'publish',
	'ignore_sticky_posts' => true
);
if (empty($args['ids'])) {
	$query_args['posts_per_page'] = $args['count'];
	$query_args['offset'] = $args['offset'];
}
$query_args = trx_addons_query_add_sort_order($query_args, $args['orderby'], $args['order']);
$query_args = trx_addons_query_add_posts_and_cats($query_args, $args['ids'], TRX_ADDONS_CPT_SERVICES_PT, $args['cat'], TRX_ADDONS_CPT_SERVICES_TAXONOMY);
$query = new WP_Query( $query_args );
if ((int)$query->found_posts > 0) {
	if ($args['count'] > $query->found_posts) $args['count'] = $query->found_posts;
	if ((int)$args['columns'] < 1) $args['columns'] = $args['count'];
	$args['columns'] = max(1, min(12, (int) $args['columns']));
	$args['slider'] = (int)$args['slider'] > 0 && $args['count'] > $args['columns'];
	$args['slides_space'] = max(0, (int) $args['slides_space']);
	?><div class="sc_services sc_services_default sc_services_<?php 
			echo esc_attr($args['type']);
			if (!empty($args['class'])) echo ' '.esc_attr($args['class']); 
			?>"<?php
		if (!empty($args['css'])) echo ' style="'.esc_attr($args['css']).'"';
		?>><?php

		trx_addons_sc_show_titles('sc_services', $args);
		
		if ($args['slider']) {
			$args['slides_min_width'] = $args['type']=='iconed' ? 250 : 200;
			trx_addons_sc_show_slider_wrap_start('sc_services', $args);
		} else if ((int)$args['columns'] > 1) {
			?><div class="sc_services_columns sc_item_columns sc_item_columns_<?php
							echo esc_attr($args['columns']);
							echo ' '.esc_attr(trx_addons_get_columns_wrap_class()) . ($args['type']!='list' ? ' columns_padding_bottom' : '');
							if ((int)$args['no_margin']==1) echo ' no_margin';
						?>"><?php
		} else {
			?><div class="sc_services_content sc_item_content sc_item_columns_1"><?php
		}	

		set_query_var('trx_addons_args_sc_services', $args);
		$trx_addons_number = $args['offset'];
		while ( $query->have_posts() ) { $query->the_post();
			$trx_addons_number++;
			set_query_var('trx_addons_args_item_number', $trx_addons_number);
			if (($fdir = trx_addons_get_file_dir('cpt/services/tpl.'.trx_addons_esc($args['type']).'-item.php')) != '') { include $fdir; }
			else if (($fdir = trx_addons_get_file_dir('cpt/services/tpl.alter-item.php')) != '') { include $fdir; }
		}

		wp_reset_postdata();
	
		?></div><?php

		if ($args['slider']) {
			trx_addons_sc_show_slider_wrap_end('sc_services', $args);
		}
		
		trx_addons_sc_show_links('sc_services', $args);

	?></div><!-- /.sc_services --><?php
}
?>