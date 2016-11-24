<?php

/***** Get current author page ID and meta boxes options from author admin panel *****/
$author_id = newshub_mikado_get_current_object_id();

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

/***** Set params for posts on author page *****/

$template = 'type2';
if (newshub_mikado_options()->getOptionValue('author_unique_layout') !== ''){
    $template = newshub_mikado_options()->getOptionValue('author_unique_layout');
}

$chars_array = newshub_mikado_blog_lists_number_of_chars();
if (isset($chars_array) && $chars_array !== '') {
    $params['excerpt_length'] = $chars_array;
}

$author_info_email = esc_attr(newshub_mikado_options()->getOptionValue('blog_author_info_email'));

$params['archive_type'] = 'author';
$params['author_id'] = $author_id;
$params['template_type'] = $template;
$params['thumb_image_width'] = '748';
$params['thumb_image_height'] = '520';
$params['posts_per_page'] = 4;
$params['pagination_type'] = 'infinite';


?>

<div class="mkd-unique-author-layout clearfix">
    <div class="mkd-author-description">
        <div class="mkd-author-description-inner">
            <div class="mkd-author-description-image">
                <a itemprop="url" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" title="<?php the_title_attribute(); ?>" target="_self">
                    <?php echo newshub_mikado_kses_img(get_avatar(get_the_author_meta( 'ID' ), 174)); ?>
                </a>
            </div>
            <div class="mkd-author-description-text-holder">
                <h6 class="mkd-author-name vcard author">
                    <a itemprop="url" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" title="<?php the_title_attribute(); ?>" target="_self">
                        <?php
                        if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
                            echo esc_attr(get_the_author_meta('first_name')) . " " . esc_attr(get_the_author_meta('last_name'));
                        } else {
                            echo esc_attr(get_the_author_meta('display_name'));
                        }
                        ?>
                    </a>
                </h6>
                <?php if($author_info_email === 'yes' && is_email(get_the_author_meta('email'))){ ?>
                    <p class="mkd-author-email"><?php echo sanitize_email(get_the_author_meta('email')); ?></p>
                <?php } ?>
                <?php if(get_the_author_meta('description') != "") { ?>
                    <div class="mkd-author-text">
                        <p><?php echo esc_attr(get_the_author_meta('description')); ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php

    newshub_mikado_get_module_template_part('templates/lists/unique-layouts', 'blog','',$params);
    ?>
</div>