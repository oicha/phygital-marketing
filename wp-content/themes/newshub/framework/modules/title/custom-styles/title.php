<?php

if (!function_exists('newshub_mikado_title_area_typography_style')) {

    function newshub_mikado_title_area_typography_style(){

        $title_styles = array();

        if(newshub_mikado_options()->getOptionValue('page_title_color') !== '') {
            $title_styles['color'] = newshub_mikado_options()->getOptionValue('page_title_color');
        }
        if(newshub_mikado_options()->getOptionValue('page_title_google_fonts') !== '-1') {
            $title_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('page_title_google_fonts'));
        }
        if(newshub_mikado_options()->getOptionValue('page_title_fontsize') !== '') {
            $title_styles['font-size'] = newshub_mikado_options()->getOptionValue('page_title_fontsize').'px';
        }
        if(newshub_mikado_options()->getOptionValue('page_title_lineheight') !== '') {
            $title_styles['line-height'] = newshub_mikado_options()->getOptionValue('page_title_lineheight').'px';
        }
        if(newshub_mikado_options()->getOptionValue('page_title_texttransform') !== '') {
            $title_styles['text-transform'] = newshub_mikado_options()->getOptionValue('page_title_texttransform');
        }
        if(newshub_mikado_options()->getOptionValue('page_title_fontstyle') !== '') {
            $title_styles['font-style'] = newshub_mikado_options()->getOptionValue('page_title_fontstyle');
        }
        if(newshub_mikado_options()->getOptionValue('page_title_fontweight') !== '') {
            $title_styles['font-weight'] = newshub_mikado_options()->getOptionValue('page_title_fontweight');
        }
        if(newshub_mikado_options()->getOptionValue('page_title_letter_spacing') !== '') {
            $title_styles['letter-spacing'] = newshub_mikado_options()->getOptionValue('page_title_letter_spacing').'px';
        }

        $title_selector = array(
            '.mkd-title .mkd-title-holder .mkd-title-text',
            '.single-post.single-format-standard .mkd-title .mkd-title-holder .mkd-title-text'
        );

        echo newshub_mikado_dynamic_css($title_selector, $title_styles);


        $breadcrumb_styles = array();

        if(newshub_mikado_options()->getOptionValue('page_breadcrumb_color') !== '') {
            $breadcrumb_styles['color'] = newshub_mikado_options()->getOptionValue('page_breadcrumb_color');
        }
        if(newshub_mikado_options()->getOptionValue('page_breadcrumb_google_fonts') !== '-1') {
            $breadcrumb_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('page_breadcrumb_google_fonts'));
        }
        if(newshub_mikado_options()->getOptionValue('page_breadcrumb_fontsize') !== '') {
            $breadcrumb_styles['font-size'] = newshub_mikado_options()->getOptionValue('page_breadcrumb_fontsize').'px';
        }
        if(newshub_mikado_options()->getOptionValue('page_breadcrumb_lineheight') !== '') {
            $breadcrumb_styles['line-height'] = newshub_mikado_options()->getOptionValue('page_breadcrumb_lineheight').'px';
        }
        if(newshub_mikado_options()->getOptionValue('page_breadcrumb_texttransform') !== '') {
            $breadcrumb_styles['text-transform'] = newshub_mikado_options()->getOptionValue('page_breadcrumb_texttransform');
        }
        if(newshub_mikado_options()->getOptionValue('page_breadcrumb_fontstyle') !== '') {
            $breadcrumb_styles['font-style'] = newshub_mikado_options()->getOptionValue('page_breadcrumb_fontstyle');
        }
        if(newshub_mikado_options()->getOptionValue('page_breadcrumb_fontweight') !== '') {
            $breadcrumb_styles['font-weight'] = newshub_mikado_options()->getOptionValue('page_breadcrumb_fontweight');
        }
        if(newshub_mikado_options()->getOptionValue('page_breadcrumb_letter_spacing') !== '') {
            $breadcrumb_styles['letter-spacing'] = newshub_mikado_options()->getOptionValue('page_breadcrumb_letter_spacing').'px';
        }

        $breadcrumb_selector = array(
            '.mkd-title .mkd-title-holder .mkd-breadcrumbs a, .mkd-title .mkd-title-holder .mkd-breadcrumbs span'
        );

        echo newshub_mikado_dynamic_css($breadcrumb_selector, $breadcrumb_styles);

        $breadcrumb_selector_styles = array();
        if(newshub_mikado_options()->getOptionValue('page_breadcrumb_hovercolor') !== '') {
            $breadcrumb_selector_styles['color'] = newshub_mikado_options()->getOptionValue('page_breadcrumb_hovercolor').' !important';
        }

        $breadcrumb_hover_selector = array(
            '.mkd-title .mkd-title-holder .mkd-breadcrumbs a:hover'
        );

        echo newshub_mikado_dynamic_css($breadcrumb_hover_selector, $breadcrumb_selector_styles);


        $title_info_styles = array();

        if(newshub_mikado_options()->getOptionValue('page_title_info_color') !== '') {
            $title_color['color'] = newshub_mikado_options()->getOptionValue('page_title_info_color');
			$title_color_selector = array(
			'.single-post .mkd-title .mkd-title-cat, .single-post .mkd-title .mkd-pt-info-section'
			);

			echo newshub_mikado_dynamic_css($title_color_selector, $title_color);
        }
        if(newshub_mikado_options()->getOptionValue('page_title_info_google_fonts') !== '-1') {
            $title_info_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('page_title_info_google_fonts'));
        }
        if(newshub_mikado_options()->getOptionValue('page_title_info_fontsize') !== '') {
            $title_info_styles['font-size'] = newshub_mikado_options()->getOptionValue('page_title_info_fontsize').'px';
            echo newshub_mikado_dynamic_css('.single-post .mkd-title .mkd-pt-info-section > div', array('font-size' => ($title_info_styles['font-size'] - 3).'px' ));
        }
        if(newshub_mikado_options()->getOptionValue('page_title_info_lineheight') !== '') {
            $title_info_styles['line-height'] = newshub_mikado_options()->getOptionValue('page_title_info_lineheight').'px';
        }
        if(newshub_mikado_options()->getOptionValue('page_title_info_texttransform') !== '') {
            $title_info_styles['text-transform'] = newshub_mikado_options()->getOptionValue('page_title_info_texttransform');
        }
        if(newshub_mikado_options()->getOptionValue('page_title_info_fontstyle') !== '') {
            $title_info_styles['font-style'] = newshub_mikado_options()->getOptionValue('page_title_info_fontstyle');
        }
        if(newshub_mikado_options()->getOptionValue('page_title_info_fontweight') !== '') {
            $title_info_styles['font-weight'] = newshub_mikado_options()->getOptionValue('page_title_info_fontweight');
        }
        if(newshub_mikado_options()->getOptionValue('page_title_info_letter_spacing') !== '') {
            $title_info_styles['letter-spacing'] = newshub_mikado_options()->getOptionValue('page_title_info_letter_spacing').'px';
        }

        $title_info_selector = array(
            '.single-post .mkd-title .mkd-post-info-category,.single-post.single-format-standard .mkd-title .mkd-title-post-author, .single-post .mkd-title .mkd-pt-info-section > div'
        );

        echo newshub_mikado_dynamic_css($title_info_selector, $title_info_styles);

        $title_info_selector_styles = array();
        if(newshub_mikado_options()->getOptionValue('page_title_info_hover_color') !== '') {
            $title_info_selector_styles['color'] = newshub_mikado_options()->getOptionValue('page_title_info_hover_color').' !important';
        }

        $title_info_hover_selector = array(
            '.single-post .mkd-title .mkd-post-info-category a:hover',
            '.single-post.single-format-standard .mkd-title .mkd-title-post-author a:hover',
            '.single-post .mkd-title .mkd-pt-info-section > div a:hover'
        );

        echo newshub_mikado_dynamic_css($title_info_hover_selector, $title_info_selector_styles);

        if(newshub_mikado_options()->getOptionValue('page_title_info_author_color') !== '') {
            $title_info_author['color'] = newshub_mikado_options()->getOptionValue('page_title_info_author_color');

			echo newshub_mikado_dynamic_css('.single-post.single-format-standard .mkd-title .mkd-title-post-author', $title_info_author);
        }

    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_title_area_typography_style');

}


if (!function_exists('newshub_mikado_section_title_style')) {

    function newshub_mikado_section_title_style() {

        $section_title_styles = array();
        $section_title_holder_styles = array();

        if (newshub_mikado_options()->getOptionValue('page_section_title_color') !== '') {
            $section_title_styles['color'] = newshub_mikado_options()->getOptionValue('page_section_title_color');
        }
        if (newshub_mikado_options()->getOptionValue('page_section_title_google_fonts') !== '-1') {
            $section_title_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('page_section_title_google_fonts'));
        }
        if (newshub_mikado_options()->getOptionValue('page_section_title_fontsize') !== '') {
            $section_title_styles['font-size'] = newshub_mikado_options()->getOptionValue('page_section_title_fontsize') . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('page_section_title_lineheight') !== '') {
            $section_title_styles['line-height'] = newshub_mikado_options()->getOptionValue('page_section_title_lineheight') . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('page_section_title_texttransform') !== '') {
            $section_title_styles['text-transform'] = newshub_mikado_options()->getOptionValue('page_section_title_texttransform');
        }
        if (newshub_mikado_options()->getOptionValue('page_section_title_fontstyle') !== '') {
            $section_title_styles['font-style'] = newshub_mikado_options()->getOptionValue('page_section_title_fontstyle');
        }
        if (newshub_mikado_options()->getOptionValue('page_section_title_fontweight') !== '') {
            $section_title_styles['font-weight'] = newshub_mikado_options()->getOptionValue('page_section_title_fontweight');
        }
        if (newshub_mikado_options()->getOptionValue('page_section_title_letter_spacing') !== '') {
            $section_title_styles['letter-spacing'] = newshub_mikado_options()->getOptionValue('page_section_title_letter_spacing') . 'px';
        }

        $section_title_selector = array('.mkd-title-line-head');

        echo newshub_mikado_dynamic_css($section_title_selector, $section_title_styles);

        if (newshub_mikado_options()->getOptionValue('page_section_title_padding_top') !== '') {
            $section_title_holder_styles['padding-top'] = newshub_mikado_options()->getOptionValue('page_section_title_padding_top') . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('page_section_title_padding_bottom') !== '') {
            $section_title_holder_styles['padding-bottom'] = newshub_mikado_options()->getOptionValue('page_section_title_padding_bottom') . 'px';
        }

        $section_title_holder_selector = array('.mkd-section-title-holder');

        echo newshub_mikado_dynamic_css($section_title_holder_selector, $section_title_holder_styles);

        if (newshub_mikado_options()->getOptionValue('page_section_title_border_color') !== '') {
            $section_title_holder_styles['background-color'] = newshub_mikado_options()->getOptionValue('page_section_title_border_color');
        }

        $section_title_holder_selector = array('.mkd-title-line-body::after');

        echo newshub_mikado_dynamic_css($section_title_holder_selector, $section_title_holder_styles);

    }


    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_section_title_style');

}

