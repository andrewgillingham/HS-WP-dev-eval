<?php

function eval_register_custom_taxonomies() {
	$custom_taxonomies = array(
		'gutter_type' => array(
			'singular'     => 'Gutter Type',
			'plural'       => 'Gutter Types',
			'post_types'   => array( 'gutter' ),
			'hierarchical' => false,
			'labels'       => array(
				'name'          => 'Gutter Types',
				'singular_name' => 'Gutter Type',
				'add_new'       => 'Add New Gutter Type',
				'add_new_item'  => 'Add New Gutter Type',
				'edit_item'     => 'Edit Gutter Type',
				'new_item'      => 'New Gutter Type',
				'view_item'     => 'View Gutter Type',
			),
		),
	);

	foreach ( $custom_taxonomies as $taxonomy => $args ) {

		$taxonomy_defaults = array(
			'hierarchical' => true,
			'public'       => true,
            'show_in_rest' => true,
			'labels'       => array(),
		);

		$args = wp_parse_args( $args, $taxonomy_defaults );

		register_taxonomy( $taxonomy, $args['post_types'], $args );

	}
}

add_action( 'init', 'eval_register_custom_taxonomies' );
