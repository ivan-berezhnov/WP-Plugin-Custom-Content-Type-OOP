<?php

namespace SW\SWExtend;

/**
 * Class SWContentType
 * @package SW\CustomContentType
 */
class ContentType {
	public $type;
	public $options = array();
	public $labels = array();

	/**
	 * SWContentType constructor.
	 *
	 * @param string $type
	 * @param array $options
	 * @param array $labels
	 */
	public function __construct( $type, $options = array(), $labels = array() ) {
		$this->type = $type;

		$default_options = array(
			'public'   => TRUE,
			'supports' => array( 'title', 'editor', 'revisions', 'thumbnail' )
		);

		$required_labels = array(
			'singular_name' => ucwords( $this->type ),
			'plural_name'   => ucwords( $this->type )
		);

		$this->options = $options + $default_options;
		$this->labels  = $labels + $required_labels;

		$this->options['labels'] = $this->labels + $this->default_labels();

		add_action( 'init', array( $this, 'sw_register' ) );
	}

	/**
	 *
	 */
	public function sw_register() {
		register_post_type( $this->type, $this->options );
	}

	/**
	 * @return array
	 */
	public function default_labels() {
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
