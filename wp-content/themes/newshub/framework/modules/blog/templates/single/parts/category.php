<?php if ($display_category == 'yes') { ?>
    <div class="mkd-post-info-category-holder clearfix">
        <?php newshub_mikado_post_info(array(
            'category' => $display_category,
        )) ?>
    </div>
<?php } ?>