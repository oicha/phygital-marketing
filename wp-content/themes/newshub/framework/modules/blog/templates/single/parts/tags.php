<?php if(newshub_mikado_options()->getOptionValue('blog_single_tags') == 'yes'){ ?>
<div class="mkd-single-tags-share-holder">
<?php } ?>

<?php if(newshub_mikado_options()->getOptionValue('blog_single_tags') == 'yes' && has_tag()){ ?>
    <div class="mkd-single-tags-holder" style="padding-bottom: 0px;padding-top: 0px;">
        <span class="mkd-single-tags-title mkd-title-line-head"><?php esc_html_e('タグ：', 'newshub'); ?></span>
        <!--<div class="mkd-title-line-body"></div>-->
        <span class="mkd-tags">
            <?php the_tags('', '', ''); ?>
        </span>
    </div>
<?php } ?>


<?php if(newshub_mikado_options()->getOptionValue('blog_single_tags') == 'yes'){ ?>
</div>
<?php } ?>