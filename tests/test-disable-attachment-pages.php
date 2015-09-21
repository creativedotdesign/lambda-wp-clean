<?php

class DisableAttachmentPages extends WP_UnitTestCase {

  function test_add_theme_support() {
    $this->assertTrue( current_theme_supports( 'WP_Clean-disable-attachment-pages' ) );
  }

  function test_action_attachement_template_redirect() {
    $this->assertNotFalse( has_action( 'template_redirect', 'WP_Clean\\DisableAttachmentPages\action_attachement_template_redirect' ) );
  }

}
