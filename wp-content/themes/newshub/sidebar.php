<?php
$newshub_sidebar = newshub_mikado_get_sidebar();
?>
<div class="mkd-column-inner">
    <aside class="mkd-sidebar">
        <?php
            if (is_active_sidebar($newshub_sidebar)) {
                dynamic_sidebar($newshub_sidebar);
            }
        ?>
    </aside>
</div>
