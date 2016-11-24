<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php
    /**
     * @see newshub_mikado_header_meta() - hooked with 10
     * @see mkd_user_scalable - hooked with 10
     */
    ?>
	<?php do_action('newshub_mikado_header_meta'); ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
<?php newshub_mikado_get_side_area(); ?>
<div class="mkd-wrapper">
    <div class="mkd-wrapper-inner">
        <?php 
        $id = newshub_mikado_get_page_id();
        if(newshub_mikado_get_meta_field_intersect('uncovering_footer', $id ) == 'yes') { ?>
            <div id="mkd-content-wrapper">
            <!-- needed for uncovering footer effect -->
        <?php } ?>

        <?php newshub_mikado_get_header(); ?>

        <?php if(newshub_mikado_options()->getOptionValue('show_back_button') == "yes") { ?>
            <a id='mkd-back-to-top'  href='#'>
                <span class="mkd-icon-stack">
                     <span aria-hidden="true" class="mkd-icon-font-elegant arrow_carrot-up"></span>
                </span>
            </a>
        <?php } ?>

        <div class="mkd-content" <?php newshub_mikado_content_elem_style_attr(); ?>>
            <div class="mkd-content-inner">