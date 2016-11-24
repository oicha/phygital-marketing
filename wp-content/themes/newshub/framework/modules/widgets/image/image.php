<?php

/**
 * Widget that adds image type
 *
 * Class Image_Widget
 */
class NewsHubMikadoImageWidget extends NewsHubMikadoWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_image_widget', // Base ID
            esc_html__('Mikado Image Widget', 'newshub') // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type' => 'textfield',
                'title' => esc_html__('Widget Title','newshub'),
                'name' => 'widget_title'
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Image Source','newshub'),
                'name' => 'image_src'
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Image Alt','newshub'),
                'name' => 'image_alt'
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Link','newshub'),
                'name' => 'link'
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Target','newshub'),
                'name' => 'target',
                'options' => array(
                    '_self' => esc_html__('Same Window','newshub'),
                    '_blank' => esc_html__('New Window','newshub')
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

        extract($args);

        $image_src = '';
        $image_alt = 'Widget Image';

        if (!empty($instance['image_alt']) && $instance['image_alt'] !== '') {
            $image_alt = $instance['image_alt'];
        }

        if (!empty($instance['image_src']) && $instance['image_src'] !== '') {
            $image_src = '<img src="'.esc_url($instance['image_src']).'" alt="'.$image_alt.'" />';
        }

        $link_begin_html = '';
        $link_end_html = '';
        $target = '_self';

        if (!empty($instance['target']) && $instance['target'] !== '') {
            $target = $instance['target'];
        }

        if (!empty($instance['link']) && $instance['link'] !== '') {
            $link_begin_html = '<a href="'.esc_url($instance['link']).'" target="'.$target.'">';
            $link_end_html = '</a>';
        }


        if (!empty($instance['widget_title']) && $instance['widget_title'] !== '') {
            echo $args['before_title'] . esc_attr($instance['widget_title']) . $args['after_title'];
        }


        ?>



        <div class="widget mkd-image-widget">
            <?php 
                if ($link_begin_html !== '') {
                    print $link_begin_html;
                }
                if ($image_src !== '') {
                    print $image_src;
                }
                if ($link_end_html !== '') {
                    print $link_end_html;
                }
            ?>
        </div>
    <?php 
    }
}