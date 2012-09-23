<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">

	<?php $mb->the_field('example_id'); ?>
	<?php $wpalchemy_media_access->setGroupName('nn')->setInsertButtonLabel('Insert'); ?>

	<label>Upload Metabox</label>
	<p style="margin-bottom: 15px;">
		<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
		<?php echo $wpalchemy_media_access->getButton(); ?>
	</p>

</div>