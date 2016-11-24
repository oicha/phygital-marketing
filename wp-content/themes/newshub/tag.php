<?php
$newshub_blog_archive_pages_classes = newshub_mikado_blog_archive_pages_classes(newshub_mikado_get_author_blog_list());
?>
<?php get_header(); ?>
<?php newshub_mikado_get_title(); ?>
<div class="<?php echo esc_attr($newshub_blog_archive_pages_classes['holder']); ?>">
<?php do_action('newshub_mikado_after_container_open'); ?>
	<div class="<?php echo esc_attr($newshub_blog_archive_pages_classes['inner']); ?>">
		<?php newshub_mikado_get_blog(newshub_mikado_get_tag_blog_list()); ?>
	</div>
<?php do_action('newshub_mikado_before_container_close'); ?>
</div>
<?php get_footer(); ?>