<?php

function eval_register_post_types() {
	$post_types = array(
		'gutter'      => array(
			'singular'        => 'Gutter',
			'plural'          => 'Gutters',
			'public'          => true,
			'has_archive'     => true,
			'capability_type' => 'page',
			'menu_icon'       => 'dashicons-admin-site',
			'supports'        => array( 'title', 'editor', 'excerpt' ),
			'taxonomies'      => array( 'gutter_type' ),
			'labels'          => array(
				'name'          => 'Gutters',
				'singular_name' => 'Gutter',
				'add_new'       => 'Add New Gutter',
				'add_new_item'  => 'Add New Gutter',
				'edit_item'     => 'Edit Gutter',
				'new_item'      => 'New Gutter',
				'view_item'     => 'View Gutter',
			),
		),
		'testimonial' => array(
			'singular'          => 'Testimonial',
			'plural'            => 'Testimonials',
			'public'            => true,
			'publicy_queryable' => false,
			'has_archive'       => false,
			'menu_icon'         => 'dashicons-format-quote',
			'supports'          => array( 'title', 'excerpt' ),
			'taxonomies'        => array( 'gutter_type' ),
			'labels'            => array(
				'name'          => 'Testimonials',
				'singular_name' => 'Testimonial',
				'add_new'       => 'Add New Testimonial',
				'add_new_item'  => 'Add New Testimonial',
				'edit_item'     => 'Edit Testimonial',
				'new_item'      => 'New Testimonial',
			),
		),

	);

	foreach ( $post_types as $post_type => $args ) {

		$post_type_defaults = array(
			'public'          => true,
			'show_in_rest'    => true,
			'capability_type' => 'post',
			'has_archive'     => false,
			'hierarchical'    => false,
			'supports'        => array( 'title', 'editor', 'thumbnail' ),
		);

		$args = wp_parse_args( $args, $post_type_defaults );

		register_post_type( $post_type, $args );
	}
}

add_action( 'init', 'eval_register_post_types' );
