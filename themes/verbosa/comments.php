<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to verbosa_comment() which is
 * located in the includes/theme-comments.php file.
 *
 * @package Verbosa
 */
?>

<section id="comments"> 
<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'verbosa' ); ?></p>
		</section><!-- #comments --> <?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;

	if ( have_comments() ) : ?>
	
		<h3 id="comments-title">
			<span><?php  printf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'verbosa' ),
					number_format_i18n( get_comments_number() )); ?>
			</span>
		</h3>
		
		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'verbosa_comment' ) ); ?>
		</ol>
		
		<?php 
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation" id="nav-comments">
				<div class="nav-previous"><?php previous_comments_link( __('<i class="icon-arrow-left2"></i>' . __( 'Older comments', 'verbosa' ) ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer comments', 'verbosa' ) . '<i class="icon-arrow-right2"></i>'); ?></div>
			</div> <!-- .navigation --><?php 
		endif; // check for comment navigation 
	
	//else : // or, if we don't have comments:
	endif; // end have_comments() 
	
		if ( ! comments_open() ) : ?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'verbosa' ); ?></p>
		<?php endif; 
		
	//endif; // end have_comments() 
	
	if ( comments_open() ) comment_form();  ?>
</section><!-- #comments -->
