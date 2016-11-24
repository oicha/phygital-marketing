<?php

/***** Set params for posts on 404 page *****/

$newshub_params = '';

$number_of_posts = 6;
$newshub_params .= ' number_of_posts="'.$number_of_posts.'"';	

$column_number = 3;
$newshub_params .= ' column_number="'.$column_number.'"';

$display_author = 'yes';
$newshub_params .= ' display_author="'.$display_author.'"';

$display_excerpt = 'yes';
$newshub_params .= ' display_excerpt="'.$display_excerpt.'"';

$newshub_params .= 'thumb_image_size = "custom_size"';
$newshub_params .= 'thumb_image_width = "748"';
$newshub_params .= 'thumb_image_height = "520"';

if (newshub_mikado_blog_lists_number_of_chars() !== '') {
    $newshub_params .= ' excerpt_length="' . newshub_mikado_blog_lists_number_of_chars() . ' " ';
}

$newshub_params .= ' title_tag="h3"';
$newshub_params .= ' title_length="10"';


?>
<?php get_header(); ?>

<?php newshub_mikado_get_title(); ?>

	<div class="mkd-container mkd-404-page">
	<?php do_action('newshub_mikado_after_container_open'); ?>
        <div class="mkd-page-not-found">
            <h1>
                <?php if(newshub_mikado_options()->getOptionValue('404_title')){
                    echo esc_html(newshub_mikado_options()->getOptionValue('404_title'));
                } else {
                    esc_html_e('404エラー', 'newshub');
                } ?>
            </h1>
            <h5>
                <?php if(newshub_mikado_options()->getOptionValue('404_text')){
                    echo esc_html(newshub_mikado_options()->getOptionValue('404_text'));
                } else {
                    esc_html_e("申し訳ございません。お探しのページは存在いたしません。.", "newshub");
                } ?>
            </h5>
            <?php
                $newshub_button_params = array();
                if (newshub_mikado_options()->getOptionValue('404_back_to_home')){
                    $newshub_button_params['text'] = newshub_mikado_options()->getOptionValue('404_back_to_home');
                } else {
                    $newshub_button_params['text'] = esc_html__('ホームに戻る', 'newshub');
                }
                $newshub_button_params['type'] = 'solid';
                $newshub_button_params['size'] = 'large';
                $newshub_button_params['link'] = esc_url(home_url('/'));
                $newshub_button_params['target'] = '_self';
            echo newshub_mikado_execute_shortcode('mkd_button', $newshub_button_params);?>


        </div>
        <div class="mkd-container-inner">
            <div class="mkd-layout-title-holder"><div class="mkd-section-title-holder clearfix">
                    <h5 class="mkd-title-line-head">
                        <?php esc_html_e('最新記事', 'newshub') ?></h5>
                    <div class="mkd-title-line-body"></div>
                </div>
            </div>
            <?php echo do_shortcode("[mkd_post_layout_one $newshub_params]"); ?>
        </div>


		<?php do_action('newshub_mikado_before_container_close'); ?>
	</div>
<?php get_footer(); ?>