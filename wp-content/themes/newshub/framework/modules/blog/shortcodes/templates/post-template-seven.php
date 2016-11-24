<section class="mkd-post-item mkd-pt-seven-item" style="background-image:url(<?php echo esc_url(the_post_thumbnail_url(get_the_ID(), 'full')); ?>);">
    <div class="mkd-grid">
        <div class="mkd-post-item-holder">
        <div class="mkd-post-item-inner">

            <?php if ($display_post_type_icon == 'yes') {
                newshub_mikado_post_info_type(array(
                    'icon' => 'yes',
                    'size' => $post_type_icon_size,
                ));
            }
            ?>

            <?php
            newshub_mikado_post_info_category(array(
                'category' => $display_category
            )); ?>

            <h3 class="mkd-pt-title" <?php newshub_mikado_inline_style($title_style); ?>>
                <a itemprop="url" class="mkd-pt-title-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"><?php echo newshub_mikado_get_title_substring(get_the_title(), $title_length) ?></a>
            </h3>

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

            <?php if ($display_excerpt == 'yes') { ?>
                <div itemprop="description" class="mkd-pt-excerpt" <?php newshub_mikado_inline_style($excerpt_style); ?>>
                    <?php newshub_mikado_excerpt($excerpt_length); ?>
                </div>
            <?php } ?>

        </div><!-- .mkd-post-item-inner -->
        </div><!-- .mkd-post-item-holder -->
        </div><!-- .grid -->
</section><!-- .mkd-post-item -->