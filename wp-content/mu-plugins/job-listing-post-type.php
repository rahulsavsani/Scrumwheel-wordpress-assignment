<?php 

function job_opening_post_types(){
	register_post_type('job_opening', array(
		'rewrite' => array('slug' => 'job_openings'),
		'has_archive' => true,
		'supports' => array('title', 'editor', 'thumbnail'),
		'public' => true,
		'labels' => array(
			'name' => 'Jobs',
			'add_new_item' => 'Add New Job',
			'edit_item' => 'Edit listing',
			'all_items' => 'All listings',
			'singular_name' => 'Job Opening'
		),
		
	));

	$args = array(
		'hierarchical' => true,
		'labels' => array(
			'name' => 'Categories',
			'add_new_item' => 'Add New Job Category',
			'edit_item' => 'Edit Job Category',
			'all_items' => 'All Job Categories',
			'singular_name' => 'Category',
			'add_or_remove_items' => 'Add or remove Job Category'
		),
		'show_admin_column' => true,
		'query_var' => true,

	);

	register_taxonomy('job-category', 'job_opening',$args);

}

add_action('init', 'job_opening_post_types');
?>