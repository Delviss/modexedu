<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

studeon_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'classie', studeon_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'imagesloaded', studeon_get_file_url('js/theme.gallery/imagesloaded.min.js'), array(), null, true );
wp_enqueue_script( 'masonry', studeon_get_file_url('js/theme.gallery/masonry.min.js'), array(), null, true );
wp_enqueue_script( 'studeon-gallery-script', studeon_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$studeon_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$studeon_sticky_out = is_array($studeon_stickies) && count($studeon_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$studeon_cat = studeon_get_theme_option('parent_cat');
	$studeon_post_type = studeon_get_theme_option('post_type');
	$studeon_taxonomy = studeon_get_post_type_taxonomy($studeon_post_type);
	$studeon_show_filters = studeon_get_theme_option('show_filters');
	$studeon_tabs = array();
	if (!studeon_is_off($studeon_show_filters)) {
		$studeon_args = array(
			'type'			=> $studeon_post_type,
			'child_of'		=> $studeon_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $studeon_taxonomy,
			'pad_counts'	=> false
		);
		$studeon_portfolio_list = get_terms($studeon_args);
		if (is_array($studeon_portfolio_list) && count($studeon_portfolio_list) > 0) {
			$studeon_tabs[$studeon_cat] = esc_html__('All', 'studeon');
			foreach ($studeon_portfolio_list as $studeon_term) {
				if (isset($studeon_term->term_id)) $studeon_tabs[$studeon_term->term_id] = $studeon_term->name;
			}
		}
	}
	if (count($studeon_tabs) > 0) {
		$studeon_portfolio_filters_ajax = true;
		$studeon_portfolio_filters_active = $studeon_cat;
		$studeon_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters studeon_tabs studeon_tabs_ajax">
			<ul class="portfolio_titles studeon_tabs_titles">
				<?php
				foreach ($studeon_tabs as $studeon_id=>$studeon_title) {
					?><li><a href="<?php echo esc_url(studeon_get_hash_link(sprintf('#%s_%s_content', $studeon_portfolio_filters_id, $studeon_id))); ?>" data-tab="<?php echo esc_attr($studeon_id); ?>"><?php echo esc_html($studeon_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$studeon_ppp = studeon_get_theme_option('posts_per_page');
			if (studeon_is_inherit($studeon_ppp)) $studeon_ppp = '';
			foreach ($studeon_tabs as $studeon_id=>$studeon_title) {
				$studeon_portfolio_need_content = $studeon_id==$studeon_portfolio_filters_active || !$studeon_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $studeon_portfolio_filters_id, $studeon_id)); ?>"
					class="portfolio_content studeon_tabs_content"
					data-blog-template="<?php echo esc_attr(studeon_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(studeon_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($studeon_ppp); ?>"
					data-post-type="<?php echo esc_attr($studeon_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($studeon_taxonomy); ?>"
					data-cat="<?php echo esc_attr($studeon_id); ?>"
					data-parent-cat="<?php echo esc_attr($studeon_cat); ?>"
					data-need-content="<?php echo (false===$studeon_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($studeon_portfolio_need_content) 
						studeon_show_portfolio_posts(array(
							'cat' => $studeon_id,
							'parent_cat' => $studeon_cat,
							'taxonomy' => $studeon_taxonomy,
							'post_type' => $studeon_post_type,
							'page' => 1,
							'sticky' => $studeon_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		studeon_show_portfolio_posts(array(
			'cat' => $studeon_cat,
			'parent_cat' => $studeon_cat,
			'taxonomy' => $studeon_taxonomy,
			'post_type' => $studeon_post_type,
			'page' => 1,
			'sticky' => $studeon_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>