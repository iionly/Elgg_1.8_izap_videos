<?php

/**
 * Most commented videos this year
 *
 */

// set up breadcrumbs
elgg_push_breadcrumb(elgg_echo('videos'), 'videos/all');
elgg_push_breadcrumb(elgg_echo('izap_videos:mostcommentedthisyear'));

$offset = (int)get_input('offset', 0);
$limit = (int)get_input('limit', 10);

$start = mktime(0, 0, 0, 1, 1, date("Y"));
$end = time();

$options = array(
	'type' => 'object',
	'subtype' => 'izap_videos',
	'limit' => $limit,
	'offset' => $offset,
	'annotation_name' => 'generic_comment',
	'calculation' => 'count',
	'annotation_created_time_lower' => $start,
	'annotation_created_time_upper' => $end,
	'order_by' => 'annotation_calculation desc',
	'full_view' => false,
);

$result = elgg_list_entities_from_annotation_calculation($options);

$title = elgg_echo('izap_videos:mostcommentedthisyear');

elgg_register_title_button('videos');

if (!empty($result)) {
	$area2 = $result;
} else {
	$area2 = elgg_echo('izap_videos:mostcommentedthisyear:nosuccess');
}
$body = elgg_view_layout('content', array(
	'filter_override' => '',
	'content' => $area2,
	'title' => $title,
	'sidebar' => elgg_view('izap_videos/sidebar', array('page' => 'all')),
));

// Draw it
echo elgg_view_page(elgg_echo('izap_videos:mostcommentedthisyear'), $body);
