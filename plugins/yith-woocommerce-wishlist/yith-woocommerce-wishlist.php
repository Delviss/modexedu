<?php
/* Elegro Crypto Payment support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'studeon_yith_woocommerce_wishlist_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'studeon_yith_woocommerce_wishlist_theme_setup9', 9 );
	function studeon_yith_woocommerce_wishlist_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'studeon_filter_tgmpa_required_plugins', 'studeon_yith_wcwl_wishlist_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'studeon_yith_wcwl_wishlist_tgmpa_required_plugins' ) ) {
    function studeon_yith_wcwl_wishlist_tgmpa_required_plugins( $list = array() ) {
        if ( in_array( 'yith-woocommerce-wishlist', studeon_storage_get('required_plugins')))
            $list[] = array(
                'name'     => esc_html__( 'YITH WooCommerce Wishlist', 'studeon' ),
                'slug'     => 'yith-woocommerce-wishlist',
                'required' => false,
            );
        return $list;
    }
}


// Check if this plugin installed and activated
if ( ! function_exists( 'studeon_exists_woocommerce_wishlist' ) ) {
	function studeon_exists_woocommerce_wishlist() {
		return defined( 'YITH_WCWL_INIT' );
	}
}

/* Import Options */
// Set plugin's specific importer options
if ( !function_exists( 'studeon_yith_woocommerce_wishlist_importer_set_options' ) ) {
    add_filter( 'trx_addons_filter_importer_options',	'studeon_yith_woocommerce_wishlist_importer_set_options' );
    function studeon_yith_woocommerce_wishlist_importer_set_options($options=array()) {
        if ( studeon_exists_woocommerce_wishlist() && studeon_storage_isset( 'required_plugins', 'yith-woocommerce-wishlist' ) ) {
            $options['additional_options'][]	= 'yith_wcwl_%';
        }
        return $options;
    }
}