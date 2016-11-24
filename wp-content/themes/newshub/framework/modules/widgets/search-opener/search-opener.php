<?php

/**
 * Widget that adds search icon that triggers opening of search form
 *
 * Class Mikado_Search_Opener
 */
class NewsHubMikadoSearchOpener extends NewsHubMikadoWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_search_opener', // Base ID
            esc_html__('Mikado Search Opener', 'newshub') // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'name'        => 'search_icon_size',
                'type'        => 'textfield',
                'title'       => esc_html__('Search Icon Size (px)','newshub'),
                'description' => esc_html__('Define size for Search icon','newshub')
            ),
            array(
                'name'        => 'search_icon_color',
                'type'        => 'textfield',
                'title'       => esc_html__('Search Icon Color','newshub'),
                'description' => esc_html__('Define color for Search icon','newshub')
            ),
            array(
                'name'        => 'search_icon_hover_color',
                'type'        => 'textfield',
                'title'       => esc_html__('Search Icon Hover Color','newshub'),
                'description' => esc_html__('Define hover color for Search icon','newshub')
            ),
            array(
                'name'        => 'show_label',
                'type'        => 'dropdown',
                'title'       => esc_html__('Enable Search Icon Text','newshub'),
                'description' => esc_html__('Enable this option to show \'Search\' text next to search icon in header','newshub'),
                'options'     => array(
                    ''    => '',
                    'yes' => esc_html__('Yes','newshub'),
                    'no'  => esc_html__('No','newshub'),
                )
            ),
            array(
                'name'        => 'enable_separator',
                'type'        => 'dropdown',
                'title'       => esc_html__('Enable Separator on Left Side','newshub'),
                'description' => esc_html__('Enable this option to show separator before search icon in header','newshub'),
                'options'     => array(
                    ''    => '',
                    'yes' => esc_html__('Yes','newshub'),
                    'no'  => esc_html__('No','newshub'),
                )
            ),
			array(
				'name'			=> 'close_icon_position',
				'type'			=> 'dropdown',
				'title'			=> esc_html__('Close icon stays on opener place','newshub'),
				'description'	=> esc_html__('Enable this option to set close icon on same position like opener icon','newshub'),
				'options'		=> array(
					'yes'	=> esc_html__('Yes','newshub'),
					'no'	=> esc_html__('No','newshub'),
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

        $search_type_class    = 'mkd-search-opener';
        $search_holder_class    = 'mkd-search-opener-holder';
        $search_opener_styles = array();
		$close_icon_on_same_position = $instance['close_icon_position'] == 'yes' ? true : false;

	    if(newshub_mikado_options()->getOptionValue( 'search_type' ) == 'search_covers_header') {
		    if(newshub_mikado_options()->getOptionValue( 'search_type' ) == 'yes') {
			    $search_type_class .= ' search_covers_only_bottom';
		    }
	    }

        if (!empty($instance['enable_separator']) && $instance['enable_separator'] === 'yes') {
            $search_holder_class .= ' mkd-widget-separator';
        }

        if(!empty($instance['search_icon_size'])) {
            $search_opener_styles[] = 'font-size: '.$instance['search_icon_size'].'px';
        }

        if(!empty($instance['search_icon_color'])) {
            $search_opener_styles[] = 'color: '.$instance['search_icon_color'];
        }

        ?>

        <div <?php newshub_mikado_class_attribute($search_holder_class); ?>>
            <div class="mkd-search-opener-inner">

        <a <?php echo newshub_mikado_get_inline_attr($instance['search_icon_hover_color'], 'data-hover-color'); ?>
			<?php if ( $close_icon_on_same_position ) {
				echo newshub_mikado_get_inline_attr('yes', 'data-icon-close-same-position');
			} ?>
            <?php newshub_mikado_inline_style($search_opener_styles); ?>
            <?php newshub_mikado_class_attribute($search_type_class); ?> href="javascript:void(0)">
            <?php
            newshub_mikado_icon_collections()->getSearchIcon( newshub_mikado_options()->getOptionValue( 'search_icon_pack' ), false );
            ?>
        </a>

            </div>
        </div>
    <?php }
}