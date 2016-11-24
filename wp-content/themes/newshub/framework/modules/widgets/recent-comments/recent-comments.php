<?php

/**
 * Widget that adds recent comments
 *
 * Class RecentComments
 */
class NewsHubMikadoRecentComments extends NewsHubMikadoWidget
{
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_recent_comments_widget', // Base ID
            esc_html__('Mikado Recent Comments Widget', 'newshub') // Name
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
                'title' => esc_html__('Display Date','newshub'),
                'name' => 'display_date',
                'options' => array(
                    'yes' => esc_html__('Yes','newshub'),
                    'no' => esc_html__('No','newshub'),
                )
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Date Format','newshub'),
                'name' => 'date_format',
                'description' => esc_html__('Enter the date format that you want to display','newshub')
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
        $number_of_posts = 3;
        if (!empty($instance['number_of_posts']) && $instance['number_of_posts'] !== '') {
            $number_of_posts = $instance['number_of_posts'];
        }

        $display_date = true;
        if (!empty($instance['display_date']) && $instance['display_date'] === 'no') {
            $display_date = false;
        }

        $date_format = 'F d';
        if (!empty($instance['date_format']) && $instance['date_format'] !== '') {
            $date_format = $instance['date_format'];
        }

        $month = get_the_time('m');
        $year = get_the_time('Y');

        $comments = get_comments(
            array(
                'number' => $number_of_posts,
                'status' => 'approve',
                'post_status' => 'publish'
            )
        );

        echo '<div class="widget mkd-rc-holder">';
        if (!empty($instance['widget_title']) && $instance['widget_title'] !== '') {
            echo $args['before_title'] . esc_attr($instance['widget_title']) . $args['after_title'];
        }
        echo '<div class="mkd-rc-inner">';
        echo '<ul>';
        if (is_array($comments) && $comments) {
            foreach ((array)$comments as $comment) {
                echo '<li>';
                echo '<div class="mkd-rc-holder clearfix">';
                echo '<div class="mkd-rc-icon-holder"><i class="ion-ios-chatboxes-outline"></i></div>';
                echo '<div class="mkd-rc-content">';
                echo '<h6 class="mkd-rc-link"><a itemprop="url" href="' . esc_url(get_comment_link($comment)) . '">' . get_the_title($comment->comment_post_ID) . '</a></h6>';
                if ($display_date) {
                    echo '<a class="mkd-rc-date" itemprop="url" href="' . get_month_link($year, $month) . '">' . get_the_time($date_format, $comment->comment_post_ID) . '</a>';
                }
                echo '</div>';
                echo '</div>';
                echo '</li>';
            }
        }
        echo '</ul>';
        echo '</div>';
        echo '</div>';
    }
}