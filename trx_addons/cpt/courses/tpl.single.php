<?php
/**
 * The template to display the course's single post
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

get_header();

while ( have_posts() ) { the_post();
	
	$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
	
	?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'courses_single itemscope' ); ?>
    	itemscope itemtype="//schema.org/Article">
		
		<section class="courses_page_header">	

			<?php
			// Image
			if ( has_post_thumbnail() ) {
				?><div class="courses_page_featured">
					<?php
					the_post_thumbnail( trx_addons_get_thumb_size('huge'), array(
								'alt' => the_title_attribute( array( 'echo' => false ) ),
								'itemprop' => 'image'
								)
							);
					?>
				</div>
				<?php
			}
			
			// Title, price and meta
			?>
			<h2 class="courses_page_title">
				<?php the_title(); ?>
				<div class="courses_page_price"><?php
					$price = explode('/', $meta['price']);
					echo esc_html($price[0]) . (!empty($price[1]) ? '<span class="courses_page_period">'.$price[1].'</span>' : '');
				?></div>
			</h2>

			<div class="courses_page_meta">
				<span class="courses_page_meta_item courses_page_meta_date"><?php
					$dt = $meta['date'];
					echo sprintf($dt < date('Y-m-d') ? esc_html__('Started on %s', 'studeon') : esc_html__('Starting %s', 'studeon'), '<span class="courses_page_meta_item_date">' . date(get_option('date_format'), strtotime($dt)) . '</span>');
				?></span>
				<span class="courses_page_meta_item courses_page_meta_duration"><?php echo esc_html($meta['duration']); ?></span>
            </div>

		</section>
		<?php

		// Post content
		?><div class="courses_page_content entry-content" itemprop="articleBody"><?php
			the_content( );
		?></div><!-- .entry-content -->
		<?php
		if (!empty($meta['product']) && (int) $meta['product'] > 0) {
			$title = array();
			$title['link'] = get_permalink($meta['product']);
			$title['link_text'] = esc_html__('Join the Course', 'studeon');
			echo '<div class="sc_item_button sc_button_wrap"><a href="' . esc_url($title['link']) . '" class="sc_button sc_button_default  sc_button_size_normal"><span class="sc_button_text"><span class="sc_button_title">' . esc_html($title['link_text']) . '</span></span></a><!-- /.sc_button --></div>';
		}
	?></article><?php

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

get_footer();
?>