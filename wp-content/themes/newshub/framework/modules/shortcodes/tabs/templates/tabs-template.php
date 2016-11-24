<div class="mkd-tabs clearfix <?php echo esc_attr($tabs_classes) ?>">
    <div class="mkd-tabs-nav">
        <ul>
            <?php  foreach ($tabs_titles as $tab_title) {?>
                <li>
                    <h5 class="mkd-tabs-nav-item"><a href="#tab-<?php echo sanitize_title($tab_title)?>"><?php echo esc_attr($tab_title)?></a></h5>
                </li>
            <?php } ?>
        </ul>
    </div>
    <?php echo do_shortcode($content) ?>
</div>