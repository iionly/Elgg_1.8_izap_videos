<?php
/**
 * Post comment on videos river view
 */

elgg_load_js('lightbox');
elgg_load_css('lightbox');

$subject = $vars['item']->getSubjectEntity();
$object = $vars['item']->getObjectEntity();
$comment = $vars['item']->getAnnotation();

$subject_link = elgg_view('output/url', array(
	'href' => $subject->getURL(),
	'text' => $subject->name,
	'class' => 'elgg-river-subject',
	'is_trusted' => true,
));

$target_link = elgg_view('output/url', array(
	'href' => $object->getURL(),
	'text' => $object->title,
	'class' => 'elgg-river-target',
	'is_trusted' => true,
));

$attachments = '';
$size = izapAdminSettings_izap_videos('izap_river_thumbnails');
if($size != 'none') {
	$attachments = elgg_view_entity_icon($object, $size, array(
		'href' => 'ajax/view/izap_videos/playpopup?guid=' . $object->getGUID(),
		'title' => $object->title,
		'img_class' => 'screenshot',
		'link_class' => 'elgg-lightbox',
	));
}

echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'attachments' => $attachments,
	'summary' => elgg_echo('river:comment:object:izap_videos', array($subject_link, $target_link)),
	'message' => elgg_get_excerpt($comment->value),
));
