<?php
$icon_html = newshub_mikado_icon_collections()->renderIcon($icon, $icon_pack, $params);
?>
<div class="mkd-icon-list-item">
	<div class="mkd-icon-list-icon-holder">
        <div class="mkd-icon-list-icon-holder-inner clearfix">
			<?php 
			print $icon_html;
			?>
		</div>
	</div>
	<p class="mkd-icon-list-text" <?php echo newshub_mikado_get_inline_style($title_style)?> > <?php echo esc_attr($title)?></p>
</div>