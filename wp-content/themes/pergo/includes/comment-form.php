<?php
function pergo_comment_form( $args = array(), $post_id = null ) {
	if ( null === $post_id )
		$post_id = get_the_ID();

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html_req = ( $req ? " required='required'" : '' );
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
		'author' => '<div id="post-name" class="col-md-12"><p>' . __( 'Name', 'pergo' ) . ( $req ? ' *' : '' ) . '</p><input id="author" class="form-control name" placeholder="' . __( 'Name', 'pergo' ) . ( $req ? ' *' : '' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></div>',
		'email'  => '<div id="post-email" class="col-md-12"><p>' . __( 'Email', 'pergo' ) . ( $req ? ' *' : '' ) . '</p><input id="email" class="form-control name" placeholder="' . __( 'Email', 'pergo' ) . ( $req ? ' *' : '' ) . '" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></div>',
		'website'  => '<div id="post-website" class="col-md-12"><p>' . __( 'Website', 'pergo' ) . '</p><input id="website" class="form-control name" placeholder="' . __( 'Website', 'pergo' ) .'" name="email" ' . ( $html5 ? 'type="text"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $html_req  . ' /></div>'
	);

	$required_text = sprintf( ' ' . __('Required fields are marked %s', 'pergo'), '<span class="required">*</span>' );

	/**
	 * Filter the default comment form fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $fields The default comment fields.
	 */
	$fields = apply_filters( 'comment_form_default_fields', $fields );
	$defaults = array(
		'fields'               => $fields,
		'comment_field'        => '<div  id="post-message" class="col-md-12"><p>'.esc_attr(__('Add Comment', 'pergo')). ( $req ? ' *' : '' ) .'</p><textarea id="comment" class="form-control comment" placeholder="'._x( 'Comment', 'noun', 'pergo' ). ( $req ? ' *' : '' ) .'" name="comment"  aria-required="true" required="required"></textarea></div>',
		/** This filter is documented in wp-includes/link-template.php */
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a class="color-text" href="%s">logged in</a> to post a comment.', 'pergo' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		/** This filter is documented in wp-includes/link-template.php */
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a class="color-text" href="%1$s" aria-label="Logged in as %2$s. Edit your profile.">%2$s</a>. <a class="color-text" href="%3$s">Log out?</a>', 'pergo' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . __( 'Your email address will not be published.' , 'pergo') . '</span>'. ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'class_form'           => 'commentform',
		'class_submit'         => 'btn btn-arrow submit btn-'.pergo_default_color(),
		'name_submit'          => 'submit',
		'title_reply'          => __( 'Leave a Comment', 'pergo' ),
		'title_reply_to'       => __( 'Leave a Reply to %s', 'pergo' ),
		'title_reply_before'   => '<h4 id="reply-title" class="h4-xs">',
		'title_reply_after'    => '</h4>',
		'cancel_reply_before'  => ' <small>',
		'cancel_reply_after'   => '</small>',
		'cancel_reply_link'    => __( 'Cancel reply', 'pergo' ),
		'label_submit'         => __( 'Send comment', 'pergo' ),
		'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
		'submit_field'         => '<div class="form-submit col-md-12 comment-form-btn m-top-20">%1$s %2$s</div>',
		'format'               => 'xhtml',
	);

	/**
	 * Filter the comment form default arpergoents.
	 *
	 * Use 'comment_form_default_fields' to filter the comment fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $defaults The default comment form arpergoents.
	 */
	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	// Ensure that the filtered args contain all required default values.
	$args = array_merge( $defaults, $args );

	if ( comments_open( $post_id ) ) : ?>
		<?php
		/**
		 * Fires before the comment form.
		 *
		 * @since 3.0.0
		 */
		do_action( 'comment_form_before' );
		?>
		<div id="respond" class="comment-respond leave-a-reply clearfix m-top-80">
			<?php
			echo $args['title_reply_before'];

			comment_form_title( $args['title_reply'], $args['title_reply_to'] );

			echo $args['cancel_reply_before'];

			cancel_comment_reply_link( $args['cancel_reply_link'] );

			echo $args['cancel_reply_after'];

			echo $args['title_reply_after'];

			if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) :
				echo $args['must_log_in'];
				/**
				 * Fires after the HTML-formatted 'must log in after' message in the comment form.
				 *
				 * @since 3.0.0
				 */
				do_action( 'comment_form_must_log_in_after' );
			else : ?>
				<?php
					/**
					 * Fires at the top of the comment form, inside the form tag.
					 *
					 * @since 3.0.0
					 */
					do_action( 'comment_form_top' );

					if ( is_user_logged_in() ) :
						/**
						 * Filter the 'logged in' message for the comment form for display.
						 *
						 * @since 3.0.0
						 *
						 * @param string $args_logged_in The logged-in-as HTML-formatted message.
						 * @param array  $commenter      An array containing the comment author's
						 *                               username, email, and URL.
						 * @param string $user_identity  If the commenter is a registered user,
						 *                               the display name, blank otherwise.
						 */
						echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );

						/**
						 * Fires after the is_user_logged_in() check in the comment form.
						 *
						 * @since 3.0.0
						 *
						 * @param array  $commenter     An array containing the comment author's
						 *                              username, email, and URL.
						 * @param string $user_identity If the commenter is a registered user,
						 *                              the display name, blank otherwise.
						 */
						do_action( 'comment_form_logged_in_after', $commenter, $user_identity );

					else :

						echo $args['comment_notes_before'];

					endif;
					?>

				<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="comment-form row m-top-50 <?php echo esc_attr( $args['class_form'] ); ?>"<?php echo $html5 ? ' novalidate' : ''; ?>>					

					<?php
					// Prepare an array of all fields, including the textarea
					$comment_fields = array( 'comment' => $args['comment_field'] ) + (array) $args['fields'];
					//$comment_fields = $args['fields'];

					/**
					 * Filter the comment form fields.
					 *
					 * @since 4.4.0
					 *
					 * @param array $comment_fields The comment fields.
					 */
					$comment_fields = apply_filters( 'comment_form_fields', $comment_fields );

					// Get an array of field names, excluding the textarea
					$comment_field_keys = array_diff( array_keys( $comment_fields ), array( 'comment' ) );

					// Get the first and the last field name, excluding the textarea
					$first_field = reset( $comment_field_keys );
					$last_field  = end( $comment_field_keys );
					
					foreach ( $comment_fields as $name => $field ) {

						if ( 'comment' === $name ) {

							/**
							 * Filter the content of the comment textarea field for display.
							 *
							 * @since 3.0.0
							 *
							 * @param string $args_comment_field The content of the comment textarea field.
							 */
							echo apply_filters( 'comment_form_field_comment', $field );

							echo $args['comment_notes_after'];

						} elseif ( ! is_user_logged_in() ) {

							if ( $first_field === $name ) {
								/**
								 * Fires before the comment fields in the comment form, excluding the textarea.
								 *
								 * @since 3.0.0
								 */
								do_action( 'comment_form_before_fields' );
							}

							/**
							 * Filter a comment form field for display.
							 *
							 * The dynamic portion of the filter hook, `$name`, refers to the name
							 * of the comment form field. Such as 'author', 'email', or 'url'.
							 *
							 * @since 3.0.0
							 *
							 * @param string $field The HTML-formatted output of the comment form field.
							 */
							
							echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";


							
						}
					}
					
						
						
					//echo apply_filters( "comment_form_field_comment", $args['comment_field'] ) . "\n";
						

					$submit_button = sprintf(
						$args['submit_button'],
						esc_attr( $args['name_submit'] ),
						esc_attr( $args['id_submit'] ),
						esc_attr( $args['class_submit'] ),
						esc_attr( $args['label_submit'] )
					);

					/**
					 * Filter the submit button for the comment form to display.
					 *
					 * @since 4.2.0
					 *
					 * @param string $submit_button HTML markup for the submit button.
					 * @param array  $args          Arpergoents passed to `comment_form()`.
					 */
					$submit_button = apply_filters( 'comment_form_submit_button', $submit_button, $args );

					$submit_field = sprintf(
						$args['submit_field'],
						$submit_button,
						get_comment_id_fields( $post_id )
					);

					/**
					 * Filter the submit field for the comment form to display.
					 *
					 * The submit field includes the submit button, hidden fields for the
					 * comment form, and any wrapper markup.
					 *
					 * @since 4.2.0
					 *
					 * @param string $submit_field HTML markup for the submit field.
					 * @param array  $args         Arpergoents passed to comment_form().
					 */
				
					
					echo apply_filters( 'comment_form_submit_field', $submit_field, $args );
				
				
					if ( $last_field === $name ) {
						/**
						 * Fires after the comment fields in the comment form, excluding the textarea.
						 *
						 * @since 3.0.0
						 */
						do_action( 'comment_form_after_fields' );
					}
				

					/**
					 * Fires at the bottom of the comment form, inside the closing </form> tag.
					 *
					 * @since 1.5.0
					 *
					 * @param int $post_id The post ID.
					 */
					do_action( 'comment_form', $post_id );
					?>
				</form>
			<?php endif; ?>
		</div><!-- #respond -->
		<?php
		/**
		 * Fires after the comment form.
		 *
		 * @since 3.0.0
		 */
		do_action( 'comment_form_after' );
	else :
		/**
		 * Fires after the comment form if comments are closed.
		 *
		 * @since 3.0.0
		 */
		do_action( 'comment_form_comments_closed' );
	endif;
}

add_filter( 'comment_reply_link', 'pergo_comment_reply_link', 10, 3 );
function pergo_comment_reply_link( $args = array(), $comment = null, $post = null ) {
        $defaults = array(
                'add_below'     => 'comment',
                'respond_id'    => 'respond',
                'reply_text'    => __( 'Reply', 'pergo' ),
                'reply_to_text' => __( 'Reply to %s', 'pergo' ),
                'login_text'    => __( 'Log in to Reply', 'pergo' ),
                'depth'         => 0,
                'before'        => '',
                'after'         => ''
        );

        $args = wp_parse_args( $args, $defaults );

        if ( 0 == $args['depth'] || $args['max_depth'] <= $args['depth'] ) {
                return;
        }

        $comment = get_comment( $comment );

        if ( empty( $post ) ) {
                $post = $comment->comment_post_ID;
        }

        $post = get_post( $post );

        if ( ! comments_open( $post->ID ) ) {
                return false;
        }

        $args = apply_filters( 'comment_reply_link_args', $args, $comment, $post );

        if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) {
                $link = sprintf( '<a rel="nofollow" class="comment-reply-login" href="%s">%s</a>',
                        esc_url( wp_login_url( get_permalink() ) ),
                        $args['login_text']
                );
        } else {
                $onclick = sprintf( 'return addComment.moveForm( "%1$s-%2$s", "%2$s", "%3$s", "%4$s" )',
                        $args['add_below'], $comment->comment_ID, $args['respond_id'], $post->ID
                );

                $link = sprintf( "<span class='btn-reply'><a rel='nofollow' class='reply-link' href='%s' onclick='%s' aria-label='%s'>%s</a></span>",
                        esc_url( add_query_arg( 'replytocom', $comment->comment_ID, get_permalink( $post->ID ) ) ) . "#" . $args['respond_id'],
                        $onclick,
                        esc_attr( sprintf( $args['reply_to_text'], $comment->comment_author ) ),
                        $args['reply_text']
                );
        }


        return apply_filters( 'pergo_comment_reply_link', $args['before'] . $link . $args['after'], $args, $comment, $post );
}