<?php

/**
 * Widget that adds separator shortcode
 *
 * Class Separator_Widget
 */
class NewsHubMikadoSeparatorWidget extends NewsHubMikadoWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_separator_widget', // Base ID
            esc_html__('Mikado Separator Widget', 'newshub') // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Type','newshub'),
                'name' => 'type',
                'options' => array(
                    'normal' => esc_html__('Normal','newshub'),
                    'full-width' => esc_html__('Full Width','newshub'),
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Position','newshub'),
                'name' => 'position',
                'options' => array(
                    'center' => esc_html__('Center','newshub'),
                    'left' => esc_html__('Left','newshub'),
                    'right' => esc_html__('Right','newshub'),
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Style','newshub'),
                'name' => 'border_style',
                'options' => array(
                    'solid' => esc_html__('Solid','newshub'),
                    'dashed' => esc_html__('Dashed','newshub'),
                    'dotted' => esc_html__('Dotted','newshub'),
                )
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Color','newshub'),
                'name' => 'color'
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Width','newshub'),
                'name' => 'width',
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Thickness (px)','newshub'),
                'name' => 'thickness',
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Top Margin','newshub'),
                'name' => 'top_margin',
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Bottom Margin','newshub'),
                'name' => 'bottom_margin',
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {

        extract($args);

        //prepare variables
        $params = '';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params .= " $key='$value' ";
            }
        }

        echo '<div class="widget mkd-separator-widget">';

        //finally call the shortcode
        echo do_shortcode("[mkd_separator $params]"); // XSS OK

        echo '</div>'; //close div.mkd-separator-widget
    }
}