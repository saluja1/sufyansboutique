<?php
/*-----------------------------------------------------------------------------------*/
/*  Begin processing our comments
/*-----------------------------------------------------------------------------------*/
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<?php if ( have_comments() ) : ?>
<!-- Start #comments -->
<div class="comments-container">
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-10 col-lg-8">
				<h4 class="comments-title">
					<?php
						printf( _nx( '%1$s Reply', '%1$s Replies', get_comments_number(), 'comments', 'goya' ),
							number_format_i18n( get_comments_number() ) );
					?>
					<?php esc_html_e('on', 'goya'); ?>
					<?php the_title(); ?>
				</h4>
					
				<ul class="commentlist cf">
					<?php wp_list_comments(
						array(
							'type'		  	=> 'all',
							'style'       => 'ul',
							'short_ping'  => true,
							'avatar_size' => 60,
							'reply_text'  => esc_html__('Reply', 'goya' ),
						)
					); ?>
				</ul>
				
				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
					<div class="navigation">
						<div class="nav-previous"><?php previous_comments_link(); ?></div>
						<div class="nav-next"><?php next_comments_link(); ?></div>
					</div><!-- .navigation -->
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php else : 
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php esc_html_e('Comments are closed', 'goya'); ?></p>
<?php endif; // end ! comments_open() ?>
		
<?php endif; // end have_comments() ?>
		
<div class="respond-container">
	<div class="container">
		<?php
			// Comment Form
			$commenter = wp_get_current_commenter();
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? ' aria-required="true" data-required="true"' : '' );
			
			$defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
			
				'author' => '<p class="form-row form-row-first"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="' . esc_attr__( 'Name', 'goya' ) . '" class="full"/></p>',
				
				'email'  => '<p class="form-row form-row-last"><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="' . esc_attr__( 'Email', 'goya' ) . '" class="full" /></p>',
				
				'url'    => '<p class="form-row-wide"><input name="url" size="30" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" type="text" placeholder="' . esc_attr__( 'Website', 'goya' ) . '" class="full"/></p>' ) ),
				
				'comment_field' => '<p class="form-row-wide"><textarea name="comment" id="comment"' . $aria_req . ' rows="3" cols="58" class="full" placeholder="' . esc_attr__( 'Your Comment', 'goya' ) . '"></textarea></p>',
				
				'must_log_in' => '<p class="must-log-in">' .  sprintf( wp_kses(__( 'You must be <a href="%s">logged in</a> to post a comment.', 'goya' ), array('a' => array('href' => array(),'title' => array()))), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				
				'logged_in_as' => '<p class="logged-in-as">' . sprintf( wp_kses(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'goya' ), array('a' => array('href' => array(),'title' => array()))), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				
				'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Your email address will not be published.', 'goya' ) . '</p>',
				'comment_notes_after' => '',
				'id_form' => 'form-comment',
				'id_submit' => 'submit',
				'title_reply' => esc_html__( 'Leave a Reply', 'goya' ),
				'title_reply_to' => esc_html__( 'Leave a Reply to %s', 'goya' ),
				'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
				'title_reply_after' => '</h4>',
				'cancel_reply_link' => esc_attr__( 'Cancel reply', 'goya' ),
				'class_submit' => 'submit btn',
				'label_submit' => esc_attr__( 'Submit Comment', 'goya' ),
			); 
		comment_form($defaults); 
		?>
	</div>
</div>
<!-- End #comments -->