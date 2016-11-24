<?php

if(!function_exists('newshub_mikado_is_responsive_on')) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function newshub_mikado_is_responsive_on() {
        return newshub_mikado_options()->getOptionValue('responsiveness') !== 'no';
    }
}