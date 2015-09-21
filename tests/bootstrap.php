<?php

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

require_once $_tests_dir . '/includes/functions.php';

function _manually_load_plugin() {
	require dirname( dirname( __FILE__ ) ) . '/wp-clean.php';

	//Loop through each module adding theme support.
	foreach (glob(dirname( dirname( __FILE__ ) ) . '/modules/*.php') as $file) {
    add_theme_support( 'WP_Clean-' . basename( $file, '.php' ) );
  }
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

require $_tests_dir . '/includes/bootstrap.php';
