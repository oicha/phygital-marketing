<?php

/*** Audio Post Format ***/

$audio_post_format_meta_box = newshub_mikado_add_meta_box(
    array(
        'scope' => array('post'),
        'title' => esc_html__('Audio Post Format','newshub'),
        'name' => 'post_format_audio_meta'
    )
);

newshub_mikado_add_meta_box_field(
    array(
        'name' => 'mkd_audio_type_meta',
        'type' => 'select',
        'label' => esc_html__('Audio Type','newshub'),
        'description' => esc_html__('Choose audio type','newshub'),
        'parent' => $audio_post_format_meta_box,
        'default_value' => 'social_networks',
        'options' => array(
            'social_networks' => 'Embedded link',
            'self' => 'Selfhosted'
        ),
        'args' => array(
            'dependence' => true,
            'hide' => array(
                'social_networks' => '#mkd_mkd_audio_self_hosted_container',
                'self' => '#mkd_mkd_audio_embedded_container'
            ),
            'show' => array(
                'social_networks' => '#mkd_mkd_audio_embedded_container',
                'self' => '#mkd_mkd_audio_self_hosted_container')
        )
    )
);

$mkd_audio_embedded_container = newshub_mikado_add_admin_container(
    array(
        'parent' => $audio_post_format_meta_box,
        'name' => 'mkd_audio_embedded_container',
        'hidden_property' => 'mkd_audio_type_meta',
        'hidden_value' => 'self'
    )
);

$mkd_audio_self_hosted_container = newshub_mikado_add_admin_container(
    array(
        'parent' => $audio_post_format_meta_box,
        'name' => 'mkd_audio_self_hosted_container',
        'hidden_property' => 'mkd_audio_type_meta',
        'hidden_value' => 'social_networks'
    )
);

newshub_mikado_add_meta_box_field(
    array(
        'name' => 'mkd_post_audio_link_meta',
        'type' => 'text',
        'label' => esc_html__('Audio URL','newshub'),
        'description' => esc_html__('Enter audio URL','newshub'),
        'parent' => $mkd_audio_embedded_container,
    )
);

newshub_mikado_add_meta_box_field(
    array(
        'name' => 'mkd_post_audio_mp3_link_meta',
        'type' => 'text',
        'label' => esc_html__('Selfhosted Audio URL','newshub'),
        'description' => esc_html__('Enter audio URL for MP3 format','newshub'),
        'parent' => $mkd_audio_self_hosted_container,
    )
);