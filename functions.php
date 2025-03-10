<?php
/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

if (!defined("STUDEON_THEME_DIR")) define("STUDEON_THEME_DIR", trailingslashit( get_template_directory() ));
if (!defined("STUDEON_CHILD_DIR")) define("STUDEON_CHILD_DIR", trailingslashit( get_stylesheet_directory() ));

/**
 * Fire the wp_body_open action.
 *
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
 */
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         */
        do_action('wp_body_open');
    }
}


// Theme storage
$STUDEON_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array(

		// Required plugins
		// DON'T COMMENT OR REMOVE NEXT LINES!
		'trx_addons',

		// Recommended (supported) plugins
		// If plugin not need - comment (or remove) it
		'essential-grid',
		'js_composer',
		'mailchimp-for-wp',
		'revslider',
		'the-events-calendar',
		'woocommerce',
        'contact-form-7',
        'trx_updater',
        'elegro-payment',
        'yith-woocommerce-wishlist',
        'yith-woocommerce-compare',
        'yith-woocommerce-zoom-magnifier',
		'instagram-feed'
    )
);


//-------------------------------------------------------
//-- Theme init
//-------------------------------------------------------

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('studeon_theme_setup1') ) {
	add_action( 'after_setup_theme', 'studeon_theme_setup1', 1 );
	function studeon_theme_setup1() {
		// Make theme available for translation
		// Translations can be filed in the /languages directory
		// Attention! Translations must be loaded before first call any translation functions!
		load_theme_textdomain( 'studeon', studeon_get_folder_dir('languages') );

		// Set theme content width
		$GLOBALS['content_width'] = apply_filters( 'studeon_filter_content_width', 1170 );
	}
}

if ( !function_exists('studeon_theme_setup') ) {
	add_action( 'after_setup_theme', 'studeon_theme_setup' );
	function studeon_theme_setup() {

		// Add default posts and comments RSS feed links to head 
		add_theme_support( 'automatic-feed-links' );
		
		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('studeon_filter_add_thumb_sizes', array(
			'studeon-thumb-huge'		=> array(1170, 658, true),
			'studeon-thumb-big' 		=> array( 760, 428, true),
			'studeon-thumb-big-blogger'	=> array( 740, 530, true),
            'studeon-thumb-med' 		=> array( 740, 416, true),
			'studeon-thumb-tiny' 		=> array(  90,  90, true),
			'studeon-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'studeon-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = studeon_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'studeon_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}
		
		// Custom header setup
		add_theme_support( 'custom-header', array(
			'header-text'=>false,
			'video' => true
			)
		);

		// Custom backgrounds setup
		add_theme_support( 'custom-background', array()	);
		
		// Supported posts formats
		add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat') ); 
 
 		// Autogenerate title tag
		add_theme_support('title-tag');
 		
		// Add theme menus
		add_theme_support('nav-menus');
		
		// Switch default markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
		
		// WooCommerce Support
		add_theme_support( 'woocommerce' );

        // Next setting from the WooCommerce 3.0+ enable built-in image zoom on the single product page
        add_theme_support( 'wc-product-gallery-zoom' );

        // Next setting from the WooCommerce 3.0+ enable built-in image slider on the single product page
        add_theme_support( 'wc-product-gallery-slider' );

        // Next setting from the WooCommerce 3.0+ enable built-in image lightbox on the single product page
        add_theme_support( 'wc-product-gallery-lightbox' );
		
		// Editor custom stylesheet - for user
		add_editor_style( array_merge(
			array(
				'css/editor-style.css',
				studeon_get_file_url('css/fontello/css/fontello-embedded.css')
			),
			studeon_theme_fonts_for_editor()
			)
		);	
	
		// Register navigation menu
		register_nav_menus(array(
			'menu_main' => esc_html__('Main Menu', 'studeon'),
			'menu_mobile' => esc_html__('Mobile Menu', 'studeon'),
			'menu_footer' => esc_html__('Footer Menu', 'studeon')
			)
		);

		// Excerpt filters
		add_filter( 'excerpt_length',						'studeon_excerpt_length' );
		add_filter( 'excerpt_more',							'studeon_excerpt_more' );
		
		// Add required meta tags in the head
		add_action('wp_head',		 						'studeon_wp_head', 0);
		
		// Add custom inline styles
		add_action('wp_footer',		 						'studeon_wp_footer');
		add_action('admin_footer',	 						'studeon_wp_footer');

		// Enqueue scripts and styles for frontend
		add_action('wp_enqueue_scripts', 					'studeon_wp_scripts', 1000);			//priority 1000 - load styles before the plugin's support custom styles (priority 1100)
		add_action('wp_footer',		 						'studeon_localize_scripts');
		add_action('wp_enqueue_scripts', 					'studeon_wp_scripts_responsive', 2000);	//priority 2000 - load responsive after all other styles
		
		// Add body classes
		add_filter( 'body_class',							'studeon_add_body_classes' );

		// Register sidebars
		add_action('widgets_init',							'studeon_register_sidebars');

		// Set options for importer (before other plugins)
		add_filter( 'trx_addons_filter_importer_options',	'studeon_importer_set_options', 9 );
	}

}


//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------
if ( !function_exists('studeon_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'studeon_image_sizes' );
	function studeon_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('studeon_filter_add_thumb_sizes', array(
			'studeon-thumb-huge'		=> esc_html__( 'Fullsize image', 'studeon' ),
			'studeon-thumb-big'			=> esc_html__( 'Large image', 'studeon' ),
			'studeon-thumb-big-blogger'	=> esc_html__( 'Large blogger image', 'studeon' ),
			'studeon-thumb-med'			=> esc_html__( 'Medium image', 'studeon' ),
			'studeon-thumb-tiny'		=> esc_html__( 'Small square avatar', 'studeon' ),
			'studeon-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'studeon' ),
			'studeon-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'studeon' ),
			)
		);
		$mult = studeon_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'studeon' );
		}
		return $sizes;
	}
}


//-------------------------------------------------------
//-- Theme scripts and styles
//-------------------------------------------------------

// Load frontend scripts
if ( !function_exists( 'studeon_wp_scripts' ) ) {
	
	function studeon_wp_scripts() {
		
		// Enqueue styles
		//------------------------
		
		// Links to selected fonts
		$links = studeon_theme_fonts_links();
		if (count($links) > 0) {
			foreach ($links as $slug => $link) {
				wp_enqueue_style( sprintf('studeon-font-%s', $slug), $link );
			}
		}
		
		// Fontello styles must be loaded before main stylesheet
		// This style NEED the theme prefix, because style 'fontello' in some plugin contain different set of characters
		// and can't be used instead this style!
		wp_enqueue_style( 'fontello',  studeon_get_file_url('css/fontello/css/fontello-embedded.css') );

		// Load main stylesheet
		$main_stylesheet = get_template_directory_uri() . '/style.css';
		wp_enqueue_style( 'studeon-main', $main_stylesheet, array(), null );

		// Load child stylesheet (if different) after the main stylesheet and fontello icons (important!)
		$child_stylesheet = get_stylesheet_directory_uri() . '/style.css';
		if ($child_stylesheet != $main_stylesheet) {
			wp_enqueue_style( 'studeon-child', $child_stylesheet, array('studeon-main'), null );
		}

		// Add custom bg image for the body_style == 'boxed'
		if ( studeon_get_theme_option('body_style') == 'boxed' && ($bg_image = studeon_get_theme_option('boxed_bg_image')) != '' )
			wp_add_inline_style( 'studeon-main', '.body_style_boxed { background-image:url('.esc_url($bg_image).') }' );

		// Merged styles
		if ( studeon_is_off(studeon_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'studeon-styles', studeon_get_file_url('css/__styles.css') );

		// Custom colors
		if ( !is_customize_preview() && !isset($_GET['color_scheme']) && studeon_is_off(studeon_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'studeon-colors', studeon_get_file_url('css/__colors.css') );
		else
			wp_add_inline_style( 'studeon-main', studeon_customizer_get_css() );

		// Add post nav background
		studeon_add_bg_in_post_nav();

		// Disable loading JQuery UI CSS
		wp_deregister_style('jquery_ui');
		wp_deregister_style('date-picker-css');


		// Enqueue scripts	
		//------------------------
		
		// Modernizr will load in head before other scripts and styles
		if ( in_array(substr(studeon_get_theme_option('blog_style'), 0, 7), array('gallery', 'portfol', 'masonry')) )
			wp_enqueue_script( 'modernizr', studeon_get_file_url('js/theme.gallery/modernizr.min.js'), array(), null, false );

		// Superfish Menu
		// Attention! To prevent duplicate this script in the plugin and in the menu, don't merge it!
		wp_enqueue_script( 'superfish', studeon_get_file_url('js/superfish.js'), array('jquery'), null, true );
		
		// Merged scripts
		if ( studeon_is_off(studeon_get_theme_option('debug_mode')) )
			wp_enqueue_script( 'studeon-init', studeon_get_file_url('js/__scripts.js'), array('jquery'), null, true );
		else {
			// Skip link focus
			wp_enqueue_script( 'skip-link-focus-fix', studeon_get_file_url('js/skip-link-focus-fix.js'), null, true );
			// Background video
			$header_video = studeon_get_header_video();
			if (!empty($header_video) && !studeon_is_inherit($header_video))
				wp_enqueue_script( 'bideo', studeon_get_file_url('js/bideo.js'), array(), null, true );
			// Theme scripts
			wp_enqueue_script( 'studeon-utils', studeon_get_file_url('js/_utils.js'), array('jquery'), null, true );
			wp_enqueue_script( 'studeon-init', studeon_get_file_url('js/_init.js'), array('jquery'), null, true );	
		}
		
		// Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Media elements library	
		if (studeon_get_theme_setting('use_mediaelements')) {
			wp_enqueue_style ( 'mediaelement' );
			wp_enqueue_style ( 'wp-mediaelement' );
			wp_enqueue_script( 'mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
		}
	}
}

// Add variables to the scripts in the frontend
if ( !function_exists( 'studeon_localize_scripts' ) ) {
	
	function studeon_localize_scripts() {

		$video = studeon_get_header_video();

		wp_localize_script( 'studeon-init', 'STUDEON_STORAGE', apply_filters( 'studeon_filter_localize_script', array(
			// AJAX parameters
			'ajax_url' => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))),
			
			// Site base url
			'site_url' => get_site_url(),
						
			// Site color scheme
			'site_scheme' => sprintf('scheme_%s', studeon_get_theme_option('color_scheme')),
			
			// User logged in
			'user_logged_in' => is_user_logged_in() ? true : false,
			
			// Window width to switch the site header to the mobile layout
			'mobile_layout_width' => 767,
						
			// Sidemenu options
			'menu_side_stretch' => studeon_get_theme_option('menu_side_stretch') > 0 ? true : false,
			'menu_side_icons' => studeon_get_theme_option('menu_side_icons') > 0 ? true : false,

			// Video background
			'background_video' => studeon_is_from_uploads($video) ? $video : '',

			// Video and Audio tag wrapper
			'use_mediaelements' => studeon_get_theme_setting('use_mediaelements') ? true : false,

			// Messages max length
			'message_maxlength'	=> intval(studeon_get_theme_setting('message_maxlength')),

			
			// Internal vars - do not change it!
			
			// Flag for review mechanism
			'admin_mode' => false,

			// E-mail mask
			'email_mask' => '^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$',
			
			// Strings for translation
			'strings' => array(
					'ajax_error'		=> esc_html__('Invalid server answer!', 'studeon'),
					'error_global'		=> esc_html__('Error data validation!', 'studeon'),
					'name_empty' 		=> esc_html__("The name can't be empty", 'studeon'),
					'name_long'			=> esc_html__('Too long name', 'studeon'),
					'email_empty'		=> esc_html__('Too short (or empty) email address', 'studeon'),
					'email_long'		=> esc_html__('Too long email address', 'studeon'),
					'email_not_valid'	=> esc_html__('Invalid email address', 'studeon'),
					'text_empty'		=> esc_html__("The message text can't be empty", 'studeon'),
					'text_long'			=> esc_html__('Too long message text', 'studeon')
					)
			))
		);
	}
}

// Load responsive styles (priority 2000 - load it after main styles and plugins custom styles)
if ( !function_exists( 'studeon_wp_scripts_responsive' ) ) {
	
	function studeon_wp_scripts_responsive() {
		wp_enqueue_style( 'studeon-responsive', studeon_get_file_url('css/responsive.css') );
	}
}

//  Add meta tags and inline scripts in the header for frontend
if (!function_exists('studeon_wp_head')) {
	
	function studeon_wp_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="format-detection" content="telephone=no">
		<link rel="profile" href="//gmpg.org/xfn/11">
		<link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>">
		<?php
	}
}

// Add theme specified classes to the body
if ( !function_exists('studeon_add_body_classes') ) {
	
	function studeon_add_body_classes( $classes ) {
		$classes[] = 'body_tag';	// Need for the .scheme_self
		$classes[] = 'scheme_' . esc_attr(studeon_get_theme_option('color_scheme'));

		$blog_mode = studeon_storage_get('blog_mode');
		$classes[] = 'blog_mode_' . esc_attr($blog_mode);
		$classes[] = 'body_style_' . esc_attr(studeon_get_theme_option('body_style'));

		if (in_array($blog_mode, array('post', 'page'))) {
			$classes[] = 'is_single';
		} else {
			$classes[] = ' is_stream';
			$classes[] = 'blog_style_'.esc_attr(studeon_get_theme_option('blog_style'));
			if (studeon_storage_get('blog_template') > 0)
				$classes[] = 'blog_template';
		}
		
		if (studeon_sidebar_present()) {
			$classes[] = 'sidebar_show sidebar_' . esc_attr(studeon_get_theme_option('sidebar_position')) ;
		} else {
			$classes[] = 'sidebar_hide';
			if (studeon_is_on(studeon_get_theme_option('expand_content')))
				 $classes[] = 'expand_content';
		}
		
		if (studeon_is_on(studeon_get_theme_option('remove_margins')))
			 $classes[] = 'remove_margins';

		$classes[] = 'header_style_' . esc_attr(studeon_get_theme_option("header_style"));
		$classes[] = 'header_position_' . esc_attr(studeon_get_theme_option("header_position"));

		$menu_style= studeon_get_theme_option("menu_style");
		$classes[] = 'menu_style_' . esc_attr($menu_style) . (in_array($menu_style, array('left', 'right'))	? ' menu_style_side' : '');
		$classes[] = 'no_layout';
		
		return $classes;
	}
}
	
// Load inline styles
if ( !function_exists( 'studeon_wp_footer' ) ) {
	
	function studeon_wp_footer() {
		// Get inline styles
		if (($css = studeon_get_inline_css()) != '') {
			wp_enqueue_style(  'studeon-inline-styles',  studeon_get_file_url('css/__inline.css') );
			wp_add_inline_style( 'studeon-inline-styles', $css );
		}
	}
}


//-------------------------------------------------------
//-- Sidebars and widgets
//-------------------------------------------------------

// Register widgetized areas
if ( !function_exists('studeon_register_sidebars') ) {
	
	function studeon_register_sidebars() {
		$sidebars = studeon_get_sidebars();
		if (is_array($sidebars) && count($sidebars) > 0) {
			foreach ($sidebars as $id=>$sb) {
				register_sidebar( array(
										'name'          => $sb['name'],
										'description'   => $sb['description'],
										'id'            => $id,
										'before_widget' => '<aside id="%1$s" class="widget %2$s">',
										'after_widget'  => '</aside>',
										'before_title'  => '<h5 class="widget_title">',
										'after_title'   => '</h5>'
										)
								);
			}
		}
	}
}

// Return theme specific widgetized areas
if ( !function_exists('studeon_get_sidebars') ) {
	function studeon_get_sidebars() {
		$list = apply_filters('studeon_filter_list_sidebars', array(
			'sidebar_widgets'		=> array(
											'name' => esc_html__('Sidebar Widgets', 'studeon'),
											'description' => esc_html__('Widgets to be shown on the main sidebar', 'studeon')
											),
			'header_widgets'		=> array(
											'name' => esc_html__('Header Widgets', 'studeon'),
											'description' => esc_html__('Widgets to be shown at the top of the page (in the page header area)', 'studeon')
											),
			'above_page_widgets'	=> array(
											'name' => esc_html__('Above Page Widgets', 'studeon'),
											'description' => esc_html__('Widgets to be shown below the header, but above the content and sidebar', 'studeon')
											),
			'above_content_widgets' => array(
											'name' => esc_html__('Above Content Widgets', 'studeon'),
											'description' => esc_html__('Widgets to be shown above the content, near the sidebar', 'studeon')
											),
			'below_content_widgets' => array(
											'name' => esc_html__('Below Content Widgets', 'studeon'),
											'description' => esc_html__('Widgets to be shown below the content, near the sidebar', 'studeon')
											),
			'below_page_widgets' 	=> array(
											'name' => esc_html__('Below Page Widgets', 'studeon'),
											'description' => esc_html__('Widgets to be shown below the content and sidebar, but above the footer', 'studeon')
											),
			'footer_widgets'		=> array(
											'name' => esc_html__('Footer Widgets', 'studeon'),
											'description' => esc_html__('Widgets to be shown at the bottom of the page (in the page footer area)', 'studeon')
											)
			)
		);
		return $list;
	}
}


//-------------------------------------------------------
//-- Theme fonts
//-------------------------------------------------------

// Return links for all theme fonts
if ( !function_exists('studeon_theme_fonts_links') ) {
	function studeon_theme_fonts_links() {
		$links = array();
		
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		$google_fonts_enabled = ( 'off' !== esc_html_x( 'on', 'Google fonts: on or off', 'studeon' ) );
		$custom_fonts_enabled = ( 'off' !== esc_html_x( 'on', 'Custom fonts (included in the theme): on or off', 'studeon' ) );
        if ( ($google_fonts_enabled || $custom_fonts_enabled) && !studeon_storage_empty('load_fonts') ) {
			$load_fonts = (array)studeon_storage_get('load_fonts');
			if (count($load_fonts) > 0) {
				$google_fonts = '';
				foreach ($load_fonts as $font) {
					$slug = studeon_get_load_fonts_slug($font['name']);
					$url  = studeon_get_file_url( sprintf('css/font-face/%s/stylesheet.css', $slug));
					if ($url != '') {
						if ($custom_fonts_enabled) {
							$links[$slug] = $url;
						}
					} else {
						if ($google_fonts_enabled) {
							$google_fonts .= ($google_fonts ? '|' : '')
											. str_replace(' ', '+', $font['name'])
											. ':' 
											. (empty($font['styles']) ? '400,400italic,700,700italic' : $font['styles']);
						}
					}
				}
				if ($google_fonts && $google_fonts_enabled) {
					$links['google_fonts'] = sprintf('%s://fonts.googleapis.com/css?family=%s&subset=%s', studeon_get_protocol(), $google_fonts, studeon_get_theme_option('load_fonts_subset'));
				}
			}
		}
		return $links;
	}
}

// Return links for WP Editor
if ( !function_exists('studeon_theme_fonts_for_editor') ) {
	function studeon_theme_fonts_for_editor() {
		$links = array_values(studeon_theme_fonts_links());
		if (is_array($links) && count($links) > 0) {
			for ($i=0; $i<count($links); $i++) {
				$links[$i] = str_replace(',', '%2C', $links[$i]);
			}
		}
		return $links;
	}
}


//-------------------------------------------------------
//-- The Excerpt
//-------------------------------------------------------
if ( !function_exists('studeon_excerpt_length') ) {
	function studeon_excerpt_length( $length ) {
		return max(1, studeon_get_theme_setting('max_excerpt_length'));
	}
}

if ( !function_exists('studeon_excerpt_more') ) {
	function studeon_excerpt_more( $more ) {
		return '&hellip;';
	}
}


//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'studeon_importer_set_options' ) ) {
	
	function studeon_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(studeon_get_protocol() . '://demofiles.axiomthemes.com/studeon/');
			// Required plugins
			$options['required_plugins'] = studeon_storage_get('required_plugins');
			// Default demo
			$options['files']['default']['title'] = esc_html__('Studeon Demo', 'studeon');
			$options['files']['default']['domain_dev'] = esc_url('http://studeon.dev');		// Developers domain
			$options['files']['default']['domain_demo']= esc_url('https://studeon.axiomthemes.com');		// Demo-site domain
		}
		return $options;
	}
}

// Add checkbox with "I agree ..."
if ( ! function_exists( 'studeon_comment_form_agree' ) ) {
    add_filter('comment_form_fields', 'studeon_comment_form_agree', 11);
    function studeon_comment_form_agree( $comment_fields ) {
        $privacy_text = studeon_get_privacy_text();
        if ( ! empty( $privacy_text ) ) {
            $comment_fields['i_agree_privacy_policy'] = studeon_single_comments_field(
                array(
                    'form_style'        => 'default',
                    'field_type'        => 'checkbox',
                    'field_req'         => '',
                    'field_icon'        => '',
                    'field_value'       => '1',
                    'field_name'        => 'i_agree_privacy_policy',
                    'field_title'       => $privacy_text,
                )
            );
        }
        return $comment_fields;
    }
}


/* wp_kses handlers
----------------------------------------------------------------------------------------------------- */
if ( ! function_exists( 'studeon_kses_allowed_html' ) ) {
    add_filter( 'wp_kses_allowed_html', 'studeon_kses_allowed_html', 10, 2);
    function studeon_kses_allowed_html($tags, $context) {
        if ( in_array( $context, array( 'studeon_kses_content', 'trx_addons_kses_content' ) ) ) {
            $tags = array(
                'h1'     => array( 'id' => array(), 'class' => array(), 'title' => array(), 'align' => array() ),
                'h2'     => array( 'id' => array(), 'class' => array(), 'title' => array(), 'align' => array() ),
                'h3'     => array( 'id' => array(), 'class' => array(), 'title' => array(), 'align' => array() ),
                'h4'     => array( 'id' => array(), 'class' => array(), 'title' => array(), 'align' => array() ),
                'h5'     => array( 'id' => array(), 'class' => array(), 'title' => array(), 'align' => array() ),
                'h6'     => array( 'id' => array(), 'class' => array(), 'title' => array(), 'align' => array() ),
                'p'      => array( 'id' => array(), 'class' => array(), 'title' => array(), 'align' => array() ),
                'span'   => array( 'id' => array(), 'class' => array(), 'title' => array() ),
                'div'    => array( 'id' => array(), 'class' => array(), 'title' => array(), 'align' => array() ),
                'a'      => array( 'id' => array(), 'class' => array(), 'title' => array(), 'href' => array(), 'target' => array() ),
                'b'      => array( 'id' => array(), 'class' => array(), 'title' => array() ),
                'i'      => array( 'id' => array(), 'class' => array(), 'title' => array() ),
                'em'     => array( 'id' => array(), 'class' => array(), 'title' => array() ),
                'strong' => array( 'id' => array(), 'class' => array(), 'title' => array() ),
                'img'    => array( 'id' => array(), 'class' => array(), 'src' => array(), 'width' => array(), 'height' => array(), 'alt' => array() ),
                'br'     => array( 'clear' => array() ),
            );
        }
        return $tags;
    }
}

//-------------------------------------------------------
//-- Include theme (or child) PHP-files
//-------------------------------------------------------

require_once STUDEON_THEME_DIR . 'includes/utils.php';
require_once STUDEON_THEME_DIR . 'includes/storage.php';
require_once STUDEON_THEME_DIR . 'includes/lists.php';
require_once STUDEON_THEME_DIR . 'includes/wp.php';

if (is_admin()) {
	require_once STUDEON_THEME_DIR . 'includes/tgmpa/class-tgm-plugin-activation.php';
	require_once STUDEON_THEME_DIR . 'includes/admin.php';
}

require_once STUDEON_THEME_DIR . 'theme-options/theme.customizer.php';

require_once STUDEON_THEME_DIR . 'theme-specific/trx_addons.php';

require_once STUDEON_THEME_DIR . 'includes/theme.tags.php';
require_once STUDEON_THEME_DIR . 'includes/theme.hovers/theme.hovers.php';


// Plugins support
if (is_array($STUDEON_STORAGE['required_plugins']) && count($STUDEON_STORAGE['required_plugins']) > 0) {
	foreach ($STUDEON_STORAGE['required_plugins'] as $plugin_slug) {
		$plugin_slug = studeon_esc($plugin_slug);
		$plugin_path = STUDEON_THEME_DIR . sprintf('plugins/%s/%s.php', $plugin_slug, $plugin_slug);
		if (file_exists($plugin_path)) { require_once $plugin_path; }
	}
}
?>