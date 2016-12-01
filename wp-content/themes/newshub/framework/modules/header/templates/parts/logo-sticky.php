<?php do_action('newshub_mikado_before_site_logo'); ?>

<div class="mkd-logo-wrapper" style="float:left;">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php newshub_mikado_inline_style($logo_styles); ?>>
        <img src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('logo','newshub' ); ?>"/>
    </a>
</div>
<div style="width:500px; float:right;padding-top:15px;">フィジカル（物質の）とデジタルをかけ合わせた造語であるPhygital（フィジタル）。 このサイトではそのPhigitalにMarketingをさらに合わせ、オフラインとオンラインの世界を融合させた事例や体験を配信中</div>

<?php do_action('newshub_mikado_after_site_logo'); ?>