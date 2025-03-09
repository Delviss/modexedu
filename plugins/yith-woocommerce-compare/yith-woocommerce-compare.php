<?php

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('studeon_yith_woocommerce_compare_theme_setup9')) {
    add_action('after_setup_theme', 'studeon_yith_woocommerce_compare_theme_setup9', 9);
    function studeon_yith_woocommerce_compare_theme_setup9() {
        if (is_admin()) {
            add_filter( 'studeon_filter_tgmpa_required_plugins',		'studeon_yith_woocommerce_compare_tgmpa_required_plugins' );
        }
    }
}

// Check if plugin installed and activated
if ( ! function_exists( 'studeon_exists_yith_woocommerce_compare' ) ) {
    function studeon_exists_yith_woocommerce_compare() {
        return class_exists( 'YITH_WOOCOMPARE' );
    }
}



// Filter to add in the required plugins list
if ( ! function_exists( 'studeon_yith_woocommerce_compare_tgmpa_required_plugins' ) ) {
    function studeon_yith_woocommerce_compare_tgmpa_required_plugins( $list = array() ) {
        if ( in_array( 'yith-woocommerce-compare', studeon_storage_get('required_plugins')))
            $list[] = array(
                'name'     => esc_html__( 'YITH WooCommerce Compare', 'studeon' ),
                'slug'     => 'yith-woocommerce-compare',
                'required' => false,
            );
        return $list;
    }
}


// Set plugin's specific importer options
if ( !function_exists( 'studeon_yith_woocommerce_compare_importer_set_options' ) ) {
    if (is_admin()) add_filter( 'trx_addons_filter_importer_options',    'studeon_yith_woocommerce_compare_importer_set_options' );
    function studeon_yith_woocommerce_compare_importer_set_options($options=array()) {
        if ( studeon_exists_yith_woocommerce_compare() && in_array('yith-woocommerce-compare', $options['required_plugins']) ) {
            $options['additional_options'][]    = 'yith_woocompare_%';
        }
        return $options;
    }
}

