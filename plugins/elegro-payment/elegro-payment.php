<?php
/* elegro Crypto Payment support functions
------------------------------------------------------------------------------- */


// Check if this plugin installed and activated
if ( ! function_exists( 'studeon_exists_elegro_payment' ) ) {
	function studeon_exists_elegro_payment() {
		return class_exists( 'WC_Elegro_Payment' );
	}
}


/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('studeon_elegro_payment_theme_setup9')) {
    add_action('after_setup_theme', 'studeon_elegro_payment_theme_setup9', 9);
    function studeon_elegro_payment_theme_setup9()
    {
        if (studeon_exists_elegro_payment()) {
            add_action('wp_enqueue_scripts', 'studeon_elegro_payment_frontend_scripts', 1100);
            add_filter('studeon_filter_merge_styles', 'studeon_elegro_payment_merge_styles');
        }
        if (is_admin()) {
            add_filter('studeon_filter_tgmpa_required_plugins', 'studeon_elegro_payment_tgmpa_required_plugins');
        }
    }
}



// Filter to add in the required plugins list
if (!function_exists('studeon_elegro_payment_tgmpa_required_plugins')) {
    function studeon_elegro_payment_tgmpa_required_plugins($list = array())
    {
        if (in_array('elegro-payment', studeon_storage_get('required_plugins'))) {

            $list[] = array(
                'name' => esc_html__('elegro Crypto Payment', 'studeon'),
                'slug' => 'elegro-payment',
                'required' => false
            );
        }
        return $list;
    }
}


// Add our ref to the link
if ( !function_exists( 'trx_addons_elegro_payment_add_ref' ) ) {
    add_filter( 'woocommerce_settings_api_form_fields_elegro', 'trx_addons_elegro_payment_add_ref' );
    function trx_addons_elegro_payment_add_ref( $fields ) {
        if ( ! empty( $fields['listen_url']['description'] ) ) {
            $fields['listen_url']['description'] = preg_replace( '/href="([^"]+)"/', 'href="$1?ref=246218d7-a23d-444d-83c5-a884ecfa4ebd"', $fields['listen_url']['description'] );
        }
        return $fields;
    }
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue custom styles
if (!function_exists('studeon_elegro_payment_frontend_scripts')) {
    function studeon_elegro_payment_frontend_scripts()
    {
        if (studeon_exists_elegro_payment()) {
            if (studeon_is_on(studeon_get_theme_option('debug_mode')) && studeon_get_file_dir('plugins/elegro-payment/elegro-payment.css') != '')
                wp_enqueue_style('studeon-elegro-payment', studeon_get_file_url('plugins/elegro-payment/elegro-payment.css'), array(), null);
        }
    }
}

// Merge custom styles
if (!function_exists('studeon_elegro_payment_merge_styles')) {
    function studeon_elegro_payment_merge_styles($list)
    {
        $list[] = 'plugins/elegro-payment/elegro-payment.css';
        return $list;
    }
}


