<?php 
/*
Template Name: Full Width
*/ 
?>
<?php
$newshub_sidebar = newshub_mikado_sidebar_layout(); ?>

<?php get_header(); ?>
<?php newshub_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>
<?php get_template_part('content-top'); ?>

<div class="mkd-full-width">
<div class="mkd-full-width-inner">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php if(($newshub_sidebar == 'default')||($newshub_sidebar == '')) : ?>
			<?php the_content(); ?>
			<?php do_action('newshub_mikado_page_after_content'); ?>
		<?php elseif($newshub_sidebar == 'sidebar-33-right' || $newshub_sidebar == 'sidebar-25-right'): ?>
			<div <?php echo newshub_mikado_sidebar_columns_class(); ?>>
				<div class="mkd-column1 mkd-content-left-from-sidebar">
					<div class="mkd-column-inner">
						<?php the_content(); ?>
						<?php do_action('newshub_mikado_page_after_content'); ?>
					</div>
				</div>
				<div class="mkd-column2">
					<?php get_sidebar(); ?>
				</div>
			</div>
		<?php elseif($newshub_sidebar == 'sidebar-33-left' || $newshub_sidebar == 'sidebar-25-left'): ?>
			<div <?php echo newshub_mikado_sidebar_columns_class(); ?>>
				<div class="mkd-column1">
					<?php get_sidebar(); ?>
				</div>
				<div class="mkd-column2 mkd-content-right-from-sidebar">
					<div class="mkd-column-inner">
						<?php the_content(); ?>
						<?php do_action('newshub_mikado_page_after_content'); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
	<?php endif; ?>
</div>
</div>
<?php get_template_part('content-bottom'); ?>
<?php get_footer(); ?>