<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkd-post-item-inner">

        <?php
        newshub_mikado_post_info_category(array(
            'category' => $display_category
        )); ?>

        <div class="mkd-post-title">
            <<?php echo esc_attr($title_tag); ?> class="mkd-quote-text"><?php the_title(); ?></<?php echo esc_attr($title_tag); ?>>
        <?php if (get_post_meta(get_the_ID(), "mkd_post_quote_author_meta", true) !== '') { ?>
            <span class="mkd-quote-author">-<?php echo esc_html(get_post_meta(get_the_ID(), "mkd_post_quote_author_meta", true)); ?></span>
        <?php } ?>
    </div>

    <a itemprop="url" class="mkd-post-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>


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

    </div>
    <?php do_action('newshub_mikado_before_blog_list_article_closed_tag'); ?>
</article>