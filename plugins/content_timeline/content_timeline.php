<?php
/* Content Timeline support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('studeon_content_timeline_theme_setup9')) {
	add_action( 'after_setup_theme', 'studeon_content_timeline_theme_setup9', 9 );
	function studeon_content_timeline_theme_setup9() {
		
		if (studeon_exists_content_timeline()) {
			add_action( 'wp_enqueue_scripts',								'studeon_content_timeline_frontend_scripts', 1100 );
			add_filter( 'studeon_filter_merge_styles',						'studeon_content_timeline_merge_styles' );
			add_filter( 'studeon_filter_get_css',							'studeon_content_timeline_get_css', 10, 4 );
		}
		if (is_admin()) {
			add_filter( 'studeon_filter_tgmpa_required_plugins',			'studeon_content_timeline_tgmpa_required_plugins' );
		}

	}
}

// Check if plugin is installed and activated
if ( !function_exists( 'studeon_exists_content_timeline' ) ) {
	function studeon_exists_content_timeline() {
		return class_exists( 'ContentTimelineAdmin' );
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'studeon_content_timeline_frontend_scripts' ) ) {
	
	function studeon_content_timeline_frontend_scripts() {
		if ( studeon_is_on(studeon_get_theme_option('debug_mode')) && studeon_get_file_dir('plugins/content_timeline/content_timeline.css')!='')
			wp_enqueue_style( 'studeon-content-timeline',  studeon_get_file_url('plugins/content_timeline/content_timeline.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'studeon_content_timeline_merge_styles' ) ) {
	
	function studeon_content_timeline_merge_styles($list) {
		$list[] = 'plugins/content_timeline/content_timeline.css';
		return $list;
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'studeon_content_timeline_tgmpa_required_plugins' ) ) {
	
	function studeon_content_timeline_tgmpa_required_plugins($list=array()) {
		if (in_array('content_timeline', studeon_storage_get('required_plugins'))) {
			$path = studeon_get_file_dir('plugins/content_timeline/content_timeline.zip');
			$list[] = array(
						'name' 		=> esc_html__('Content Timeline', 'studeon'),
						'slug' 		=> 'content_timeline',
						'source'	=> !empty($path) ? $path : 'upload://content_timeline.zip',
						'required' 	=> false
				);
		}
		return $list;
	}
}


// Add plugin's specific styles into color scheme
//------------------------------------------------------------------------

// Add styles into CSS
if ( !function_exists( 'studeon_content_timeline_get_css' ) ) {
	
	function studeon_content_timeline_get_css($css, $colors, $fonts, $scheme='') {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
			
.timeline.my_style_style_4 .t_line_month,
.timeline.my_style_style_4 a.t_line_node,
.timeline.my_style_style_4 .item .my_timeline_content .read_more {
	{$fonts['p_font-family']}
}

CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

/* Timeline */
.timeline.my_style_style_4 .timeline_line {
	background-color: {$colors['text_dark']};
	color: {$colors['text']};
}
.timeline.my_style_style_4 .t_line_month {
	color: {$colors['bg_color']};
}
.timeline.my_style_style_4 .t_line_wrapper:after {
	border-bottom-color: {$colors['text_link']} !important;
}
#tl1.timeline.my_style_style_4 .t_line_node {
	color: {$colors['text']} !important;
}
#tl1.timeline.my_style_style_4 .t_line_node.active {
	color: {$colors['bg_color']} !important;
}
#tl1.timeline.my_style_style_4 .t_line_node:after {
	background: {$colors['text_link']} !important;
}
#tl1.timeline.my_style_style_4 .t_line_node.active:after {
	border-color: {$colors['text_link']} !important;
	background: {$colors['text_dark']} !important;
}
#tl1.timeline.my_style_style_4 #t_line_left, 
#tl1.timeline.my_style_style_4 #t_line_right {
	color: {$colors['text_link']} !important;
}
#tl1.timeline.my_style_style_4 #t_line_left:hover, 
#tl1.timeline.my_style_style_4 #t_line_right:hover {
	color: {$colors['bg_color']} !important;
}
.timeline.my_style_style_4 .t_node_desc {
	color: {$colors['bg_color']};
}
.timeline.my_style_style_4 .t_node_desc span {
	background: {$colors['text_link']} !important;
}
#tl1.timeline.my_style_style_4 .t_node_desc span:after {
	border-top-color: {$colors['text_link']};
}

/* Items */
.timeline.my_style_style_4 .item {
	background: {$colors['bg_color']} !important;
}
.timeline.my_style_style_4 .timeline_items_wrapper .item h2 {
	color: {$colors['text_dark']} !important;
}
.timeline.my_style_style_4 .my_post_date {
	color: {$colors['text_light']} !important;
}
.timeline.my_style_style_4 .my_timeline_content span {
	color: {$colors['text']} !important;
}
#tl1.timeline.my_style_style_4 .my_timeline_content .read_more {
	color: {$colors['text_link']} !important;
}
#tl1.timeline.my_style_style_4 .my_timeline_content .read_more:hover {
	color: {$colors['text_dark']} !important;
}
#tl1.timeline.my_style_style_4 .item_node_hover:before {
	background-color: {$colors['text_link']} !important;
}
#tl1.timeline.my_style_style_4 .item_node_hover:after {
	border-top-color: {$colors['text_link']} !important;
}

/* Studeon Timeline */

.my_style_orange .timeline_items .item .read_more,
#content .timeline_items .my_style_orange .item .read_more {
	color: {$colors['text_link']} !important;
}
.my_style_orange .timeline_items .item .read_more:hover,
#content .timeline_items .my_style_orange .item .read_more:hover {
	background: transparent !important;
	color: {$colors['text_dark']} !important;
}

CSS;
		}
		
		return $css;
	}
}
?>