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
$studeon_columns = empty($studeon_blog_style[1]) ? 1 : max(1, $studeon_blog_style[1]);
$studeon_expanded = !studeon_sidebar_present() && studeon_is_on(studeon_get_theme_option('expand_content'));
$studeon_post_format = get_post_format();
$studeon_post_format = empty($studeon_post_format) ? 'standard' : str_replace('post-format-', '', $studeon_post_format);
$studeon_animation = studeon_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($studeon_columns).' post_format_'.esc_attr($studeon_post_format) ); ?>
	<?php echo (!studeon_is_off($studeon_animation) ? ' data-animation="'.esc_attr(studeon_get_animation_classes($studeon_animation)).'"' : ''); ?>
	>

	<?php
	// Add anchor
	if ($studeon_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Featured image
	studeon_show_post_featured( array(
											'class' => $studeon_columns == 1 ? 'trx-stretch-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => studeon_get_thumb_size(
																	strpos(studeon_get_theme_option('body_style'), 'full')!==false
																		? ( $studeon_columns > 1 ? 'huge' : 'original' )
																		: (	$studeon_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('studeon_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('studeon_action_before_post_meta'); 

			// Post meta
			$studeon_post_meta = studeon_show_post_meta(array(
					'categories' => true,
					'date' => true,
					'author' => true,
					'edit' => false,
					'seo' => false,
					'share' => false,
					'counters' => ''	//comments,likes,views - comma separated in any combination
									)
								);
			studeon_show_layout($studeon_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$studeon_show_learn_more = !in_array($studeon_post_format, array('link', 'aside', 'status', 'quote'));
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
				studeon_show_layout($studeon_post_meta);
			}
			// More button
			if ( $studeon_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'studeon'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>