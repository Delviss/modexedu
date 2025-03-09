<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('studeon_essential_grid_theme_setup9')) {
	add_action( 'after_setup_theme', 'studeon_essential_grid_theme_setup9', 9 );
	function studeon_essential_grid_theme_setup9() {
		if (studeon_exists_essential_grid()) {
			add_action( 'wp_enqueue_scripts', 							'studeon_essential_grid_frontend_scripts', 1100 );
			add_filter( 'studeon_filter_merge_styles',					'studeon_essential_grid_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'studeon_filter_tgmpa_required_plugins',		'studeon_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'studeon_exists_essential_grid' ) ) {
	function studeon_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH') || defined( 'ESG_PLUGIN_PATH' );
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'studeon_essential_grid_tgmpa_required_plugins' ) ) {
	
	function studeon_essential_grid_tgmpa_required_plugins($list=array()) {
		if (in_array('essential-grid', studeon_storage_get('required_plugins'))) {
			$path = studeon_get_file_dir('plugins/essential-grid/essential-grid.zip');
			$list[] = array(
						'name' 		=> esc_html__('Essential Grid', 'studeon'),
						'slug' 		=> 'essential-grid',
                        'version'	=> '3.0.16',
						'source'	=> !empty($path) ? $path : 'upload://essential-grid.zip',
						'required' 	=> false
			);
		}
		return $list;
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'studeon_essential_grid_frontend_scripts' ) ) {
	
	function studeon_essential_grid_frontend_scripts() {
		if (studeon_is_on(studeon_get_theme_option('debug_mode')) && studeon_get_file_dir('plugins/essential-grid/essential-grid.css')!='')
			wp_enqueue_style( 'studeon-essential-grid',  studeon_get_file_url('plugins/essential-grid/essential-grid.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'studeon_essential_grid_merge_styles' ) ) {
	
	function studeon_essential_grid_merge_styles($list) {
		$list[] = 'plugins/essential-grid/essential-grid.css';
		return $list;
	}
}
?>