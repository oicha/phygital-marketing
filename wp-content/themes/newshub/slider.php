<?php
$newshub_slider_shortcode = get_post_meta(newshub_mikado_get_page_id(), "mkd_page_slider_meta", true);
$newshub_slider_shortcode = apply_filters('newshub_mikado_slider_shortcode', $newshub_slider_shortcode);
if (!empty($newshub_slider_shortcode)) { ?>
	<div class="mkd-slider">
		<div class="mkd-slider-inner">
			<?php echo do_shortcode(wp_kses_post($newshub_slider_shortcode)); // XSS OK ?>
		</div>
	</div>
<?php } ?>