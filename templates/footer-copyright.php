<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0.10
 */

// Copyright area
$studeon_footer_scheme =  studeon_is_inherit(studeon_get_theme_option('footer_scheme')) ? studeon_get_theme_option('color_scheme') : studeon_get_theme_option('footer_scheme');
$studeon_copyright_scheme = studeon_is_inherit(studeon_get_theme_option('copyright_scheme')) ? $studeon_footer_scheme : studeon_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($studeon_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and [[...]] on the <i>...</i> and <b>...</b>
				$studeon_copyright = studeon_prepare_macros(studeon_get_theme_option('copyright'));
				if (!empty($studeon_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $studeon_copyright, $studeon_matches)) {
						$studeon_copyright = str_replace($studeon_matches[1], date(str_replace(array('{', '}'), '', $studeon_matches[1])), $studeon_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($studeon_copyright));
				}
			?></div>
		</div>
	</div>
</div>
