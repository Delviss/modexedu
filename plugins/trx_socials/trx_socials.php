<?php
/* ThemeREX Socials support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'studeon_trx_socials_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'studeon_trx_socials_theme_setup9', 9 );
	function studeon_trx_socials_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'studeon_filter_tgmpa_required_plugins', 'studeon_trx_socials_tgmpa_required_plugins', 8 );
		}
	}
}

// Priority 8 is used to add this plugin before all other plugins
if ( ! function_exists( 'studeon_trx_socials_tgmpa_required_plugins' ) ) {
    function studeon_trx_socials_tgmpa_required_plugins( $list = array() ) {

	    if (in_array('trx_socials', studeon_storage_get('required_plugins'))) {
		    $path = studeon_get_file_dir( 'plugins/trx_socials/trx_socials.zip' );
            $list[] = array(
                'name' 		=> esc_html__('ThemeREX Socials', 'studeon'),
                'slug'     => 'trx_socials',
                'version'  => '1.4.5',
                'source'   => ! empty( $path ) ? $path : 'upload://trx_socials.zip',
                'required' => false,
            );

	        return $list;
        }
    }
}

// Check if plugin installed and activated
if ( ! function_exists( 'studeon_exists_trx_socials' ) ) {
	function studeon_exists_trx_socials() {
		return defined( 'TRX_SOCIALS_STORAGE' );
	}

}