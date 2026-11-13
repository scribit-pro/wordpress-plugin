<?php
/**
 * PHPUnit bootstrap file
 *
 * @package scribit
 */

require dirname( __DIR__ ) . '/vendor/autoload.php';

$_tests_dir = getenv( 'WP_PHPUNIT__DIR' );

if ( ! file_exists( getenv( 'WP_PHPUNIT__TESTS_CONFIG' ) ) ) {
    echo 'Could not find ' . getenv( 'WP_PHPUNIT__TESTS_CONFIG' ) . ', did you run composer run setup-tests ?';
    exit( 1 );
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin() {
    require dirname( dirname( __FILE__ ) ) . '/plugin.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
