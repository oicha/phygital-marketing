<?php
/**
 * Section Table shortcode template
 */
?>
<div class="mkd-section-title-holder clearfix">
    <?php if ($title !== '') { ?>
        <?php echo '<' . esc_html($title_tag) ?> class="mkd-title-line-head">
        <?php echo esc_attr($title); ?>
        <?php echo '</' . esc_html($title_tag) ?>>
    <?php } ?>
    <div class="mkd-title-line-body"></div>
</div>