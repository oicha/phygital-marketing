<?php

if (newshub_mikado_options()->getOptionValue('blog_list_masonry_section_title') === 'yes') {
    newshub_mikado_get_module_template_part('templates/lists/parts/section-title', 'blog');
}

?>

<div <?php echo newshub_mikado_class_attribute($blog_classes) ?> <?php echo esc_attr($blog_data_params) ?> >

    <div class="mkd-blog-masonry-grid-sizer"></div>
    <div class="mkd-blog-masonry-grid-gutter"></div>

    <?php
    if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post();
        newshub_mikado_get_post_format_html($blog_type);
    endwhile;

    else:
        newshub_mikado_get_module_template_part('templates/parts/no-posts', 'blog');
    endif;

    ?>
</div>

<?php
if (newshub_mikado_options()->getOptionValue('pagination') == 'yes') {
    newshub_mikado_pagination($blog_query->max_num_pages, $blog_page_range, $paged, $blog_type);
}