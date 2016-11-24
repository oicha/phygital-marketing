<?php
if(!defined('ABSPATH')) exit;

class MikadoInstagramWidget extends WP_Widget {

	protected $params;

	public function __construct() {
		parent::__construct(
			'mkd_instagram_widget',
            esc_html__('Mikado Instagram Widget', 'mkd'),
			array( 'description' => esc_html__( 'Display instagram images', 'mkd' ) )
		);

		$this->setParams();
	}

	protected function setParams() {
		$this->params = array(
			array(
				'name' => 'title',
				'type' => 'textfield',
				'title' => esc_html__('Title','mkd'),
			),
			array(
				'name' => 'tag',
				'type' => 'textfield',
				'title' => esc_html__('Tag','mkd'),
			),
			array(
				'name' => 'number_of_photos',
				'type' => 'textfield',
				'title' => esc_html__('Number of photos','mkd'),
			),
			array(
				'name' => 'number_of_cols',
				'type' => 'dropdown',
				'title' => esc_html__('Number of columns','mkd'),
				'options' => array(
					'3' => esc_html__('Three','mkd'),
					'2' => esc_html__('Two','mkd'),
					'4' => esc_html__('Four','mkd'),
					'5' => esc_html__('Five','mkd'),
                    '6' => esc_html__('Six','mkd'),
					'7' => esc_html__('Seven','mkd'),
					'8' => esc_html__('Eight','mkd'),
					'9' => esc_html__('Nine','mkd'),
				)
			),
            array(
                'name' => 'space_between_items',
                'type' => 'dropdown',
                'title' => esc_html__('Spaces between items','mkd'),
                'options' => array(
                    'yes' => esc_html__('Yes','mkd'),
                    'no' => esc_html__('No','mkd'),
                )
            ),
			array(
				'name' => 'image_size',
				'type' => 'dropdown',
				'title' => esc_html__('Image Size','mkd'),
				'options' => array(
					'thumbnail' => esc_html__('Small','mkd'),
					'low_resolution' => esc_html__('Medium','mkd'),
					'standard_resolution' => esc_html__('Large','mkd'),
				)
			),
			array(
				'name' => 'transient_time',
				'type' => 'textfield',
				'title' => esc_html__('Images Cache Time','mkd'),
			),
		);
	}
	public function getParams() {
		return $this->params;
	}

	public function widget($args, $instance) {
		$title = '';
		$tag = '';
		$number_of_photos = '';
        $space_between_items = '';
		$number_of_cols = '';
		$image_size = 'thumbnail';
		$transient_time = array();
		extract($instance);

		$instagram_api = MikadoInstagramApi::getInstance();
		$images_array = $instagram_api->getImages($number_of_photos, $tag, array(
			'use_transients' => true,
			'transient_name' => $args['widget_id'],
			'transient_time' => $transient_time
		));

		$number_of_cols = $number_of_cols == '' ? 3 : $number_of_cols;
        $instagram_ul_classes = $space_between_items === 'yes' ? 'mkd-instagram-with-spaces' : '';

		echo $args['before_widget'];

		if(is_array($images_array) && count($images_array)) {

			if($title !== '') {
				?>
				<div class="mkd-instagram-feed-heading">
			<?php
				echo $args['before_title'] . $title . $args['after_title'];
			?>
			</div>
			<?php }
			?>
			<ul class="mkd-instagram-feed clearfix mkd-col-<?php echo esc_attr($number_of_cols); ?> <?php echo esc_attr($instagram_ul_classes) ?> >">
				<?php
				foreach ($images_array as $image) { ?>
					<li>
						<a itemprop="url" href="<?php echo esc_url($instagram_api->getHelper()->getImageLink($image)); ?>" target="_blank">
							<?php echo newshub_mikado_kses_img($instagram_api->getHelper()->getImageHTML($image, $image_size)); ?>
							<span class="fa fa-instagram"></span>
						</a>
					</li>
				<?php } ?>
			</ul>
		<?php }

		echo $args['after_widget'];
	}

	public function form($instance) {
		foreach ($this->params as $param_array) {
			$param_name = $param_array['name'];
			${$param_name} = isset( $instance[$param_name] ) ? esc_attr( $instance[$param_name] ) : '';
		}
		$instagram_api = MikadoInstagramApi::getInstance();

		//user has connected with instagram. Show form
		if($instagram_api->hasUserConnected()) {
			foreach ($this->params as $param) {
				switch($param['type']) {
					case 'textfield':
						?>
						<p>
							<label for="<?php echo esc_attr($this->get_field_id( $param['name'] )); ?>"><?php echo
								esc_html($param['title']); ?></label>
							<input class="widefat" id="<?php echo esc_attr($this->get_field_id( $param['name'] )); ?>" name="<?php echo esc_attr($this->get_field_name( $param['name'] )); ?>" type="text" value="<?php echo esc_attr( ${$param['name']} ); ?>" />
						</p>
						<?php
						break;
					case 'dropdown':
						?>
						<p>
							<label for="<?php echo esc_attr($this->get_field_id( $param['name'] )); ?>"><?php echo
								esc_html($param['title']); ?></label>
							<?php if(isset($param['options']) && is_array($param['options']) && count($param['options'])) { ?>
								<select class="widefat" name="<?php echo esc_attr($this->get_field_name( $param['name'] )); ?>" id="<?php echo esc_attr($this->get_field_id( $param['name'] )); ?>">
									<?php foreach ($param['options'] as $param_option_key => $param_option_val) {
										$option_selected = '';
										if(${$param['name']} == $param_option_key) {
											$option_selected = 'selected';
										}
										?>
										<option <?php echo esc_attr($option_selected); ?> value="<?php echo esc_attr($param_option_key); ?>"><?php echo esc_attr($param_option_val); ?></option>
									<?php } ?>
								</select>
							<?php } ?>
						</p>

						<?php
						break;
				}
			}
		}
	}
}

function mkd_instagram_widget_load(){
	register_widget('MikadoInstagramWidget');
}

add_action('widgets_init', 'mkd_instagram_widget_load');