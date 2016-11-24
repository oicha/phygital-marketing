<?php
/**
 * Footer template part
 */
?>
</div> <!-- close div.content_inner -->
</div>  <!-- close div.content -->

<?php 
$id = newshub_mikado_get_page_id();
if(newshub_mikado_get_meta_field_intersect('uncovering_footer', $id ) == 'yes') { ?>
    </div>
    <!-- needed for uncovering footer effect -->
<?php } ?>

<?php if($display_footer_top || $display_footer_bottom || $display_footer_heading) { ?>
<footer>
	<div class="mkd-footer-inner clearfix">
		<?php
            if($display_footer_heading) {
                newshub_mikado_get_footer_heading();
            }
			if($display_footer_top) {
				newshub_mikado_get_footer_top();
			}
			if($display_footer_bottom) {
				newshub_mikado_get_footer_bottom();
			}
		?>
	</div>
</footer>
<?php } ?>

</div> <!-- close div.mkd-wrapper-inner  -->
</div> <!-- close div.mkd-wrapper -->
<?php wp_footer(); ?>
</body>
</html>