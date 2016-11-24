<?php
namespace NewsHub\Modules\Tab;

use NewsHub\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Tab
 */

class Tab implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'mkd_tab';
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
			'name' => esc_html__('Mikado Tab', 'newshub'),
			'base' => $this->getBase(),
			'as_parent' => array('except' => 'vc_row'),
			'as_child' => array('only' => 'mkd_tabs'),
			'is_container' => true,
			'category' => esc_html__('by MIKADO','newshub'),
			'icon' => 'icon-wpb-tab extended-custom-icon',
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' =>
				array(
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => esc_html__('Title','newshub'),
						'param_name' => 'tab_title',
					)
				)
        ));
	}

	public function render($atts, $content = null) {
		
		$default_atts = array(
			'tab_title' => 'Tab',
			'tab_id' => ''
		);

		$params       = shortcode_atts($default_atts, $atts);
		extract($params);

		$rand_number = rand(0, 1000);

		$params['tab_title'] = $params['tab_title'].'-'.$rand_number;

		$params['content'] = $content;
		
		$output = '';
		$output .= newshub_mikado_get_shortcode_module_template_part('templates/tab_content','tabs', '', $params);
		return $output;
	}
}