<?php

$display_custom_feature_image_width = '';
if(newshub_mikado_options()->getOptionValue('blog_list_feature_image_max_width') !== ''){
	$display_custom_feature_image_width = intval(newshub_mikado_options()->getOptionValue('blog_list_feature_image_max_width'));
}
?>
<?php if ( has_post_thumbnail() ) { ?>
	<div class="mkd-post-image">
		<a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php if($type === 'masonry'){
                the_post_thumbnail(newshub_mikado_get_blog_masonry_gallery_classes(get_the_ID()));
            } elseif($display_custom_feature_image_width !== '') {
				the_post_thumbnail(array($display_custom_feature_image_width, 0));
			} else {
				the_post_thumbnail('newshub_mikado_post_feature_image');
			} ?>
		</a>
	</div>
<?php } ?>