<div class="mkd-comment-holder clearfix <?php if ( !have_comments() && !comments_open() ) { echo "mkd-comment-holder-without-comments"; } ?> ">
	<div class="mkd-comment-title">
		<h5 class="mkd-title-line-head"><?php comments_number( esc_html__('No comments','newshub'), esc_html__('Latest comment','newshub'), esc_html__('Latest comments','newshub')); ?></h5>
        <div class="mkd-title-line-body"></div>
	</div>
	<div class="mkd-comments">
<?php if ( post_password_required() ) : ?>
		<p class="mkd-no-password"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'newshub' ); ?></p>
	</div>
</div>
<?php
		return;
	endif;
?>
<?php if ( have_comments() ) : ?>
	<ul class="mkd-comment-list">
		<?php wp_list_comments(array( 'callback' => 'newshub_mikado_comment')); ?>
	</ul>
<?php // End Comments ?>

 <?php else : // this is displayed if there are no comments so far 

	if ( ! comments_open() ) :
?>
		<!-- If comments are open, but there are no comments. -->

	 
		<!-- If comments are closed. -->
		<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'newshub'); ?></p>

	<?php endif; ?>
<?php endif; ?>
</div></div>
<?php
$newshub_commenter = wp_get_current_commenter();
$newshub_req = get_option( 'require_name_email' );
$newshub_aria_req = ( $newshub_req ? " aria-required='true'" : '' );

$args = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit_comment',
	'title_reply'=> esc_html__( 'leave a comment','newshub' ),
	'title_reply_to' => esc_html__( 'Post a Reply to %s','newshub' ),
	'cancel_reply_link' => esc_html__( 'Cancel Reply','newshub' ),
	'label_submit' => esc_html__( 'Post Comment','newshub' ),
	'comment_field' => '<textarea id="comment" placeholder="'.esc_html__( 'Comment *','newshub' ).'" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<div class="mkd-two-columns-50-50 clearfix"><div class="mkd-two-columns-50-50-inner"><div class="mkd-column"><div class="mkd-column-inner"><input id="author" name="author" placeholder="'. esc_html__( 'Name *','newshub' ) .'" type="text" value="' . esc_attr( $newshub_commenter['comment_author'] ) . '"' . $newshub_aria_req . ' /></div></div>',
		'url' => '<div class="mkd-column"><div class="mkd-column-inner"><input id="email" name="email" placeholder="'. esc_html__( 'Email *','newshub' ) .'" type="text" value="' . esc_attr(  $newshub_commenter['comment_author_email'] ) . '"' . $newshub_aria_req . ' /></div></div></div></div>',
		'email' => '<input id="url" name="url" type="text" placeholder="'. esc_html__( 'Website','newshub' ) .'" value="' . esc_attr( $newshub_commenter['comment_author_url'] ) . '" />'
		 ) ) 
	);
 ?>
<?php if(get_comment_pages_count() > 1){
	?>
	<div class="mkd-comment-pager">
		<p><?php paginate_comments_links(); ?></p>
	</div>
<?php } ?>
 <div class="mkd-comment-form">
	<?php comment_form($args); ?>
</div>