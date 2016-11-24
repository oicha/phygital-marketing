<?php

$newshub_custom_sidebars = newshub_mikado_get_custom_sidebars();

$newshub_sidebar_meta_box = newshub_mikado_add_meta_box(
    array(
        'scope' => array('page', 'post', 'forum', 'topic'),
        'title' => esc_html__('Sidebar','newshub'),
        'name' => 'sidebar_meta'
    )
);

    newshub_mikado_add_meta_box_field(
        array(
            'name'        => 'mkd_sidebar_meta',
            'type'        => 'select',
            'label'       => esc_html__('Layout','newshub'),
            'description' => esc_html__('Choose the sidebar layout','newshub'),
            'parent'      => $newshub_sidebar_meta_box,
            'options'     => array(
						''			=> 'Default',
						'no-sidebar'		=> 'No Sidebar',
						'sidebar-33-right'	=> 'Sidebar 1/3 Right',
						'sidebar-25-right' 	=> 'Sidebar 1/4 Right',
						'sidebar-33-left' 	=> 'Sidebar 1/3 Left',
						'sidebar-25-left' 	=> 'Sidebar 1/4 Left',
					)
        )
    );

if(count($newshub_custom_sidebars) > 0) {
    newshub_mikado_add_meta_box_field(array(
        'name' => 'mkd_custom_sidebar_meta',
        'type' => 'selectblank',
        'label' => esc_html__('Choose Widget Area in Sidebar','newshub'),
        'description' => esc_html__('Choose Custom Widget area to display in Sidebar"','newshub'),
        'parent' => $newshub_sidebar_meta_box,
        'options' => $newshub_custom_sidebars
    ));
}
