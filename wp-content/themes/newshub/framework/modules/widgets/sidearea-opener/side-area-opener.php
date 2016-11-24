<?php

class NewsHubMikadoSideAreaOpener extends NewsHubMikadoWidget
{
    public function __construct() {
        parent::__construct(
            'mkd_side_area_opener', // Base ID
            esc_html__('Mikado Side Area Opener', 'newshub') // Name
        );

        $this->setParams();
    }

    protected function setParams() {

        $this->params = array(
            array(
                'name' => 'side_area_opener_icon_color',
                'type' => 'textfield',
                'title' => esc_html__('Icon Color','newshub'),
                'description' => esc_html__('Define color for Side Area opener icon','newshub')
            ),
            array(
                'name' => 'side_area_opener_label',
                'type' => 'textfield',
                'title' => esc_html__('Icon Label','newshub'),
                'description' => esc_html__('Define label for Side Area opener icon','newshub')
            )
        );

    }


    public function widget($args, $instance) {

        $sidearea_icon_styles = array();

        if (!empty($instance['side_area_opener_icon_color'])) {
            $sidearea_icon_styles[] = 'color: ' . $instance['side_area_opener_icon_color'];
        }

        $icon_size = '';
        if (newshub_mikado_options()->getOptionValue('side_area_predefined_icon_size')) {
            $icon_size = newshub_mikado_options()->getOptionValue('side_area_predefined_icon_size');
        }
        ?>
        <a class="mkd-side-menu-button-opener <?php echo esc_attr($icon_size); ?>" <?php newshub_mikado_inline_style($sidearea_icon_styles) ?> href="javascript:void(0)">
            <?php echo newshub_mikado_get_side_menu_icon_html(); ?>
            <?php if (!empty($instance['side_area_opener_label'])) {
                echo '<label>' . esc_html($instance['side_area_opener_label']) . '</label>';
            } ?>
        </a>

    <?php }

}