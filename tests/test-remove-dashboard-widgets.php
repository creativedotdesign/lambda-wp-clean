<?php

class RemoveDashboardWidgets extends WP_UnitTestCase {

  function test_add_theme_support() {
    $this->assertTrue( current_theme_supports( 'WP_Clean-remove-dashboard-widgets' ) );
  }

  function test_remove_dashboard_widgets() {
    $this->assertNotFalse( has_filter( 'admin_init', 'WP_Clean\\RemoveDashboardWidgets\remove_dashboard_widgets' ) );
  }

}
