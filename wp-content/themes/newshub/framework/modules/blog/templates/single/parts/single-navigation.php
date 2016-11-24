<?php if(newshub_mikado_options()->getOptionValue('blog_single_navigation') == 'yes'){
    if(isset($post_id)){
        $id = $post_id;
    }else{
        $id = get_the_ID();
    }

    $same_category = false;
    if(newshub_mikado_options()->getOptionValue('blog_navigation_through_same_category') == 'yes') {
        $same_category = true;
    }
    $prev_post = get_previous_post($same_category);
    $next_post = get_next_post($same_category);

    ?>

	<div class="mkd-blog-single-navigation">
        <div class="mkd-blog-single-navigation-title">
            <h5 class="mkd-title-line-head"><?php esc_html_e('前の記事', 'newshub' ); ?></h5>
            <div class="mkd-title-line-body"></div>
            <h5 class="mkd-title-line-head"><?php esc_html_e('次の記事', 'newshub' ); ?></h5>
        </div>
        <?php
        if(($prev_post)) {
			$prev_html = '<div class="mkd-blog-single-navigation-arrow">
                    <span class="ion-chevron-left"></span></div>
                    <h6 class="mkd-blog-single-navigation-link-name">'.esc_html(newshub_mikado_get_title_substring(get_the_title($prev_post->ID),10)).'</h6>';
			?>
			<div class="mkd-blog-single-prev">
				<?php
                if($same_category){
					previous_post_link('%link', $prev_html, true,'','category');

				} else {
					previous_post_link('%link',$prev_html);
				}
				?>
			</div>
		<?php }
		if(($next_post)) {
			$next_html = '<h6 class="mkd-blog-single-navigation-link-name">'.esc_html(newshub_mikado_get_title_substring(get_the_title($next_post->ID),10)).'</h6>
                    <div class="mkd-blog-single-navigation-arrow">
                    <span class="ion-chevron-right"></span></div>';
			?>
			<div class="mkd-blog-single-next">
				<?php
                if($same_category){
					next_post_link('%link', $next_html, true,'','category');
				} else {
					next_post_link('%link',$next_html);
				}
				?>
			</div>
            <?php } ?>
    </div>
<?php } ?>