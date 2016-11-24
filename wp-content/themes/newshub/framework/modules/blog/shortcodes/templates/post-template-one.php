<section class="mkd-post-item mkd-pt-one-item">
    <div class="mkd-post-item-inner">

        <?php if (has_post_thumbnail()) { ?>
            <div class="mkd-pt-image-holder">
                <a itemprop="url" class="mkd-pt-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
                    <?php
                    if ($thumb_image_size != 'custom_size') {
                        echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
                    } elseif ($thumb_image_width != '' && $thumb_image_height != '') {
                        echo newshub_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $thumb_image_width, $thumb_image_height);
                    }
                    ?>
                </a>

                <?php if ($display_post_type_icon == 'yes') {
                    newshub_mikado_post_info_type(array(
                        'icon' => 'yes',
                        'size' => $post_type_icon_size,
                    ));
                } ?>

                <?php if ($display_share == 'yes') {
                    newshub_mikado_post_info_share(array(
                        'share' => $display_share
                    ));
                } ?>
            </div><!-- .mkd-pt-image-holder -->
        <?php } ?>

        <?php
        newshub_mikado_post_info_category(array(
            'category' => $display_category
        )); ?>

        <<?php echo esc_html($title_tag); ?> class="mkd-pt-title" <?php newshub_mikado_inline_style($title_style); ?>>
        <a itemprop="url" class="mkd-pt-title-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"><?php echo newshub_mikado_get_title_substring(get_the_title(), $title_length) ?></a>
    </<?php echo esc_html($title_tag) ?>>

    <?php if ($display_title_separator == 'yes') { ?>
        <div class="mkd-pt-title-separator-holder">
            <div class="mkd-pt-title-separator">
            </div>
        </div>
    <?php } ?>

    <?php if ($display_excerpt == 'yes') { ?>
        <div itemprop="description" class="mkd-pt-excerpt" <?php newshub_mikado_inline_style($excerpt_style); ?>>
            <?php newshub_mikado_excerpt($excerpt_length); ?>
        </div>
    <?php } ?>

    <?php if ($display_date == 'yes' || $display_author == 'yes' || $display_comments == 'yes' || $display_count == 'yes' || $display_like == 'yes' || $display_read_more == 'yes') { ?>
        <div class="mkd-pt-meta-more-holder">
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

            <?php if ($display_read_more == 'yes') { ?>
                <div class="mkd-pt-more-section">
                    <?php $params = array(
                        'icon_pack' => 'ion_icons',
                    ); ?>
                    <?php newshub_mikado_read_more_button('', 'mkd-read-more', $params); ?>
                </div>
            <?php } ?>
        </div><!-- .mkd-pt-meta-more-holder -->
    <?php } ?>

    <?php if ($display_rating == 'yes') {
        newshub_mikado_post_info_rating(array(
            'rating' => $display_rating
        ));
    } ?>

    </div><!-- .mkd-post-item-inner -->
</section><!-- .mkd-post-item -->