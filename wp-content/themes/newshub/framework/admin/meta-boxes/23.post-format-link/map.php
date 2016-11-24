<?php

/*** Link Post Format ***/

$link_post_format_meta_box = newshub_mikado_add_meta_box(
	array(
		'scope' => array('post'),
		'title' => esc_html__('Link Post Format','newshub'),
		'name' => 'post_format_link_meta'
	)
);

    newshub_mikado_add_meta_box_field(
        array(
            'name'        => 'mkd_post_link_link_meta',
            'type'        => 'text',
            'label'       => esc_html__('Link','newshub'),
            'description' => esc_html__('Enter link','newshub'),
            'parent'      => $link_post_format_meta_box,

        )
    );

