<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

$studeon_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$studeon_post_format = get_post_format();
$studeon_post_format = empty($studeon_post_format) ? 'standard' : str_replace('post-format-', '', $studeon_post_format);
$studeon_animation = studeon_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($studeon_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($studeon_post_format) ); ?>
	<?php echo (!studeon_is_off($studeon_animation) ? ' data-animation="'.esc_attr(studeon_get_animation_classes($studeon_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	studeon_show_post_featured(array(
		'thumb_size' => studeon_get_thumb_size($studeon_columns==1 ? 'big' : ($studeon_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($studeon_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post meta
			studeon_show_post_meta(array(
				'categories' => true,
				'date' => true,
				'author' => true,
				'edit' => false,
				'seo' => false,
				'share' => false,
				'counters' => 'comments'	//comments,likes,views - comma separated in any combination
			)
			);
			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );

			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>