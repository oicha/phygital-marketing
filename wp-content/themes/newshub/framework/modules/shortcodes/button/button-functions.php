<?php

if(!function_exists('newshub_mikado_get_button_html')) {
    /**
     * Calls button shortcode with given parameters and returns it's output
     * @param $params
     *
     * @return mixed|string
     */
    function newshub_mikado_get_button_html($params) {
        $button_html = newshub_mikado_execute_shortcode('mkd_button', $params);
        $button_html = str_replace("\n", '', $button_html);
        return $button_html;
    }
}