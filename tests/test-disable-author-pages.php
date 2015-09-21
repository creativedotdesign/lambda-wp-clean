<?php

class DisableAuthorPages extends WP_UnitTestCase {

  function test_add_theme_support() {
    $this->assertTrue( current_theme_supports( 'WP_Clean-disable-author-pages' ) );
  }

  function test_action_author_template_redirect() {
    $this->assertNotFalse( has_action( 'template_redirect', 'WP_Clean\\DisableAuthorPages\action_author_template_redirect' ) );
  }

}
