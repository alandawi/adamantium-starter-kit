<?php
/**
 * @package WordPress
 * @subpackage Adamantium - Starter Kit
 * @author Alan Gabriel Dawidowicz - www.alandawi.com.ar
 */
?>
<?php
// Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

  if ( post_password_required() ) { ?>
  	<p>This post is password protected. Enter the password to view comments.</p>
  <?php
    return;
  }
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>

	<!--#content-->
  
	<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>

    	<!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed ?>
	
	<!-- If comments are closed. -->
	<!--p class="nocomments">Comments are closed.</p-->

	<?php endif; ?>

<?php endif; ?>


<?php if ( comments_open() ) : ?>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>

		<!--#content-->

	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

	<?php if ( is_user_logged_in() ) : ?>

		<!-- User Loggedin-->

	<?php else : ?>

		<!-- Form Design (name, email, website) -->

	<?php endif; ?>

		<!-- Form Design (comment and submit) -->
		<?php do_action('comment_form', $post->ID); ?>
	
	</form>
	
	<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
