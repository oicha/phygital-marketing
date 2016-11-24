<?php

/*** Video Post Format ***/

$video_post_format_meta_box = newshub_mikado_add_meta_box(
    array(
        'scope' => array('post'),
        'title' => esc_html__('Video Post Format','newshub'),
        'name' => 'post_format_video_meta'
    )
);

newshub_mikado_add_meta_box_field(
    array(
        'name' => 'mkd_video_type_meta',
        'type' => 'select',
        'label' => esc_html__('Video Type','newshub'),
        'description' => esc_html__('Choose video type','newshub'),
        'parent' => $video_post_format_meta_box,
        'default_value' => 'social_networks',
        'options' => array(
            'social_networks' => 'Embedded link',
            'self' => 'Selfhosted'
        ),
        'args' => array(
            'dependence' => true,
            'hide' => array(
                'social_networks' => '#mkd_mkd_video_self_hosted_container',
                'self' => '#mkd_mkd_video_embedded_container'
            ),
            'show' => array(
                'social_networks' => '#mkd_mkd_video_embedded_container',
                'self' => '#mkd_mkd_video_self_hosted_container')
        )
    )
);

$mkd_video_embedded_container = newshub_mikado_add_admin_container(
    array(
        'parent' => $video_post_format_meta_box,
        'name' => 'mkd_video_embedded_container',
        'hidden_property' => 'mkd_video_type_meta',
        'hidden_value' => 'self'
    )
);

$mkd_video_self_hosted_container = newshub_mikado_add_admin_container(
    array(
        'parent' => $video_post_format_meta_box,
        'name' => 'mkd_video_self_hosted_container',
        'hidden_property' => 'mkd_video_type_meta',
        'hidden_value' => 'social_networks'
    )
);

newshub_mikado_add_meta_box_field(
    array(
        'name' => 'mkd_post_video_link_meta',
        'type' => 'text',
        'label' => esc_html__('Video URL','newshub'),
        'description' => esc_html__('Enter video URL','newshub'),
        'parent' => $mkd_video_embedded_container,
    )
);

newshub_mikado_add_meta_box_field(
    array(
        'name' => 'mkd_post_video_image_meta',
        'type' => 'image',
        'label' => esc_html__('Video Image','newshub'),
        'description' => esc_html__('Upload video image','newshub'),
        'parent' => $mkd_video_self_hosted_container,
    )
);

newshub_mikado_add_meta_box_field(
    array(
        'name' => 'mkd_post_video_mp4_link_meta',
        'type' => 'text',
        'label' => esc_html__('Selfhosted Video URL','newshub'),
        'description' => esc_html__('Enter video URL for MP4 format','newshub'),
        'parent' => $mkd_video_self_hosted_container,
    )
);