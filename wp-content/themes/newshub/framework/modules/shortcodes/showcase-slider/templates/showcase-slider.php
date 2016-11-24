<div class="mkd-showcase-slider">

    <?php
    $count = 0;
    $links = explode(',', $links);
    ?>

    <?php foreach ($images as $image) : ?>

        <div>

            <?php $link = false; ?>
            <?php if (array_key_exists($count, $links)): ?>
                <?php $link = (trim($links[$count]) !== '') ? true : false; ?>
            <?php endif; ?>

            <?php if ($link == true): ?>
                <?php echo '<a href="' . esc_url($links[$count]) . '" target="_blank">'; ?>
            <?php endif; ?>

            <div class="mkd-showcase-slide">
                <?php echo wp_get_attachment_image($image['image_id'], 'full'); ?>
            </div>

            <?php if ($link == true): ?>
                <?php echo '</a>'; ?>
            <?php endif; ?>

        </div>

        <?php $count++; ?>

    <?php endforeach; ?>

</div>