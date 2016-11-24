<section class="mkd-post-item mkd-pt-nine-item">
    <div class="mkd-pt-nine-bgrnd" style="background-image:url(<?php echo esc_url(the_post_thumbnail_url(get_the_ID(), 'full')); ?>);"></div>
    <div class="mkd-post-item-inner">

        <div class="mkd-vertical-shader">
        </div>

        <div class="mkd-pt-content-holder">
            <div class="mkd-grid">
                <div class="mkd-pt-content-holder-inner">
                    <div class="mkd-pt-content-holder-inner2">

                        <?php
                        newshub_mikado_post_info_category(array(
                            'category' => $display_category
                        )); ?>

                        <<?php echo esc_html($title_tag); ?> class="mkd-pt-title" <?php newshub_mikado_inline_style($title_style); ?>>
                        <a itemprop="url" class="mkd-pt-title-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"><?php echo newshub_mikado_get_title_substring(get_the_title(), $title_length) ?></a>
                    </<?php echo esc_html($title_tag) ?>>

                    <?php if ($display_excerpt == 'yes') { ?>
                        <div itemprop="description" class="mkd-pt-excerpt" <?php newshub_mikado_inline_style($excerpt_style); ?>>
                            <?php newshub_mikado_excerpt($excerpt_length); ?>
                        </div>
                    <?php } ?>

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

                    <?php if ($display_read_more == 'yes') { ?>
                        <div class="mkd-read-more-holder">
                            <?php $params = array(
                                'type' => 'solid',
                                'icon_pack' => 'ion_icons',
                                'ion_icon' => 'ion-chevron-right'
                            ); ?>
                            <?php newshub_mikado_read_more_button('', 'mkd-read-more', $params); ?>
                        </div>
                    <?php } ?>
                </div><!-- .mkd-pt-content-holder-inner2 -->
            </div><!-- .mkd-pt-content-holder-inner -->

        </div><!-- .grid -->
    </div><!-- .mkd-pt-content-holder -->

    </div><!-- .mkd-post-item-inner -->
</section><!-- .mkd-post-item -->