<?php
	if(isset($title_tag)){
		$title_tag = $title_tag;
	}else{
		$title_tag = 'h1';
	}
?>

<?php

if ($post_type == 'link') { ?>
    <<?php echo esc_attr($title_tag);?> itemprop="name" class="entry-title mkd-post-title"><a href="<?php echo esc_url(get_post_meta(get_the_ID(), "mkd_post_link_link_meta", true)); ?>"><?php echo the_title() ?></a></<?php echo esc_attr($title_tag);?>>
<?php } else { ?>
    <<?php echo esc_attr($title_tag);?> itemprop="name" class="entry-title mkd-post-title"><?php the_title(); ?></<?php echo esc_attr($title_tag);?>>
<?php } ?>