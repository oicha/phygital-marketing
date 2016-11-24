<?php

if (!function_exists('newshub_mikado_register_widgets')) {

    function newshub_mikado_register_widgets() {

        $widgets = array(
            'NewsHubMikadoBreakingNews',
            'NewsHubMikadoDateWidget',
            'NewsHubMikadoImageWidget',
            'NewsHubMikadoPostLayoutOne',
            'NewsHubMikadoPostLayoutTwo',
            'NewsHubMikadoPostLayoutThree',
            'NewsHubMikadoPostLayoutTabs',
            'NewsHubMikadoRecentComments',
            'NewsHubMikadoSearchForm',
            'NewsHubMikadoSearchOpener',
            'NewsHubMikadoSeparatorWidget',
            'NewsHubMikadoSocialIconWidget',
            'NewsHubMikadoStickySidebar',
            'NewsHubMikadoSideAreaOpener',
            'NewsHubMikadoWeatherWidget',
        );

        foreach ($widgets as $widget) {
            register_widget($widget);
        }
    }
}

add_action('widgets_init', 'newshub_mikado_register_widgets');