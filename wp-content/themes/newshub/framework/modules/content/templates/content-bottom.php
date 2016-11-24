<div class="mkd-content-bottom-widget-area">
<?php if ($content_bottom_in_grid) { ?>

<div class="mkd-container">
    <div class="mkd-container-inner">

<?php } ?>
    <div class="mkd-three-columns clearfix">
        <div class="mkd-three-columns-inner">
            <div class="mkd-column">
                <div class="mkd-column-inner">
                    <?php if (is_active_sidebar('content_bottom_1')) {
                        dynamic_sidebar('content_bottom_1');
                    } ?>
                </div>
            </div>
            <div class="mkd-column">
                <div class="mkd-column-inner">
                    <?php if (is_active_sidebar('content_bottom_2')) {
                        dynamic_sidebar('content_bottom_2');
                    } ?>
                </div>
            </div>
            <div class="mkd-column">
                <div class="mkd-column-inner">
                    <?php if (is_active_sidebar('content_bottom_3')) {
                        dynamic_sidebar('content_bottom_3');
                    } ?>
                </div>
            </div>
        </div>
    </div>

<?php if ($content_bottom_in_grid) { ?>
    </div>
</div>
<?php } ?>

</div>
