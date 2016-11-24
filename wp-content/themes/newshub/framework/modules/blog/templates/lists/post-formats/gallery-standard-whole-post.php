<article id="post-<?php the_ID(); ?>" <?php post_class('mkd-post-item mkd-pt-one-item'); ?> >
    <div class="mkd-post-item-inner">

        <?php if (has_post_thumbnail() && $display_feature_image == 'yes') { ?>
            <div class="mkd-pt-image-holder">
                <?php newshub_mikado_get_module_template_part('templates/lists/parts/gallery', 'blog'); ?>
            </div><!-- .mkd-pt-image-holder -->
        <?php } ?>

        <?php
        newshub_mikado_post_info_category(array(
            'category' => $display_category
        )); ?>

        <<?php echo esc_attr($title_tag); ?> itemprop="name" class="entry-title mkd-pt-title">
        <a itemprop="url" href="<?php the_permalink(); ?>" class="mkd-pt-title-link" title="<?php the_title_attribute(); ?>"><?php echo newshub_mikado_get_title_substring(get_the_title(), $title_length) ?></a>
    </<?php echo esc_attr($title_tag); ?>>


    <?php the_content(); ?>

    <?php if ($display_date == 'yes' || $display_author == 'yes' || $display_comments == 'yes' || $display_count == 'yes' || $display_like == 'yes' || $display_share == 'yes' || $display_read_more == 'yes') { ?>
        <div class="mkd-pt-meta-more-holder">
            <div class="mkd-pt-meta-section clearfix">
                <?php newshub_mikado_post_info_author(array(
                    'author' => $display_author
                )) ?>
                <?php newshub_mikado_post_info_date(array(
                    'date' => $display_date,
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
                <?php newshub_mikado_post_info_share(array(
                    'share' => $display_share,
                    'type' => 'list'
                )); ?>
            </div><!-- .mkd-pt-meta-section -->
            <div class="mkd-pt-more-section">
                <?php if ($display_read_more == 'yes') {
                    $params = array(
                        'icon_pack' => 'ion_icons',
                    );
                    newshub_mikado_read_more_button('', 'mkd-read-more', $params);
                } ?>
            </div>
        </div><!-- .mkd-pt-meta-more-holder -->
    <?php } ?>

    </div><!-- .mkd-post-item-inner -->
    <?php do_action('newshub_mikado_before_blog_list_article_closed_tag'); ?>
</article>