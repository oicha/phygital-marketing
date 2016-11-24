<?php
namespace NewsHub\Modules\OrderedList;

use NewsHub\Modules\Shortcodes\Lib\ShortcodeInterface;

class OrderedList implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'mkd_list_ordered';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Mikado List - Ordered', 'newshub'),
			'base' => $this->base,
			'icon' => 'icon-wpb-ordered-list extended-custom-icon',
			'category' => esc_html__('by MIKADO','newshub'),
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__('Content','newshub'),
					'param_name' => 'content',
					'value' => '<ol><li>Lorem Ipsum</li><li>Lorem Ipsum</li><li>Lorem Ipsum</li></ol>',
				)
			)
		) );
	}

	public function render($atts, $content = null) {
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);
		$html = '<div class="mkd-ordered-list">'.do_shortcode($content).'</div>';
        return $html;
	}
}