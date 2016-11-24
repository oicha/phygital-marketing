<?php
/*
Template Name: Blog: Masonry
*/
?>
<?php get_header(); ?>
<?php newshub_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>
<?php get_template_part('content-top'); ?>
    <div class="mkd-container">
        <?php do_action('newshub_mikado_after_container_open'); ?>
        <div class="mkd-container-inner">
            <?php the_content(); ?>
            <?php newshub_mikado_get_blog('masonry'); ?>
        </div>
        <?php do_action('newshub_mikado_before_container_close'); ?>
    </div>
<?php get_template_part('content-bottom'); ?>
<?php get_footer(); ?>