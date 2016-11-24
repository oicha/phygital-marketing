<div class="mkd-footer-heading-holder">
    <div <?php newshub_mikado_class_attribute($footer_heading_classes); ?>>
		<?php if($footer_in_grid) { ?>

		<div class="mkd-container">
			<div class="mkd-container-inner">

		<?php } ?>

                <div class="mkd-column-inner">
                    <?php if(is_active_sidebar('footer_heading')) {
                        dynamic_sidebar( 'footer_heading' );
                    } ?>
                </div>

		<?php if($footer_in_grid) { ?>
			</div>
		</div>
	<?php } ?>
	</div>
</div>
