<?php
namespace NewsHub\Modules\SectionTitle;

use NewsHub\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class ExpandingVideoPost
 */
class SectionTitle implements ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'mkd_section_title';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /*
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     */

    public function vcMap() {

        vc_map(array(
            'name' => esc_html__('Mikado Section Title', 'newshub'),
            'base' => $this->getBase(),
            'icon' => 'icon-wpb-section-title extended-custom-icon',
            'category' => esc_html__('by MIKADO','newshub'),
            'allowed_container_element' => 'vc_row',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title','newshub'),
                    'param_name' => 'title',
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Title Tag','newshub'),
                    'param_name' => 'title_tag',
                    'value' => array(
                        esc_html__('Default', 'newshub') => '',
                        'h1' => 'h1',
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h4' => 'h4',
                        'h5' => 'h5',
                        'h6' => 'h6',
                    ),
                    'dependency' => array('element' => 'title', 'not_empty' => true),
                ),
            )
        ));

    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'title' => '',
            'title_tag' => 'h5',
        );

        $params = shortcode_atts($args, $atts);

        //Get HTML from template
        $html = newshub_mikado_get_shortcode_module_template_part('templates/section-title-template', 'section-title', '', $params);

        return $html;
    }
}