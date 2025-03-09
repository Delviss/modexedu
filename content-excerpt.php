<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

$studeon_post_format = get_post_format();
$studeon_post_format = empty($studeon_post_format) ? 'standard' : str_replace('post-format-', '', $studeon_post_format);
$studeon_full_content = studeon_get_theme_option('blog_content') != 'excerpt' || in_array($studeon_post_format, array('link', 'aside', 'status', 'quote'));
$studeon_animation = studeon_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php
	if ($studeon_post_format == 'quote'){

		post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($studeon_post_format) ); ?>
		<?php echo (!studeon_is_off($studeon_animation) ? ' data-animation="'.esc_attr(studeon_get_animation_classes($studeon_animation)).'"' : ''); ?>
		><?php

		// Post content
		?><div class="post_content entry-content"><?php
			if ($studeon_full_content) {
				// Post content area
				?><div class="post_content_inner"><?php
					the_content( '' );
				?></div><?php
				// Inner pages
				wp_link_pages( array(
					'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'studeon' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'studeon' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );

			}
		?></div><!-- .entry-content -->
	<?php


		// Post meta
		if (get_the_title() != '') {
			?>
			<div class="post_header entry-header">
				<?php

				do_action('studeon_action_before_post_meta');

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
				?>
			</div><!-- .post_header --><?php
		}

	} else if ($studeon_post_format == 'audio'){

		post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($studeon_post_format) ); ?>
		<?php echo (!studeon_is_off($studeon_animation) ? ' data-animation="'.esc_attr(studeon_get_animation_classes($studeon_animation)).'"' : ''); ?>
		><?php

		studeon_show_post_featured(array( 'thumb_size' => studeon_get_thumb_size( strpos(studeon_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));

		// Post meta
		if (get_the_title() != '') {
			?>
			<div class="post_header entry-header">
				<?php

				do_action('studeon_action_before_post_meta');

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
				?>
			</div><!-- .post_header --><?php
		} ?>

		<div class="post_content entry-content">
		<?php $studeon_show_learn_more = !in_array($studeon_post_format, array('link', 'aside', 'status', 'quote'));

		// Post content area
		?><div class="post_content_inner"><?php
		if (has_excerpt()) {
			the_excerpt();
		} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
			the_content( '' );
		} else if (in_array($studeon_post_format, array('link', 'aside', 'status', 'quote'))) {
			the_content();
		} else if (substr(get_the_content(), 0, 1)!='[') {
			the_excerpt();
		}
		?></div><?php
		// More button
		if ( $studeon_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'studeon'); ?></a></p><?php
		} ?>
		</div>

	<?php } else {

		post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($studeon_post_format) ); ?>
		<?php echo (!studeon_is_off($studeon_animation) ? ' data-animation="'.esc_attr(studeon_get_animation_classes($studeon_animation)).'"' : ''); ?>
		><?php

		// Featured image
		studeon_show_post_featured(array( 'thumb_size' => studeon_get_thumb_size( strpos(studeon_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));

		// Title and post meta
		if (get_the_title() != '') {
			?>
			<div class="post_header entry-header">
				<?php

				do_action('studeon_action_before_post_meta');

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

				do_action('studeon_action_before_post_title');

				// Post title
				the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				?>
			</div><!-- .post_header --><?php
		}

		// Post content
		?><div class="post_content entry-content"><?php
			if ($studeon_full_content) {
				// Post content area
				?><div class="post_content_inner"><?php
				the_content( '' );
				?></div><?php
				// Inner pages
				wp_link_pages( array(
					'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'studeon' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'studeon' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );

			} else {

				$studeon_show_learn_more = !in_array($studeon_post_format, array('link', 'aside', 'status', 'quote'));

				// Post content area
				?><div class="post_content_inner"><?php
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($studeon_post_format, array('link', 'aside', 'status', 'quote'))) {
					the_content();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
				?></div><?php
				// More button
				if ( $studeon_show_learn_more ) {
					?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'studeon'); ?></a></p><?php
				}

			}
			?></div><!-- .entry-content -->
	<?php } ?>
</article>