<?php
/**
 * Default Theme Options and Internal Theme Settings
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('studeon_options_theme_setup1') ) {
	add_action( 'after_setup_theme', 'studeon_options_theme_setup1', 1 );
	function studeon_options_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		studeon_storage_set('settings', array(
			
			'disable_jquery_ui'			=> false,						// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'max_load_fonts'			=> 4,							// Max fonts number to load from Google fonts or from uploaded fonts
		
			'use_mediaelements'			=> true,						// Load script "Media Elements" to play video and audio
		
			'max_excerpt_length'		=> 60,							// Max words number for the excerpt in the blog style 'Excerpt'.
																		// For style 'Classic' - get half from this value
			'message_maxlength'			=> 1000							// Max length of the message from contact form
			
		));
		
		
		
		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		
		studeon_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Raleway',
				'family' => 'sans-serif',
				'styles' => '100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i'		// Parameter 'style' used only for the Google fonts
				),
			array(
				'name'	 => 'Lora',
				'family' => 'serif',
				'styles' => '400,400i,700,700i'
				),
			array(
				'name'	 => 'Roboto',
				'family' => 'sans-serif',
				'styles' => '100,400'
				),
			// Font-face packed with theme
			array(
				'name'   => 'Montserrat',
				'family' => 'sans-serif'
				)
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		studeon_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		studeon_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'studeon'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'studeon'),
				'font-family'		=> 'Raleway, sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.857em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '2.857em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'studeon'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '3.286em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.13em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-2px',
				'margin-top'		=> '0.9583em',
				'margin-bottom'		=> '0.7em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'studeon'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '2.643em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.162em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1.3px',
				'margin-top'		=> '1.27em',
				'margin-bottom'		=> '0.92em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'studeon'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '1.429em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.55em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.3px',
				'margin-top'		=> '2.2em',
				'margin-bottom'		=> '0.95em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'studeon'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '1.286em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.3px',
				'margin-top'		=> '2.55em',
				'margin-bottom'		=> '1.1435em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'studeon'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '1.143em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.4375em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '2.9em',
				'margin-bottom'		=> '1.2em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'studeon'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '1.07em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.6em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '3.0em',
				'margin-bottom'		=> '1.3em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'studeon'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'studeon'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'studeon'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '11px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '2.1em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1.2px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'studeon'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'studeon'),
				'font-family'		=> 'Lora, sans-serif',
				'font-size' 		=> '13px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.77em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '1px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'studeon'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'studeon'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '12px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.9em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'studeon'),
				'description'		=> esc_html__('Font settings of the main menu items', 'studeon'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '13px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.77em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '2px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'studeon'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'studeon'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '11px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '2.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1.5px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		studeon_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'studeon'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#f5f5f7', // !
					'bd_color'				=> '#e6e6e8', // !
		
					// Text and links colors
					'text'					=> '#595959', // !
					'text_light'			=> '#8e8e8e', // !
					'text_dark'				=> '#111111', // !
					'text_link'				=> '#fc6b4f', // !
					'text_hover'			=> '#111111', // !
		
					// Alternative blocks (submenu, buttons, tabs, etc.)
					'alter_bg_color'		=> '#ffffff', // !
					'alter_bg_hover'		=> '#111111', // !
					'alter_bd_color'		=> '#292525', // !
					'alter_bd_hover'		=> '#1f1c1c', // !
					'alter_text'			=> '#333333', // !
					'alter_light'			=> '#b7b7b7', // !
					'alter_dark'			=> '#1d1d1d',
					'alter_link'			=> '#303030', // !
					'alter_hover'			=> '#fc6b4f', // !
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#ffffff', // !
					'input_bg_hover'		=> '#ffffff', // !
					'input_bd_color'		=> '#ffffff', // !
					'input_bd_hover'		=> '#ededed', // !
					'input_text'			=> '#595959', // !
					'input_light'			=> '#8e8e8e', // !
					'input_dark'			=> '#221c25', // !
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#ffffff', // !
					'inverse_light'			=> '#333333',
					'inverse_dark'			=> '#1f1c1b', // !
					'inverse_link'			=> '#ffffff', // !
					'inverse_hover'			=> '#333333', // !
		
					// Additional accented colors (if used in the current theme)
					
					'accent2'				=> '#2ac465'
				
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'studeon'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#1f1c1c', // !
					'bd_color'				=> '#272929', // !
		
					// Text and links colors
					'text'					=> '#b6afaf', // !
					'text_light'			=> '#8e8a8a', // !
					'text_dark'				=> '#ffffff', // !
					'text_link'				=> '#fc6b4f', // !
					'text_hover'			=> '#ffffff', // !
		
					// Alternative blocks (submenu, buttons, tabs, etc.)
					'alter_bg_color'		=> '#171515', // !
					'alter_bg_hover'		=> '#ffffff', // !
					'alter_bd_color'		=> '#292525', // !
					'alter_bd_hover'		=> '#1f1c1c', // !
					'alter_text'			=> '#dadada', // !
					'alter_light'			=> '#5f5f5f', // !
					'alter_dark'			=> '#ffffff',
					'alter_link'			=> '#ffffff', // !
					'alter_hover'			=> '#fc6b4f', // !
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#292525', // !
					'input_bg_hover'		=> '#292525', // !
					'input_bd_color'		=> '#292525', // !
					'input_bd_hover'		=> '#292525', // !
					'input_text'			=> '#b6afaf', // !
					'input_light'			=> '#8e8a8a', // !
					'input_dark'			=> '#ffffff', // !
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#1d1d1d', // !
					'inverse_light'			=> '#5f5f5f',
					'inverse_dark'			=> '#f1f1f1', // !
					'inverse_link'			=> '#ffffff', // !
					'inverse_hover'			=> '#333333', // !
				
					// Additional accented colors (if used in the current theme)
					
					'accent2'				=> '#2ac465'
		
				)
			)
		
		));
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('studeon_options_create')) {

	function studeon_options_create() {

		studeon_storage_set('options', array(
		
			// Section 'Title & Tagline' - add theme options in the standard WP section
			'title_tagline' => array(
				"title" => esc_html__('Title, Tagline & Site icon', 'studeon'),
				"desc" => wp_kses_data( __('Specify site title and tagline (if need) and upload the site icon', 'studeon') ),
				"type" => "section"
				),
		
		
			// Section 'Header' - add theme options in the standard WP section
			'header_image' => array(
				"title" => esc_html__('Header', 'studeon'),
				"desc" => wp_kses_data( __('Select or upload logo images, select header type and widgets set for the header', 'studeon') )
							. '<br>'
							. wp_kses_data( __('<b>Attention!</b> Some of these options can be overridden in the following sections (Homepage, Blog archive, Shop, Events, etc.) or in the settings of individual pages', 'studeon') ),
				"type" => "section"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'studeon'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'studeon')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_style' => array(
				"title" => esc_html__('Header style', 'studeon'),
				"desc" => wp_kses_data( __('Select style to display the site header', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'studeon')
				),
				"std" => 'header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'studeon'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'studeon')
				),
				"std" => 'default',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'studeon'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'studeon'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'studeon') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'studeon'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'studeon')
				),
				"dependency" => array(
					'header_style' => array('header-default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => studeon_get_list_range(0,6),
				"type" => "select"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'studeon'),
				"desc" => wp_kses_data( __('Select color scheme to decorate header area', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'studeon')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'studeon'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'studeon')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'studeon'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'studeon')
				),
				"dependency" => array(
					'header_style' => array('header-default')
				),
				"std" => 1,
				"type" => "checkbox"
				),

			'menu_info' => array(
				"title" => esc_html__('Menu settings', 'studeon'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'studeon') ),
				"type" => "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'studeon'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'studeon')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'studeon'),
					'left'	=> esc_html__('Left',	'studeon'),
					'right'	=> esc_html__('Right',	'studeon')
				),
				"type" => "hidden" //switch
				),
			'menu_scheme' => array(
				"title" => esc_html__('Menu Color Scheme', 'studeon'),
				"desc" => wp_kses_data( __('Select color scheme to decorate main menu area', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'studeon')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'studeon'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'studeon') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'studeon'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'studeon') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'studeon'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'studeon') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo settings', 'studeon'),
				"desc" => wp_kses_data( __('Select logo images for the normal and Retina displays', 'studeon') ),
				"type" => "info"
				),
			'logo' => array(
				"title" => esc_html__('Logo', 'studeon'),
				"desc" => wp_kses_data( __('Select or upload site logo', 'studeon') ),
				"std" => '',
				"type" => "image"
				),
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'studeon'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'studeon') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse' => array(
				"title" => esc_html__('Logo inverse', 'studeon'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it on the dark background', 'studeon') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse_retina' => array(
				"title" => esc_html__('Logo inverse for Retina', 'studeon'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'studeon') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'studeon'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'studeon') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'studeon'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'studeon') ),
				"std" => '',
				"type" => "image"
				),
			'logo_text' => array(
				"title" => esc_html__('Logo from Site name', 'studeon'),
				"desc" => wp_kses_data( __('Do you want use Site name and description as Logo if images above are not selected?', 'studeon') ),
				"std" => 1,
				"type" => "checkbox"
				),
			
		
		
			// Section 'Content'
			'content' => array(
				"title" => esc_html__('Content', 'studeon'),
				"desc" => wp_kses_data( __('Options for the content area.', 'studeon') )
							. '<br>'
							. wp_kses_data( __('<b>Attention!</b> Some of these options can be overridden in the following sections (Homepage, Blog archive, Shop, Events, etc.) or in the settings of individual pages', 'studeon') ),
				"type" => "section",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'studeon'),
				"desc" => wp_kses_data( __('Select width of the body content', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'studeon')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => array(
					'boxed'		=> esc_html__('Boxed',		'studeon'),
					'wide'		=> esc_html__('Wide',		'studeon'),
					'fullwide'	=> esc_html__('Fullwide',	'studeon'),
					'fullscreen'=> esc_html__('Fullscreen',	'studeon')
				),
				"type" => "select"
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'studeon'),
				"desc" => wp_kses_data( __('Select color scheme to decorate whole site. Attention! Case "Inherit" can be used only for custom pages, not for root site content in the Appearance - Customize', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'studeon')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'studeon'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'studeon') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'studeon')
				),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'studeon'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'studeon') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'studeon')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'studeon'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'studeon') ),
				"std" => 0,
				"type" => "checkbox"
				),
            'privacy_text' => array(
                "title" => esc_html__("Text with Privacy Policy link", 'studeon'),
                "desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'studeon') ),
                "std"   => wp_kses( __( 'I agree that my submitted data is being collected and stored.', 'studeon'),'studeon_kses_content' ),
                "type"  => "text"
            ),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'studeon'),
				"desc" => wp_kses_data( __('Specify the border radius of the form fields and buttons in pixels or other valid CSS units', 'studeon') ),
				"std" => 0,
				"type" => "text"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'studeon'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'studeon') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'studeon')
				),
				"std" => '',
				"type" => "image"
				),
			'no_image' => array(
				"title" => esc_html__('No image placeholder', 'studeon'),
				"desc" => wp_kses_data( __('Select or upload image, used as placeholder for the posts without featured image', 'studeon') ),
				"std" => '',
				"type" => "image"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'studeon'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'studeon') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'studeon')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'studeon'),
				"desc" => wp_kses_data( __('Select color scheme to decorate sidebar', 'studeon') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'studeon')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'studeon'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'studeon') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'studeon')
				),
				"refresh" => false,
				"std" => 'right',
				"options" => array(),
				"type" => "select"
				),
			'hide_sidebar_on_single' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'studeon'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'studeon') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets above the page', 'studeon'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'studeon')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'studeon'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'studeon')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'studeon'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'studeon')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets below the page', 'studeon'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'studeon')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
		
		
		
			// Section 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'studeon'),
				"desc" => wp_kses_data( __('Select set of widgets and columns number for the site footer', 'studeon') )
							. '<br>'
							. wp_kses_data( __('<b>Attention!</b> Some of these options can be overridden in the following sections (Homepage, Blog archive, Shop, Events, etc.) or in the settings of individual pages', 'studeon') ),
				"type" => "section"
				),
			'footer_style' => array(
				"title" => esc_html__('Footer style', 'studeon'),
				"desc" => wp_kses_data( __('Select style to display the site footer', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Footer', 'studeon')
				),
				"std" => 'footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'studeon'),
				"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'studeon') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'studeon')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'studeon'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'studeon') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'studeon')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'studeon'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'studeon') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'studeon')
				),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 3,
				"options" => studeon_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'studeon'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'studeon') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'studeon')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'studeon'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'studeon') ),
				'refresh' => false,
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'studeon'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'studeon') ),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'studeon'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'studeon') ),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'studeon'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'studeon') ),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'studeon'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'studeon') ),
				"std" => esc_html__('AxiomThemes &copy; {Y}. All rights reserved. Terms of use and Privacy Policy', 'studeon'),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
		
		
		
			// Section 'Homepage' - settings for home page
			'homepage' => array(
				"title" => esc_html__('Homepage', 'studeon'),
				"desc" => wp_kses_data( __('Select blog style and widgets to display on the homepage', 'studeon') ),
				"type" => "section"
				),
			'expand_content_home' => array(
				"title" => esc_html__('Expand content', 'studeon'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the Homepage', 'studeon') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style_home' => array(
				"title" => esc_html__('Blog style', 'studeon'),
				"desc" => wp_kses_data( __('Select posts style for the homepage', 'studeon') ),
				"std" => 'excerpt',
				"options" => array(),
				"type" => "select"
				),
			'first_post_large_home' => array(
				"title" => esc_html__('First post large', 'studeon'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of the Homepage', 'studeon') ),
				"dependency" => array(
					'blog_style_home' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_style_home' => array(
				"title" => esc_html__('Header style', 'studeon'),
				"desc" => wp_kses_data( __('Select style to display the site header on the homepage', 'studeon') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_position_home' => array(
				"title" => esc_html__('Header position', 'studeon'),
				"desc" => wp_kses_data( __('Select position to display the site header on the homepage', 'studeon') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets_home' => array(
				"title" => esc_html__('Header widgets', 'studeon'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the homepage', 'studeon') ),
				"std" => 'header_widgets',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_widgets_home' => array(
				"title" => esc_html__('Sidebar widgets', 'studeon'),
				"desc" => wp_kses_data( __('Select sidebar to show on the homepage', 'studeon') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_position_home' => array(
				"title" => esc_html__('Sidebar position', 'studeon'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the homepage', 'studeon') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_page_home' => array(
				"title" => esc_html__('Widgets above the page', 'studeon'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'studeon') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content_home' => array(
				"title" => esc_html__('Widgets above the content', 'studeon'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'studeon') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content_home' => array(
				"title" => esc_html__('Widgets below the content', 'studeon'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'studeon') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page_home' => array(
				"title" => esc_html__('Widgets below the page', 'studeon'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'studeon') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			
		
		
			// Section 'Blog archive'
			'blog' => array(
				"title" => esc_html__('Blog archive', 'studeon'),
				"desc" => wp_kses_data( __('Options for the blog archive', 'studeon') ),
				"type" => "section",
				),
			'expand_content_blog' => array(
				"title" => esc_html__('Expand content', 'studeon'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the blog archive', 'studeon') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style' => array(
				"title" => esc_html__('Blog style', 'studeon'),
				"desc" => wp_kses_data( __('Select posts style for the blog archive', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'studeon')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"std" => 'excerpt',
				"options" => array(),
				"type" => "select"
				),
			'blog_columns' => array(
				"title" => esc_html__('Blog columns', 'studeon'),
				"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'studeon') ),
				"std" => 2,
				"options" => studeon_get_list_range(2,4),
				"type" => "hidden"
				),
			'post_type' => array(
				"title" => esc_html__('Post type', 'studeon'),
				"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'studeon')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"linked" => 'parent_cat',
				"refresh" => false,
				"hidden" => true,
				"std" => 'post',
				"options" => array(),
				"type" => "select"
				),
			'parent_cat' => array(
				"title" => esc_html__('Category to show', 'studeon'),
				"desc" => wp_kses_data( __('Select category to show in the blog archive', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'studeon')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"refresh" => false,
				"hidden" => true,
				"std" => '0',
				"options" => array(),
				"type" => "select"
				),
			'posts_per_page' => array(
				"title" => esc_html__('Posts per page', 'studeon'),
				"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'studeon')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"hidden" => true,
				"std" => '10',
				"type" => "text"
				),
			"blog_pagination" => array( 
				"title" => esc_html__('Pagination style', 'studeon'),
				"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'studeon')
				),
				"std" => "links",
				"options" => array(
					'pages'	=> esc_html__("Page numbers", 'studeon'),
					'links'	=> esc_html__("Older/Newest", 'studeon'),
					'more'	=> esc_html__("Load more", 'studeon'),
					'infinite' => esc_html__("Infinite scroll", 'studeon')
				),
				"type" => "select"
				),
			'show_filters' => array(
				"title" => esc_html__('Show filters', 'studeon'),
				"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'studeon')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
					'blog_style' => array('portfolio', 'gallery')
				),
				"hidden" => true,
				"std" => 0,
				"type" => "checkbox"
				),
			'first_post_large' => array(
				"title" => esc_html__('First post large', 'studeon'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of blog archive', 'studeon') ),
				"dependency" => array(
					'blog_style' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			"blog_content" => array( 
				"title" => esc_html__('Posts content', 'studeon'),
				"desc" => wp_kses_data( __("Show full post's content in the blog or only post's excerpt", 'studeon') ),
				"std" => "excerpt",
				"options" => array(
					'excerpt'	=> esc_html__('Excerpt',	'studeon'),
					'fullpost'	=> esc_html__('Full post',	'studeon')
				),
				"type" => "select"
				),
			'time_diff_before' => array(
				"title" => esc_html__('Time difference', 'studeon'),
				"desc" => wp_kses_data( __("How many days show time difference instead post's date", 'studeon') ),
				"std" => 5,
				"type" => "text"
				),
			'related_posts' => array(
				"title" => esc_html__('Related posts', 'studeon'),
				"desc" => wp_kses_data( __('How many related posts should be displayed in the single post?', 'studeon') ),
				"std" => 2,
				"options" => studeon_get_list_range(2,4),
				"type" => "select"
				),
			'related_style' => array(
				"title" => esc_html__('Related posts style', 'studeon'),
				"desc" => wp_kses_data( __('Select style of the related posts output', 'studeon') ),
				"std" => 2,
				"options" => studeon_get_list_styles(1,2),
				"type" => "hidden" //select
				),
			"blog_animation" => array( 
				"title" => esc_html__('Animation for the posts', 'studeon'),
				"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'studeon')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"std" => "none",
				"options" => array(),
				"type" => "select"
				),
			'header_style_blog' => array(
				"title" => esc_html__('Header style', 'studeon'),
				"desc" => wp_kses_data( __('Select style to display the site header on the blog archive', 'studeon') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_position_blog' => array(
				"title" => esc_html__('Header position', 'studeon'),
				"desc" => wp_kses_data( __('Select position to display the site header on the blog archive', 'studeon') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets_blog' => array(
				"title" => esc_html__('Header widgets', 'studeon'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the blog archive', 'studeon') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_widgets_blog' => array(
				"title" => esc_html__('Sidebar widgets', 'studeon'),
				"desc" => wp_kses_data( __('Select sidebar to show on the blog archive', 'studeon') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_position_blog' => array(
				"title" => esc_html__('Sidebar position', 'studeon'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the blog archive', 'studeon') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'hide_sidebar_on_single_blog' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'studeon'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post", 'studeon') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'widgets_above_page_blog' => array(
				"title" => esc_html__('Widgets above the page', 'studeon'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'studeon') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content_blog' => array(
				"title" => esc_html__('Widgets above the content', 'studeon'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'studeon') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content_blog' => array(
				"title" => esc_html__('Widgets below the content', 'studeon'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'studeon') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page_blog' => array(
				"title" => esc_html__('Widgets below the page', 'studeon'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'studeon') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			
		
		
		
			// Section 'Colors' - choose color scheme and customize separate colors from it
			'scheme' => array(
				"title" => esc_html__('* Color scheme editor', 'studeon'),
				"desc" => wp_kses_data( __("<b>Simple settings</b> - you can change only accented color, used for links, buttons and some accented areas.", 'studeon') )
						. '<br>'
						. wp_kses_data( __("<b>Advanced settings</b> - change all scheme's colors and get full control over the appearance of your site!", 'studeon') ),
				"priority" => 1000,
				"type" => "section"
				),
		
			'color_settings' => array(
				"title" => esc_html__('Color settings', 'studeon'),
				"desc" => '',
				"std" => 'simple',
				"options" => array(
					"simple"  => esc_html__("Simple", 'studeon'),
					"advanced" => esc_html__("Advanced", 'studeon')
				),
				"refresh" => false,
				"type" => "switch"
				),
		
			'color_scheme_editor' => array(
				"title" => esc_html__('Color Scheme', 'studeon'),
				"desc" => wp_kses_data( __('Select color scheme to edit colors', 'studeon') ),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
		
			'scheme_storage' => array(
				"title" => esc_html__('Colors storage', 'studeon'),
				"desc" => esc_html__('Hidden storage of the all color from the all color shemes (only for internal usage)', 'studeon'),
				"std" => '',
				"refresh" => false,
				"type" => "hidden"
				),
		
			'scheme_info_single' => array(
				"title" => esc_html__('Colors for single post/page', 'studeon'),
				"desc" => wp_kses_data( __('Specify colors for single post/page (not for alter blocks)', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
				
			'bg_color' => array(
				"title" => esc_html__('Background color', 'studeon'),
				"desc" => wp_kses_data( __('Background color of the whole page', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'bd_color' => array(
				"title" => esc_html__('Border color', 'studeon'),
				"desc" => wp_kses_data( __('Color of the bordered elements, separators, etc.', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'text' => array(
				"title" => esc_html__('Text', 'studeon'),
				"desc" => wp_kses_data( __('Plain text color on single page/post', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_light' => array(
				"title" => esc_html__('Light text', 'studeon'),
				"desc" => wp_kses_data( __('Color of the post meta: post date and author, comments number, etc.', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_dark' => array(
				"title" => esc_html__('Dark text', 'studeon'),
				"desc" => wp_kses_data( __('Color of the headers, strong text, etc.', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_link' => array(
				"title" => esc_html__('Links', 'studeon'),
				"desc" => wp_kses_data( __('Color of links and accented areas', 'studeon') ),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_hover' => array(
				"title" => esc_html__('Links hover', 'studeon'),
				"desc" => wp_kses_data( __('Hover color for links and accented areas', 'studeon') ),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_alter' => array(
				"title" => esc_html__('Colors for alternative blocks', 'studeon'),
				"desc" => wp_kses_data( __('Specify colors for alternative blocks - rectangular blocks with its own background color (posts in homepage, blog archive, search results, widgets on sidebar, footer, etc.)', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'alter_bg_color' => array(
				"title" => esc_html__('Alter background color', 'studeon'),
				"desc" => wp_kses_data( __('Background color of the alternative blocks', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bg_hover' => array(
				"title" => esc_html__('Alter hovered background color', 'studeon'),
				"desc" => wp_kses_data( __('Background color for the hovered state of the alternative blocks', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_color' => array(
				"title" => esc_html__('Alternative border color', 'studeon'),
				"desc" => wp_kses_data( __('Border color of the alternative blocks', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_hover' => array(
				"title" => esc_html__('Alternative hovered border color', 'studeon'),
				"desc" => wp_kses_data( __('Border color for the hovered state of the alter blocks', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_text' => array(
				"title" => esc_html__('Alter text', 'studeon'),
				"desc" => wp_kses_data( __('Text color of the alternative blocks', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_light' => array(
				"title" => esc_html__('Alter light', 'studeon'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with alternative background', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_dark' => array(
				"title" => esc_html__('Alter dark', 'studeon'),
				"desc" => wp_kses_data( __('Color of the headers inside block with alternative background', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_link' => array(
				"title" => esc_html__('Alter link', 'studeon'),
				"desc" => wp_kses_data( __('Color of the links inside block with alternative background', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_hover' => array(
				"title" => esc_html__('Alter hover', 'studeon'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with alternative background', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_input' => array(
				"title" => esc_html__('Colors for the form fields', 'studeon'),
				"desc" => wp_kses_data( __('Specify colors for the form fields and textareas', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'input_bg_color' => array(
				"title" => esc_html__('Inactive background', 'studeon'),
				"desc" => wp_kses_data( __('Background color of the inactive form fields', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bg_hover' => array(
				"title" => esc_html__('Active background', 'studeon'),
				"desc" => wp_kses_data( __('Background color of the focused form fields', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_color' => array(
				"title" => esc_html__('Inactive border', 'studeon'),
				"desc" => wp_kses_data( __('Color of the border in the inactive form fields', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_hover' => array(
				"title" => esc_html__('Active border', 'studeon'),
				"desc" => wp_kses_data( __('Color of the border in the focused form fields', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_text' => array(
				"title" => esc_html__('Inactive field', 'studeon'),
				"desc" => wp_kses_data( __('Color of the text in the inactive fields', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_light' => array(
				"title" => esc_html__('Disabled field', 'studeon'),
				"desc" => wp_kses_data( __('Color of the disabled field', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_dark' => array(
				"title" => esc_html__('Active field', 'studeon'),
				"desc" => wp_kses_data( __('Color of the active field', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_inverse' => array(
				"title" => esc_html__('Colors for inverse blocks', 'studeon'),
				"desc" => wp_kses_data( __('Specify colors for inverse blocks, rectangular blocks with background color equal to the links color or one of accented colors (if used in the current theme)', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'inverse_text' => array(
				"title" => esc_html__('Inverse text', 'studeon'),
				"desc" => wp_kses_data( __('Color of the text inside block with accented background', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_light' => array(
				"title" => esc_html__('Inverse light', 'studeon'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with accented background', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_dark' => array(
				"title" => esc_html__('Inverse dark', 'studeon'),
				"desc" => wp_kses_data( __('Color of the headers inside block with accented background', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_link' => array(
				"title" => esc_html__('Inverse link', 'studeon'),
				"desc" => wp_kses_data( __('Color of the links inside block with accented background', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_hover' => array(
				"title" => esc_html__('Inverse hover', 'studeon'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with accented background', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'accent2' => array(
				"title" => esc_html__('Accent', 'studeon'),
				"desc" => wp_kses_data( __('Accent color', 'studeon') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$studeon_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),


			// Section 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'studeon'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'studeon') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'studeon')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'studeon'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'studeon') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'studeon')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// Panel 'Fonts' - manage fonts loading and set parameters of the base theme elements
			'fonts' => array(
				"title" => esc_html__('* Fonts settings', 'studeon'),
				"desc" => '',
				"priority" => 1500,
				"type" => "panel"
				),

			// Section 'Load_fonts'
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'studeon'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'studeon') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'studeon') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'studeon'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'studeon') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'studeon') ),
				"refresh" => false,
				"std" => '$studeon_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=studeon_get_theme_setting('max_load_fonts'); $i++) {
			$fonts["load_fonts-{$i}-info"] = array(
				"title" => esc_html(sprintf(esc_html__('Font %s', 'studeon'), $i)),
				"desc" => '',
				"type" => "info",
				);
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'studeon'),
				"desc" => '',
				"refresh" => false,
				"std" => '$studeon_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'studeon'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'studeon') )
							: '',
				"refresh" => false,
				"std" => '$studeon_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'studeon'),
					'serif' => esc_html__('serif', 'studeon'),
					'sans-serif' => esc_html__('sans-serif', 'studeon'),
					'monospace' => esc_html__('monospace', 'studeon'),
					'cursive' => esc_html__('cursive', 'studeon'),
					'fantasy' => esc_html__('fantasy', 'studeon')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'studeon'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'studeon') )
											. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'studeon') )
							: '',
				"refresh" => false,
				"std" => '$studeon_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Sections with font's attributes for each theme element
		$theme_fonts = studeon_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								: esc_html(sprintf(esc_html__('%s settings', 'studeon'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								: wp_kses( sprintf(__('Font settings of the "%s" tag.', 'studeon'), $tag),'studeon_kses_content' ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'studeon'),
						'100' => esc_html__('100 (Light)', 'studeon'), 
						'200' => esc_html__('200 (Light)', 'studeon'), 
						'300' => esc_html__('300 (Thin)',  'studeon'),
						'400' => esc_html__('400 (Normal)', 'studeon'),
						'500' => esc_html__('500 (Semibold)', 'studeon'),
						'600' => esc_html__('600 (Semibold)', 'studeon'),
						'700' => esc_html__('700 (Bold)', 'studeon'),
						'800' => esc_html__('800 (Black)', 'studeon'),
						'900' => esc_html__('900 (Black)', 'studeon')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'studeon'),
						'normal' => esc_html__('Normal', 'studeon'), 
						'italic' => esc_html__('Italic', 'studeon')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'studeon'),
						'none' => esc_html__('None', 'studeon'), 
						'underline' => esc_html__('Underline', 'studeon'),
						'overline' => esc_html__('Overline', 'studeon'),
						'line-through' => esc_html__('Line-through', 'studeon')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'studeon'),
						'none' => esc_html__('None', 'studeon'), 
						'uppercase' => esc_html__('Uppercase', 'studeon'),
						'lowercase' => esc_html__('Lowercase', 'studeon'),
						'capitalize' => esc_html__('Capitalize', 'studeon')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"refresh" => false,
					"std" => '$studeon_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters into Theme Options
		studeon_storage_merge_array('options', '', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			studeon_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'studeon'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'studeon') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'studeon')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('studeon_options_get_list_choises')) {
	add_filter('studeon_filter_options_get_list_choises', 'studeon_options_get_list_choises', 10, 2);
	function studeon_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = studeon_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = studeon_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = studeon_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (strpos($id, 'header_scheme')===0 
					|| strpos($id, 'menu_scheme')===0
					|| strpos($id, 'color_scheme')===0
					|| strpos($id, 'sidebar_scheme')===0
					|| strpos($id, 'footer_scheme')===0)
				$list = studeon_get_list_schemes(true);
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = studeon_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = studeon_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = studeon_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = studeon_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = studeon_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = studeon_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = studeon_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = studeon_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = studeon_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = studeon_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = studeon_array_merge(array(0 => esc_html__('- Select category -', 'studeon')), studeon_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = studeon_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = studeon_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = studeon_get_list_load_fonts(true);
		}
		return $list;
	}
}




// -----------------------------------------------------------------
// -- Create and manage Theme Options
// -----------------------------------------------------------------

// Theme init priorities:
// 2 - create Theme Options
if (!function_exists('studeon_options_theme_setup2')) {
	add_action( 'after_setup_theme', 'studeon_options_theme_setup2', 2 );
	function studeon_options_theme_setup2() {
		studeon_options_create();
	}
}

// Step 1: Load default settings and previously saved mods
if (!function_exists('studeon_options_theme_setup5')) {
	add_action( 'after_setup_theme', 'studeon_options_theme_setup5', 5 );
	function studeon_options_theme_setup5() {
		studeon_storage_set('options_reloaded', false);
		studeon_load_theme_options();
	}
}

// Step 2: Load current theme customization mods
if (is_customize_preview()) {
	if (!function_exists('studeon_load_custom_options')) {
		add_action( 'wp_loaded', 'studeon_load_custom_options' );
		function studeon_load_custom_options() {
			if (!studeon_storage_get('options_reloaded')) {
				studeon_storage_set('options_reloaded', true);
				studeon_load_theme_options();
			}
		}
	}
}

// Load current values for each customizable option
if ( !function_exists('studeon_load_theme_options') ) {
	function studeon_load_theme_options() {
		$options = studeon_storage_get('options');
		$reset = (int) get_theme_mod('reset_options', 0);
		foreach ($options as $k=>$v) {
			if (isset($v['std'])) {
				if (strpos($v['std'], '$studeon_')!==false) {
					$func = substr($v['std'], 1);
					if (function_exists($func)) {
						$v['std'] = $func($k);
					}
				}
				$value = $v['std'];
				if (!$reset) {
					if (isset($_GET[$k]))
						$value = studeon_get_value_gpc($k);
					else {
						$tmp = get_theme_mod($k, -987654321);
						if ($tmp != -987654321) $value = $tmp;
					}
				}
				studeon_storage_set_array2('options', $k, 'val', $value);
				if ($reset) remove_theme_mod($k);
			}
		}
		if ($reset) {
			// Unset reset flag
			set_theme_mod('reset_options', 0);
			// Regenerate CSS with default colors and fonts
			studeon_customizer_save_css();
		} else {
			do_action('studeon_action_load_options');
		}
	}
}

// Override options with stored page/post meta
if ( !function_exists('studeon_override_theme_options') ) {
	add_action( 'wp', 'studeon_override_theme_options', 1 );
	function studeon_override_theme_options($query=null) {
		if (is_page_template('blog.php')) {
			studeon_storage_set('blog_archive', true);
			studeon_storage_set('blog_template', get_the_ID());
		}
		studeon_storage_set('blog_mode', studeon_detect_blog_mode());
		if (is_singular()) {
			studeon_storage_set('options_meta', get_post_meta(get_the_ID(), 'studeon_options', true));
		}
	}
}


// Return customizable option value
if (!function_exists('studeon_get_theme_option')) {
	function studeon_get_theme_option($name, $defa='', $strict_mode=false, $post_id=0) {
		$rez = $defa;
		$from_post_meta = false;
		if ($post_id > 0) {
			if (!studeon_storage_isset('post_options_meta', $post_id))
				studeon_storage_set_array('post_options_meta', $post_id, get_post_meta($post_id, 'studeon_options', true));
			if (studeon_storage_isset('post_options_meta', $post_id, $name)) {
				$tmp = studeon_storage_get_array('post_options_meta', $post_id, $name);
				if (!studeon_is_inherit($tmp)) {
					$rez = $tmp;
					$from_post_meta = true;
				}
			}
		}
		if (!$from_post_meta && studeon_storage_isset('options')) {
			if ( !studeon_storage_isset('options', $name) ) {
				$rez = $tmp = '_not_exists_';
				if (function_exists('trx_addons_get_option'))
					$rez = trx_addons_get_option($name, $tmp, false);
				if ($rez === $tmp) {
					if ($strict_mode) {
						$s = debug_backtrace();
						$s = array_shift($s);
						echo '<pre>' . sprintf(esc_html__('Undefined option "%s" called from:', 'studeon'), $name);
						if (function_exists('dco')) dco($s);
						else print_r($s);
						echo '</pre>';
						wp_die();
					} else
						$rez = $defa;
				}
			} else {
				$blog_mode = studeon_storage_get('blog_mode');
				// Override option from GET or POST for current blog mode
				if (!empty($blog_mode) && isset($_REQUEST[$name . '_' . $blog_mode])) {
					$rez = sanitize_text_field($_REQUEST[$name . '_' . $blog_mode]);
				// Override option from GET
				} else if (isset($_REQUEST[$name])) {
					$rez = sanitize_text_field($_REQUEST[$name]);
				// Override option from current page settings (if exists)
				} else if (studeon_storage_isset('options_meta', $name) && !studeon_is_inherit(studeon_storage_get_array('options_meta', $name))) {
					$rez = studeon_storage_get_array('options_meta', $name);
				// Override option from current blog mode settings: 'home', 'search', 'page', 'post', 'blog', etc. (if exists)
				} else if (!empty($blog_mode) && studeon_storage_isset('options', $name . '_' . $blog_mode, 'val') && !studeon_is_inherit(studeon_storage_get_array('options', $name . '_' . $blog_mode, 'val'))) {
					$rez = studeon_storage_get_array('options', $name . '_' . $blog_mode, 'val');
				// Get saved option value
				} else if (studeon_storage_isset('options', $name, 'val')) {
					$rez = studeon_storage_get_array('options', $name, 'val');
				// Get ThemeREX Addons option value
				} else if (function_exists('trx_addons_get_option')) {
					$rez = trx_addons_get_option($name, $defa, false);
				}
			}
		}
		return $rez;
	}
}


// Check if customizable option exists
if (!function_exists('studeon_check_theme_option')) {
	function studeon_check_theme_option($name) {
		return studeon_storage_isset('options', $name);
	}
}


// Get dependencies list from the Theme Options
if ( !function_exists('studeon_get_theme_dependencies') ) {
	function studeon_get_theme_dependencies() {
		$options = studeon_storage_get('options');
		$depends = array();
		foreach ($options as $k=>$v) {
			if (isset($v['dependency'])) 
				$depends[$k] = $v['dependency'];
		}
		return $depends;
	}
}

// Return internal theme setting value
if (!function_exists('studeon_get_theme_setting')) {
	function studeon_get_theme_setting($name) {
		return studeon_storage_isset('settings', $name) ? studeon_storage_get_array('settings', $name) : false;
	}
}

// Set theme setting
if ( !function_exists( 'studeon_set_theme_setting' ) ) {
	function studeon_set_theme_setting($option_name, $value) {
		if (studeon_storage_isset('settings', $option_name))
			studeon_storage_set_array('settings', $option_name, $value);
	}
}
?>