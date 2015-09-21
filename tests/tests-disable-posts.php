<?php

class DisablePosts extends WP_UnitTestCase {

  function test_add_theme_support() {
    $this->assertTrue( current_theme_supports( 'WP_Clean-disable-posts' ) );
  }

  function test_action_remove_menus() {
    $this->assertNotFalse( has_action( 'wp_before_admin_bar_render', 'WP_Clean\\DisablePosts\action_remove_menus' ) );
  }

}
