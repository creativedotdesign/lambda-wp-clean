<?php

class DisableComments extends WP_UnitTestCase {

  function test_add_theme_support() {
    $this->assertTrue( current_theme_supports( 'WP_Clean-disable-comments' ) );
  }

  function test_action_remove_admin_menus() {
    $this->assertNotFalse( has_action( 'admin_menu', 'WP_Clean\\DisableComments\action_remove_admin_menus' ) );
  }

  function test_custom_pages_columns() {
    $this->assertNotFalse( has_filter( 'manage_pages_columns', 'WP_Clean\\DisableComments\custom_pages_columns' ) );
  }

  function test_admin_bar_render() {
    $this->assertNotFalse( has_action( 'wp_before_admin_bar_render', 'WP_Clean\\DisableComments\admin_bar_render' ) );
  }

}
