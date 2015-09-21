<?php

class DisableSearch extends WP_UnitTestCase {

  function test_add_theme_support() {
    $this->assertTrue( current_theme_supports( 'WP_Clean-disable-search' ) );
  }

  function test_disable_search() {
    $this->assertNotFalse( has_action( 'parse_query', 'WP_Clean\\DisableSearch\disable_search' ) );
  }

  function test_get_search_form() {
    $this->assertNotFalse( has_filter( 'get_search_form' ) );
  }

}
