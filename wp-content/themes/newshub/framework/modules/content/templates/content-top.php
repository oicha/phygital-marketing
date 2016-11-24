<div <?php newshub_mikado_class_attribute($content_top_classes); ?>>
<?php if ($content_top_in_grid) { ?>

<div class="mkd-container">
    <div class="mkd-container-inner">

<?php } ?>
    <div class="clearfix">
        <div class="mkd_column mkd-column1">
            <div class="mkd-column-inner">
                <?php if(is_active_sidebar('content_top')) {
                    dynamic_sidebar( 'content_top' );
                } ?>
            </div>
        </div>
    </div>


<?php if ($content_top_in_grid) { ?>
    </div>
</div>
<?php } ?>
</div>
