<?php do_action('newshub_mikado_before_site_logo');?>

<div class="mkd-logo-wrapper" style="float:left;">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php newshub_mikado_inline_style($logo_styles); ?>>
        <img class="mkd-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('logo','newshub'); ?>"/>
        <?php if(!empty($logo_image_dark)){ ?><img class="mkd-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" alt="<?php esc_html_e('dark logo','newshub'); ?>"/><?php } ?>
        <?php if(!empty($logo_image_light)){ ?><img class="mkd-light-logo" src="<?php echo esc_url($logo_image_light); ?>" alt="<?php esc_html_e('light logo','newshub'); ?>"/><?php } ?>
        <?php if(!empty($logo_image_transparent)){ ?><img class="mkd-transparent-logo" src="<?php echo esc_url($logo_image_transparent); ?>" alt="<?php esc_html_e('transparent logo','newshub'); ?>"/><?php } ?>
    </a>
</div>
<div class="mkd-site-info">フィジカル×デジタルの造語、Phygital（フィジタル）にMarketingを合わせ、ネットとリアルの世界を融合させた情報を配信</div>

<?php do_action('newshub_mikado_after_site_logo'); ?>