<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

studeon_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	?><div class="posts_container"><?php
	
	$studeon_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$studeon_sticky_out = is_array($studeon_stickies) && count($studeon_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($studeon_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	while ( have_posts() ) { the_post(); 
		if ($studeon_sticky_out && !is_sticky()) {
			$studeon_sticky_out = false;
			?></div><?php
		}
		get_template_part( 'content', $studeon_sticky_out && is_sticky() ? 'sticky' : 'excerpt' );
	}
	if ($studeon_sticky_out) {
		$studeon_sticky_out = false;
		?></div><?php
	}
	
	?></div><?php

	studeon_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>