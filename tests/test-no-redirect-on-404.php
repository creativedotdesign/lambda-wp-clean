<?php

class NoRedirect extends WP_UnitTestCase {

  function test_add_theme_support() {
    $this->assertTrue( current_theme_supports( 'WP_Clean-no-redirect-on-404' ) );
  }

  function test_filter_no_redirect_on_404() {
    $this->assertNotFalse( has_filter( 'redirect_canonical', 'WP_Clean\\NoRedirect\filter_no_redirect_on_404' ) );
  }

}
