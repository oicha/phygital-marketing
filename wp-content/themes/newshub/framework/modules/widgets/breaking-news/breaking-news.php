<?php

/**
 * Widget that adds breaking news shortcode
 *
 * Class Breaking_News
 */
class NewsHubMikadoBreakingNews extends NewsHubMikadoWidget
{
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_breaking_news', // Base ID
            esc_html__('Mikado Breaking News', 'newshub') // Name
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
                'title' => esc_html__('Number of Posts','newshub'),
                'name' => 'number_of_posts',
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Order By','newshub'),
                'name' => 'order_by',
                'options' => array(
                    'title' => esc_html__('Title','newshub'),
                    'date' => esc_html__('Date','newshub'),
                    'author' => esc_html__('Author','newshub'),
                    'random' => esc_html__('Random','newshub')
                ),
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Order','newshub'),
                'name' => 'order',
                'options' => array(
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ),
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Category Slug','newshub'),
                'name' => 'category_slug',
                'description' => esc_html__('Leave empty for all or use comma for list','newshub')
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Author ID','newshub'),
                'name' => 'author_id',
                'description' => esc_html__('Leave empty for all or use comma for list','newshub')
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
                'type' => 'textfield',
                'title' => esc_html__('Slideshow Speed','newshub'),
                'name' => 'slideshowspeed',
                'description' => esc_html__('Set the speed of the slideshow cycling, in milliseconds. Default value is 4000.','newshub')
            ),
            array(
                'type' => 'textfield',
                'title' => esc_html__('Slide Animation Speed','newshub'),
                'name' => 'animationspeed',
                'description' => esc_html__('Set the speed of animations, in milliseconds. Default value is 400.','newshub')
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('style','newshub'),
                'name' => 'style',
                'options' => array(
                    '' => esc_html__('Default','newshub'),
                    'light' => esc_html__('Light','newshub'),
                    'dark' => esc_html__('Dark','newshub'),
                    'red' => esc_html__('Red','newshub'),
                ),
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

        $queryArray = array();

        if (!empty($instance['number_of_posts']) && $instance['number_of_posts'] !== '') {
            $queryArray['posts_per_page'] = $instance['number_of_posts'];
        }

        if (!empty($instance['order_by']) && $instance['order_by'] !== '') {
            $queryArray['orderby'] = $instance['order_by'];
        }

        if (!empty($instance['order']) && $instance['order'] !== '') {
            $queryArray['order'] = $instance['order'];
        }

        if (!empty($instance['category_slug']) && $instance['category_slug'] !== '') {
            $queryArray['category_name'] = $instance['category_slug'];
        }

        if (!empty($instance['author_id']) && $instance['author_id'] !== '') {
            $queryArray['author'] = $instance['author_id'];
        }

        if (!empty($instance['tag_slug']) && $instance['tag_slug'] !== '') {
            $queryArray['tag'] = str_replace(' ', '-', $instance['tag_slug']);
        }

        if (!empty($instance['post_in']) && $instance['post_in'] !== '') {
            $queryArray['post__in'] = explode(",", $instance['post_in']);
        }

        if (!empty($instance['post_not_in']) && $instance['post_not_in'] !== '') {
            $queryArray['post__not_in'] = $instance['post_not_in'];
        }

        $queryArray['post_status'] = 'publish'; //to ensure that ajax call will not return 'private' posts

        $queryResult = new \WP_Query($queryArray);

        $data = array();

        if (!empty($instance['slideshowspeed']) && $instance['slideshowspeed'] !== '') {
            $data['slideshowspeed'] = $instance['slideshowspeed'];
        }

        if (!empty($instance['animationspeed']) && $instance['animationspeed'] !== '') {
            $data['animationspeed'] = $instance['animationspeed'];
        }

        echo '';

        $additional_class = 'mkd-' . $instance['style'];

        ?>
        <div class="widget mkd-bn-holder <?php echo esc_attr($additional_class); ?> " <?php echo newshub_mikado_get_inline_attrs($data); ?>>
            <?php if ($queryResult->have_posts()): ?>
                <div class="mkd-bn-title">
                    <h5><?php esc_html_e('Trending News', 'newshub'); ?></h5>
                    <span class="mkd-bn-icon ion-chevron-right"></span>
                </div>
                <ul class="mkd-bn-slide">
                    <?php while ($queryResult->have_posts()) : $queryResult->the_post(); ?>
                        <li class="mkd-bn-text">
                            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_attr(get_the_title()); ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>

                <div class="mkd-bn-messsage">
                    <p><?php esc_html_e('No posts were found.', 'newshub'); ?></p>
                </div>

            <?php endif;
            wp_reset_postdata();
            ?>
        </div>
        <?php
    }
}