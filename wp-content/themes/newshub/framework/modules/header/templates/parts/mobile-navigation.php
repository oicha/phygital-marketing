<?php do_action('newshub_mikado_before_mobile_navigation'); ?>

<nav class="mkd-mobile-nav">
    <div class="mkd-grid">
        <?php wp_nav_menu(array(
            'theme_location' => 'mobile-navigation' ,
            'container'  => '',
            'container_class' => '',
            'menu_class' => '',
            'menu_id' => '',
            'fallback_cb' => 'top_navigation_fallback',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'walker' => new NewsHubMikadoMobileNavigationWalker()
        )); ?>
    </div>
</nav>

<?php do_action('newshub_mikado_after_mobile_navigation'); ?>