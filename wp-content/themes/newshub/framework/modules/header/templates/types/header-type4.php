<?php do_action('newshub_mikado_before_page_header'); ?>

    <header class="mkd-page-header">
        <div class="mkd-logo-area">
            <div class="mkd-grid">
                <div class="mkd-vertical-align-containers">
                    <div class="mkd-position-left">
                        <div class="mkd-position-left-inner" style="width:900px;">
                            <?php if (!$hide_logo) {
                                newshub_mikado_get_logo();
                            } ?>
                        </div>
                    </div>
                    <div class="mkd-position-right">
                        <div class="mkd-position-right-inner">
                            <?php if (is_active_sidebar('mkd-right-from-logo')): ?>
                                <?php dynamic_sidebar('mkd-right-from-logo'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if($show_fixed_wrapper) : ?>
            <div class="mkd-fixed-wrapper">
        <?php endif; ?>
        <div class="mkd-menu-area">
            <div class="mkd-grid">
                <?php do_action( 'newshub_mikado_after_header_menu_area_html_open' )?>
                <div class="mkd-vertical-align-containers">
                    <div class="mkd-position-left">
                        <div class="mkd-position-left-inner">
                            <?php newshub_mikado_get_main_menu(); ?>
                        </div>
                    </div>
                    <div class="mkd-position-right">
                        <div class="mkd-position-right-inner">
                            <?php if (is_active_sidebar('mkd-right-from-main-menu')) : ?>
                                <?php dynamic_sidebar('mkd-right-from-main-menu'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if($show_fixed_wrapper) : ?>
            </div>
        <?php endif; ?>
        <?php if ($show_sticky) {
            newshub_mikado_get_sticky_header('centered');
        } ?>
    </header>

<?php do_action('newshub_mikado_after_page_header'); ?>