<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php newshub_mikado_inline_style($button_styles); ?> <?php newshub_mikado_class_attribute($button_classes); ?> <?php echo newshub_mikado_get_inline_attrs($button_data); ?> <?php echo newshub_mikado_get_inline_attrs($button_custom_attrs); ?>>
    <span class="mkd-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo newshub_mikado_icon_collections()->renderIcon($icon, $icon_pack, array(
    	'icon_attributes' => array(
    		'class' => 'mkd-btn-icon-element'
		)
    )); ?>
</a>