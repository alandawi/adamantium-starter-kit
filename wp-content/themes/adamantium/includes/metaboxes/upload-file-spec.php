<?php

$wpalchemy_media_access = new WPAlchemy_MediaAccess();

$example_upload_metabox = new WPAlchemy_MetaBox(array
(
	'id' => '_example_upload_metabox',
	'title' => 'Example Upload Metabox',
	'types' => array('page'),
    'context' => 'side', // same as above, defaults to "normal"
    'priority' => 'default', // same as above, defaults to "high"
	'template' => get_stylesheet_directory() . '/includes/metaboxes/upload-file-meta.php',
));

/* eof */