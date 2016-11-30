<?php do_action('newshub_mikado_before_site_logo'); ?>

<div class="mkd-logo-wrapper" style="float:left;">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php newshub_mikado_inline_style($logo_styles); ?>>
        <img src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('logo','newshub' ); ?>"/>
    </a>
</div>
<div style="width:500px; float:right;padding-top:15px;">フィジカルとデジタルをかけ合わせた造語であるPhygital（フィジタル）。
主に小売業のマーケティングで活用が広がるフィジタル関連情報を配信中。</div>

<?php do_action('newshub_mikado_after_site_logo'); ?>