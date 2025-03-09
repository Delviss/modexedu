<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('studeon_mailchimp_theme_setup9')) {
	add_action( 'after_setup_theme', 'studeon_mailchimp_theme_setup9', 9 );
	function studeon_mailchimp_theme_setup9() {
		if (studeon_exists_mailchimp()) {
			add_action( 'wp_enqueue_scripts',							'studeon_mailchimp_frontend_scripts', 1100 );
			add_filter( 'studeon_filter_merge_styles',					'studeon_mailchimp_merge_styles');
			add_filter( 'studeon_filter_get_css',						'studeon_mailchimp_get_css', 10, 4);
		}
		if (is_admin()) {
			add_filter( 'studeon_filter_tgmpa_required_plugins',		'studeon_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'studeon_exists_mailchimp' ) ) {
	function studeon_exists_mailchimp() {
		return function_exists('__mc4wp_load_plugin') || defined('MC4WP_VERSION');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'studeon_mailchimp_tgmpa_required_plugins' ) ) {
	
	function studeon_mailchimp_tgmpa_required_plugins($list=array()) {
		if (in_array('mailchimp-for-wp', studeon_storage_get('required_plugins')))
			$list[] = array(
				'name' 		=> esc_html__('MailChimp for WP', 'studeon'),
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		return $list;
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue custom styles
if ( !function_exists( 'studeon_mailchimp_frontend_scripts' ) ) {
	
	function studeon_mailchimp_frontend_scripts() {
		if (studeon_exists_mailchimp()) {
			if (studeon_is_on(studeon_get_theme_option('debug_mode')) && studeon_get_file_dir('plugins/mailchimp-for-wp/mailchimp-for-wp.css')!='')
				wp_enqueue_style( 'studeon-mailchimp-for-wp',  studeon_get_file_url('plugins/mailchimp-for-wp/mailchimp-for-wp.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'studeon_mailchimp_merge_styles' ) ) {
	
	function studeon_mailchimp_merge_styles($list) {
		$list[] = 'plugins/mailchimp-for-wp/mailchimp-for-wp.css';
		return $list;
	}
}

// Add css styles into global CSS stylesheet
if (!function_exists('studeon_mailchimp_get_css')) {
	
	function studeon_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		
			
			$rad = studeon_get_border_radius();
			$css['fonts'] .= <<<CSS

.mc4wp-form .mc4wp-form-fields input[type="email"],
.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	-webkit-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}

CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

.mc4wp-form input[type="email"] {
	background-color: {$colors['input_bg_color']};
	border-color: {$colors['input_bg_color']};
	color: {$colors['input_text']};
}
.mc4wp-form input[type="submit"] {
	color: {$colors['inverse_link']};
	background-color: {$colors['accent2']};
}
.mc4wp-form input[type="submit"]:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['accent2_blend']};
}

CSS;
		}

		return $css;
	}
}
?>