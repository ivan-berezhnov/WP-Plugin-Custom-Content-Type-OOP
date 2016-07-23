<?php
/*
Plugin Name: ! SimilarWeb Corp
Plugin URI: https://similarweb.com/
Description: Text description.
Version: 1.0.0
Author: Ivan Berezhnov
Author Email: ivan.berezhnov@icloud.com
License: GPLv2 or later
Text Domain: SimilarWebCorp
*/
/**
 * @package SimilarWebCorp
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

spl_autoload_register( function ( $class ) {
	$segment = array_filter( explode( '\\', $class ) );

	if ( array_shift( $segment ) === "SW" ) {
		$path = __DIR__ . '/' . implode( '/', $segment ) . '.class.php';

		if ( file_exists( $path ) ) {
			require_once $path;
		}
	}
} );

add_action( 'plugins_loaded', function () {
	$quotes = new SW\SWExtend\ContentType(
		'quotes',
		[ 'supports' => array( 'title' ) ],
		[ 'plural_name' => 'Quotes' ]
	);
} );
