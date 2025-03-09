<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

$studeon_blog_style = explode('_', studeon_get_theme_option('blog_style'));
$studeon_columns = empty($studeon_blog_style[1]) ? 2 : max(2, $studeon_blog_style[1]);
$studeon_expanded = !studeon_sidebar_present() && studeon_is_on(studeon_get_theme_option('expand_content'));
$studeon_post_format = get_post_format();
$studeon_post_format = empty($studeon_post_format) ? 'standard' : str_replace('post-format-', '', $studeon_post_format);
$studeon_animation = studeon_get_theme_option('blog_animation');

?><div class="<?php echo esc_attr($studeon_blog_style[0]) == 'classic' ? 'column' : 'masonry_item masonry_item'; ?>-1_<?php echo esc_attr($studeon_columns); ?>"><article id="post-<?php the_ID(); ?>"
	<?php post_class( 'post_item post_format_'.esc_attr($studeon_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($studeon_columns)
					. ' post_layout_'.esc_attr($studeon_blog_style[0]) 
					. ' post_layout_'.esc_attr($studeon_blog_style[0]).'_'.esc_attr($studeon_columns)
					); ?>
	<?php echo (!studeon_is_off($studeon_animation) ? ' data-animation="'.esc_attr(studeon_get_animation_classes($studeon_animation)).'"' : ''); ?>
	>

	<?php

	// Featured image
	studeon_show_post_featured( array( 'thumb_size' => studeon_get_thumb_size($studeon_blog_style[0] == 'classic'
													? (strpos(studeon_get_theme_option('body_style'), 'full')!==false 
															? ( $studeon_columns > 2 ? 'big' : 'huge' )
															: (	$studeon_columns > 2
																? ($studeon_expanded ? 'med' : 'small')
																: ($studeon_expanded ? 'big' : 'med')
																)
														)
													: (strpos(studeon_get_theme_option('body_style'), 'full')!==false 
															? ( $studeon_columns > 2 ? 'masonry-big' : 'full' )
															: (	$studeon_columns <= 2 && $studeon_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($studeon_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('studeon_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			do_action('studeon_action_before_post_meta'); 

			// Post meta
			studeon_show_post_meta(array(
					'categories' => true,
					'date' => true,
					'author' => true,
					'edit' => false,
					'seo' => false,
					'share' => false,
					'counters' => ''	//comments,likes,views - comma separated in any combination
				)
			);
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$studeon_show_learn_more = false;
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($studeon_post_format, array('link', 'aside', 'status', 'quote'))) {
				the_content();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($studeon_post_format, array('link', 'aside', 'status', 'quote'))) {
			studeon_show_post_meta(array(
				'share' => false,
				'counters' => 'comments'
				)
			);
		}
		// More button
		if ( $studeon_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'studeon'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>