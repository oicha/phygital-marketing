<?php

$params = '';

if ($archive_type == 'category'){
	$posts_in_archive = $posts_in_category;
	$params .= ' category_id="'.$category_id.'"';
}
elseif($archive_type == 'author'){
	$posts_in_archive = '';
	$params .= ' author_id="'.$author_id.'"';
}
elseif($archive_type == 'tag'){
	$posts_in_archive = '';
	$params .= ' tag_slug="'.$tag_slug.'"';
}

if($thumb_image_width != '' && $thumb_image_height != '') {
	$params .= ' thumb_image_size="custom_size"';
	$params .= ' thumb_image_width="'.$thumb_image_width.'"';
	$params .= ' thumb_image_height="'.$thumb_image_height.'"';
}

if($excerpt_length != ''){
	$params .= ' excerpt_length="'.$excerpt_length.'"';
}

if (isset($title) && $title != '') {
    $params .= ' title="'.$title.'"';
}

if(isset($display_category) && $display_category != ''){
    $params .= ' display_category="'.$display_category.'"';
}

if ($template_type == "type1") {

	if($posts_in_archive > 8 || $posts_in_archive == ''){
        $per_page  = $posts_per_page !== 0 ? $posts_per_page : 8;
		$number_of_posts = $per_page;
		$params .= ' number_of_posts="'.$number_of_posts.'"';
	} else {
		$number_of_posts = $posts_in_archive;
		$params .= ' number_of_posts="'.$number_of_posts.'"';
	}

    $params .= ' title_tag="h3"';

    $params .= ' title_length="10"';

	$column_number = 2;
	$params .= ' column_number="'.$column_number.'"';

    $display_author = 'yes';
    $params .= ' display_author="'.$display_author.'"';

    $display_excerpt = 'yes';
    $params .= ' display_excerpt="'.$display_excerpt.'"';

	$display_pagination = 'yes';
	$params .= ' display_pagination="'.$display_pagination.'"';

	$params .= ' pagination_type="'.$pagination_type.'"';

	$extra_class_name = 'unique-category-template-one';
	$params .= ' extra_class_name="'.$extra_class_name.'"';

} else if ($template_type == "type2") {

    if($posts_in_archive > 9 || $posts_in_archive == ''){
        $per_page  = $posts_per_page !== 0 ? $posts_per_page : 9;
        $number_of_posts = $per_page;
        $params .= ' number_of_posts="'.$number_of_posts.'"';
    } else {
        $number_of_posts = $posts_in_archive;
        $params .= ' number_of_posts="'.$number_of_posts.'"';
    }

    $params .= ' title_tag="h3"';

    $params .= ' title_length="10"';

    $column_number = 3;
    $params .= ' column_number="'.$column_number.'"';

    $display_author = 'yes';
    $params .= ' display_author="'.$display_author.'"';

    $display_excerpt = 'yes';
    $params .= ' display_excerpt="'.$display_excerpt.'"';

    $display_pagination = 'yes';
    $params .= ' display_pagination="'.$display_pagination.'"';

    $params .= ' pagination_type="'.$pagination_type.'"';

    $extra_class_name = 'unique-category-template-two';
    $params .= ' extra_class_name="'.$extra_class_name.'"';

} else if ($template_type == "type3") {

    if($posts_in_archive > 4 || $posts_in_archive == ''){
        $per_page  = $posts_per_page !== 0 ? $posts_per_page : 4;
        $number_of_posts = $per_page;
        $params .= ' number_of_posts="'.$number_of_posts.'"';
    } else {
        $number_of_posts = $posts_in_archive;
        $params .= ' number_of_posts="'.$number_of_posts.'"';
    }

    $column_number = 1;
    $params .= ' column_number="'.$column_number.'"';

    $display_author = 'yes';
    $params .= ' display_author="'.$display_author.'"';

    $display_excerpt = 'yes';
    $params .= ' display_excerpt="'.$display_excerpt.'"';

    $display_pagination = 'yes';
    $params .= ' display_pagination="'.$display_pagination.'"';

    $params .= ' pagination_type="'.$pagination_type.'"';

    $extra_class_name = 'unique-category-template-three';
    $params .= ' extra_class_name="'.$extra_class_name.'"';

}

if (newshub_mikado_options()->getOptionValue('archive_section_title') === 'yes') {
    newshub_mikado_get_module_template_part('templates/lists/parts/section-title', 'blog');
}

?>

    <div class="mkd-unique-category-layout clearfix">
        <?php
        switch ($template_type) {
            case 'type1':
                echo do_shortcode("[mkd_post_layout_one $params]"); // XSS OK
                break;
            case 'type2':
                echo do_shortcode("[mkd_post_layout_one $params]"); // XSS OK
                break;
            case 'type3':
                echo do_shortcode("[mkd_post_layout_six $params]"); // XSS OK
                break;
            default :
                break;
        }
        ?>
    </div>