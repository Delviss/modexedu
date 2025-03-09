<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WPBakery PageBuilder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$studeon_content = '';
$studeon_blog_archive_mask = '%%CONTENT%%';
$studeon_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $studeon_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($studeon_content = apply_filters('the_content', get_the_content())) != '') {
		if (($studeon_pos = strpos($studeon_content, $studeon_blog_archive_mask)) !== false) {
			$studeon_content = preg_replace('/(\<p\>\s*)?'.$studeon_blog_archive_mask.'(\s*\<\/p\>)/i', $studeon_blog_archive_subst, $studeon_content);
		} else
			$studeon_content .= $studeon_blog_archive_subst;
		$studeon_content = explode($studeon_blog_archive_mask, $studeon_content);
	}
}

// Prepare args for a new query
$studeon_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$studeon_args = studeon_query_add_posts_and_cats($studeon_args, '', studeon_get_theme_option('post_type'), studeon_get_theme_option('parent_cat'));
$studeon_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($studeon_page_number > 1) {
	$studeon_args['paged'] = $studeon_page_number;
	$studeon_args['ignore_sticky_posts'] = true;
}
$studeon_ppp = studeon_get_theme_option('posts_per_page');
if ((int) $studeon_ppp != 0)
	$studeon_args['posts_per_page'] = (int) $studeon_ppp;
// Make a new query
query_posts( $studeon_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($studeon_content) && count($studeon_content) == 2) {
	set_query_var('blog_archive_start', $studeon_content[0]);
	set_query_var('blog_archive_end', $studeon_content[1]);
}

get_template_part('index');
?>