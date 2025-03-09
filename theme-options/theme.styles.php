<?php
/**
 * Generate custom CSS
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */


			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('studeon_customizer_add_theme_colors')) {
	function studeon_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = studeon_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_01']  = studeon_hex2rgba( $colors['bg_color'], 0.1 );
			$colors['bg_color_02']  = studeon_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_07']  = studeon_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = studeon_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = studeon_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['alter_bg_hover_01']  = studeon_hex2rgba( $colors['alter_bg_hover'], 0.1 );
			$colors['alter_bg_hover_09']  = studeon_hex2rgba( $colors['alter_bg_hover'], 0.9 );
			$colors['alter_bg_color_07']  = studeon_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = studeon_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = studeon_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = studeon_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['text_dark_07']  = studeon_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_link_02']  = studeon_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = studeon_hex2rgba( $colors['text_link'], 0.7 );
			$colors['bg_color_blend'] = studeon_hsb2hex(studeon_hex2hsb( $colors['bg_color'], 0, 0, -5 ));
			$colors['accent2_blend'] = studeon_hsb2hex(studeon_hex2hsb( $colors['accent2'], 0, 0, -10 ));
			$colors['text_link_blend'] = studeon_hsb2hex(studeon_hex2hsb( $colors['text_link'], 0, 0, -10 ));
			$colors['alter_link_blend'] = studeon_hsb2hex(studeon_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_01'] = '{{ data.bg_color_01 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['alter_bg_hover_01'] = '{{ data.alter_bg_hover_01 }}';
			$colors['alter_bg_hover_09'] = '{{ data.alter_bg_hover_09 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['bg_color_blend'] = '{{ data.bg_color_blend }}';
			$colors['accent2_blend'] = '{{ data.accent2_blend }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('studeon_customizer_add_theme_fonts')) {
	function studeon_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !studeon_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !studeon_is_inherit($font['font-size'])
														? 'font-size:' . studeon_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !studeon_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !studeon_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !studeon_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !studeon_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !studeon_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !studeon_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !studeon_is_inherit($font['margin-top'])
														? 'margin-top:' . studeon_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !studeon_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . studeon_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}


// Return CSS with custom colors and fonts
if (!function_exists('studeon_customizer_get_css')) {

	function studeon_customizer_get_css($colors=null, $fonts=null, $remove_spaces=true, $only_scheme='') {

		$css = array(
			'fonts' => '',
			'colors' => ''
		);
		
		// Theme fonts
		//---------------------------------------------
		if ($fonts === null) {
			$fonts = studeon_get_theme_fonts();
		}
		
		if ($fonts) {

			// Make theme-specific fonts rules
			$fonts = studeon_customizer_add_theme_fonts($fonts);

			$rez = array();
			$rez['fonts'] = <<<CSS

body {
	{$fonts['p_font-family']}
	{$fonts['p_font-size']}
	{$fonts['p_font-weight']}
	{$fonts['p_font-style']}
	{$fonts['p_line-height']}
	{$fonts['p_text-decoration']}
	{$fonts['p_text-transform']}
	{$fonts['p_letter-spacing']}
}
.wp-block-calendar caption,
.wp-block-calendar,
.wp-block-calendar table{
    {$fonts['p_font-family']}
}
p, ul, ol, dl, blockquote, address {
	{$fonts['p_margin-top']}
	{$fonts['p_margin-bottom']}
}

h1 {
	{$fonts['h1_font-family']}
	{$fonts['h1_font-size']}
	{$fonts['h1_font-weight']}
	{$fonts['h1_font-style']}
	{$fonts['h1_line-height']}
	{$fonts['h1_text-decoration']}
	{$fonts['h1_text-transform']}
	{$fonts['h1_letter-spacing']}
	{$fonts['h1_margin-top']}
	{$fonts['h1_margin-bottom']}
}
h2 {
	{$fonts['h2_font-family']}
	{$fonts['h2_font-size']}
	{$fonts['h2_font-weight']}
	{$fonts['h2_font-style']}
	{$fonts['h2_line-height']}
	{$fonts['h2_text-decoration']}
	{$fonts['h2_text-transform']}
	{$fonts['h2_letter-spacing']}
	{$fonts['h2_margin-top']}
	{$fonts['h2_margin-bottom']}
}
h3 {
	{$fonts['h3_font-family']}
	{$fonts['h3_font-size']}
	{$fonts['h3_font-weight']}
	{$fonts['h3_font-style']}
	{$fonts['h3_line-height']}
	{$fonts['h3_text-decoration']}
	{$fonts['h3_text-transform']}
	{$fonts['h3_letter-spacing']}
	{$fonts['h3_margin-top']}
	{$fonts['h3_margin-bottom']}
}
h4 {
	{$fonts['h4_font-family']}
	{$fonts['h4_font-size']}
	{$fonts['h4_font-weight']}
	{$fonts['h4_font-style']}
	{$fonts['h4_line-height']}
	{$fonts['h4_text-decoration']}
	{$fonts['h4_text-transform']}
	{$fonts['h4_letter-spacing']}
	{$fonts['h4_margin-top']}
	{$fonts['h4_margin-bottom']}
}
h5 {
	{$fonts['h5_font-family']}
	{$fonts['h5_font-size']}
	{$fonts['h5_font-weight']}
	{$fonts['h5_font-style']}
	{$fonts['h5_line-height']}
	{$fonts['h5_text-decoration']}
	{$fonts['h5_text-transform']}
	{$fonts['h5_letter-spacing']}
	{$fonts['h5_margin-top']}
	{$fonts['h5_margin-bottom']}
}
h6 {
	{$fonts['h6_font-family']}
	{$fonts['h6_font-size']}
	{$fonts['h6_font-weight']}
	{$fonts['h6_font-style']}
	{$fonts['h6_line-height']}
	{$fonts['h6_text-decoration']}
	{$fonts['h6_text-transform']}
	{$fonts['h6_letter-spacing']}
	{$fonts['h6_margin-top']}
	{$fonts['h6_margin-bottom']}
}

input[type="text"],
input[type="number"],
input[type="email"],
input[type="tel"],
input[type="search"],
input[type="password"],
textarea,
textarea.wp-editor-area,
.select_container,
select,
.select_container select {
	{$fonts['input_font-family']}
	{$fonts['input_font-size']}
	{$fonts['input_font-weight']}
	{$fonts['input_font-style']}
	{$fonts['input_line-height']}
	{$fonts['input_text-decoration']}
	{$fonts['input_text-transform']}
	{$fonts['input_letter-spacing']}
}

button,
input[type="button"],
input[type="reset"],
input[type="submit"],
.theme_button,
.gallery_preview_show .post_readmore,
.more-link,
.studeon_tabs .studeon_tabs_titles li a {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}

.top_panel .slider_engine_revo .slide_title {
	{$fonts['h1_font-family']}
}
.wp-block-tag-cloud a,
.widget_product_tag_cloud a, 
.widget_tag_cloud a,
blockquote p a,
blockquote a,
mark, ins,
table th,
.logo_text,
.format-audio .post_featured .post_audio_author,
.post_price.price,
.footer_copyright_inner,
.nav-links-old,
.theme_scroll_down,
.tribe-common .tribe-common-h4 {
	{$fonts['h5_font-family']}
}

.post_meta {
	{$fonts['info_font-family']}
	{$fonts['info_font-size']}
	{$fonts['info_font-weight']}
	{$fonts['info_font-style']}
	{$fonts['info_line-height']}
	{$fonts['info_text-decoration']}
	{$fonts['info_text-transform']}
	{$fonts['info_letter-spacing']}
	{$fonts['info_margin-top']}
	{$fonts['info_margin-bottom']}
}

em, i,
.post-date, .rss-date 
.post_date, .post_meta_item, .post_counters_item,
.comments_list_wrap .comment_date,
.comments_list_wrap .comment_time,
.comments_list_wrap .comment_counters,
.top_panel .slider_engine_revo .slide_subtitle,
.logo_slogan,
fieldset legend,
figure figcaption,
.wp-caption .wp-caption-text,
.wp-caption .wp-caption-dd,
.wp-caption-overlay .wp-caption .wp-caption-text,
.wp-caption-overlay .wp-caption .wp-caption-dd,
.format-audio .post_featured .post_audio_author,
.post_item_single .post_content .post_meta,
.author_bio .author_link,
.comments_list_wrap .comment_posted,
.comments_list_wrap .comment_reply {
	{$fonts['info_font-family']}
}
blockquote p,
blockquote {
	{$fonts['input_font-family']}
}

.mejs-controls .mejs-currenttime, 
.mejs-controls .mejs-duration,
.search_wrap .search_results .post_meta_item,
.search_wrap .search_results .post_counters_item {
	{$fonts['p_font-family']}
}

.logo_text {
	{$fonts['logo_font-family']}
	{$fonts['logo_font-size']}
	{$fonts['logo_font-weight']}
	{$fonts['logo_font-style']}
	{$fonts['logo_line-height']}
	{$fonts['logo_text-decoration']}
	{$fonts['logo_text-transform']}
	{$fonts['logo_letter-spacing']}
}
.logo_footer_text {
	{$fonts['logo_font-family']}
}

.menu_main_nav_area {
	{$fonts['menu_font-size']}
	{$fonts['menu_line-height']}
}
.menu_main_nav > li,
.menu_main_nav > li > a {
	{$fonts['menu_font-family']}
	{$fonts['menu_font-weight']}
	{$fonts['menu_font-style']}
	{$fonts['menu_text-decoration']}
	{$fonts['menu_text-transform']}
	{$fonts['menu_letter-spacing']}
}
.menu_main_nav > li ul,
.menu_main_nav > li ul > li,
.menu_main_nav > li ul > li > a {
	{$fonts['submenu_font-family']}
	{$fonts['submenu_font-size']}
	{$fonts['submenu_font-weight']}
	{$fonts['submenu_font-style']}
	{$fonts['submenu_line-height']}
	{$fonts['submenu_text-decoration']}
	{$fonts['submenu_text-transform']}
	{$fonts['submenu_letter-spacing']}
}
.menu_mobile .menu_mobile_nav_area > ul > li,
.menu_mobile .menu_mobile_nav_area > ul > li > a {
	{$fonts['menu_font-family']}
}
.menu_mobile .menu_mobile_nav_area > ul > li li,
.menu_mobile .menu_mobile_nav_area > ul > li li > a {
	{$fonts['submenu_font-family']}
}


/* Custom Headers */
.sc_layouts_row,
.sc_layouts_row input[type="text"] {
	{$fonts['menu_font-family']}
	{$fonts['menu_font-size']}
	{$fonts['menu_font-weight']}
	{$fonts['menu_font-style']}
	{$fonts['menu_line-height']}
}
.sc_layouts_row .sc_button_wrap .sc_button {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}
.sc_layouts_menu_nav > li,
.sc_layouts_menu_nav > li > a {
	{$fonts['menu_font-family']}
	{$fonts['menu_font-weight']}
	{$fonts['menu_font-style']}
	{$fonts['menu_text-decoration']}
	{$fonts['menu_text-transform']}
	{$fonts['menu_letter-spacing']}
}
.sc_layouts_menu_popup .sc_layouts_menu_nav > li,
.sc_layouts_menu_popup .sc_layouts_menu_nav > li > a,
.sc_layouts_menu_nav > li ul,
.sc_layouts_menu_nav > li ul > li,
.sc_layouts_menu_nav > li ul > li > a {
	{$fonts['submenu_font-family']}
	{$fonts['submenu_font-size']}
	{$fonts['submenu_font-weight']}
	{$fonts['submenu_font-style']}
	{$fonts['submenu_line-height']}
	{$fonts['submenu_text-decoration']}
	{$fonts['submenu_text-transform']}
	{$fonts['submenu_letter-spacing']}
}


CSS;
			$rez = apply_filters('studeon_filter_get_css', $rez, false, $fonts, '');
			$css['fonts'] = $rez['fonts'];

			
			// Border radius
			//--------------------------------------
			$rad = studeon_get_border_radius();
			$rad50 = ' '.$rad != ' 0' ? '50%' : 0;
			$css['fonts'] .= <<<CSS

/* Buttons */
button,
input[type="button"],
input[type="reset"],
input[type="submit"],
.theme_button,
.post_item .more-link,
.gallery_preview_show .post_readmore,

/* Fields */
input[type="text"],
input[type="number"],
input[type="email"],
input[type="tel"],
input[type="password"],
input[type="search"],
select,
.select_container,
textarea,

/* Search fields */
.widget_search .search-field,
.woocommerce.widget_product_search .search_field,
.widget_display_search #bbp_search,
#bbpress-forums #bbp-search-form #bbp_search,

/* Comment fields */
.comments_wrap .comments_field input,
.comments_wrap .comments_field textarea,

/* Other */
.trx_addons_dropcap, 
blockquote,
table,
.post_tags a,
.author_info,
.related_wrap .related_item_style_2 .post_featured,
.related_wrap .related_item_style_2 .post_featured .mask,
.related_wrap .related_item_style_2 .post_header .post-categories li,
.post_layout_excerpt .post_meta .post_categories a,
.post_layout_portfolio .post_meta .post_categories a,
.post_layout_chess .post_meta .post_categories a,
.post_layout_classic .post_meta .post_categories a,
.post_layout_sticky .post_meta .post_categories a,
.my_style_orange .item .post_date,
.my_style_orange .item_open .t_close,
 #content .my_style_orange .item_open .t_close,
.select2-container .select2-choice,
.sc_layouts_menu_nav > li > ul,

/* Tags cloud */
.wp-block-tag-cloud a,
.widget_product_tag_cloud a,
.widget_tag_cloud a {
	-webkit-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}
.select_container:before {
	-webkit-border-radius: 0 {$rad} {$rad} 0;
	    -ms-border-radius: 0 {$rad} {$rad} 0;
			border-radius: 0 {$rad} {$rad} 0;
}
textarea.wp-editor-area {
	-webkit-border-radius: 0 0 {$rad} {$rad};
	    -ms-border-radius: 0 0 {$rad} {$rad};
			border-radius: 0 0 {$rad} {$rad};
}

/* Radius 50% or 0 */
.comments_list_wrap .comment_author_avatar img,
.author_avatar img {
	-webkit-border-radius: {$rad50};
	    -ms-border-radius: {$rad50};
			border-radius: {$rad50};
}


CSS;
		}


		// Theme colors
		//--------------------------------------
		if ($colors !== false) {
			$schemes = empty($only_scheme) ? array_keys(studeon_get_list_schemes()) : array($only_scheme);
	
			if (count($schemes) > 0) {
				$rez = array();
				foreach ($schemes as $scheme) {
					// Prepare colors
					if (empty($only_scheme)) $colors = studeon_get_scheme_colors($scheme);
	
					// Make theme-specific colors and tints
					$colors = studeon_customizer_add_theme_colors($colors);
			
					// Make styles
					$rez['colors'] = <<<CSS

/* Common tags */
h1, h2, h3, h4, h5, h6,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
li a {
	color: {$colors['text_dark']};
}
h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
li a:hover {
	color: {$colors['text_link']};
}

dt, b, strong, i, em, mark, ins {	
	color: {$colors['text_dark']};
}
s, strike, del {	
	color: {$colors['text_light']};
}

code {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
}
code a {
	color: {$colors['alter_link']};
}
code a:hover {
	color: {$colors['alter_hover']};
}

a {
	color: {$colors['text_link']};
}
a:hover {
	color: {$colors['text_hover']};
}

blockquote {
	color: {$colors['text_light']};
	background-color: {$colors['alter_bg_color']};
}
blockquote:before {
	color: {$colors['accent2']};
}
blockquote a {
	color: {$colors['text_dark']};
}
blockquote a:hover {
	color: {$colors['text_link']};
}

table th, table th + th, table td + th  {
	border-color: {$colors['bg_color_01']};
}
table td, table th + td, table td + td {
	color: {$colors['alter_dark']};
	border-color: {$colors['bg_color']};
}
table tr + tr + tr {
	border-top-color: {$colors['bg_color']};
}
table th {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}
table > tbody > tr:nth-child(2n+1) > td {
	background-color: {$colors['alter_bg_color']};
}
table > tbody > tr:nth-child(2n) > td {
	background-color: {$colors['alter_bg_color']};
}
table th a:hover {
	color: {$colors['bg_color']};
}

table.variations tr th.label {
	color: {$colors['text_dark']};
}

hr {
	border-color: {$colors['bd_color']};
}

.blocks-gallery-image figcaption,
figure figcaption,
.wp-caption .wp-caption-text,
.wp-caption .wp-caption-dd,
.wp-caption-overlay .wp-caption .wp-caption-text,
.wp-caption-overlay .wp-caption .wp-caption-dd {
	color: {$colors['text']}!important;
	background-color: {$colors['bg_color_08']}!important;
}
ul > li:before {
	color: {$colors['text_link']};
}

/* Form fields */


button[disabled],
input[type="submit"][disabled],
input[type="button"][disabled] {
    background-color: {$colors['text_light']} !important;
    color: {$colors['text']} !important;
}

fieldset {
	border-color: {$colors['bd_color']};
}
fieldset legend {
	color: {$colors['text_dark']};
	background-color: {$colors['bg_color']};
}

::-webkit-input-placeholder { color: {$colors['text_light']}; }
::-moz-placeholder          { color: {$colors['text_light']}; }
:-ms-input-placeholder      { color: {$colors['text_light']}; }

input[type="text"],
input[type="number"],
input[type="email"],
input[type="tel"],
input[type="search"],
input[type="password"],
.select_container,
.select2-container .select2-choice,
textarea,
textarea.wp-editor-area {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_color']};
}
.select_container:before {
	border-color: {$colors['input_bd_color']};
}
input[type="text"]:not(tribe-common-form-control-text__input):focus,
input[type="number"]:focus,
input[type="email"]:focus,
input[type="tel"]:focus,
input[type="search"]:focus,
input[type="password"]:focus,
.select_container:hover,
select option:hover,
select option:focus,
.select2-container .select2-choice:hover,
textarea:focus,
textarea.wp-editor-area:focus {
	color: {$colors['input_dark']};
	border-color: {$colors['input_bd_hover']};
	background-color: {$colors['input_bg_hover']};
}
.select_container:before {
	color: {$colors['input_text']};
	background-color: {$colors['input_bg_color']};
}
.select_container:focus:before,
.select_container:hover:before {
	color: {$colors['input_dark']};
	background-color: {$colors['input_bg_hover']};
}
.select_container:after {
	color: {$colors['input_text']};
}
.select_container:focus:after,
.select_container:hover:after {
	color: {$colors['input_dark']};
}
.select_container select {
	color: {$colors['input_light']};
}

.select_container select:focus {
	color: {$colors['input_dark']};
	
}
form.wp-block-search button.wp-block-search__button:after,
.widget_search form:after,
.woocommerce.widget_product_search form:after,
.widget_display_search form:after,
#bbpress-forums #bbp-search-form:after {
	color: {$colors['input_light']};
}
form.wp-block-search:hover button.wp-block-search__button:after,
.widget_search form:hover:after,
.woocommerce.widget_product_search form:hover:after,
.widget_display_search form:hover:after,
#bbpress-forums #bbp-search-form:hover:after {
	color: {$colors['input_dark']};
}

input[type="radio"] + label:before,
input[type="checkbox"] + label:before,
input[type="checkbox"] + span:before{
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_color']};
}
.wp-block-search .wp-block-search__button,
button,
input[type="reset"],
input[type="submit"],
input[type="button"] {
	color: {$colors['inverse_link']};
	background-color: {$colors['accent2']};
}
.wp-block-search .wp-block-search__button:hover,
.wp-block-search .wp-block-search__button:focus,
input[type="submit"]:hover,
input[type="reset"]:hover,
input[type="button"]:hover,
button:hover,
input[type="submit"]:focus,
input[type="reset"]:focus,
input[type="button"]:focus,
button:focus {
	color: {$colors['inverse_link']};
	background-color: {$colors['accent2_blend']};
}
.wp-editor-container input[type="button"] {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
	color: {$colors['alter_dark']};
	-webkit-box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};
	    -ms-box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};
			box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};	
}
.wp-editor-container input[type="button"]:hover,
.wp-editor-container input[type="button"]:focus {
	background-color: {$colors['alter_bg_hover']};
	border-color: {$colors['alter_bd_hover']};
	color: {$colors['alter_link']};
}

.select2-results {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_hover']};
	background: {$colors['input_bg_color']};
}
.select2-results .select2-highlighted {
	color: {$colors['input_dark']};
	background: {$colors['input_bg_hover']};
}


/* WP Standard classes */
.sticky {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['bd_color']};
}
.sticky .label_sticky {
	border-top-color: {$colors['text_link']};
}
	

/* Page */
body {
	color: {$colors['text']};
	background-color: {$colors['bg_color']};
}
body.body_style_boxed {
	background-color: {$colors['bg_color_blend']};
}
body.body_style_boxed .page_content_wrap {
	background-color: {$colors['bg_color']};
}
#page_preloader,
.scheme_self.header_position_under .page_content_wrap,
.page_wrap {
	background-color: {$colors['bg_color']};
}
.preloader_wrap > div {
	background-color: {$colors['text_link']};
}

/* Header */
.scheme_self.top_panel_default {
	background-color: {$colors['alter_bg_color']};
}
.scheme_self.top_panel.with_bg_image:before {
	background-color: {$colors['bg_color_07']};
}
.scheme_self.top_panel .slider_engine_revo .slide_subtitle,
.top_panel .slider_engine_revo .slide_subtitle {
	color: {$colors['text_link']};
}
.top_panel_default .top_panel_title,
.scheme_self.top_panel_default .top_panel_title {
	background-color: {$colors['bg_color']};
}


/* Tabs */
.studeon_tabs .studeon_tabs_titles li a {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_color']};
}
.studeon_tabs .studeon_tabs_titles li a:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
.studeon_tabs .studeon_tabs_titles li.ui-state-active a {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}

/* Post layouts */
.post_item {
	color: {$colors['text']};
}
.post_meta,
.post_meta_item,
.post_meta_item a,
.post_meta_item:before,
.post_meta_item:hover:before,
.post_date a,
.post_date:before,
.post_info .post_info_item,
.post_info .post_info_item a,
.post_info_counters .post_counters_item,
.post_counters .socials_share .socials_caption:before,
.post_counters .socials_share .socials_caption:hover:before {
	color: {$colors['text_light']};
}
.post_date a:hover,
a.post_meta_item:hover,
.post_meta_item a:hover,
.post_info .post_info_item a:hover,
.post_info_counters .post_counters_item:hover {
	color: {$colors['text_dark']};
}
.post_item .post_title a:hover {
	color: {$colors['text_link']};
}

.post_meta_item.post_categories a {
	background-color: {$colors['accent2']};
	color: {$colors['inverse_link']};
}
.post_meta_item.post_categories a:hover {
	background-color: {$colors['text_dark']};
	color: {$colors['inverse_link']};
}
.sc_layouts_title .post_meta_item.post_categories a,
.sc_layouts_title .post_meta_item.post_categories a:hover {
	background-color: transparent;
}

.post_meta_item .socials_share .social_items {
	background-color: {$colors['bg_color']};
}
.post_meta_item .social_items,
.post_meta_item .social_items:before {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
	color: {$colors['text_light']};
}

.post_layout_classic {
	border-color: {$colors['bd_color']};
}

.scheme_self.gallery_preview:before {
	background-color: {$colors['bg_color']};
}
.scheme_self.gallery_preview {
	color: {$colors['text']};
}

/* Post Formats */
.format-audio .post_featured .post_audio_author {
	color: {$colors['text_light']};
}
.format-audio .post_featured.without_thumb .post_audio {
	border-color: {$colors['alter_bg_color']};
	background-color: {$colors['alter_bd_color']};
}
.format-audio .post_featured.without_thumb .post_audio_title { 
	color: {$colors['text_link']};
}
.without_thumb .mejs-controls .mejs-currenttime,
.without_thumb .mejs-controls .mejs-duration {
	color: {$colors['text_light']};
}

.mejs-container,
.mejs-container .mejs-controls,
.mejs-embed,
.mejs-embed body {
	background: {$colors['text_dark_07']};
}

.mejs-controls .mejs-button,
.mejs-controls .mejs-time-rail .mejs-time-current,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
	color: {$colors['inverse_link']};
	background: {$colors['text_link']};
}
.mejs-controls .mejs-button:hover {
	color: {$colors['inverse_hover']};
	background: {$colors['inverse_link']};
}
.mejs-controls .mejs-time-rail .mejs-time-total,
.mejs-controls .mejs-time-rail .mejs-time-loaded,
.mejs-container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total {
	background: rgba(255,255,255,0.1) !important;
}

.format-aside .post_content_inner {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_color']};
}

.format-link .post_content_inner,
.format-status .post_content_inner {
	color: {$colors['text_dark']};
}

.format-chat p > b,
.format-chat p > strong {
	color: {$colors['text_dark']};
}

.post_layout_chess .post_content_inner:after {
	background: linear-gradient(to top, {$colors['bg_color']} 0%, {$colors['bg_color_0']} 100%) no-repeat scroll right top / 100% 100% {$colors['bg_color_0']};
}
.post_layout_chess_1 .post_meta:before {
	background-color: {$colors['bd_color']};
}

/* Pagination */
.nav-links-old a,
.nav-links-old {
	color: {$colors['text_dark']};
}
.nav-links-old a:hover {
	color: {$colors['text_link']};
	border-color: transparent;
}

.page_links > a,
.comments_pagination .page-numbers,
.nav-links .page-numbers {
	color: {$colors['text_dark']};
	background-color: {$colors['input_bg_color']};
}
.page_links > a:hover,
.page_links > span:not(.page_links_title),
.comments_pagination a.page-numbers:hover,
.comments_pagination .page-numbers.current,
.nav-links a.page-numbers:hover,
.nav-links .page-numbers.current {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}

/* Single post */
.post_item_single .post_header .post_date {
	color: {$colors['text_light']};
}
.post_item_single .post_header .post_categories,
.post_item_single .post_header .post_categories a {
	color: {$colors['text_link']};
}
.post_item_single .post_header .post_meta_item,
.post_item_single .post_header .post_meta_item:before,
.post_item_single .post_header .post_meta_item:hover:before,
.post_item_single .post_header .post_meta_item a,
.post_item_single .post_header .post_meta_item a:before,
.post_item_single .post_header .post_meta_item a:hover:before,
.post_item_single .post_header .post_meta_item .socials_caption,
.post_item_single .post_header .post_meta_item .socials_caption:before,
.post_item_single .post_header .post_edit a {
	color: {$colors['text_light']};
}
.post_item_single .post_meta_item:hover,
.post_item_single .post_meta_item > a:hover,
.post_item_single .post_meta_item .socials_caption:hover,
.post_item_single .post_edit a:hover {
	color: {$colors['text_hover']};
}
.post_item_single .post_content .post_meta_label,
.post_item_single .post_content .post_meta_item:hover .post_meta_label {
	color: {$colors['text_dark']};
}
.post_item_single .post_content .post_tags {
	color: {$colors['text_dark']};.post_item_single .post_content .post_meta .post_share .social_item a
}
.post_item_single .post_content .post_tags a {
	background-color: {$colors['accent2']};
	color: {$colors['inverse_link']};
}
.post_item_single .post_content .post_tags a:hover {
	background-color: {$colors['text_dark']};
	color: {$colors['inverse_link']};
}
.post_item_single .post_content .post_meta .post_share .social_item a {
	color: {$colors['text_light']} !important;
	background-color: transparent;
}
.post_item_single .post_content .post_meta .post_share .social_item a:hover {
	color: {$colors['accent2']} !important;
	background-color: transparent;
}

.post-password-form input[type="submit"] {
	border-color: {$colors['text_dark']};
}
.post-password-form input[type="submit"]:hover,
.post-password-form input[type="submit"]:focus {
	color: {$colors['bg_color']};
}

/* Single post navi */
.nav-links-single .nav-links {
	border-color: {$colors['bd_color']};
}
.nav-links-single .nav-links a .meta-nav {
	color: {$colors['text_light']};
}
.nav-links-single .nav-links a .post_date {
	color: {$colors['text_light']};
}
.nav-links-single .nav-links a:hover .meta-nav,
.nav-links-single .nav-links a:hover .post_date {
	color: {$colors['text_dark']};
}
.nav-links-single .nav-links a:hover .post-title {
	color: {$colors['text_link']};
}

/* Author info */
.scheme_self.author_info {
	color: {$colors['text']};
	background-color: {$colors['alter_bg_color']};
}
.scheme_self.author_info .author_title {
	color: {$colors['text_dark']};
}
.scheme_self.author_info a {
	color: {$colors['text_dark']};
}
.scheme_self.author_info a:hover {
	color: {$colors['text_link']};
}

/* Related posts */
.related_wrap .related_item_style_1 .post_header {
	background-color: {$colors['bg_color_07']};
}
.related_wrap .related_item_style_1:hover .post_header {
	background-color: {$colors['bg_color']};
}
.related_wrap .related_item_style_1 .post_date a {
	color: {$colors['text']};
}
.related_wrap .related_item_style_1:hover .post_date a {
	color: {$colors['text_light']};
}
.related_wrap .related_item_style_1:hover .post_date a:hover {
	color: {$colors['text_dark']};
}
.related_wrap .related_item_style_2 .post_header .post-categories li a {
	color: {$colors['inverse_link']};
}
.related_wrap .related_item_style_2 .post_header .post-categories li {
	background-color: {$colors['accent2']};
	color: {$colors['inverse_link']};
}
.related_wrap .related_item_style_2 .post_header .post-categories li a:hover,
.related_wrap .related_item_style_2 .post_header .post-categories li:hover a {
	color: {$colors['inverse_link']};
}
.related_wrap .related_item_style_2 .post_header .post-categories li:hover {
	background-color: {$colors['text_dark']};
	color: {$colors['inverse_link']};
}
.related_wrap .related_item_style_2 .post_author a,
.related_wrap .related_item_style_2 .post_author,
.related_wrap .related_item_style_2 .post_date a,
.related_wrap .related_item_style_2 .post_date {
	color: {$colors['text_light']};
}
.related_wrap .related_item_style_2 .post_author a:hover,
.related_wrap .related_item_style_2 .post_date a:hover {
	color: {$colors['text_dark']};
}
/* Comments */
.comments_list_wrap > ul {
	border-color: {$colors['bd_color']};
}
.comments_list_wrap li + li,
.comments_list_wrap li ul {
	border-color: {$colors['bd_color']};
}
.comments_list_wrap .comment_info {
	color: {$colors['text_dark']};
}
.comments_list_wrap .comment_info .comment_date:before,
.comments_list_wrap .comment_info .comment_date {
	color: {$colors['text_light']};
}
.comments_list_wrap .comment_counters a {
	color: {$colors['text_link']};
}
.comments_list_wrap .comment_counters a:before {
	color: {$colors['text_link']};
}
.comments_list_wrap .comment_counters a:hover:before,
.comments_list_wrap .comment_counters a:hover {
	color: {$colors['text_hover']};
}
.comments_list_wrap .comment_text {
	color: {$colors['text']};
}
.comments_list_wrap .comment_reply a {
	color: {$colors['text_link']};
}
.comments_list_wrap .comment_reply a:hover {
	color: {$colors['text_hover']};
}
.comments_wrap .comments_notes {
	color: {$colors['text_light']};
}


/* Page 404 */
.post_item_404 .page_title {
	color: {$colors['text_light']};
}
.post_item_404 .page_description {
	color: {$colors['text_link']};
}
.post_item_404 .go_home:hover {
	color: {$colors['inverse_link']} !important;
}

/* Sidebar */
.scheme_self.sidebar .sidebar_inner {
	background-color: {$colors['alter_bg_color']};
	color: {$colors['alter_text']};
}
.sidebar_inner .widget + .widget {
	border-color: {$colors['bd_color']};
}
.scheme_self.sidebar .widget + .widget {
	border-color: {$colors['alter_bd_color']};
}
.scheme_self.sidebar h1, .scheme_self.sidebar h2, .scheme_self.sidebar h3, .scheme_self.sidebar h4, .scheme_self.sidebar h5, .scheme_self.sidebar h6,
.scheme_self.sidebar h1 a, .scheme_self.sidebar h2 a, .scheme_self.sidebar h3 a, .scheme_self.sidebar h4 a, .scheme_self.sidebar h5 a, .scheme_self.sidebar h6 a {
	color: {$colors['alter_dark']};
}
.scheme_self.sidebar h1 a:hover, .scheme_self.sidebar h2 a:hover, .scheme_self.sidebar h3 a:hover, .scheme_self.sidebar h4 a:hover, .scheme_self.sidebar h5 a:hover, .scheme_self.sidebar h6 a:hover {
	color: {$colors['alter_link']};
}


/* Widgets */
ul.wp-block-rss li:before,
ul.wp-block-page-list li:before,
ul.wp-block-archives-list li:before,
ul.wp-block-categories-list li:before,
ul.wp-block-categories__list li:before,
.widget li:before {
	color: {$colors['accent2']};
}
ul.wp-block-rss li:hover:before,
ul.wp-block-page-list li:hover:before,
ul.wp-block-archives-list li:hover:before,
ul.wp-block-categories-list li:hover:before,
ul.wp-block-categories__list li:hover:before,
.widget li:hover:before {
	color: {$colors['text_link']};
}
.scheme_self.sidebar a {
	color: {$colors['alter_link']};
}
.scheme_self.sidebar a:hover {
	color: {$colors['alter_hover']};
}
.scheme_self.sidebar li > a,
.scheme_self.sidebar .post_title > a {
	color: {$colors['alter_dark']};
}
.scheme_self.sidebar li > a:hover,
.scheme_self.sidebar .post_title > a:hover {
	color: {$colors['alter_link']};
}

/* Archive */
.scheme_self.sidebar .widget_archive li {
	color: {$colors['alter_dark']};
}

/* Calendar */
.wp-block-calendar caption,
.wp-block-calendar tbody td a,
.wp-block-calendar th,
.widget_calendar caption,
.widget_calendar tbody td a,
.widget_calendar th {
	color: {$colors['text_dark']};
}
.scheme_self.sidebar .widget_calendar caption,
.scheme_self.sidebar .widget_calendar tbody td a,
.scheme_self.sidebar .widget_calendar th {
	color: {$colors['alter_dark']};
}
.wp-block-calendar tbody td,
.widget_calendar tbody td {
	color: {$colors['text']} !important;
}
.scheme_self.sidebar .widget_calendar tbody td {
	color: {$colors['alter_text']} !important;
}
.wp-block-calendar tbody td a:hover,
.widget_calendar tbody td a:hover {
	color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_calendar tbody td a:hover {
	color: {$colors['alter_link']};
}
.wp-block-calendar tbody td a:after,
.widget_calendar tbody td a:after {
	background-color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_calendar tbody td a:after {
	background-color: {$colors['alter_link']};
}
.widget_calendar td#today {
	color: {$colors['inverse_text']} !important;
}
.widget_calendar td#today a {
	color: {$colors['inverse_link']};
}
.widget_calendar td#today a:hover {
	color: {$colors['inverse_hover']};
}
.widget_calendar td#today:before {
	background-color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_calendar td#today:before {
	background-color: {$colors['alter_link']};
}
.widget_calendar td#today a:after {
	background-color: {$colors['inverse_link']};
}
.widget_calendar td#today a:hover:after {
	background-color: {$colors['inverse_hover']};
}
.widget_calendar td#prev a,
.widget_calendar td#next a,
.widget_calendar .wp-calendar-nav a,
.wp-block-calendar td#prev a,
.wp-block-calendar td#next a,
.wp-block-calendar .wp-calendar-nav a {
	color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_calendar td#prev a,
.scheme_self.sidebar .widget_calendar td#next a,
.scheme_self.sidebar .widget_calendar .wp-calendar-nav a,
.scheme_self.sidebar .wp-block-calendar td#prev a,
.scheme_self.sidebar .wp-block-calendar td#next a,
.scheme_self.sidebar .wp-block-calendar .wp-calendar-nav a {
	color: {$colors['alter_link']};
}
.widget_calendar td#prev a:hover,
.widget_calendar td#next a:hover,
.widget_calendar .wp-calendar-nav a:hover,
.wp-block-calendar td#prev a:hover,
.wp-block-calendar td#next a:hover,
.wp-block-calendar .wp-calendar-nav a:hover {
	color: {$colors['text_hover']};
}
.scheme_self.sidebar .widget_calendar td#prev a:hover,
.scheme_self.sidebar .widget_calendar td#next a:hover,
.scheme_self.sidebar .widget_calendar .wp-calendar-nav a:hover,
.scheme_self.sidebar .wp-block-calendar td#prev a:hover,
.scheme_self.sidebar .wp-block-calendar td#next a:hover,
.scheme_self.sidebar .wp-block-calendar .wp-calendar-nav a:hover {
	color: {$colors['alter_hover']};
}
.widget_calendar td#prev a:before,
.widget_calendar td#next a:before,
.widget_calendar .wp-calendar-nav a:before,
.wp-block-calendar td#prev a:before,
.wp-block-calendar td#next a:before,
.wp-block-calendar .wp-calendar-nav a:before {
	background-color: {$colors['bg_color']};
}
.scheme_self.sidebar .widget_calendar td#prev a:before,
.scheme_self.sidebar .widget_calendar td#next a:before,
.scheme_self.sidebar .widget_calendar .wp-calendar-nav a:before,
.scheme_self.sidebar .wp-block-calendar td#prev a:before,
.scheme_self.sidebar .wp-block-calendar td#next a:before,
.scheme_self.sidebar .wp-block-calendar .wp-calendar-nav a:before {
	background-color: {$colors['alter_bg_color']};
}

/* Categories */
.widget_categories li {
	color: {$colors['text_dark']};
}
.scheme_self.sidebar .widget_categories li {
	color: {$colors['alter_dark']};
}

/* Tag cloud */
.wp-block-tag-cloud a,
.widget_product_tag_cloud a,
.widget_tag_cloud a {
	color: {$colors['text_dark']};
	background-color: {$colors['alter_bg_color']};
}
.scheme_self.sidebar .widget_product_tag_cloud a,
.scheme_self.sidebar .widget_tag_cloud a {
	color: {$colors['text_link']};
	background-color: {$colors['alter_bg_color']};
}
.wp-block-tag-cloud a:hover,
.widget_product_tag_cloud a:hover,
.widget_tag_cloud a:hover {
	color: {$colors['text_link']} !important;
	background-color: {$colors['alter_bg_color']};
}
.scheme_self.sidebar .widget_product_tag_cloud a:hover,
.scheme_self.sidebar .widget_tag_cloud a:hover {
	background-color: {$colors['alter_bg_color']};
}

/* RSS */
.widget_rss .widget_title a:first-child {
	color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_rss .widget_title a:first-child {
	color: {$colors['alter_link']};
}
.widget_rss .widget_title a:first-child:hover {
	color: {$colors['text_hover']};
}
.scheme_self.sidebar .widget_rss .widget_title a:first-child:hover {
	color: {$colors['alter_hover']};
}
.widget_rss .rss-date {
	color: {$colors['text_light']};
}
.scheme_self.sidebar .widget_rss .rss-date {
	color: {$colors['alter_light']};
}

/* Footer */
.scheme_self.footer_wrap,
.footer_wrap .scheme_self.vc_row {
	background-color: {$colors['bg_color']};
	color: {$colors['input_text']};
}
.scheme_self.footer_wrap .widget,
.scheme_self.footer_wrap .sc_content .wpb_column,
.footer_wrap .scheme_self.vc_row .widget,
.footer_wrap .scheme_self.vc_row .sc_content .wpb_column {
	border-color: {$colors['alter_bd_color']};
}
.scheme_self.footer_wrap h1, .scheme_self.footer_wrap h2, .scheme_self.footer_wrap h3,
.scheme_self.footer_wrap h4, .scheme_self.footer_wrap h5, .scheme_self.footer_wrap h6,
.scheme_self.footer_wrap h1 a, .scheme_self.footer_wrap h2 a, .scheme_self.footer_wrap h3 a,
.scheme_self.footer_wrap h4 a, .scheme_self.footer_wrap h5 a, .scheme_self.footer_wrap h6 a,
.footer_wrap .scheme_self.vc_row h1, .footer_wrap .scheme_self.vc_row h2, .footer_wrap .scheme_self.vc_row h3,
.footer_wrap .scheme_self.vc_row h4, .footer_wrap .scheme_self.vc_row h5, .footer_wrap .scheme_self.vc_row h6,
.footer_wrap .scheme_self.vc_row h1 a, .footer_wrap .scheme_self.vc_row h2 a, .footer_wrap .scheme_self.vc_row h3 a,
.footer_wrap .scheme_self.vc_row h4 a, .footer_wrap .scheme_self.vc_row h5 a, .footer_wrap .scheme_self.vc_row h6 a {
	color: {$colors['alter_dark']};
}
.scheme_self.footer_wrap .widget_rss ul li a:hover,
.scheme_self.footer_wrap h1 a:hover, .scheme_self.footer_wrap h2 a:hover, .scheme_self.footer_wrap h3 a:hover,
.scheme_self.footer_wrap h4 a:hover, .scheme_self.footer_wrap h5 a:hover, .scheme_self.footer_wrap h6 a:hover,
.footer_wrap .scheme_self.vc_row h1 a:hover, .footer_wrap .scheme_self.vc_row h2 a:hover, .footer_wrap .scheme_self.vc_row h3 a:hover,
.footer_wrap .scheme_self.vc_row h4 a:hover, .footer_wrap .scheme_self.vc_row h5 a:hover, .footer_wrap .scheme_self.vc_row h6 a:hover,
.footer_wrap .scheme_self.vc_row .mcfwp-agree-input a:hover
 {
	color: {$colors['accent2']};
}
.scheme_self.footer_wrap .widget li:before,
.footer_wrap .scheme_self.vc_row .widget li:before {
	background-color: {$colors['alter_link']};
}
.scheme_self.footer_wrap a,
.footer_wrap .scheme_self.vc_row a {
	color: {$colors['alter_dark']};
}
.scheme_self.footer_wrap a:hover,
.footer_wrap .scheme_self.vc_row a:hover {
	color: {$colors['alter_link']};
}

.footer_logo_inner {
	border-color: {$colors['alter_bd_color']};
}
.footer_logo_inner:after {
	background-color: {$colors['alter_text']};
}
.footer_socials_inner .social_item .social_icons {
	border-color: {$colors['alter_text']};
	color: {$colors['alter_text']};
}
.footer_socials_inner .social_item .social_icons:hover {
	border-color: {$colors['alter_dark']};
	color: {$colors['alter_dark']};
}
.menu_footer_nav_area ul li a {
	color: {$colors['alter_dark']};
}
.menu_footer_nav_area ul li a:hover {
	color: {$colors['alter_link']};
}
.menu_footer_nav_area ul li+li:before {
	border-color: {$colors['alter_light']};
}

.footer_copyright_inner {
	background-color: {$colors['alter_bg_color']} !important;
	border-color: {$colors['bd_color']} !important;
	color: {$colors['input_text']} !important;
}
.footer_copyright_inner a {
	color: {$colors['input_text']} !important;
}
.footer_copyright_inner a:hover {
	color: {$colors['accent2']} !important;
}
.footer_copyright_inner .copyright_text {
	color: {$colors['input_text']} !important;
}

/* Buttons */
.theme_button {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_link']} !important;
}
.theme_button:hover,
.theme_button:focus {
	color: {$colors['inverse_hover']} !important;
	background-color: {$colors['text_link_blend']} !important;
}
.socials_share:not(.socials_type_drop) .social_icons {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
.socials_share:not(.socials_type_drop) .social_icons:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link_blend']};
}
.is-style-outline>.wp-block-button__link:not(.has-background):hover, 
.wp-block-button__link.is-style-outline:not(.has-background):hover {
	color: {$colors['text_link']};
}

.more-link,
.comments_wrap .form-submit input[type="submit"] {
	color: {$colors['inverse_link']};
	background-color: {$colors['accent2']};
}
.more-link:hover,
.comments_wrap .form-submit input[type="submit"]:hover,
.comments_wrap .form-submit input[type="submit"]:focus {
	color: {$colors['inverse_link']};
	background-color: {$colors['accent2_blend']};
}

.format-video .post_featured.with_thumb .post_video_hover {
	color: {$colors['text_dark']};
	background-color: {$colors['alter_bg_color']};
}
.format-video .post_featured.with_thumb .post_video_hover:hover {
	color: {$colors['text_link']};
	background-color: {$colors['alter_bg_color']};
}

.theme_scroll_down:hover {
	color: {$colors['text_link']};
}

/* Third-party plugins */

.mfp-bg {
	background-color: {$colors['bg_color_07']};
}
.mfp-image-holder .mfp-close,
.mfp-iframe-holder .mfp-close,
.mfp-close-btn-in .mfp-close {
	color: {$colors['text_dark']};
	background-color: transparent;
}
.mfp-image-holder .mfp-close:hover,
.mfp-iframe-holder .mfp-close:hover,
.mfp-close-btn-in .mfp-close:hover {
	color: {$colors['text_link']};
}

/* Revolutions Slider */
.rev_slider .tparrows.custom {
	color: {$colors['inverse_link']};
}
.rev_slider .tparrows.custom:hover:before,
.rev_slider .tparrows.custom:hover {
	color: {$colors['text_link']};
}

/* Essential Grid */

.minimal-light .esg-filterbutton {
	color: {$colors['text']} !important;
}
.minimal-light .esg-filterbutton.selected,
.minimal-light .esg-filterbutton:hover {
	color: {$colors['text_link']} !important;
}
.minimal-light .esg-pagination-button {
	background-color: {$colors['alter_bg_color']} !important;
	color: {$colors['text_dark']} !important;
}
.minimal-light .esg-pagination-button.selected,
.minimal-light .esg-pagination-button:hover {
	background-color: {$colors['text_link']} !important;
	color: {$colors['inverse_link']} !important;
}

.header_style_header-default .wp-block-button__link {
	background-color: {$colors['text_link']} !important;
	color: {$colors['inverse_link']} !important;
}
.header_style_header-default .wp-block-button__link {
	background-color: {$colors['text_link']};
	color: {$colors['inverse_link']};
}
.header_style_header-default .wp-block-button__link:hover {
	background-color: {$colors['text_link_blend']} !important;
	color: {$colors['inverse_link']};
}

.header_style_header-default .wp-block-button.is-style-outline .wp-block-button__link:hover {
	border-color: {$colors['text_link_blend']} !important;
	color: {$colors['text_link_blend']}!important;
}
.header_style_header-default .wp-block-button.is-style-outline .wp-block-button__link {
	border-color: {$colors['text_link']} !important;
	color: {$colors['text_link']}!important;
}

CSS;
				
					$rez = apply_filters('studeon_filter_get_css', $rez, $colors, false, $scheme);
					$css['colors'] .= $rez['colors'];
				}
			}
		}
				
		$css_str = (!empty($css['fonts']) ? $css['fonts'] : '')
				. (!empty($css['colors']) ? $css['colors'] : '');
		return apply_filters( 'studeon_filter_prepare_css', $css_str, $remove_spaces );
	}
}
?>