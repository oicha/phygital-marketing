<?php if(newshub_mikado_options()->getOptionValue('blog_single_tags') == 'yes' && has_tag()){ ?>
	<div class="mkd-single-tags-holder">
		<h5 class="mkd-single-tags-title"><?php esc_html_e('POST TAGS:', 'newshub'); ?></h5>
		<div class="mkd-tags">
			<?php the_tags('', '', ''); ?>
		</div>
	</div>
<?php } ?>