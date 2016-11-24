<?php do_action('newshub_mikado_before_sticky_header'); ?>

    <div class="mkd-sticky-header">
        <?php do_action( 'newshub_mikado_after_sticky_menu_html_open' ); ?>
        <div class="mkd-sticky-holder">
            <?php if($sticky_in_grid) : ?>
            <div class="mkd-grid">
                <?php endif; ?>
            <div class=" mkd-vertical-align-containers">
                <div class="mkd-position-left">
                    <div class="mkd-position-left-inner">
                        <?php if(!$hide_logo) {
                            newshub_mikado_get_logo('sticky');
                        } ?>
                    </div>
                </div>
                <div class="mkd-position-center">
                    <div class="mkd-position-center-inner">
                        <?php newshub_mikado_get_sticky_main_menu('mkd-sticky-nav'); ?>
                    </div>
                </div>
                <div class="mkd-position-right">
                    <div class="mkd-position-right-inner">
                        <?php if(is_active_sidebar('mkd-sticky-right')) : ?>
                            <?php dynamic_sidebar('mkd-sticky-right'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if($sticky_in_grid) : ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php do_action('newshub_mikado_after_sticky_header'); ?>