<?php

namespace CPT;

/**
 * Class ContentType
 * @package CPT\ContentType
 */
class ContentType {
	private $type;
	private $labels = array();
	private $post_options = array();
	private $default_options = array(
		'public'             => TRUE,
		'publicly_queryable' => TRUE,
		'show_ui'            => TRUE,
		'show_in_menu'       => TRUE,
		'query_var'          => TRUE,
		'has_archive'        => TRUE,
		'delete_with_user'   => TRUE,
		'hierarchical'       => FALSE,
		'menu_position'      => 21,
		'menu_icon'          => 'dashicons-welcome-widgets-menus',
		'taxonomies'         => array( 'category', 'tags' ),
		'supports'           => array(
			'title',
			'editor',
			'revisions',
			'thumbnail'
		)
	);

	/**
	 * cptPostType constructor.
	 *
	 * @param string $type
	 * @param array $options
	 * @param array $labels
	 */
	public function __construct( $type, $options = array(), $labels = array() ) {
		$this->type                   = $type;
		$this->post_options           = wp_parse_args( $options + $this->default_options );
		$this->labels                 = wp_parse_args( $labels + $this->required_labels() );
		$this->post_options['labels'] = wp_parse_args( $this->labels + $this->default_labels() );

		add_action( 'init', array( $this, 'cpt_register' ) );
	}

	/**
	 * Register post type.
	 */
	public function cpt_register() {
		register_post_type( $this->type, $this->post_options );
	}

	/**
	 * @return array
	 */
	private function required_labels() {
		return array(
			'singular_name' => ucwords( $this->type ),
			'plural_name'   => ucwords( $this->type )
		);
	}

	/**
	 * Default labels.
	 * @return array
	 */
	private function default_labels() {
		return array(
			'name'               => $this->labels['plural_name'],
			'singular_name'      => $this->labels['singular_name'],
			'add_new'            => 'Add New ' . $this->labels['singular_name'],
			'add_new_item'       => 'Add New ' . $this->labels['singular_name'],
			'edit'               => 'Edit ',
			'edit_item'          => 'Edit ' . $this->labels['singular_name'],
			'new_item'           => 'New ' . $this->labels['singular_name'],
			'view'               => 'View ' . $this->labels['singular_name'] . ' Page',
			'view_item'          => 'View ' . $this->labels['singular_name'],
			'search_items'       => 'Search ' . $this->labels['plural_name'],
			'not_found'          => 'No matching ' . $this->labels['plural_name'] . ' found',
			'not_found_in_trash' => 'No ' . $this->labels['plural_name'] . ' found in Trash',
			'parent_item_colon'  => 'Parent ' . $this->labels['singular_name']
		);
	}
}
