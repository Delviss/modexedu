<?php
/* Theme-specific action to configure ThemeREX Addons components
------------------------------------------------------------------------------- */


/* ThemeREX Addons components
------------------------------------------------------------------------------- */

if (!function_exists('studeon_trx_addons_theme_specific_setup1')) {
	add_action( 'after_setup_theme', 'studeon_trx_addons_theme_specific_setup1', 1 );
	add_action( 'trx_addons_action_save_options', 'studeon_trx_addons_theme_specific_setup1', 8 );
	function studeon_trx_addons_theme_specific_setup1() {
		if (studeon_exists_trx_addons()) {
			add_filter( 'trx_addons_cv_enable',				'studeon_trx_addons_cv_enable');
			add_filter( 'trx_addons_cpt_list',				'studeon_trx_addons_cpt_list');
			add_filter( 'trx_addons_sc_list',				'studeon_trx_addons_sc_list');
			add_filter( 'trx_addons_widgets_list',			'studeon_trx_addons_widgets_list');
		}
	}
}

// CV
if ( !function_exists( 'studeon_trx_addons_cv_enable' ) ) {
	
	function studeon_trx_addons_cv_enable($enable=false) {
		// To do: return false if theme not use CV functionality
		return false;
	}
}

// CPT
if ( !function_exists( 'studeon_trx_addons_cpt_list' ) ) {
	
	function studeon_trx_addons_cpt_list($list=array()) {
		// To do: Enable/Disable CPT via add/remove it in the list
		unset($list['certificates']);
		unset($list['dishes']);
		unset($list['portfolio']);
		unset($list['resume']);
		unset($list['sport']);
		return $list;
	}
}

// Shortcodes
if ( !function_exists( 'studeon_trx_addons_sc_list' ) ) {
	
	function studeon_trx_addons_sc_list($list=array()) {
		// To do: Add/Remove shortcodes into list
		// If you add new shortcode - in the theme's folder must exists /trx_addons/shortcodes/new_sc_name/new_sc_name.php
		return $list;
	}
}

// Widgets
if ( !function_exists( 'studeon_trx_addons_widgets_list' ) ) {
	
	function studeon_trx_addons_widgets_list($list=array()) {
		// To do: Add/Remove widgets into list
		// If you add widget - in the theme's folder must exists /trx_addons/widgets/new_widget_name/new_widget_name.php
		unset($list['aboutme']);
		unset($list['calendar']);
		unset($list['flickr']);
		unset($list['popular_posts']);
		unset($list['recent_news']);
		unset($list['twitter']);
		return $list;
	}
}


/* Add options in the Theme Options Customizer
------------------------------------------------------------------------------- */

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('studeon_trx_addons_theme_specific_setup3')) {
	add_action( 'after_setup_theme', 'studeon_trx_addons_theme_specific_setup3', 3 );
	function studeon_trx_addons_theme_specific_setup3() {
		
		// Section 'Courses' - settings to show 'Courses' blog archive and single posts
		if (studeon_exists_courses()) {
		
			studeon_storage_merge_array('options', '', array(
				'courses' => array(
					"title" => esc_html__('Courses', 'studeon'),
					"desc" => wp_kses_data( __('Select parameters to display the courses pages', 'studeon') ),
					"type" => "section"
					),
				'expand_content_courses' => array(
					"title" => esc_html__('Expand content', 'studeon'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'studeon') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
				'header_style_courses' => array(
					"title" => esc_html__('Header style', 'studeon'),
					"desc" => wp_kses_data( __('Select style to display the site header on the courses pages', 'studeon') ),
					"std" => 'inherit',
					"options" => array(),
					"type" => "select"
					),
				'header_position_courses' => array(
					"title" => esc_html__('Header position', 'studeon'),
					"desc" => wp_kses_data( __('Select position to display the site header on the courses pages', 'studeon') ),
					"std" => 'inherit',
					"options" => array(),
					"type" => "select"
					),
				'header_widgets_courses' => array(
					"title" => esc_html__('Header widgets', 'studeon'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on the courses pages', 'studeon') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'sidebar_widgets_courses' => array(
					"title" => esc_html__('Sidebar widgets', 'studeon'),
					"desc" => wp_kses_data( __('Select sidebar to show on the courses pages', 'studeon') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'sidebar_position_courses' => array(
					"title" => esc_html__('Sidebar position', 'studeon'),
					"desc" => wp_kses_data( __('Select position to show sidebar on the courses pages', 'studeon') ),
					"refresh" => false,
					"std" => 'left',
					"options" => array(),
					"type" => "select"
					),
				'hide_sidebar_on_single_courses' => array(
					"title" => esc_html__('Hide sidebar on the single course', 'studeon'),
					"desc" => wp_kses_data( __("Hide sidebar on the single course's page", 'studeon') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'widgets_above_page_courses' => array(
					"title" => esc_html__('Widgets above the page', 'studeon'),
					"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'studeon') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_above_content_courses' => array(
					"title" => esc_html__('Widgets above the content', 'studeon'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'studeon') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_below_content_courses' => array(
					"title" => esc_html__('Widgets below the content', 'studeon'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'studeon') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_below_page_courses' => array(
					"title" => esc_html__('Widgets below the page', 'studeon'),
					"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'studeon') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'footer_scheme_courses' => array(
					"title" => esc_html__('Footer Color Scheme', 'studeon'),
					"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'studeon') ),
					"std" => 'dark',
					"options" => array(),
					"type" => "select"
					),
				'footer_widgets_courses' => array(
					"title" => esc_html__('Footer widgets', 'studeon'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'studeon') ),
					"std" => 'footer_widgets',
					"options" => array(),
					"type" => "select"
					),
				'footer_columns_courses' => array(
					"title" => esc_html__('Footer columns', 'studeon'),
					"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'studeon') ),
					"dependency" => array(
						'footer_widgets_courses' => array('^hide')
					),
					"std" => 0,
					"options" => studeon_get_list_range(0,6),
					"type" => "select"
					),
				'footer_wide_courses' => array(
					"title" => esc_html__('Footer fullwide', 'studeon'),
					"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'studeon') ),
					"std" => 0,
					"type" => "checkbox"
					)
				)
			);
		}
		
		// Section 'Sport' - settings to show 'Sport' blog archive and single posts
		if (studeon_exists_sport()) {
			studeon_storage_merge_array('options', '', array(
				'sport' => array(
					"title" => esc_html__('Sport', 'studeon'),
					"desc" => wp_kses_data( __('Select parameters to display the sport pages', 'studeon') ),
					"type" => "section"
					),
				'expand_content_sport' => array(
					"title" => esc_html__('Expand content', 'studeon'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'studeon') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
				'header_style_sport' => array(
					"title" => esc_html__('Header style', 'studeon'),
					"desc" => wp_kses_data( __('Select style to display the site header on the sport pages', 'studeon') ),
					"std" => 'inherit',
					"options" => array(),
					"type" => "select"
					),
				'header_position_sport' => array(
					"title" => esc_html__('Header position', 'studeon'),
					"desc" => wp_kses_data( __('Select position to display the site header on the sport pages', 'studeon') ),
					"std" => 'inherit',
					"options" => array(),
					"type" => "select"
					),
				'header_widgets_sport' => array(
					"title" => esc_html__('Header widgets', 'studeon'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on the sport pages', 'studeon') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'sidebar_widgets_sport' => array(
					"title" => esc_html__('Sidebar widgets', 'studeon'),
					"desc" => wp_kses_data( __('Select sidebar to show on the sport pages', 'studeon') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'sidebar_position_sport' => array(
					"title" => esc_html__('Sidebar position', 'studeon'),
					"desc" => wp_kses_data( __('Select position to show sidebar on the sport pages', 'studeon') ),
					"refresh" => false,
					"std" => 'left',
					"options" => array(),
					"type" => "select"
					),
				'hide_sidebar_on_single_sport' => array(
					"title" => esc_html__('Hide sidebar on the single course', 'studeon'),
					"desc" => wp_kses_data( __("Hide sidebar on the single course's page", 'studeon') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'widgets_above_page_sport' => array(
					"title" => esc_html__('Widgets above the page', 'studeon'),
					"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'studeon') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_above_content_sport' => array(
					"title" => esc_html__('Widgets above the content', 'studeon'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'studeon') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_below_content_sport' => array(
					"title" => esc_html__('Widgets below the content', 'studeon'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'studeon') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_below_page_sport' => array(
					"title" => esc_html__('Widgets below the page', 'studeon'),
					"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'studeon') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'footer_scheme_sport' => array(
					"title" => esc_html__('Footer Color Scheme', 'studeon'),
					"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'studeon') ),
					"std" => 'dark',
					"options" => array(),
					"type" => "select"
					),
				'footer_widgets_sport' => array(
					"title" => esc_html__('Footer widgets', 'studeon'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'studeon') ),
					"std" => 'footer_widgets',
					"options" => array(),
					"type" => "select"
					),
				'footer_columns_sport' => array(
					"title" => esc_html__('Footer columns', 'studeon'),
					"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'studeon') ),
					"dependency" => array(
						'footer_widgets_sport' => array('^hide')
					),
					"std" => 0,
					"options" => studeon_get_list_range(0,6),
					"type" => "select"
					),
				'footer_wide_sport' => array(
					"title" => esc_html__('Footer fullwide', 'studeon'),
					"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'studeon') ),
					"std" => 0,
					"type" => "checkbox"
					)
				)
			);
		}
	}
}

// Add mobile menu to the plugin's cached menu list
if ( !function_exists( 'studeon_trx_addons_menu_cache' ) ) {
	add_filter( 'trx_addons_filter_menu_cache', 'studeon_trx_addons_menu_cache');
	function studeon_trx_addons_menu_cache($list=array()) {
		if (in_array('#menu_main', $list)) $list[] = '#menu_mobile';
		$list[] = '.menu_mobile_inner > nav > ul';
		return $list;
	}
}

// Add vars into localize array
if (!function_exists('studeon_trx_addons_localize_script')) {
	add_filter( 'studeon_filter_localize_script','studeon_trx_addons_localize_script' );
	function studeon_trx_addons_localize_script($arr) {
		$arr['alter_link_color'] = studeon_get_scheme_color('alter_link');
		return $arr;
	}
}


// Add theme-specific layouts to the list
if (!function_exists('studeon_trx_addons_theme_specific_default_layouts')) {
	add_filter( 'trx_addons_filter_default_layouts',	'studeon_trx_addons_theme_specific_default_layouts');
	function studeon_trx_addons_theme_specific_default_layouts($default_layouts=array()) {
		require_once STUDEON_THEME_DIR . 'theme-specific/trx_addons.layouts.php';
		return isset($layouts) && is_array($layouts) && count($layouts) > 0
						? array_merge($default_layouts, $layouts)
						: $default_layouts;
	}
}

// Disable override header image on team pages
if ( !function_exists( 'studeon_trx_addons_allow_override_header_image' ) ) {
	add_filter( 'studeon_filter_allow_override_header_image', 'studeon_trx_addons_allow_override_header_image' );
	function studeon_trx_addons_allow_override_header_image($allow) {
		return studeon_is_team_page() || studeon_is_portfolio_page() ? false : $allow;
	}
}

// Hide sidebar on the team pages
if ( !function_exists( 'studeon_trx_addons_sidebar_present' ) ) {
	add_filter( 'studeon_filter_sidebar_present', 'studeon_trx_addons_sidebar_present' );
	function studeon_trx_addons_sidebar_present($present) {
		return !is_single() && (studeon_is_team_page() || studeon_is_portfolio_page()) ? false : $present;
	}
}


// WP Editor addons
//------------------------------------------------------------------------

// Theme-specific configure of the WP Editor
if ( !function_exists( 'studeon_trx_addons_editor_init' ) ) {
	if (is_admin()) add_filter( 'tiny_mce_before_init', 'studeon_trx_addons_editor_init', 11);
	function studeon_trx_addons_editor_init($opt) {
		if (studeon_exists_trx_addons()) {
			// Add style 'Arrow' to the 'List styles'
			// Remove 'false &&' from condition below to add new style to the list
			if (false && !empty($opt['style_formats'])) {
				$style_formats = json_decode($opt['style_formats'], true);
				if (is_array($style_formats) && count($style_formats)>0 ) {
					foreach ($style_formats as $k=>$v) {
						if ( $v['title'] == esc_html__('List styles', 'studeon') ) {
							$style_formats[$k]['items'][] = array(
										'title' => esc_html__('Arrow', 'studeon'),
										'selector' => 'ul',
										'classes' => 'trx_addons_list trx_addons_list_arrow'
									);
						}
					}
					$opt['style_formats'] = json_encode( $style_formats );		
				}
			}
		}
		return $opt;
	}
}


// Theme-specific thumb sizes
//------------------------------------------------------------------------

// Replace thumb sizes to the theme-specific
if ( !function_exists( 'studeon_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'studeon_trx_addons_add_thumb_sizes');
	function studeon_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// Return theme-specific thumb size instead removed plugin's thumb size
if ( !function_exists( 'studeon_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'studeon_trx_addons_get_thumb_size');
	function studeon_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'studeon-thumb-huge',
							'studeon-thumb-huge-@retina',
							'studeon-thumb-big',
							'studeon-thumb-big-@retina',
							'studeon-thumb-med',
							'studeon-thumb-med-@retina',
							'studeon-thumb-tiny',
							'studeon-thumb-tiny-@retina',
							'studeon-thumb-masonry-big',
							'studeon-thumb-masonry-big-@retina',
							'studeon-thumb-masonry',
							'studeon-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}

// Get thumb size for the team items
if ( !function_exists( 'studeon_trx_addons_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_thumb_size',	'studeon_trx_addons_thumb_size', 10, 2);
	function studeon_trx_addons_thumb_size($thumb_size='', $type='') {
		if ($type == 'team-default')
			$thumb_size = studeon_get_thumb_size('med');
		return $thumb_size;
	}
}



// Shortcodes support
//------------------------------------------------------------------------

// Return tag for the item's title
if ( !function_exists( 'studeon_trx_addons_sc_item_title_tag' ) ) {
	add_filter( 'trx_addons_filter_sc_item_title_tag', 'studeon_trx_addons_sc_item_title_tag');
	function studeon_trx_addons_sc_item_title_tag($tag='') {
		return $tag=='h1' ? 'h2' : $tag;
	}
}

// Return args for the item's button
if ( !function_exists( 'studeon_trx_addons_sc_item_button_args' ) ) {
	add_filter( 'trx_addons_filter_sc_item_button_args', 'studeon_trx_addons_sc_item_button_args');
	function studeon_trx_addons_sc_item_button_args($args, $sc='') {
		if (false && $sc != 'sc_button') {
			$args['type'] = 'simple';
			$args['icon_type'] = 'fontawesome';
			$args['icon_fontawesome'] = 'icon-down-big';
			$args['icon_position'] = 'top';
		}
		return $args;
	}
}

// Add/remove animation types in the inputs
if ( !function_exists( 'studeon_filter_get_list_input_hover' ) ) {
	add_filter( 'trx_addons_filter_get_list_input_hover', 'studeon_filter_get_list_input_hover', 10, 2);
	function studeon_filter_get_list_input_hover($list) {
		unset($list['accent']);
		unset($list['jump']);
		unset($list['path']);
		unset($list['underline']);
		unset($list['iconed']);
		return $list;
	}
}
// Add new types in the shortcodes
if ( !function_exists( 'studeon_trx_addons_sc_type' ) ) {
	add_filter( 'trx_addons_sc_type', 'studeon_trx_addons_sc_type', 10, 2);
	function studeon_trx_addons_sc_type($list, $sc) {
		if (in_array($sc, array('trx_sc_button'))) {
			unset($list['Simple']);
			$list[esc_html__('White', 'studeon')] = 'white';
			$list[esc_html__('Accent', 'studeon')] = 'accent';
			$list[esc_html__('Transparent', 'studeon')] = 'transparent';
		}
		if (in_array($sc, array('trx_sc_form'))) {
			unset($list['Detailed']);
			unset($list['Modern']);
			$list[esc_html__('Simple', 'studeon')] = 'simple';
			$list[esc_html__('Simple 2', 'studeon')] = 'simple_2';
			$list[esc_html__('Alter', 'studeon')] = 'alter';
		}
		if (in_array($sc, array('trx_sc_events'))) {
			unset($list['Default']);
		}
		if (in_array($sc, array('trx_sc_services'))) {
			unset($list['Iconed']);
			unset($list['List']);
			unset($list['Hover']);
			unset($list['Chess']);
			unset($list['Tabs']);
			unset($list['Tabs (simple)']);
			$list[esc_html__('Alter', 'studeon')] = 'alter';
		}
		if (in_array($sc, array('trx_sc_testimonials'))) {
			unset($list['Simple']);
			$list[esc_html__('Alter', 'studeon')] = 'alter';
		}
		if (in_array($sc, array('trx_sc_team'))) {
			unset($list['Default']);
			unset($list['Featured']);
		}
		return $list;
	}
}

// Add new styles to the Google map
if ( !function_exists( 'studeon_trx_addons_sc_googlemap_styles' ) ) {
	add_filter( 'trx_addons_filter_sc_googlemap_styles',	'studeon_trx_addons_sc_googlemap_styles');
	function studeon_trx_addons_sc_googlemap_styles($list) {
		$list[esc_html__('Dark', 'studeon')] = 'dark';
		return $list;
	}
}
