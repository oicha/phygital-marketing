<div <?php echo newshub_mikado_class_attribute($blog_classes) ?>>
    <?php

    if (newshub_mikado_options()->getOptionValue('blog_list_first_post_full_content_section_title') === 'yes') {
        newshub_mikado_get_module_template_part('templates/lists/parts/section-title', 'blog');
    }

    $i = 1;

    if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post();

        if ($i === 1) {

            newshub_mikado_get_post_format_html($blog_type);
            $i++;
        } else {
            if ($i === 2) {
                echo '<div class="mkd-bnl-holder mkd-pl-one-holder mkd-post-columns-1">';
                echo '<div class="mkd-bnl-outer">';
                echo '<div class="mkd-bnl-inner">';
                $i++;
            }

            newshub_mikado_get_layout_post_format_html($blog_type, "second");
        }


    endwhile;

        if ($i !== 1) {
            echo '</div></div></div>';
        };

    else:
        newshub_mikado_get_module_template_part('templates/parts/no-posts', 'blog');
    endif;
    ?>
</div>
<?php
if (newshub_mikado_options()->getOptionValue('pagination') == 'yes') {
    newshub_mikado_pagination($blog_query->max_num_pages, $blog_page_range, $paged);
}
?>