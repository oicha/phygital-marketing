<?php
namespace NewsHub\Modules\IconListItem;

use NewsHub\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Icon List Item
 */
class IconListItem implements ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'mkd_icon_list_item';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     */

    public function vcMap() {
        vc_map(array(
            'name' => esc_html__('Mikado Icon List Item', 'newshub'),
            'base' => $this->base,
            'icon' => 'icon-wpb-icon-list-item extended-custom-icon',
            'category' => esc_html__('by MIKADO','newshub'),
            'params' => array_merge(
                \NewsHubMikadoIconCollections::get_instance()->getVCParamsArray(),
                array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Icon Size (px)','newshub'),
                        'param_name' => 'icon_size',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('Icon Color','newshub'),
                        'param_name' => 'icon_color',
                    ),
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => esc_html__('Title','newshub'),
                        'param_name' => 'title',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Title size (px)','newshub'),
                        'param_name' => 'title_size',
                        'dependency' => Array('element' => 'title', 'not_empty' => true)
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('Title Color','newshub'),
                        'param_name' => 'title_color',
                        'dependency' => Array('element' => 'title', 'not_empty' => true)
                    )
                )
            )
        ));

    }

    public function render($atts, $content = null) {
        $args = array(
            'icon_size' => '',
            'icon_color' => '',
            'title' => '',
            'title_color' => '',
            'title_size' => ''
        );

        $args = array_merge($args, newshub_mikado_icon_collections()->getShortcodeParams());

        $params = shortcode_atts($args, $atts);

        //Extract params for use in method
        extract($params);
        $iconPackName = newshub_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
        $iconClasses = '';

        //generate icon holder classes
        $iconClasses .= 'mkd-icon-list-item-icon ';
        $iconClasses .= $params['icon_pack'];

        $params['icon_classes'] = $iconClasses;
        $params['icon'] = $params[$iconPackName];
        $params['icon_attributes']['style'] = $this->getIconStyle($params);
        $params['title_style'] = $this->getTitleStyle($params);

        //Get HTML from template
        $html = newshub_mikado_get_shortcode_module_template_part('templates/icon-list-item-template', 'icon-list-item', '', $params);
        return $html;
    }

    /**
     * Generates icon styles
     *
     * @param $params
     *
     * @return array
     */
    private function getIconStyle($params) {

        $iconStylesArray = array();
        if (!empty($params['icon_color'])) {
            $iconStylesArray[] = 'color:' . $params['icon_color'];
        }

        if (!empty($params['icon_size'])) {
            $iconStylesArray[] = 'font-size:' . newshub_mikado_filter_px($params['icon_size']) . 'px';
        }

        return implode(';', $iconStylesArray);
    }

    /**
     * Generates title styles
     *
     * @param $params
     *
     * @return array
     */
    private function getTitleStyle($params) {
        $titleStylesArray = array();
        if (!empty($params['title_color'])) {
            $titleStylesArray[] = 'color:' . $params['title_color'];
        }

        if (!empty($params['title_size'])) {
            $titleStylesArray[] = 'font-size:' . newshub_mikado_filter_px($params['title_size']) . 'px';
        }

        return implode(';', $titleStylesArray);
    }

}