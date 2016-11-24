<?php
$audio_type = get_post_meta(get_the_ID(), "mkd_audio_type_meta", true);
if ($audio_type == 'social_networks') {
    $audio_link = get_post_meta(get_the_ID(), "mkd_post_audio_link_meta", true);
}
elseif ($audio_type == 'self') {
    $audio_link = get_post_meta(get_the_ID(), "mkd_post_audio_mp3_link_meta", true);
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkd-post-content">
        <?php if ($audio_link !== ''){ ?>
            <div class="mkd-post-image-area">
                <?php newshub_mikado_get_module_template_part('templates/parts/audio', 'blog'); ?>
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

