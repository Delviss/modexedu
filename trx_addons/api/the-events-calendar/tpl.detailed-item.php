<?php
/**
 * The style "detailed" of the Events item
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

$args = get_query_var('trx_addons_args_sc_events');

if ($args['slider']) {
	?><div class="swiper-slide"><?php
} else if ((int)$args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}

	// Event's date
	$date_d = tribe_get_start_date(null, true, 'd');
	$date_m = tribe_get_start_date(null, true, 'F');
	if (empty($date_d) || empty($date_m)) {
		$date_d = get_the_date('d');
		$date_m = get_the_date('F');
	}
	$start_day = tribe_get_start_date(null, true, 'l ');
	$start_date = explode('|', tribe_get_start_date(null, true, 'M,d|'.get_option('time_format')));
	$end_date = explode('|', tribe_get_end_date(null, true, 'M,d|'.get_option('time_format')));
	$thumb_url = get_the_post_thumbnail_url(null,apply_filters('trx_addons_filter_thumb_size', trx_addons_get_thumb_size('avatar'), 'events-detailed'));
	// Event's date
	?><div class="sc_events_detailed_wrap">
	<span class="sc_events_item_date_wrap"><span class="sc_events_item_date"><?php echo esc_html($date_d); ?><span><?php echo esc_html($date_m); ?></span></span></span><?php
	// Event's thumb
	?><span class="sc_events_item_thumb_wrap"><span class="sc_events_item_thumb"><img src="<?php echo esc_url($thumb_url);?>" alt="<?php the_title(); ?>"/></span></span><?php
	// Event's title
	?><span class="sc_events_item_title_wrap"><span class="sc_events_item_title"><a href="<?php echo esc_url(get_permalink()); ?>" class="sc_events_item"><?php the_title(); ?></a></span></span><?php
	// Event's time
	?><span class="sc_events_item_time_wrap"><span class="sc_events_item_time">
	<?php
		if($start_date[0]==$end_date[0] && trim($start_date[1]) && trim($end_date[1])){
			echo (trim($start_date[1]) ? $start_day . $start_date[1] : esc_html__('Whole day', 'studeon'))
				. ($start_date[0] == $end_date[0] && trim($start_date[1]) && trim($end_date[1]) ? ' - ' . $end_date[1] : '');
		}
		else {
			$start = tribe_get_start_date(null, true, 'l @ '.get_option('time_format'));
			$end = tribe_get_end_date(null, true, 'l @ '.get_option('time_format'));
			echo '<span>' . esc_html($start) . '</span><span>' . esc_html($end) . '</span>';
		}
	?>
	</span></span><?php
	// Arrow (button)
	?>
	<?php if ( tribe_address_exists() ) { ?>
	<span class="sc_events_item_address_wrap">
		<span class="sc_events_item_address">
			<?php echo tribe_get_full_address(); ?>
		</span>
	</span>
	<?php } ?>
	</div>
	<?php
	
if ($args['slider'] || (int)$args['columns'] > 1) {
	?></div><?php
}

?>