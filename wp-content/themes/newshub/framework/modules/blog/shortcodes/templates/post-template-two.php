<section class="mkd-post-item mkd-pt-two-item">
    <div class="mkd-post-item-inner">

        <?php if (has_post_thumbnail()) { ?>
            <div class="mkd-pt-image-holder">
                <div class="mkd-pt-image-holder-inner">
                    <a itemprop="url" class="mkd-pt-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self" <?php newshub_mikado_inline_style($image_style); ?>>
                        <?php echo newshub_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $custom_thumb_image_width, $custom_thumb_image_height); ?>
                    </a>
                </div><!-- .mkd-pt-image-holder-inner -->
            </div><!-- .mkd-pt-image-holder -->
        <?php } ?>


        <div class="mkd-pt-content-holder">
            <<?php echo esc_html($title_tag); ?> class="mkd-pt-title" <?php newshub_mikado_inline_style($title_style); ?>>
            <a itemprop="url" class="mkd-pt-title-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"><?php echo newshub_mikado_get_title_substring(get_the_title(), $title_length) ?></a>
        </<?php echo esc_html($title_tag) ?>>

        <?php if ($display_date == 'yes' || $display_author == 'yes' || $display_comments == 'yes' || $display_count == 'yes' || $display_like == 'yes') { ?>
            <div class="mkd-pt-meta-section clearfix">
                <?php newshub_mikado_post_info_author(array(
                    'author' => $display_author
                )) ?>
                <?php newshub_mikado_post_info_date(array(
                    'date' => $display_date,
                    'date_format' => $date_format
                )) ?>
                <?php newshub_mikado_post_info_comments(array(
                    'comments' => $display_comments
                )) ?>
                <?php newshub_mikado_post_info_count(array(
                    'count' => $display_count
                )); ?>
                <?php newshub_mikado_post_info_like(array(
                    'like' => $display_like
                )); ?>
            </div><!-- .mkd-pt-meta-section -->
        <?php } ?>
    </div><!-- .mkd-pt-contnet-holder -->

    </div><!-- .mkd-post-item-inner -->
</section><!-- .mkd-post-item -->