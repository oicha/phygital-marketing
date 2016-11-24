<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkd-post-content">
        <?php if (has_post_thumbnail()){ ?>
            <div class="mkd-post-image-area">
                <?php newshub_mikado_get_module_template_part('templates/parts/video', 'blog'); ?>
            </div>
        <?php } ?>
        <div class="mkd-post-text">
            <div class="mkd-post-text-inner clearfix">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
    <?php do_action('newshub_mikado_before_blog_article_closed_tag'); ?>
</article>