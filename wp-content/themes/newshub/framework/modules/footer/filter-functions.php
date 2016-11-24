<?php  

if(!function_exists('newshub_mikado_uncovering_footer')) {
    /**
     * Function that adds behaviour class to body based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function newshub_mikado_uncovering_footer($classes) {
        $id = newshub_mikado_get_page_id();

        if(newshub_mikado_get_meta_field_intersect('uncovering_footer_effect', $id ) == 'yes') {
	        $classes[] = 'mkd-uncovering-footer';
        } else {
            $classes[] = '';
        }

        return $classes;
    }

    add_filter('body_class', 'newshub_mikado_uncovering_footer');
}