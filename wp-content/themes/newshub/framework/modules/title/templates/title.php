<?php do_action('newshub_mikado_before_page_title'); ?>
<?php if($show_title_area) { ?>
    <?php switch ($type) {
        case 'standard': ?>
            <div class="mkd-title <?php echo newshub_mikado_title_classes(); ?> <?php if ($enable_breadcrumbs) { ?> mkd-standard-with-breadcrumbs <?php } ?>" style="<?php echo esc_attr($title_background_color); echo esc_attr($title_background_image); ?>" data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10)); ?>" <?php echo esc_attr($title_background_image_width); ?>>
                <div class="mkd-title-image"><?php if ($title_background_image_src != "") { ?><img itemprop="image" src="<?php echo esc_url($title_background_image_src); ?>" alt="&nbsp;" /> <?php } ?></div>
                <div class="mkd-title-holder" <?php newshub_mikado_inline_style($title_holder_height); ?>>
                    <div class="mkd-container clearfix">
                        <div class="mkd-container-inner">
                            <div class="mkd-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); echo esc_attr($title_border_color); ?>">
                                <div class="mkd-title-subtitle-holder-inner">
                                    <h1 class="mkd-title-text" <?php newshub_mikado_inline_style($title_color); ?>><span><?php newshub_mikado_title_text(); ?></span></h1>
                                    <?php if ($enable_breadcrumbs) { ?>
                                        <div class="mkd-breadcrumbs-holder"> <?php newshub_mikado_custom_breadcrumbs(); ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php break;
        case 'breadcrumb': ?>
            <div class="mkd-title <?php echo newshub_mikado_title_classes(); ?>" style="<?php echo esc_attr($title_background_color); echo esc_attr($title_background_image); ?>" data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10)); ?>" <?php echo esc_attr($title_background_image_width); ?>>
                <div class="mkd-title-image"><?php if ($title_background_image_src != "") { ?><img src="<?php echo esc_url($title_background_image_src); ?>" alt="&nbsp;" /> <?php } ?></div>
                <div class="mkd-title-holder" <?php newshub_mikado_inline_style($title_holder_height); ?>>
                    <div class="mkd-breadcrumbs-holder"><div class="mkd-breadcrumbs-holder-inner"><?php newshub_mikado_custom_breadcrumbs(); ?></div>
                    </div>
                </div>
            </div>
        <?php break;
    } ?>
<?php } ?>
<?php do_action('newshub_mikado_after_page_title'); ?>