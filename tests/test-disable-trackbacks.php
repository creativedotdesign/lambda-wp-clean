<?php

class DisableTrackbacks extends WP_UnitTestCase {

  function test_add_theme_support() {
    $this->assertTrue( current_theme_supports( 'WP_Clean-disable-trackbacks' ) );
  }

  function test_filter_remove_header_pingback() {
    $this->assertNotFalse( has_filter( 'wp_headers', 'WP_Clean\\DisableTrackbacks\filter_remove_header_pingback' ) );
  }

  function test_filter_disable_pingback() {
    $this->assertNotFalse( has_filter( 'xmlrpc_methods', 'WP_Clean\\DisableTrackbacks\filter_disable_pingback' ) );
  }

}
