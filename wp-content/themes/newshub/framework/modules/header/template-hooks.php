<?php

//top header bar
add_action('newshub_mikado_before_page_header', 'newshub_mikado_get_header_top');

//mobile header
add_action('newshub_mikado_after_page_header', 'newshub_mikado_get_mobile_header');