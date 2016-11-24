<?php

/**
 * Widget that adds post layout one
 *
 * Class PostLayoutOne
 */
class NewsHubMikadoPostLayoutOne extends NewsHubMikadoWidget
{
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_post_layout_one_widget', // Base ID
            esc_html__('Mikado Post Layout One Widget', 'newshub') // Name,
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
                'title' => esc_html__('Number of Posts','newshub'),
                'name' => 'number_of_posts'
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Number of Columns','newshub'),
                'name' => 'column_number',
                'options' => array(
                    '' => esc_html__('Default','newshub'),
                    1 => esc_html__('One Column','newshub'),
                    2 => esc_html__('Two Columns','newshub'),
                    3 => esc_html__('Three Columns','newshub'),
                    4 => esc_html__('Four Columns','newshub'),
                    5 => esc_html__('Five Columns','newshub'),
                ),
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Category','newshub'),
                'name' => 'category_id',
                'options' => array_flip(newshub_mikado_get_post_categories_VC()),
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Category Slug','newshub'),
                'name' => 'category_slug',
                'description' => esc_html__('Leave empty for all or use comma for list','newshub')
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Choose Author','newshub'),
                'name' => 'author_id',
                'options' => array_flip(newshub_mikado_get_authors_VC()),
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Tag Slug','newshub'),
                'name' => 'tag_slug',
                'description' => esc_html__('Leave empty for all or use comma for list','newshub')
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Include Posts','newshub'),
                'name' => 'post_in',
                'description' => esc_html__('Enter the IDs of the posts you want to display','newshub')
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Exclude Posts','newshub'),
                'name' => 'post_not_in',
                'description' => esc_html__('Enter the IDs of the posts you want to exclude','newshub')
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
                'type' => 'dropdown',
                'title' => esc_html__('Horizontal Content Centering','newshub'),
                'name' => 'horizontally_centered_content',
                'options' => array(
                    'no' => esc_html__('No','newshub'),
                    'yes' => esc_html__('Yes','newshub'),
                ),
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
                    'h6' => 'h6',
                    'h2' => 'h2',
                    'h3' => 'h3',
                    'h4' => 'h4',
                    'h5' => 'h5'
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Title Separator','newshub'),
                'name' => 'display_title_separator',
                'options' => array(
                    'no' => esc_html__('No','newshub'),
                    'yes' => esc_html__('Yes','newshub'),
                )
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Title Max Words','newshub'),
                'name' => 'title_length',
                'description' => esc_html__('Enter max words of title post list that you want to display','newshub'),
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Title Font Size','newshub'),
                'name' => 'title_font_size',
                'description' => esc_html__('Set custom font size for title (px)','newshub'),
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Title Line Height','newshub'),
                'name' => 'title_line_height',
                'description' => esc_html__('Set custom line height for title (px)','newshub'),
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Title Text Transform','newshub'),
                'name' => 'title_text_transform',
                'options' => array(
                    '' => esc_html__('Default','newshub'),
                    'none' => esc_html__('None','newshub'),
                    'capitalize' => esc_html__('Capitalize','newshub'),
                    'uppercase' => esc_html__('Uppercase','newshub'),
                    'lowercase' => esc_html__('Lowercase','newshub'),
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Title Font Style','newshub'),
                'name' => 'title_font_style',
                'options' => array(
                    '' => esc_html__('Default','newshub'),
                    'normal' => esc_html__('Normal','newshub'),
                    'italic' => esc_html__('Italic','newshub'),
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Title Font Weight','newshub'),
                'name' => 'title_font_weight',
                'options' => array(
                    '' => esc_html__('Default','newshub'),
                    '100' => '100',
                    '200' => '200',
                    '300' => '300',
                    '400' => '400',
                    '500' => '500',
                    '600' => '600',
                    '700' => '700',
                    '800' => '800',
                    '900' => '900',
                )
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Title Letter Spacing','newshub'),
                'name' => 'title_letter_spacing',
                'description' => esc_html__('Set custom letter spacing for title (px)','newshub'),
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
                'title' => esc_html__('Display Category','newshub'),
                'name' => 'display_category',
                'options' => array(
                    'yes' => esc_html__('Yes','newshub'),
                    'no' => esc_html__('No','newshub'),
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Display Author','newshub'),
                'name' => 'display_author',
                'options' => array(
                    'no' => esc_html__('No','newshub'),
                    'yes' => esc_html__('Yes','newshub'),
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Display Comments','newshub'),
                'name' => 'display_comments',
                'options' => array(
                    'no' => esc_html__('No','newshub'),
                    'yes' => esc_html__('Yes','newshub'),
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Display Like','newshub'),
                'name' => 'display_like',
                'options' => array(
                    'no' => esc_html__('No','newshub'),
                    'yes' => esc_html__('Yes','newshub'),
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Display Count','newshub'),
                'name' => 'display_count',
                'options' => array(
                    'no' => esc_html__('No','newshub'),
                    'yes' => esc_html__('Yes','newshub'),
                )
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
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Display Post Type Icon','newshub'),
                'name' => 'display_post_type_icon',
                'options' => array(
                    'no' => esc_html__('No','newshub'),
                    'yes' => esc_html__('Yes','newshub'),
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Post Type Icon Size','newshub'),
                'name' => 'post_type_icon_size',
                'options' => array(
                    'small' => esc_html__('Small','newshub'),
                    'medium' => esc_html__('Medium','newshub'),
                    'large' => esc_html__('Large','newshub'),
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Display Share Links','newshub'),
                'name' => 'display_share',
                'options' => array(
                    'no' => esc_html__('No','newshub'),
                    'yes' => esc_html__('Yes','newshub'),
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Display Rating','newshub'),
                'name' => 'display_rating',
                'options' => array(
                    'no' => esc_html__('No','newshub'),
                    'yes' => esc_html__('Yes','newshub'),
                )
            ),
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
        $params = '';

        $instance['thumb_image_size'] = 'custom_size';
        $instance['thumb_image_width'] = $instance['thumb_image_width'] != '' ? $instance['thumb_image_width'] : '480';
        $instance['thumb_image_height'] = $instance['thumb_image_height'] != '' ? $instance['thumb_image_height'] : '300';

        //is instance empty?
        if (is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach ($instance as $key => $value) {
                $params .= " $key = '$value' ";
            }
        }

        $mkd_skin = '';
        if (isset($instance['skin']) && $instance['skin'] != '') {
            $mkd_skin = $instance['skin'] == 'light' ? 'mkd-light' : 'mkd-dark';
        }

        echo '<div class="widget mkd-plw-one ' . $mkd_skin . '">';

        if (!empty($instance['widget_title']) && $instance['widget_title'] !== '') {
            echo $args['before_title'] . esc_attr($instance['widget_title']) . $args['after_title'];
        }

        //finally call the shortcode
        echo do_shortcode("[mkd_post_layout_one $params]"); // XSS OK

        echo '</div>'; //close div.mkd-plw-one
    }
}