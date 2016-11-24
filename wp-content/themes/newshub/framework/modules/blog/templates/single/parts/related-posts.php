<?php if ($related_posts && $related_posts->have_posts()) : ?>

<div class="mkd-related-posts-holder clearfix">
    <div class="mkd-title-holder">
        <h5 class="mkd-title-line-head"><?php esc_html_e('関連した記事', 'newshub'); ?></h5>
        <div class="mkd-title-line-body"></div>
    </div>

    <div class="mkd-post-columns-<?php echo esc_attr($related_posts_number) ?>">
        <div class="mkd-post-columns-inner">

            <?php while ($related_posts->have_posts()): $related_posts->the_post(); ?>

                <section class="mkd-post-item mkd-pt-one-item">
                    <div class="mkd-post-item-inner">

                        <?php if (has_post_thumbnail()) { ?>
                            <div class="mkd-pt-image-holder">
                                <a itemprop="url" class="mkd-pt-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
                                    <?php
                                    if ($related_posts_image_size == '') {
                                        echo get_the_post_thumbnail(get_the_ID());
                                    } else {
                                        echo newshub_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $related_posts_image_size, $related_posts_image_size);
                                    }
                                    ?>
                                </a>
                            </div><!-- .mkd-pt-image-holder -->
                        <?php } ?>

                        <?php
                        newshub_mikado_post_info_category(array(
                            'category' => 'yes'
                        )); ?>

                        <div class="mkd-pt-title">
                            <h3>
                                <a itemprop="url" class="mkd-pt-title-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"><?php echo newshub_mikado_get_title_substring(get_the_title(), $related_posts_title_size) ?></a>
                            </h3>
                        </div>

                        <div class="mkd-pt-meta-section clearfix">
                            <?php newshub_mikado_post_info_date(array(
                                'date' => 'yes',
                            )) ?>
                        </div><!-- .mkd-pt-meta-section -->

                    </div><!-- .mkd-post-item-inner -->
                </section><!-- .mkd-post-item -->

            <?php endwhile; ?>
        </div>
    </div><!-- .mkd-related-posts-inner -->
</div><!-- .mkd-related-posts-holder -->
<?php endif;
wp_reset_postdata();
?>
