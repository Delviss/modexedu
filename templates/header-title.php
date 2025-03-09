<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

// Page (category, tag, archive, author) title

if ( studeon_need_page_title() ) {
	studeon_sc_layouts_showed('title', true);
	studeon_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title">
						<?php
						// Post meta on the single post
						if ( is_single() )  {
							?><div class="sc_layouts_title_meta"><?php
								studeon_show_post_meta(array(
									'date' => true,
									'categories' => true,
									'seo' => true,
									'share' => false,
									'counters' => 'views,comments,likes'
									)
								);
							?></div><?php
						}

						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$studeon_blog_title = studeon_get_blog_title();
							$studeon_blog_title_text = $studeon_blog_title_class = $studeon_blog_title_link = $studeon_blog_title_link_text = '';
							if (is_array($studeon_blog_title)) {
								$studeon_blog_title_text = $studeon_blog_title['text'];
								$studeon_blog_title_class = !empty($studeon_blog_title['class']) ? ' '.$studeon_blog_title['class'] : '';
								$studeon_blog_title_link = !empty($studeon_blog_title['link']) ? $studeon_blog_title['link'] : '';
								$studeon_blog_title_link_text = !empty($studeon_blog_title['link_text']) ? $studeon_blog_title['link_text'] : '';
							} else
								$studeon_blog_title_text = $studeon_blog_title;
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr($studeon_blog_title_class); ?>"><?php
								$studeon_top_icon = studeon_get_category_icon();
								if (!empty($studeon_top_icon)) {
									$studeon_attr = studeon_getimagesize($studeon_top_icon);
									?><img src="<?php echo esc_url($studeon_top_icon); ?>" alt="<?php echo esc_attr(basename($studeon_top_icon)); ?>" <?php if (!empty($studeon_attr[3])) studeon_show_layout($studeon_attr[3]);?>><?php
								}
								if (class_exists( 'WooCommerce' ) && is_product()) {
									echo esc_html__('Our Shop','studeon');
								} else {
									echo wp_kses_post($studeon_blog_title_text);
								}
							?></h1>
							<?php
							if (!empty($studeon_blog_title_link) && !empty($studeon_blog_title_link_text)) {
								?><a href="<?php echo esc_url($studeon_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($studeon_blog_title_link_text); ?></a><?php
							}

							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() )
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );

						?></div><?php

						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'studeon_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>