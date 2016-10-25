<?php
/**
 * Plugin Name:     Custom Content Type
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          Ivan Berezhnov
 * Author URI:      YOUR SITE HERE
 * Text Domain:     cpt
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Cpt
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

spl_autoload_register( function ( $class ) {
    $segment = array_filter( explode( '\\', $class ) );

    if ( array_shift( $segment ) === "CPT" ) {
        $path = __DIR__ . '/' . implode( '/', $segment ) . '.class.php';

        if ( file_exists( $path ) ) {
            require_once $path;
        }
    }
} );

add_action( 'plugins_loaded', function () {
    $quotes = new CPT\ContentType(
        'quotes',
        [ 'supports' => array( 'title' ) ],
        [ 'plural_name' => 'Quotes' ]
    );
} );