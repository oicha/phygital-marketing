<section class="mkd-post-item mkd-pt-three-item">


    <div class="mkd-post-item-inner">


        <?php
        newshub_mikado_post_info_category(array(
            'category' => $display_category
        )); ?>

        <<?php echo esc_html($title_tag); ?> class="mkd-pt-title" <?php newshub_mikado_inline_style($title_style); ?>>
        <a itemprop="url" class="mkd-pt-title-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"><?php echo newshub_mikado_get_title_substring(get_the_title(), $title_length) ?></a>
    </<?php echo esc_html($title_tag); ?>>

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

    </div><!-- .mkd-post-item-inner -->
</section><!-- .mkd-post-item -->