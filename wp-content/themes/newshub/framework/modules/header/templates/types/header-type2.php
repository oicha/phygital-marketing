<?php do_action('newshub_mikado_before_page_header'); ?>

<header class="mkd-page-header">

    <?php if($show_fixed_wrapper) : ?>
    <div class="mkd-fixed-wrapper">
        <?php endif; ?>
        <div class="mkd-menu-area">
            <?php if($menu_area_in_grid) : ?>
            <div class="mkd-grid">
                <?php endif; ?>
                <?php do_action( 'newshub_mikado_after_header_menu_area_html_open' )?>
                <div class="mkd-vertical-align-containers">
                    <div class="mkd-position-left">
                        <div class="mkd-position-left-inner">
                            <?php newshub_mikado_get_main_menu(); ?>
                        </div>
                    </div>
                    <?php if(is_active_sidebar('mkd-right-from-main-menu')) :
                        $widget_class = 'mkd-has-widget'; ?>
                        <div class="mkd-position-right <?php echo esc_attr($widget_class)?>">
                            <div class="mkd-position-right-inner">
                                <?php dynamic_sidebar('mkd-right-from-main-menu'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if($menu_area_in_grid) : ?>
            </div>
        <?php endif; ?>
        </div>
        <?php if($show_fixed_wrapper) : ?>
    </div>
    <?php endif; ?>
    
    
    <div class="mkd-logo-area">
        <?php if($logo_area_in_grid) : ?>
        <div class="mkd-grid">
            <?php endif; ?>
            <div class="mkd-vertical-align-containers">
                <div class="mkd-position-left">
                    <div class="mkd-position-left-inner">
                        <?php if(is_active_sidebar('mkd-left-from-logo')) : ?>
                            <?php dynamic_sidebar('mkd-left-from-logo'); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mkd-position-center">
                    <div class="mkd-position-center-inner">
                        <?php if(!$hide_logo) {
                            newshub_mikado_get_logo();
                        } ?>
                    </div>
                </div>
                <div class="mkd-position-right">
                    <div class="mkd-position-right-inner">
                        <?php if(is_active_sidebar('mkd-right-from-logo')) : ?>
                            <?php dynamic_sidebar('mkd-right-from-logo'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php if($logo_area_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>

    <?php if($show_sticky) {
        newshub_mikado_get_sticky_header();
    } ?>
</header>

<?php do_action('newshub_mikado_after_page_header'); ?>

