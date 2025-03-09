<?php
/**
 * The Header: Logo and main menu
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js scheme_<?php
										 // Class scheme_xxx need in the <html> as context for the <body>!
										 echo esc_attr(studeon_get_theme_option('color_scheme'));
										 ?>">
<head>
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>
    <?php wp_body_open(); ?>

	<?php do_action( 'studeon_action_before' ); ?>

	<div class="body_wrap">

		<div class="page_wrap">

			<?php
			// Desktop header
			$studeon_header_style = studeon_get_theme_option("header_style");
			if (strpos($studeon_header_style, 'header-custom-')===0) $studeon_header_style = 'header-custom';
			get_template_part( "templates/{$studeon_header_style}");

			// Side menu
			if (in_array(studeon_get_theme_option('menu_style'), array('left', 'right'))) {
				get_template_part( 'templates/header-navi-side' );
			}

			// Mobile header
			get_template_part( 'templates/header-mobile');
			?>

			<div class="page_content_wrap scheme_<?php echo esc_attr(studeon_get_theme_option('color_scheme')); ?>">

				<?php if (studeon_get_theme_option('body_style') != 'fullscreen') { ?>
				<div class="content_wrap">
				<?php } ?>

					<?php
					// Widgets area above page content
					studeon_create_widgets_area('widgets_above_page');
					?>				

					<div class="content">
						<?php
						// Widgets area inside page content
						studeon_create_widgets_area('widgets_above_content');
						?>				
