<?php
namespace NewsHub\Modules\Shortcodes\Button;

use NewsHub\Modules\Shortcodes\Lib\ShortcodeInterface;


/**
 * Class Button that represents button shortcode
 * @package NewsHub\Modules\Shortcodes\Button
 */
class Button implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     * Sets base attribute and registers shortcode with Visual Composer
     */
    public function __construct() {
        $this->base = 'mkd_button';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base attribute
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Mikado Button', 'newshub'),
            'base'                      => $this->base,
            'category'                  => esc_html__('by MIKADO','newshub'),
            'admin_enqueue_css' => array(newshub_mikado_get_skin_uri().'/assets/css/mkd-vc-extend.css'),
            'icon'                      => 'icon-wpb-button extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                array(
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Size','newshub'),
                        'param_name'  => 'size',
                        'value'       => array(
                            esc_html__('Default', 'newshub')                => '',
                            esc_html__('Small', 'newshub')                  => 'small',
                            esc_html__('Medium', 'newshub')                 => 'medium',
                            esc_html__('Large', 'newshub')                  => 'large',
                            esc_html__('Full Width', 'newshub')             => 'huge'
                        ),
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Type','newshub'),
                        'param_name'  => 'type',
                        'value'       => array(
                            esc_html__('Default', 'newshub') => '',
                            esc_html__('Outline', 'newshub') => 'outline',
                            esc_html__('Solid', 'newshub')   => 'solid',
                        ),
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Text','newshub'),
                        'param_name'  => 'text',
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Link','newshub'),
                        'param_name'  => 'link',
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Link Target','newshub'),
                        'param_name'  => 'target',
                        'value'       => array(
                            'Self'  => '_self',
                            'Blank' => '_blank'
                        ),
                        'save_always' => true,
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Custom CSS class','newshub'),
                        'param_name'  => 'custom_class',
                        'admin_label' => true
                    )
                ),
                newshub_mikado_icon_collections()->getVCParamsArray(array(), '', true),
                array(
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Color','newshub'),
                        'param_name'  => 'color',
                        'group'       => esc_html__('Design Options','newshub'),
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Hover Color','newshub'),
                        'param_name'  => 'hover_color',
                        'group'       => esc_html__('Design Options','newshub'),
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Background Color','newshub'),
                        'param_name'  => 'background_color',
                        'admin_label' => true,
                        'dependency'  => array('element' => 'type', 'value' => array('solid')),
                        'group'       => esc_html__('Design Options','newshub')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Hover Background Color','newshub'),
                        'param_name'  => 'hover_background_color',
                        'dependency'  => array('element' => 'type', 'value' => array('solid')),
                        'admin_label' => true,
                        'group'       => esc_html__('Design Options','newshub')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Border Color','newshub'),
                        'param_name'  => 'border_color',
                        'dependency'  => array('element' => 'type', 'value' => array('solid', 'outline')),
                        'admin_label' => true,
                        'group'       => esc_html__('Design Options','newshub')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Hover Border Color','newshub'),
                        'param_name'  => 'hover_border_color',
                        'dependency'  => array('element' => 'type', 'value' => array('solid', 'outline')),
                        'admin_label' => true,
                        'group'       => esc_html__('Design Options','newshub')
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Font Size (px)','newshub'),
                        'param_name'  => 'font_size',
                        'admin_label' => true,
                        'group'       => esc_html__('Design Options','newshub')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Font Weight','newshub'),
                        'param_name'  => 'font_weight',
                        'value'       => array_flip(newshub_mikado_get_font_weight_array(true)),
                        'admin_label' => true,
                        'group'       => esc_html__('Design Options','newshub'),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Margin','newshub'),
                        'param_name'  => 'margin',
                        'description' => esc_html__('Insert margin in format: 0px 0px 1px 0px', 'newshub'),
                        'admin_label' => true,
                        'group'       => esc_html__('Design Options','newshub')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Background Color','newshub'),
                        'param_name'  => 'icon_background_color',
                        'admin_label' => true,
                        'dependency'  => array('element' => 'icon_pack', 'not_empty' => true),
                        'group'       => esc_html__('Icon Options','newshub'),
                        'description' => esc_html__('Will not influence outline type','newshub')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Hover Background Color','newshub'),
                        'param_name'  => 'icon_hover_background_color',
                        'admin_label' => true,
                        'dependency'  => array('element' => newshub_mikado_icon_collections()->iconPackParamName, 'not_empty' => true),
                        'group'       => esc_html__('Icon Options','newshub'),
                        'description' => esc_html__('Will not influence outline type','newshub')
                    ),
                )
            ) //close array_merge
        ));
    }

    /**
     * Renders HTML for button shortcode
     *
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'size'                   => '',
            'type'                   => '',
            'text'                   => '',
            'link'                   => '',
            'target'                 => '',
            'color'                  => '',
            'hover_color'            => '',
            'background_color'       => '',
            'hover_background_color' => '',
            'border_color'           => '',
            'hover_border_color'     => '',
            'font_size'              => '',
            'font_weight'            => '',
            'margin'                 => '',
            'icon_background_color'  => '',
            'icon_hover_background_color'  => '',
            'custom_class'           => '',
            'html_type'              => 'anchor',
            'input_name'             => '',
            'hover_animation'        => '',
            'custom_attrs'           => array()
        );

        $default_atts = array_merge($default_atts, newshub_mikado_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

        if($params['html_type'] !== 'input') {
            $iconPackName   = newshub_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
            $params['icon'] = $iconPackName ? $params[$iconPackName] : '';
        }

        $params['size'] = !empty($params['size']) ? $params['size'] : 'medium';
        $params['type'] = !empty($params['type']) ? $params['type'] : 'transparent';


        $params['link']   = !empty($params['link']) ? $params['link'] : '#';
        $params['target'] = !empty($params['target']) ? $params['target'] : '_self';

        //prepare params for template
        $params['button_classes']      = $this->getButtonClasses($params);
        $params['button_custom_attrs'] = !empty($params['custom_attrs']) ? $params['custom_attrs'] : array();
        $params['button_styles']       = $this->getButtonStyles($params);
        $params['button_data']         = $this->getButtonDataAttr($params);

        return newshub_mikado_get_shortcode_module_template_part('templates/'.$params['html_type'], 'button', $params['hover_animation'], $params);
    }

    /**
     * Returns array of button styles
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonStyles($params) {
        $styles = array();

        if(!empty($params['color'])) {
            $styles[] = 'color: '.$params['color'];
        }

        if(!empty($params['background_color']) && $params['type'] !== 'outline') {
            $styles[] = 'background-color: '.$params['background_color'];
        }

        if(!empty($params['border_color'])) {
            $styles[] = 'border: 1px solid '.$params['border_color'];
        }

        if(!empty($params['font_size'])) {
            $styles[] = 'font-size: '.newshub_mikado_filter_px($params['font_size']).'px';
        }

        if(!empty($params['font_weight'])) {
            $styles[] = 'font-weight: '.$params['font_weight'];
        }

        if(!empty($params['margin'])) {
            $styles[] = 'margin: '.$params['margin'];
        }

        return $styles;
    }

    /**
     *
     * Returns array of button data attr
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonDataAttr($params) {
        $data = array();

        if(!empty($params['hover_background_color'])) {
            $data['data-hover-bg-color'] = $params['hover_background_color'];
        }

        if(!empty($params['hover_color'])) {
            $data['data-hover-color'] = $params['hover_color'];
        }

        if(!empty($params['hover_color'])) {
            $data['data-hover-color'] = $params['hover_color'];
        }

        if(!empty($params['hover_border_color'])) {
            $data['data-hover-border-color'] = $params['hover_border_color'];
        }

        if(!empty($params['icon_hover_background_color'])) {
            $data['data-icon-bg-color'] = $params['icon_background_color'];
        }

        if(!empty($params['icon_hover_background_color'])) {
            $data['data-icon-hover-bg-color'] = $params['icon_hover_background_color'];
        }

        return $data;
    }

    /**
     * Returns array of HTML classes for button
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonClasses($params) {
        $buttonClasses = array(
            'mkd-btn',
            'mkd-btn-'.$params['size'],
            'mkd-btn-'.$params['type']
        );

        if(!empty($params['hover_background_color'])) {
            $buttonClasses[] = 'mkd-btn-custom-hover-bg';
        }

        if(!empty($params['hover_border_color'])) {
            $buttonClasses[] = 'mkd-btn-custom-border-hover';
        }

        if(!empty($params['hover_color'])) {
            $buttonClasses[] = 'mkd-btn-custom-hover-color';
        }

        if(!empty($params['icon'])) {
            $buttonClasses[] = 'mkd-btn-icon';
        }

        if(!empty($params['custom_class'])) {
            $buttonClasses[] = $params['custom_class'];
        }

        if(!empty($params['hover_animation'])) {
            $buttonClasses[] = 'mkd-btn-'.$params['hover_animation'];
        }

        return $buttonClasses;
    }
}