<?php
class ThumbnailUploadMetabox {
	var $media_upload_type = 'thumbnail';
	var $meta_key = '_thumbnail_id';
	var $post_type;
	
	function iframe($postId, $uploadError) {
		$img = null;
		if ($attachmentId = get_post_meta($postId, $this->meta_key, true)) {
			list($img) = wp_get_attachment_image_src($attachmentId, 'full');
		}
		$url = admin_url('media-upload.php?type='.$this->media_upload_type.'&post_id='.$postId);
?>
		<style>html,body{ height: auto; background: transparent !important }</style>
		<form style="margin:0" enctype="multipart/form-data" method="post" action="<?php echo esc_attr($url) ?>"
			onsubmit="jQuery('#img').css('visibility', 'hidden')">
			<input type="hidden" name="html-upload" value="" />
			<?php if ($img): ?>
				<div style="background: url(<?php echo admin_url('images/loading.gif') ?>) no-repeat center center">
					<img id="img" style="width:100%;display:block;margin:auto" src="<?php echo esc_attr($img) ?>" />
				</div>
			<?php endif ?>
			<?php if ($uploadError): ?>
				<div><?php echo $uploadError->get_error_message() ?></div>
			<?php endif ?>
			<div>
				<label class="screen-reader-text" for="async-upload"><?php call_user_func('_e', 'Upload') ?></label>
				<input style="width:95%" type="file" name="async-upload" id="async-upload" onchange="this.form.submit()" />
				<div class="clear"></div>
			</div>
		</form>
		<form method="post" action="<?php echo esc_attr($url) ?>" onsubmit="jQuery('#img').css('visibility', 'hidden')">
			<input type="submit" class="button" name="delete" value="<?php call_user_func('esc_attr_e', 'Delete') ?>" />
			<div class="clear"></div>
		</form>
<?php
	}
	
	function media_upload() {
		$postId = $_GET['post_id'];
		$uploadError = null;
		if (isset($_POST['html-upload']) && !empty($_FILES)) {
			if (is_wp_error($attachmentId = media_handle_upload('async-upload', $postId))) {
				$uploadError = $attachmentId;
			} else {
				if ($oldAttachmentId = get_post_meta($postId, $this->meta_key, true)) {
					wp_delete_attachment($oldAttachmentId);
				}
				update_post_meta($postId, $this->meta_key, $attachmentId);
			}
		} elseif (isset($_POST['delete'])) {
			if ($attachmentId = get_post_meta($postId, $this->meta_key, true)) {
				wp_delete_attachment($attachmentId);
			}
			delete_post_meta($postId, $this->meta_key);
		}
		return wp_iframe(array($this, 'iframe'), $postId, $uploadError);
	}
	
	function metabox() {
		global $post;
?>
		<iframe src="<?php echo esc_attr(admin_url('media-upload.php?type='.$this->media_upload_type.'&post_id='.$post->ID)) ?>"
			frameborder="0" width="100%" height="0" allowtransparency="true" scrolling="no"
			onload="jQuery(this).height(jQuery('body', this.contentWindow.document).height())"></iframe>
<?php
	}
	
	function add_meta_boxes() {
		add_meta_box('thumbnail-upload-metabox', call_user_func('__', 'Featured Image'), array($this, 'metabox'), $this->post_type, 'side', 'low');
		remove_meta_box('postimagediv', $this->post_type, 'side');
	}
	
	function init() {
		if (!is_admin()) return;
		if (isset($_GET['post'])) {
			$this->post_type = get_post_type($_GET['post']);
		} elseif (isset($_GET['post'])) {
			$this->post_type = $_GET['post_type'];
		} else {
			$this->post_type = 'post';
		}
		if (!current_theme_supports('post-thumbnails', $this->post_type) || !post_type_supports($this->post_type, 'thumbnail')) return;
		add_action('media_upload_'.$this->media_upload_type, array($this, 'media_upload'));
		add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
	}
	
	function __construct() {
		add_action('init', array($this, 'init'));
	}
}

new ThumbnailUploadMetabox;
