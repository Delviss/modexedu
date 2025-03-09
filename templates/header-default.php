<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

$studeon_header_css = $studeon_header_image = '';
$studeon_header_video = studeon_get_header_video();
if (true || empty($studeon_header_video)) {
	$studeon_header_image = get_header_image();
	if (studeon_is_on(studeon_get_theme_option('header_image_override')) && apply_filters('studeon_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($studeon_cat_img = studeon_get_category_image()) != '')
				$studeon_header_image = $studeon_cat_img;
		} else if (is_singular() || studeon_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$studeon_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($studeon_header_image)) $studeon_header_image = $studeon_header_image[0];
			} else
				$studeon_header_image = '';
		}
	}
}

?><header class="top_panel top_panel_default<?php
					echo !empty($studeon_header_image) || !empty($studeon_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($studeon_header_video!='') echo ' with_bg_video';
					if ($studeon_header_image!='') echo ' '.esc_attr(studeon_add_inline_css_class('background-image: url('.esc_url($studeon_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (studeon_is_on(studeon_get_theme_option('header_fullheight'))) echo ' header_fullheight trx-stretch-height';
					?> scheme_<?php echo esc_attr(studeon_is_inherit(studeon_get_theme_option('header_scheme')) 
													? studeon_get_theme_option('color_scheme') 
													: studeon_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($studeon_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (studeon_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );


?></header>