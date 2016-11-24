<?php if(newshub_mikado_options()->getOptionValue('blog_single_share') == 'yes' && newshub_mikado_options()->getOptionValue('enable_social_share') == 'yes' && newshub_mikado_options()->getOptionValue('enable_social_share_on_post') == 'yes'){ ?>
    <div class ="mkd-blog-single-share">
        <?php echo newshub_mikado_get_social_share_html(array('type'=> $type)); ?>
    </div>
<?php }