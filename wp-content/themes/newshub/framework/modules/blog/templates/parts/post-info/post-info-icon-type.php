<div class="mkd-post-info-icon-holder mkd-<?php echo esc_attr($params['size']) ?>">
	<span class="mkd-post-info-icon-holder-table">
		<span class="mkd-post-info-icon-holder-cell">
            <?php
            if ($params['post_type'] == 'mkd-post-video') { ?>
                <a itemprop="image" href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto">
                    <span class="mkd-post-info-icon <?php echo esc_attr($params['post_type']) ?>"></span>
                </a>
            <?php } else { ?>
                <span class="mkd-post-info-icon <?php echo esc_attr($params['post_type']) ?>"></span>
            <?php } ?>
		</span>
	</span>
</div>