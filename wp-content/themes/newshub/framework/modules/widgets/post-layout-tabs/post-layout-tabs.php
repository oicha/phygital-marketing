<?php

/**
 * Widget that adds post layout tabs
 *
 * Class PostLayoutTabs
 */
class NewsHubMikadoPostLayoutTabs extends NewsHubMikadoWidget
{
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_post_layout_tabs_widget', // Base ID
            esc_html__('Mikado Post Layout Tabs Widget', 'newshub') // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $categories = array(-1 => 'None') + array_flip(newshub_mikado_get_post_categories_VC());
        $this->params = array(
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Layout','newshub'),
                'name' => 'layout',
                'options' => array(
                    'one' => esc_html__('Layout 1','newshub'),
                    'two' => esc_html__('Layout 2','newshub'),
                ),
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Number of Posts','newshub'),
                'name' => 'number_of_posts'
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Number of Columns','newshub'),
                'name' => 'column_number',
                'options' => array(
                    3 => esc_html__('Three Columns','newshub'),
                    1 => esc_html__('One Column','newshub'),
                    2 => esc_html__('Two Columns','newshub'),
                    4 => esc_html__('Four Columns','newshub'),
                    5 => esc_html__('Five Columns','newshub'),
                ),
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('First Category','newshub'),
                'name' => 'category_id_1',
                'options' => $categories,
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Second Category','newshub'),
                'name' => 'category_id_2',
                'options' => $categories,
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Third Category','newshub'),
                'name' => 'category_id_3',
                'options' => $categories,
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Fourth Category','newshub'),
                'name' => 'category_id_4',
                'options' => $categories,
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Fifth Category','newshub'),
                'name' => 'category_id_5',
                'options' => $categories,
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Sixth Category','newshub'),
                'name' => 'category_id_6',
                'options' => $categories,
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Sort','newshub'),
                'name' => 'sort',
                'options' => array_flip(newshub_mikado_get_sort_array()),
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Skin','newshub'),
                'name' => 'skin',
                'options' => array(
                    '' => esc_html__('Default','newshub'),
                    'dark' => esc_html__('Dark','newshub'),
                    'light' => esc_html__('Light','newshub'),
                )
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Image Width (px)','newshub'),
                'name' => 'thumb_image_width',
                'description' => esc_html__('Set custom image width (px)','newshub'),
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Image Height (px)','newshub'),
                'name' => 'thumb_image_height',
                'description' => esc_html__('Set custom image height (px)','newshub'),
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Title Tag','newshub'),
                'name' => 'title_tag',
                'options' => array(
                    'h5' => 'h5',
                    'h2' => 'h2',
                    'h3' => 'h3',
                    'h4' => 'h4',
                    'h6' => 'h6',
                )
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Font Size (px)','newshub'),
                'name' => 'title_font_size',
                'description' => esc_html__('Set custom font size for title (px)','newshub')
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Title Max Words','newshub'),
                'name' => 'title_length',
                'description' => esc_html__('Enter max words of title post list that you want to display','newshub')
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Display Category','newshub'),
                'name' => 'display_category',
                'options' => array(
                    'yes' => esc_html__('Yes','newshub'),
                    'no' => esc_html__('No','newshub'),
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Display Date','newshub'),
                'name' => 'display_date',
                'options' => array(
                    'no' => esc_html__('No','newshub'),
                    'yes' => esc_html__('Yes','newshub'),
                )
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Date Format','newshub'),
                'name' => 'date_format',
                'description' => esc_html__('Enter the date format that you want to display','newshub')
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Display Excerpt','newshub'),
                'name' => 'display_excerpt',
                'options' => array(
                    'no' => esc_html__('No','newshub'),
                    'yes' => esc_html__('Yes','newshub'),
                )
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Max. Excerpt Length','newshub'),
                'name' => 'excerpt_length',
                'description' => esc_html__('Enter max of words that can be shown for excerpt','newshub'),
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

        //prepare variables
        if (is_array($instance) && count($instance)) {
            $params_label = 'params';
            $categories = array();
            $layout = 'one';

            if (isset($instance['layout']) && $instance['layout'] !== '') {
                $layout = $instance['layout'];
            }

            if ($layout == 'one') {
                $instance['thumb_image_size'] = 'custom_size';
                $instance['thumb_image_width'] = $instance['thumb_image_width'] != '' ? $instance['thumb_image_width'] : '480';
                $instance['thumb_image_height'] = $instance['thumb_image_height'] != '' ? $instance['thumb_image_height'] : '300';
            } else {
                $instance['custom_thumb_image_width'] = $instance['thumb_image_width'] != '' ? $instance['thumb_image_width'] : '120';
                $instance['custom_thumb_image_height'] = $instance['thumb_image_height'] != '' ? $instance['thumb_image_height'] : '120';
            }

            $instance['display_share'] = 'no';

            //check how menu category fields we have
            $count = 0;
            foreach ($instance as $key => $value) {
                if (strpos($key, 'category_id') !== false) {
                    $count++;
                }
            }

            //create category array of each category field
            for ($i = 1; $i <= $count; $i++) {
                //${$params_label.$i} = '';
                if ($instance['category_id_' . $i] !== '-1') { //don't render 'all categories' item
                    $categories[$i] = $instance['category_id_' . $i];
                }
                unset($instance['category_id_' . $i]);
            }

            //generate shortcode params
            foreach ($categories as $key => $value) {

                ${$params_label . $key} = '';
                foreach ($instance as $id => $val) {
                    ${$params_label . $key} .= " " . $id . " = '" . $val . "' ";
                }
                ${$params_label . $key} .= " category_id = '" . $value . "' ";
            }
        }

        $mkd_skin = '';
        if ($instance['skin'] != '') {
            $mkd_skin = $instance['skin'] == 'light' ? 'mkd-light' : 'mkd-dark';
        }

        echo '<div class="widget mkd-plw-tabs ' . $mkd_skin . '">';
        echo '<div class="mkd-plw-tabs-inner">';
        echo '<div class="mkd-plw-tabs-tabs-holder">';
        foreach ($categories as $key => $value) {
            $category_name = $value != 0 ? get_the_category_by_ID($value) : esc_html__('All', 'newshub');
            echo '<div class="mkd-plw-tabs-tab"><a href="#"><span class="item_text">' . esc_attr($category_name) . '</span></a></div>';
        }
        echo '</div>'; //close div.mkd-plw-tabs-tabs-holder

        echo '<div class="mkd-plw-tabs-content-holder">';
        foreach ($categories as $key => $value) {
            echo '<div class="mkd-plw-tabs-content">';
            echo do_shortcode('[mkd_post_layout_' . esc_attr($layout) . ' ' . ${$params_label . $key} . ']'); // XSS OK
            echo '</div>';
        }
        echo '</div>'; //close div.mkd-plw-tabs-content-holder
        echo '</div>'; //close div.mkd-plw-tabs-inner
        echo '</div>'; //close div.mkd-plw-tabs
    }
}