<?php

/**
 * Most viewed videos
 *
 */

// set up breadcrumbs
elgg_push_breadcrumb(elgg_echo('videos'), 'videos/all');
elgg_push_breadcrumb(elgg_echo('izap_videos:mostviewed'));

$offset = (int)get_input('offset', 0);
$limit = (int)get_input('limit', 10);

$options = array(
	'type' => 'object',
	'subtype' => 'izap_videos',
	'limit' => $limit,
	'offset' => $offset,
	'order_by_metadata' =>  array('name' => 'views', 'direction' => DESC, 'as' => integer),
	'full_view' => false,
);
$options['metadata_name_value_pairs'] = array(array('name' => 'views', 'value' => 0,  'operand' => '>'));
$result = elgg_list_entities_from_metadata($options);

$title = elgg_echo('izap_videos:mostviewed');

elgg_register_title_button('videos');

if (!empty($result)) {
	$area2 = $result;
} else {
	$area2 = elgg_echo('izap_videos:mostviewed:nosuccess');
}
$body = elgg_view_layout('content', array(
	'filter_override' => '',
	'content' => $area2,
	'title' => $title,
	'sidebar' => elgg_view('izap_videos/sidebar', array('page' => 'all')),
));

// Draw it
echo elgg_view_page(elgg_echo('izap_videos:mostviewed'), $body);
