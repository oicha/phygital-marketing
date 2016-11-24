<li class="mkd-<?php echo esc_html($name) ?>-share">
	<a itemprop="url" class="mkd-share-link" href="#" onclick="<?php print $link; ?>">
		<?php if ($custom_icon !== '') { ?>
			<img itemprop="image" src="<?php echo esc_url($custom_icon); ?>" alt="<?php echo esc_html($name); ?>" />
		<?php } else { ?>
			<span class="mkd-social-network-icon <?php echo esc_attr($icon); ?>"></span>
		<?php } ?>
        <?php if ($type == 'list') {?>
            <span><?php echo esc_attr($name); ?></span>
        <?php } ?>
	</a>
</li>