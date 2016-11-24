<?php

$template_type = newshub_mikado_options()->getOptionValue('blog_list_type');


$params = array();

if ($template_type == "type1") {

    $template_type_layout = 'post-template-one';

    $template_classes = "mkd-pl-one-holder mkd-post-columns-2";

    $params['thumb_image_size'] = '';
    $params['thumb_image_width'] = '';
    $params['thumb_image_height'] = '';

    $params['display_post_type_icon'] = 'no';
    $params['post_type_icon_size'] = 'small';

    $params['display_category'] = 'yes';

    $params['title_tag'] = 'h4';
    $params['title_length'] = '';

    $params['display_date'] = 'yes';
    $params['date_format'] = 'F d';

    $params['display_comments'] = 'no';
    $params['display_count'] = 'no';
    $params['display_like'] = 'no';
    $params['display_author'] = 'no';

    $params['display_excerpt'] = 'no';
    $params['excerpt_length'] = '20';
    $params['excerpt_style'] = '';

    $params['display_share'] = 'no';
    $params['display_read_more'] = 'no';

} else if ($template_type == "type2") {

    $template_type_layout = 'post-template-one';

    $template_classes = "mkd-pl-six-holder mkd-post-columns-3";

    $params['thumb_image_size'] = '';
    $params['thumb_image_width'] = '';
    $params['thumb_image_height'] = '';

    $params['display_post_type_icon'] = 'no';
    $params['post_type_icon_size'] = 'small';

    $params['display_category'] = 'yes';

    $params['title_tag'] = 'h4';
    $params['title_length'] = '';

    $params['display_date'] = 'yes';
    $params['date_format'] = 'F d';

    $params['display_comments'] = 'no';
    $params['display_count'] = 'no';
    $params['display_like'] = 'no';
    $params['display_author'] = 'no';

    $params['display_excerpt'] = 'no';
    $params['excerpt_length'] = '20';
    $params['excerpt_style'] = '';

    $params['display_share'] = 'no';
    $params['display_read_more'] = 'no';

} else if ($template_type == "type3") {

    $template_type_layout = 'post-template-one';

    $template_classes = "mkd-pl-one-holder mkd-post-columns-1";

    $params['thumb_image_size'] = '';
    $params['thumb_image_width'] = '';
    $params['thumb_image_height'] = '';

    $params['display_post_type_icon'] = 'no';
    $params['post_type_icon_size'] = 'small';

    $params['display_category'] = 'yes';

    $params['title_tag'] = 'h4';
    $params['title_length'] = '';

    $params['display_date'] = 'yes';
    $params['date_format'] = 'F d';

    $params['display_comments'] = 'no';
    $params['display_count'] = 'no';
    $params['display_like'] = 'no';
    $params['display_author'] = 'no';

    $params['display_excerpt'] = 'no';
    $params['excerpt_length'] = '20';
    $params['excerpt_style'] = '';

    $params['display_share'] = 'no';
    $params['display_read_more'] = 'no';

}

?>

    <div class="mkd-unique-type clearfix">

        <?php if (newshub_mikado_options()->getOptionValue('archive_section_title') === 'yes') {
        newshub_mikado_get_module_template_part('templates/lists/parts/section-title', 'blog');
        } ?>

        <?php
        if ($blog_query->have_posts()) { ?>
            <div class="mkd-bnl-holder <?php echo esc_attr($template_classes); ?>">
                <div class="mkd-bnl-outer">
                    <div class="mkd-bnl-inner">
                        <?php
                        while ($blog_query->have_posts()) : $blog_query->the_post();
                            echo newshub_mikado_get_list_shortcode_module_template_part($template_type_layout, 'templates', '', $params);
                        endwhile;
                        ?>
                    </div>
                </div>
            </div>
            <?php
        } else {
            newshub_mikado_get_module_template_part('templates/parts/no-posts', 'blog');
        }
        ?>
    </div>
<?php
if (newshub_mikado_options()->getOptionValue('pagination') == 'yes') {
    newshub_mikado_pagination($blog_query->max_num_pages, $blog_page_range, $paged);
}
?>