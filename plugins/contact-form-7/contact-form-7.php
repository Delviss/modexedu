<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('studeon_cf7_theme_setup9')) {
	add_action( 'after_setup_theme', 'studeon_cf7_theme_setup9', 9 );
	function studeon_cf7_theme_setup9() {
		
		if (studeon_exists_cf7()) {
			add_action( 'wp_enqueue_scripts', 								'studeon_cf7_frontend_scripts', 1100 );
			add_filter( 'studeon_filter_merge_styles',						'studeon_cf7_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'studeon_filter_tgmpa_required_plugins',			'studeon_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'studeon_cf7_tgmpa_required_plugins' ) ) {
	
	function studeon_cf7_tgmpa_required_plugins($list=array()) {
		if (in_array('contact-form-7', studeon_storage_get('required_plugins'))) {
			// CF7 plugin
			$list[] = array(
					'name' 		=> esc_html__('Contact Form 7', 'studeon'),
					'slug' 		=> 'contact-form-7',
					'required' 	=> false
			);
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( !function_exists( 'studeon_exists_cf7' ) ) {
	function studeon_exists_cf7() {
		return class_exists('WPCF7');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'studeon_cf7_frontend_scripts' ) ) {
	
	function studeon_cf7_frontend_scripts() {
		if (studeon_is_on(studeon_get_theme_option('debug_mode')) && studeon_get_file_dir('plugins/contact-form-7/contact-form-7.css')!='')
			wp_enqueue_style( 'studeon-contact-form-7',  studeon_get_file_url('plugins/contact-form-7/contact-form-7.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'studeon_cf7_merge_styles' ) ) {
	
	function studeon_cf7_merge_styles($list) {
		$list[] = 'plugins/contact-form-7/contact-form-7.css';
		return $list;
	}
}
?>