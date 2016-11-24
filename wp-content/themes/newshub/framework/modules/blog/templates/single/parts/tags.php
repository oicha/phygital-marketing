<?php if(newshub_mikado_options()->getOptionValue('blog_single_tags') == 'yes'){ ?>
<div class="mkd-single-tags-share-holder">
<?php } ?>

<?php if(newshub_mikado_options()->getOptionValue('blog_single_tags') == 'yes' && has_tag()){ ?>
    <div class="mkd-single-tags-holder">
        <h5 class="mkd-single-tags-title mkd-title-line-head"><?php esc_html_e('タグ', 'newshub'); ?></h5>
        <div class="mkd-title-line-body"></div>
        <div class="mkd-tags">
            <?php the_tags('', '', ''); ?>
        </div>
    </div>
<?php } ?>


<?php if(newshub_mikado_options()->getOptionValue('blog_single_tags') == 'yes'){ ?>
</div>
<?php } ?>