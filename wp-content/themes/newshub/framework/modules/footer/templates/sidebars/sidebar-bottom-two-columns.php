<div class="mkd-two-columns-50-50 clearfix">
	<div class="mkd-two-columns-50-50-inner">
		<div class="mkd-column">
			<div class="mkd-column-inner">
				<?php if(is_active_sidebar('footer_bottom_left')) {
					dynamic_sidebar( 'footer_bottom_left' );
				} ?>
			</div>
		</div>
		<div class="mkd-column">
			<div class="mkd-column-inner">
				<?php if(is_active_sidebar('footer_bottom_right')) {
					dynamic_sidebar( 'footer_bottom_right' );
				} ?>
			</div>
		</div>
	</div>
</div>