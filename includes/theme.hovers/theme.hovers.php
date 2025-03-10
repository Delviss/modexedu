<?php
/**
 * Generate custom CSS for theme hovers
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('studeon_hovers_theme_setup3')) {
	add_action( 'after_setup_theme', 'studeon_hovers_theme_setup3', 3 );
	function studeon_hovers_theme_setup3() {

		// Add 'Buttons hover' option
		studeon_storage_set_array_before('options', 'sidebar_widgets', array(
				'button_hover' => array(
					"title" => esc_html__("Button's hover", 'studeon'),
					"desc" => wp_kses_data( __('Select hover effect to decorate all theme buttons', 'studeon') ),
					"std" => 'default',
					"options" => array(
						'default'		=> esc_html__('Fade',				'studeon'),
						'slide_left'	=> esc_html__('Slide from Left',	'studeon'),
						'slide_right'	=> esc_html__('Slide from Right',	'studeon'),
						'slide_top'		=> esc_html__('Slide from Top',		'studeon'),
						'slide_bottom'	=> esc_html__('Slide from Bottom',	'studeon'),
					),
					"type" => "hidden" //select
				),
				'image_hover' => array(
					"title" => esc_html__("Image's hover", 'studeon'),
					"desc" => wp_kses_data( __('Select hover effect to decorate all theme images', 'studeon') ),
					"std" => 'icon',
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'studeon')
					),
					"options" => array(
						'dots'	=> esc_html__('Dots',	'studeon'),
						'icon'	=> esc_html__('Icon',	'studeon'),
						'icons'	=> esc_html__('Icons',	'studeon'),
						'zoom'	=> esc_html__('Zoom',	'studeon'),
						'fade'	=> esc_html__('Fade',	'studeon'),
						'slide'	=> esc_html__('Slide',	'studeon'),
						'pull'	=> esc_html__('Pull',	'studeon'),
						'border'=> esc_html__('Border',	'studeon')
					),
					"type" => "hidden" //select
				) )
		);
	}
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('studeon_hovers_theme_setup9')) {
	add_action( 'after_setup_theme', 'studeon_hovers_theme_setup9', 9 );
	function studeon_hovers_theme_setup9() {
		add_action( 'wp_enqueue_scripts',		'studeon_hovers_frontend_scripts', 1010 );
		add_filter( 'studeon_filter_localize_script','studeon_hovers_localize_script' );
		add_filter( 'studeon_filter_merge_scripts',	'studeon_hovers_merge_scripts' );
		add_filter( 'studeon_filter_merge_styles',	'studeon_hovers_merge_styles' );
		add_filter( 'studeon_filter_get_css', 		'studeon_hovers_get_css', 10, 4 );
	}
}

// Enqueue hover styles and scripts
if ( !function_exists( 'studeon_hovers_frontend_scripts' ) ) {
	
	function studeon_hovers_frontend_scripts() {
		if ( studeon_is_on(studeon_get_theme_option('debug_mode')) && studeon_get_file_dir('includes/theme.hovers/theme.hovers.js')!='' )
			wp_enqueue_script( 'studeon-hovers', studeon_get_file_url('includes/theme.hovers/theme.hovers.js'), array('jquery'), null, true );
		if ( studeon_is_on(studeon_get_theme_option('debug_mode')) && studeon_get_file_dir('includes/theme.hovers/theme.hovers.css')!='' )
			wp_enqueue_style( 'studeon-hovers',  studeon_get_file_url('includes/theme.hovers/theme.hovers.css'), array(), null );
	}
}

// Merge hover effects into single js
if (!function_exists('studeon_hovers_merge_scripts')) {
	
	function studeon_hovers_merge_scripts($list) {
		$list[] = 'includes/theme.hovers/theme.hovers.js';
		return $list;
	}
}

// Merge hover effects into single css
if (!function_exists('studeon_hovers_merge_styles')) {
	
	function studeon_hovers_merge_styles($list) {
		$list[] = 'includes/theme.hovers/theme.hovers.css';
		return $list;
	}
}

// Add hover effect's vars into localize array
if (!function_exists('studeon_hovers_localize_script')) {
	
	function studeon_hovers_localize_script($arr) {
		$arr['button_hover'] = studeon_get_theme_option('button_hover');
		return $arr;
	}
}

// Add hover icons on the featured image
if ( !function_exists('studeon_hovers_add_icons') ) {
	function studeon_hovers_add_icons($hover, $args=array()) {

		// Additional parameters
		$args = array_merge(array(
			'cat' => '',
			'image' => null
		), $args);

		// Hover style 'Icons and 'Zoom'
		if (in_array($hover, array('icons', 'zoom'))) {
			if ($args['image'])
				$large_image = $args['image'];
			else {
				$attachment = wp_get_attachment_image_src( get_post_thumbnail_id(), 'masonry-big' );
				if (!empty($attachment[0]))
					$large_image = $attachment[0];
			}
			?>
            <div class="icons">
                <a href="<?php esc_url(the_permalink()); ?>" aria-hidden="true" class="icon-link<?php if (empty($large_image)) echo ' single_icon'; ?>"></a>
				<?php if (!empty($large_image)) { ?>
                    <a href="<?php echo esc_url($large_image); ?>" aria-hidden="true" class="icon-search" title="<?php the_title_attribute(); ?>"></a>
				<?php } ?>
            </div>
			<?php

			// Hover style 'Shop'
		} else if ($hover == 'shop' || $hover == 'shop_buttons') {
			global $product;
			?>
            <div class="icons">
                <a href="<?php echo esc_url(is_object($args['cat']) ? get_term_link($args['cat']->slug, 'product_cat') : get_permalink());; ?>" aria-hidden="true" class="shop_link button icon-link"><?php
					if ($hover == 'shop_buttons') esc_html_e('Details', 'studeon');
					?></a>
            </div>
			<?php

			// Hover style 'Icon'
		} else if ($hover == 'icon') {
			?><div class="icons"><a href="<?php esc_url(the_permalink()); ?>" aria-hidden="true" class="icon-plus-2"></a></div><?php

			// Hover style 'Dots'
		} else if ($hover == 'dots') {
			?><a href="<?php esc_url(the_permalink()); ?>" aria-hidden="true" class="icons"><span></span><span></span><span></span></a><?php

			// Hover style 'Fade', 'Slide', 'Pull', 'Border'
		} else if (in_array($hover, array('fade', 'pull', 'slide', 'border'))) {
			?>
            <div class="post_info">
                <div class="post_info_back">
                    <h4 class="post_title"><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h4>
                    <div class="post_descr">
						<?php
						studeon_show_post_meta(array(
							'categories' => false,
							'date' => true,
							'edit' => false,
							'seo' => false,
							'share' => false,
							'counters' => 'comments,views',
							'echo' => true
						));
						// Remove the condition below if you want display excerpt
						if (false) {
							?><div class="post_excerpt"><?php the_excerpt(); ?></div><?php
						}
						?>
                    </div>
                </div>
            </div>
			<?php

			// Hover style empty
		} else {
			?><a href="<?php esc_url(the_permalink()); ?>" aria-hidden="true" class="icons"></a><?php
		}
	}
}

// Add styles into CSS
if ( !function_exists( 'studeon_hovers_get_css' ) ) {
	
	function studeon_hovers_get_css($css, $colors, $fonts, $scheme='') {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

/* ================= BUTTON'S HOVERS ==================== */

/* Slide */
.sc_button_hover_slide_left {	background: linear-gradient(to right,	{$colors['text_dark']} 50%, {$colors['text_link']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['text_link']} !important; }
.sc_button_hover_slide_right {  background: linear-gradient(to left,	{$colors['text_dark']} 50%, {$colors['text_link']} 50%) no-repeat scroll left bottom / 210% 100% {$colors['text_link']} !important; }
.sc_button_hover_slide_top {	background: linear-gradient(to bottom,	{$colors['text_dark']} 50%, {$colors['text_link']} 50%) no-repeat scroll right bottom / 100% 210% {$colors['text_link']} !important; }
.sc_button_hover_slide_bottom {	background: linear-gradient(to top,		{$colors['text_dark']} 50%, {$colors['text_link']} 50%) no-repeat scroll right top / 100% 210% {$colors['text_link']} !important; }

.sc_button_hover_style_dark.sc_button_hover_slide_left {		background: linear-gradient(to right,	{$colors['text_link']} 50%, {$colors['text_dark']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['text_dark']} !important; }
.sc_button_hover_style_dark.sc_button_hover_slide_right {		background: linear-gradient(to left,	{$colors['text_link']} 50%, {$colors['text_dark']} 50%) no-repeat scroll left bottom / 210% 100% {$colors['text_dark']} !important; }
.sc_button_hover_style_dark.sc_button_hover_slide_top {			background: linear-gradient(to bottom,	{$colors['text_link']} 50%, {$colors['text_dark']} 50%) no-repeat scroll right bottom / 100% 210% {$colors['text_dark']} !important; }
.sc_button_hover_style_dark.sc_button_hover_slide_bottom {		background: linear-gradient(to top,		{$colors['text_link']} 50%, {$colors['text_dark']} 50%) no-repeat scroll right top / 100% 210% {$colors['text_dark']} !important; }

.sc_button_hover_style_inverse.sc_button_hover_slide_left {		background: linear-gradient(to right,	{$colors['inverse_link']} 50%, {$colors['text_link']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['text_link']} !important; }
.sc_button_hover_style_inverse.sc_button_hover_slide_right {	background: linear-gradient(to left,	{$colors['inverse_link']} 50%, {$colors['text_link']} 50%) no-repeat scroll left bottom / 210% 100% {$colors['text_link']} !important; }
.sc_button_hover_style_inverse.sc_button_hover_slide_top {		background: linear-gradient(to bottom,	{$colors['inverse_link']} 50%, {$colors['text_link']} 50%) no-repeat scroll right bottom / 100% 210% {$colors['text_link']} !important; }
.sc_button_hover_style_inverse.sc_button_hover_slide_bottom {	background: linear-gradient(to top,		{$colors['inverse_link']} 50%, {$colors['text_link']} 50%) no-repeat scroll right top / 100% 210% {$colors['text_link']} !important; }

.sc_button_hover_style_hover.sc_button_hover_slide_left {		background: linear-gradient(to right,	{$colors['text_hover']} 50%, {$colors['text_link']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['text_link']} !important; }
.sc_button_hover_style_hover.sc_button_hover_slide_right {		background: linear-gradient(to left,	{$colors['text_hover']} 50%, {$colors['text_link']} 50%) no-repeat scroll left bottom / 210% 100% {$colors['text_link']} !important; }
.sc_button_hover_style_hover.sc_button_hover_slide_top {		background: linear-gradient(to bottom,	{$colors['text_hover']} 50%, {$colors['text_link']} 50%) no-repeat scroll right bottom / 100% 210% {$colors['text_link']} !important; }
.sc_button_hover_style_hover.sc_button_hover_slide_bottom {		background: linear-gradient(to top,		{$colors['text_hover']} 50%, {$colors['text_link']} 50%) no-repeat scroll right top / 100% 210% {$colors['text_link']} !important; }

.sc_button_hover_style_alter.sc_button_hover_slide_left {		background: linear-gradient(to right,	{$colors['alter_dark']} 50%, {$colors['alter_link']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['alter_link']} !important; }
.sc_button_hover_style_alter.sc_button_hover_slide_right {		background: linear-gradient(to left,	{$colors['alter_dark']} 50%, {$colors['alter_link']} 50%) no-repeat scroll left bottom / 210% 100% {$colors['alter_link']} !important; }
.sc_button_hover_style_alter.sc_button_hover_slide_top {		background: linear-gradient(to bottom,	{$colors['alter_dark']} 50%, {$colors['alter_link']} 50%) no-repeat scroll right bottom / 100% 210% {$colors['alter_link']} !important; }
.sc_button_hover_style_alter.sc_button_hover_slide_bottom {		background: linear-gradient(to top,		{$colors['alter_dark']} 50%, {$colors['alter_link']} 50%) no-repeat scroll right top / 100% 210% {$colors['alter_link']} !important; }

.sc_button_hover_style_alterbd.sc_button_hover_slide_left {		background: linear-gradient(to right,	{$colors['alter_link']} 50%, {$colors['alter_bd_color']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['alter_bd_color']} !important; }
.sc_button_hover_style_alterbd.sc_button_hover_slide_right {	background: linear-gradient(to left,	{$colors['alter_link']} 50%, {$colors['alter_bd_color']} 50%) no-repeat scroll left bottom / 210% 100% {$colors['alter_bd_color']} !important; }
.sc_button_hover_style_alterbd.sc_button_hover_slide_top {		background: linear-gradient(to bottom,	{$colors['alter_link']} 50%, {$colors['alter_bd_color']} 50%) no-repeat scroll right bottom / 100% 210% {$colors['alter_bd_color']} !important; }
.sc_button_hover_style_alterbd.sc_button_hover_slide_bottom {	background: linear-gradient(to top,		{$colors['alter_link']} 50%, {$colors['alter_bd_color']} 50%) no-repeat scroll right top / 100% 210% {$colors['alter_bd_color']} !important; }

.sc_button_hover_style_alter.sc_button_hover_slide_left:hover,
.sc_button_hover_style_alter.sc_button_hover_slide_right:hover,
.sc_button_hover_style_alter.sc_button_hover_slide_top,
.sc_button_hover_style_alter.sc_button_hover_slide_bottom  {	color: {$colors['bg_color']} !important; }

.sc_button_hover_slide_left:hover,
.sc_button_hover_slide_left.active,
.ui-state-active .sc_button_hover_slide_left,
.vc_active .sc_button_hover_slide_left,
.vc_tta-accordion .vc_tta-panel-title:hover .sc_button_hover_slide_left,
li.active .sc_button_hover_slide_left {		background-position: left bottom !important; color: {$colors['bg_color']} !important; }

.sc_button_hover_slide_right:hover,
.sc_button_hover_slide_right.active,
.ui-state-active .sc_button_hover_slide_right,
.vc_active .sc_button_hover_slide_right,
.vc_tta-accordion .vc_tta-panel-title:hover .sc_button_hover_slide_right,
li.active .sc_button_hover_slide_right {	background-position: right bottom !important; color: {$colors['bg_color']} !important; }

.sc_button_hover_slide_top:hover,
.sc_button_hover_slide_top.active,
.ui-state-active .sc_button_hover_slide_top,
.vc_active .sc_button_hover_slide_top,
.vc_tta-accordion .vc_tta-panel-title:hover .sc_button_hover_slide_top,
li.active .sc_button_hover_slide_top {		background-position: right top !important; color: {$colors['bg_color']} !important; }

.sc_button_hover_slide_bottom:hover,
.sc_button_hover_slide_bottom.active,
.ui-state-active .sc_button_hover_slide_bottom,
.vc_active .sc_button_hover_slide_bottom,
.vc_tta-accordion .vc_tta-panel-title:hover .sc_button_hover_slide_bottom,
li.active .sc_button_hover_slide_bottom {	background-position: right bottom !important; color: {$colors['bg_color']} !important; }


/* ================= IMAGE'S HOVERS ==================== */

/* Common styles */
.post_featured .mask {
	background-color: {$colors['text_dark_07']};
}

/* Dots */
.post_featured.hover_dots:hover .mask {
	background-color: {$colors['text_dark_07']};
}
.post_featured.hover_dots .icons span {
	background-color: {$colors['text_link']};
}
.post_featured.hover_dots .post_info {
	color: {$colors['bg_color']};
}

/* Icon */
.post_featured.hover_icon .icons a {
	color: {$colors['inverse_link']};
}
.post_featured.hover_icon a:hover {
	color: {$colors['accent2']};
}

/* Icon and Icons */
.post_featured.hover_icons .icons a {
	color: {$colors['text_dark']};
	background-color: {$colors['bg_color_07']};
}
.post_featured.hover_icons a:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['bg_color']};
}

/* Fade */
.post_featured.hover_fade .post_info,
.post_featured.hover_fade .post_info a,
.post_featured.hover_fade .post_info .post_meta_item,
.post_featured.hover_fade .post_info .post_meta .post_meta_item:before,
.post_featured.hover_fade .post_info .post_meta .post_meta_item:hover:before {
	color: {$colors['inverse_link']};
}
.post_featured.hover_fade .post_info a:hover {
	color: {$colors['text_link']};
}

/* Slide */
.post_featured.hover_slide .post_info,
.post_featured.hover_slide .post_info a,
.post_featured.hover_slide .post_info .post_meta_item,
.post_featured.hover_slide .post_info .post_meta .post_meta_item:before,
.post_featured.hover_slide .post_info .post_meta .post_meta_item:hover:before {
	color: {$colors['inverse_link']};
}
.post_featured.hover_slide .post_info a:hover {
	color: {$colors['text_link']};
}
.post_featured.hover_slide .post_info .post_title:after {
	background-color: {$colors['inverse_link']};
}

/* Pull */
.post_featured.hover_pull .post_info,
.post_featured.hover_pull .post_info a {
	color: {$colors['inverse_link']};
}
.post_featured.hover_pull .post_info a:hover {
	color: {$colors['text_link']};
}
.post_featured.hover_pull .post_info .post_descr {
	background-color: {$colors['text_dark']};
}

/* Border */
.post_featured.hover_border .post_info,
.post_featured.hover_border .post_info a,
.post_featured.hover_border .post_info .post_meta_item,
.post_featured.hover_border .post_info .post_meta .post_meta_item:before,
.post_featured.hover_border .post_info .post_meta .post_meta_item:hover:before {
	color: {$colors['inverse_link']};
}
.post_featured.hover_border .post_info a:hover {
	color: {$colors['text_link']};
}
.post_featured.hover_border .post_info:before,
.post_featured.hover_border .post_info:after {
	border-color: {$colors['inverse_link']};
}

/* Shop */
.post_featured.hover_shop .icons a {
	color: {$colors['inverse_link']};
	border-color: {$colors['text_link']} !important;
	background-color: transparent;
}
.post_featured.hover_shop .icons a:hover {
	color: {$colors['inverse_link']};
	border-color: {$colors['text_link']} !important;
	background-color: {$colors['text_link']};
}
.products.related .post_featured.hover_shop .icons a {
	color: {$colors['inverse_link']};
	border-color: {$colors['text_link']} !important;
	background-color: {$colors['text_link']};
}
.products.related .post_featured.hover_shop .icons a:hover {
	color: {$colors['inverse_link']};
	border-color: {$colors['text_link_blend']} !important;
	background-color: {$colors['text_link_blend']};
}

/* Shop Buttons */
.post_featured.hover_shop_buttons .icons .shop_link {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}
.post_featured.hover_shop_buttons .icons a:hover {
	color: {$colors['inverse_hover']};
	background-color: {$colors['text_hover']};
}
CSS;
		}

		return $css;
	}
}
?>