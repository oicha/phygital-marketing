<?php

namespace NewsHub\Modules\ShowcaseSlider;

use NewsHub\Modules\Shortcodes\Lib\ShortcodeInterface;

class ShowcaseSlider implements ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'mkd_showcase_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name' => esc_html__('Mikado Showcase Slider', 'newshub'),
            'base' => $this->base,
            'icon' => 'icon-wpb-showcase-slider extended-custom-icon',
            'category' => esc_html__('by MIKADO', 'newshub'),
            'allowed_container_element' => 'vc_row',
            'params' => array(
                array(
                    'type' => 'attach_images',
                    'param_name' => 'images',
                    'heading' => esc_html__('Images', 'newshub'),
                    'description' => esc_html__('Select images from media library', 'newshub')
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__('Enter links for images separated with comma', 'newshub'),
                    'param_name' => 'links',
                    'value' => ''
                ),
            )
        ));
    }

    public function render($atts, $content = null) {
        $args = array(
            'images' => '',
            'links' => '',
        );

        $params = shortcode_atts($args, $atts);
        extract($params);

        $params['images'] = $this->getGalleryImages($params);

        $html = '';

        $html .= newshub_mikado_get_shortcode_module_template_part('templates/showcase-slider', 'showcase-slider', '', $params);

        return $html;
    }

    /**
     * Return images for gallery
     *
     * @param $params
     * @return array
     */
    private function getGalleryImages($params) {
        $image_ids = array();
        $images = array();
        $i = 0;

        if ($params['images'] !== '') {
            $image_ids = explode(',', $params['images']);
        }

        foreach ($image_ids as $id) {

            $image['image_id'] = $id;
            $image_original = wp_get_attachment_image_src($id, 'full');
            $image['url'] = $image_original[0];
            $image['alt'] = get_post_meta($id, '_wp_attachment_image_alt', true);

            $images[$i] = $image;
            $i++;
        }

        return $images;
    }
}
