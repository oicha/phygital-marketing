<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkd-post-content">
        <div class="mkd-post-text">
            <div class="mkd-post-text-inner clearfix">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
    <?php do_action('newshub_mikado_before_blog_article_closed_tag'); ?>
</article>