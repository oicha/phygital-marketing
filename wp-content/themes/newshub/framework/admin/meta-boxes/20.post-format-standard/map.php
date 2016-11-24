<?php

    $standard_post_format_meta_box = newshub_mikado_add_meta_box(
        array(
            'scope' => array('post'),
            'title' => esc_html__('Standard Post Format','newshub'),
            'name'  => 'post_format_standard_meta'
        )
    );

    newshub_mikado_add_meta_box_field(
        array(
            'name'        => 'mkd_show_featured_post',
            'type'        => 'select',
            'default_value' => 'no',
            'label'       => esc_html__('Set as featured post','newshub'),
            'description' => esc_html__('Enable this option will show this post as featured','newshub'),
            'parent'      => $standard_post_format_meta_box,
            'options'     => array(
                'no' => 'No',
                'yes' => 'Yes'
            )
        )
    );

    newshub_mikado_add_meta_box_field(
        array(
            'name'        => 'mkd_blog_single_masonry_type',
            'type'        => 'selectblank',
            'label'       => esc_html__('Dimensions for Masonry','newshub'),
            'description' => esc_html__('Choose image layout in Blog Masonry shortcode','newshub'),
            'parent'      => $standard_post_format_meta_box,
			'options'     => array(
				'default'            => 'Default',
				'large-width'        => 'Large width',
				'large-height'       => 'Large height',
				'square'       => 'Square'
			),
			'default_value' => 'default'
        )
    );