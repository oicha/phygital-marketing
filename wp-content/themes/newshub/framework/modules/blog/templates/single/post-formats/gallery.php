<?php
$image_gallery_val = get_post_meta( get_the_ID(), 'mkd_post_gallery_images_meta' , true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkd-post-content">
        <?php if ($image_gallery_val !== ''){ ?>
            <div class="mkd-post-image-area">
                <?php newshub_mikado_get_module_template_part('templates/single/parts/gallery', 'blog'); ?>
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