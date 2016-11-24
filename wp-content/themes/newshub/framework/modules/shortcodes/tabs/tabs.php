<?php
namespace NewsHub\Modules\Tabs;

use NewsHub\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Tabs
 */

class Tabs implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'mkd_tabs';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Mikado Tabs', 'newshub'),
			'base' => $this->getBase(),
			'as_parent' => array('only' => 'mkd_tab'),
			'content_element' => true,
			'show_settings_on_create' => true,
			'category' => esc_html__('by MIKADO','newshub'),
			'icon' => 'icon-wpb-tabs extended-custom-icon',
			'js_view' => 'VcColumnView',
			'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Tabs Style','newshub'),
                    'param_name' => 'tabs_style',
                    'value' => array(
                        esc_html__('Default', 'newshub') => '',
                        esc_html__('Dark', 'newshub') => 'dark',
                        esc_html__('Light', 'newshub') => 'light'
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Tabs separator style','newshub'),
                    'param_name' => 'tabs_separator_style',
                    'value' => array(
                        esc_html__('Default ("/")', 'newshub') => '',
                        esc_html__('Dot', 'newshub') => 'dot',
                    ),
                )
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'tabs_style' => '',
			'tabs_title' => '',
			'tabs_separator_style' => '',
			'title_tag' => 'h6'
		);
		
		$args = array_merge($args, newshub_mikado_icon_collections()->getShortcodeParams());
        $params  = shortcode_atts($args, $atts);
		
		extract($params);
		
		// Extract tab titles
		preg_match_all('/tab_title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
		$tab_titles = array();

		$params['tabs_classes'] = $this->getTabsClasses($params);


		/**
		 * get tab titles array
		 *
		 */
		if (isset($matches[0])) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach($tab_titles as $tab) {
			preg_match('/tab_title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['tabs_titles'] = $tab_title_array;

		// Extract tab titles images
		preg_match_all('/title_image="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);

		$params['content'] = $content;

		$output = newshub_mikado_get_shortcode_module_template_part('templates/tabs-template','tabs', '', $params);
		
		return $output;
	}

	/**
	 * Return tabs classes
	 *
	 * @param $params
	 * @return string
	 */
	private function getTabsClasses($params) {
		$tabs_classes = array();

		if ($params['tabs_style'] !== ''){
			$tabs_classes[] = 'mkd-tabs-skin-'.$params['tabs_style'];
		}

        if ($params['tabs_separator_style'] !== ''){
            $tabs_classes[] = 'mkd-tabs-separator-'.$params['tabs_separator_style'];
        }

		return implode(' ', $tabs_classes);
	}
}