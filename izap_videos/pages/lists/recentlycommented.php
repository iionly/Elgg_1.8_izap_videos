<?php

/**
  * Videos recently commented on - world view only
 *
 */

// set up breadcrumbs
elgg_push_breadcrumb(elgg_echo('videos'), 'videos/all');
elgg_push_breadcrumb(elgg_echo('izap_videos:recentlycommented'));

$offset = (int)get_input('offset', 0);
$limit = (int)get_input('limit', 10);

$options = array(
	'type' => 'object',
	'subtype' => 'izap_videos',
	'limit' => $limit,
	'offset' => $offset,
	'annotation_name' => 'generic_comment',
	'order_by_annotation' => "n_table.time_created desc",
	'full_view' => false,
);

$result = elgg_list_entities_from_annotations($options);

$title = elgg_echo('izap_videos:recentlycommented');

elgg_register_title_button('videos');

if (!empty($result)) {
	$area2 = $result;
} else {
	$area2 = elgg_echo('izap_videos:recentlycommented:nosuccess');
}
$body = elgg_view_layout('content', array(
	'filter_override' => '',
	'content' => $area2,
	'title' => $title,
	'sidebar' => elgg_view('izap_videos/sidebar', array('page' => 'all')),
));

// Draw it
echo elgg_view_page(elgg_echo('izap_videos:recentlycommented'), $body);
