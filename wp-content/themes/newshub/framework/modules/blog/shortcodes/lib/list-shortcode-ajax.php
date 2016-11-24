<?php

/*
	Layouts - shortcodes
*/
use NewsHub\Modules\Blog\Shortcodes\PostLayoutOne\PostLayoutOne;
use NewsHub\Modules\Blog\Shortcodes\PostLayoutTwo\PostLayoutTwo;
use NewsHub\Modules\Blog\Shortcodes\PostLayoutThree\PostLayoutThree;
use NewsHub\Modules\Blog\Shortcodes\PostLayoutFour\PostLayoutFour;
use NewsHub\Modules\Blog\Shortcodes\PostLayoutFive\PostLayoutFive;
use NewsHub\Modules\Blog\Shortcodes\PostLayoutSix\PostLayoutSix;

/*
	Blocks - combinations of several layouts
*/
use NewsHub\Modules\Blog\Shortcodes\BlockOne\BlockOne;
use NewsHub\Modules\Blog\Shortcodes\BlockTwo\BlockTwo;
use NewsHub\Modules\Blog\Shortcodes\BlockThree\BlockThree;
use NewsHub\Modules\Blog\Shortcodes\BlockFour\BlockFour;
use NewsHub\Modules\Blog\Shortcodes\BlockFive\BlockFive;
use NewsHub\Modules\Blog\Shortcodes\BlockSix\BlockSix;
use NewsHub\Modules\Blog\Shortcodes\BlockSeven\BlockSeven;

/*
	Post Sliders - combinations of several layouts
*/
use NewsHub\Modules\Blog\Shortcodes\SliderPostOne\SliderPostOne;
use NewsHub\Modules\Blog\Shortcodes\SliderPostTwo\SliderPostTwo;
use NewsHub\Modules\Blog\Shortcodes\SliderPostTwo\SliderPostThree;

if (!function_exists('newshub_mikado_list_ajax')) {
    function newshub_mikado_list_ajax() {

        $params = ($_POST);

        $prefix_block = 'mkd_block_';
        $prefix_layout = 'mkd_post_layout_';

        switch ($params['base']) {
            case 'mkd_block_one' : {
                $newShortcode = new BlockOne();
            }
                break;
            case 'mkd_block_two' : {
                $newShortcode = new BlockTwo();
            }
                break;
            case 'mkd_block_three' : {
                $newShortcode = new BlockThree();
            }
                break;
            case 'mkd_block_four' : {
                $newShortcode = new BlockFour();
            }
                break;
            case 'mkd_block_five' : {
                $newShortcode = new BlockFive();
            }
                break;
            case 'mkd_block_six' : {
                $newShortcode = new BlockSix();
            }
                break;
            case 'mkd_block_seven' : {
                $newShortcode = new BlockSeven();
            }
                break;
            case 'mkd_post_layout_one' : {
                $newShortcode = new PostLayoutOne();
            }
                break;
            case 'mkd_post_layout_two' : {
                $newShortcode = new PostLayoutTwo();
            }
                break;
            case 'mkd_post_layout_three' : {
                $newShortcode = new PostLayoutThree();
            }
                break;
            case 'mkd_post_layout_four' : {
                $newShortcode = new PostLayoutFour();
            }
                break;
            case 'mkd_post_layout_five' : {
                $newShortcode = new PostLayoutFive();
            }
                break;
            case 'mkd_post_layout_six' : {
                $newShortcode = new PostLayoutSix();
            }
                break;
            case 'mkd_slider_post_one' : {
                $newShortcode = new SliderPostOne();
            }
                break;
            case 'mkd_slider_post_two' : {
                $newShortcode = new SliderPostTwo();
            }
                break;
            case 'mkd_slider_post_three' : {
                $newShortcode = new SliderPostThree();
            }
                break;
        }

        $params['query_result'] = $newShortcode->generatePostsQuery($params);
        $html_response = $newShortcode->render($params);

        $show_next_page = true;
        if ($params['paged'] < 1 || $params['paged'] > $params['query_result']->max_num_pages) {
            $show_next_page = false;
        }


        $return_obj = array(
            'html' => $html_response,
            'showNextPage' => $show_next_page,
            'pagedResult' => $params['paged']
        );

        echo json_encode($return_obj);
        exit;
    }

    add_action('wp_ajax_newshub_mikado_list_ajax', 'newshub_mikado_list_ajax');
    add_action('wp_ajax_nopriv_newshub_mikado_list_ajax', 'newshub_mikado_list_ajax');
}