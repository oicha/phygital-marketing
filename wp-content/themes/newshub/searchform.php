<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <div role="search">
        <input type="text" value="" placeholder="<?php esc_html_e('こちらに入力して検索してください。', 'newshub'); ?>" name="s" id="s"/>
        <input type="submit" class="mkd-search-widget-icon" id="searchsubmit" value="&#x55;">
    </div>
</form>