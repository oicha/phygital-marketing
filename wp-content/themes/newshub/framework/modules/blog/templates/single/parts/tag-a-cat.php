<?php if ($display_category == 'yes') { ?>
    <div class="mkd-post-info-category-holder clearfix">
        <?php newshub_mikado_post_info(array(
            'category' => $display_category,
        )) ?>
    </div>
<?php } ?>
<div style="float:right">
	    <div class="mkd-single-tags-holder" style="padding-bottom: 0px;padding-top: 0px;">
        <h6 class="mkd-single-tags-title mkd-title-line-head"><?php esc_html_e('タグ', 'newshub'); ?></h6>
        <div class="mkd-title-line-body"></div>
        <div class="mkd-tags">
            <?php the_tags('', '', ''); ?>
        </div>
    </div>	
</div>