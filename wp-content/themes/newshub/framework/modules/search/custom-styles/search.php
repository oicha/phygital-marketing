<?php

if (!function_exists('newshub_mikado_search_holder_style')) {

    function newshub_mikado_search_holder_style()
    {

        $search_holder_styles = array();
        $search_holder_placeholder_styles = array();

        if(newshub_mikado_options()->getOptionValue('search_icon_color') !== '') {
            $search_holder_styles['color'] = newshub_mikado_options()->getOptionValue('search_icon_color');
            $search_holder_placeholder_styles['color'] = newshub_mikado_options()->getOptionValue('search_icon_color');
        }
        if(newshub_mikado_options()->getOptionValue('search_background_color') !== '') {
            $search_holder_styles['background-color'] = newshub_mikado_options()->getOptionValue('search_background_color');
        }

        $search_holder_selector = array(
            '.mkd-search-cover'
        );

        echo newshub_mikado_dynamic_css($search_holder_selector, $search_holder_styles);

        $search_holder_placeholder_selector = array(
            '.mkd-search-cover ::-webkit-input-placeholder,
             .mkd-search-cover :-moz-placeholder,
             .mkd-search-cover ::-moz-placeholder,
             .mkd-search-cover :-ms-input-placeholder'
        );

        echo newshub_mikado_dynamic_css($search_holder_placeholder_selector, $search_holder_placeholder_styles);
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_search_holder_style');
}

if (!function_exists('newshub_mikado_search_icon_styles')) {

	function newshub_mikado_search_icon_styles()
	{

		if (newshub_mikado_options()->getOptionValue('search_icon_color') !== '') {
			echo newshub_mikado_dynamic_css('.mkd-search-opener, .mkd-light .mkd-search-opener, .mkd-dark .mkd-search-opener', array(
				'color' => newshub_mikado_options()->getOptionValue('search_icon_color')
			));
		}
		if (newshub_mikado_options()->getOptionValue('search_icon_hover_color') !== '') {
			echo newshub_mikado_dynamic_css('.mkd-search-opener:hover, .mkd-light .mkd-search-opener:hover, .mkd-dark .mkd-search-opener:hover', array(
				'color' => newshub_mikado_options()->getOptionValue('search_icon_hover_color')
			));
		}
		if (newshub_mikado_options()->getOptionValue('search_icon_size') !== '') {
			echo newshub_mikado_dynamic_css('.mkd-search-opener', array(
				'font-size' => newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('search_icon_size')) . 'px'
			));
		}

	}

	add_action('newshub_mikado_style_dynamic', 'newshub_mikado_search_icon_styles');
}

if (!function_exists('newshub_mikado_search_close_icon_styles')) {

	function newshub_mikado_search_close_icon_styles()
	{

		if (newshub_mikado_options()->getOptionValue('search_close_color') !== '') {
			echo newshub_mikado_dynamic_css('.mkd-search-cover .mkd-search-close > a > *', array(
				'color' => newshub_mikado_options()->getOptionValue('search_close_color')
			));
		}
		if (newshub_mikado_options()->getOptionValue('search_close_hover_color') !== '') {
			echo newshub_mikado_dynamic_css('.mkd-search-cover .mkd-search-close  > a:hover > *', array(
				'color' => newshub_mikado_options()->getOptionValue('search_close_hover_color')
			));
		}
		if (newshub_mikado_options()->getOptionValue('search_close_size') !== '') {
			echo newshub_mikado_dynamic_css('.mkd-search-cover .mkd-search-close  > a > *', array(
				'font-size' => newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('search_close_size')) . 'px'
			));
		}

	}

	add_action('newshub_mikado_style_dynamic', 'newshub_mikado_search_close_icon_styles');
}

?>