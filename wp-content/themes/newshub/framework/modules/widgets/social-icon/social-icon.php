<?php

/**
 * Widget that adds social icon
 *
 * Class Social_Icon_Widget
 */
class NewsHubMikadoSocialIconWidget extends NewsHubMikadoWidget
{
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_social_icon_widget', // Base ID
            esc_html__('Mikado Social Icon Widget', 'newshub') // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array_merge(
            newshub_mikado_icon_collections()->getSocialIconWidgetParamsArray(),
            array(
                array(
                    'type' => 'textfield',
                    'title' => esc_html__('Link','newshub'),
                    'name' => 'link',
                ),
                array(
                    'type' => 'dropdown',
                    'title' => esc_html__('Target','newshub'),
                    'name' => 'target',
                    'options' => array(
                        '_self' => esc_html__('Same Window','newshub'),
                        '_blank' => esc_html__('New Window','newshub'),
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'title' => esc_html__('Type','newshub'),
                    'name' => 'type',
                    'options' => array(
                        'normal' => esc_html__('Normal','newshub'),
                        'circle' => esc_html__('Circle','newshub'),
                        'square' => esc_html__('Square','newshub'),
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'title' => esc_html__('Shape Size (px)','newshub'),
                    'name' => 'shape_size',
                ),
                array(
                    'type' => 'textfield',
                    'title' => esc_html__('Text Size (px)','newshub'),
                    'name' => 'text_size',
                ),
                array(
                    'type' => 'textfield',
                    'title' => esc_html__('Color','newshub'),
                    'name' => 'color',
                ),
                array(
                    'type' => 'textfield',
                    'title' => esc_html__('Hover Color','newshub'),
                    'name' => 'hover_color',
                ),
                array(
                    'type' => 'textfield',
                    'title' => esc_html__('Border Width','newshub'),
                    'name' => 'border_width',
                ),
                array(
                    'type' => 'textfield',
                    'title' => esc_html__('Border Color','newshub'),
                    'name' => 'border_color',
                ),
                array(
                    'type' => 'textfield',
                    'title' => esc_html__('Hover Border Color','newshub'),
                    'name' => 'hover_border_color',
                ),
                array(
                    'type' => 'textfield',
                    'title' => esc_html__('Background Color','newshub'),
                    'name' => 'background_color',
                ),
                array(
                    'type' => 'textfield',
                    'title' => esc_html__('Hover Background Color','newshub'),
                    'name' => 'hover_background_color',
                ),
                array(
                    'type' => 'textfield',
                    'title' => esc_html__('Margin','newshub'),
                    'name' => 'margin',
                    'description' => esc_html__('Margin (top right bottom left)','newshub')
                ),
                array(
                    'type' => 'dropdown',
                    'title' => esc_html__('Enable Separator Between Icons','newshub'),
                    'name' => 'separator_between_icons',
                    'options' => array(
                        'no' => esc_html__('No','newshub'),
                        'yes' => esc_html__('Yes','newshub'),
                    ),
                )
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

        $icon_params = array();

        if (!empty($instance['icon_pack']) && $instance['icon_pack'] !== '') {
            $icon_params['icon_pack'] = $instance['icon_pack'];
        }
        if (!empty($instance['fa_icon']) && $instance['fa_icon'] !== '') {
            $icon_params['fa_icon'] = $instance['fa_icon'];
        }
        if (!empty($instance['fe_icon']) && $instance['fe_icon'] !== '') {
            $icon_params['fe_icon'] = $instance['fe_icon'];
        }
        if (!empty($instance['ion_icon']) && $instance['ion_icon'] !== '') {
            $icon_params['ion_icon'] = $instance['ion_icon'];
        }
        if (!empty($instance['simple_line_icons']) && $instance['simple_line_icons'] !== '') {
            $icon_params['simple_line_icons'] = $instance['simple_line_icons'];
        }
        if (!empty($instance['type']) && $instance['type'] !== '') {
            $icon_params['type'] = $instance['type'];
        }
        if (!empty($instance['color']) && $instance['color'] !== '') {
            $icon_params['icon_color'] = $instance['color'];
        }
        if (!empty($instance['hover_color']) && $instance['hover_color'] !== '') {
            $icon_params['hover_icon_color'] = $instance['hover_color'];
        }
        if (!empty($instance['link']) && $instance['link'] !== '') {
            $icon_params['link'] = $instance['link'];
        }
        if (!empty($instance['target']) && $instance['target'] !== '') {
            $icon_params['target'] = $instance['target'];
        }
        if (!empty($instance['margin']) && $instance['margin'] !== '') {
            $icon_params['margin'] = $instance['margin'];
        }
        if (!empty($instance['text_size']) && $instance['text_size'] !== '') {
            $icon_params['custom_size'] = $instance['text_size'];
        }
        if (!empty($instance['shape_size']) && $instance['shape_size'] !== '') {
            $icon_params['shape_size'] = $instance['shape_size'];
        }
        if (!empty($instance['border_width']) && $instance['border_width'] !== '') {
            $icon_params['border_width'] = $instance['border_width'];
        }
        if (!empty($instance['border_color']) && $instance['border_color'] !== '') {
            $icon_params['border_color'] = $instance['border_color'];
        }
        if (!empty($instance['hover_border_color']) && $instance['hover_border_color'] !== '') {
            $icon_params['hover_border_color'] = $instance['hover_border_color'];
        }
        if (!empty($instance['background_color']) && $instance['background_color'] !== '') {
            $icon_params['background_color'] = $instance['background_color'];
        }
        if (!empty($instance['hover_background_color']) && $instance['hover_background_color'] !== '') {
            $icon_params['hover_background_color'] = $instance['hover_background_color'];
        }
        if (!empty($instance['separator_between_icons']) && $instance['separator_between_icons'] !== '') {
            $icon_params['separator_between_icons'] = $instance['separator_between_icons'];
        }

        echo $args['before_widget'];
        echo newshub_mikado_execute_shortcode('mkd_icon', $icon_params);
        echo $args['after_widget'];

    }
}