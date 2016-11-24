<?php
    /*
        Template Name: Blog: Standard
    */
?>
<?php get_header(); ?>
<?php newshub_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>
<?php get_template_part('content-top'); ?>
<div class="mkd-container">
    <?php do_action('newshub_mikado_after_container_open'); ?>
    <div class="mkd-container-inner" >
        <?php newshub_mikado_get_blog('standard'); ?>
    </div>
    <?php do_action('newshub_mikado_before_container_close'); ?>
</div>
<?php get_template_part('content-bottom'); ?>
<?php get_footer(); ?>