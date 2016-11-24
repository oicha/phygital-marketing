<?php

/*** Quote Post Format ***/

$quote_post_format_meta_box = newshub_mikado_add_meta_box(
	array(
		'scope' =>	array('post'),
		'title' => esc_html__('Quote Post Format','newshub'),
		'name' 	=> 'post_format_quote_meta'
	)
);

    newshub_mikado_add_meta_box_field(
        array(
            'name'        => 'mkd_post_quote_author_meta',
            'type'        => 'text',
            'label'       => esc_html__('Quote Author','newshub'),
            'description' => esc_html__('Enter Quote Author','newshub'),
            'parent'      => $quote_post_format_meta_box,

        )
    );

