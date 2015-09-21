<?php

class DisableFeed extends WP_UnitTestCase {

  function test_add_theme_support() {
    $this->assertTrue( current_theme_supports( 'WP_Clean-disable-feed' ) );
  }

  function test_disable_feed() {
    $this->assertNotFalse( has_action( 'do_feed', 'WP_Clean\DisableFeed\\disable_feed' ) );
    $this->assertNotFalse( has_action( 'do_feed_rdf', 'WP_Clean\DisableFeed\\disable_feed' ) );
    $this->assertNotFalse( has_action( 'do_feed_rss', 'WP_Clean\DisableFeed\\disable_feed' ) );
    $this->assertNotFalse( has_action( 'do_feed_rss2', 'WP_Clean\DisableFeed\\disable_feed' ) );
    $this->assertNotFalse( has_action( 'do_feed_atom', 'WP_Clean\DisableFeed\\disable_feed' ) );
    $this->assertNotFalse( has_action( 'do_feed_rss2_comments', 'WP_Clean\DisableFeed\\disable_feed' ) );
    $this->assertNotFalse( has_action( 'do_feed_atom_comments', 'WP_Clean\DisableFeed\\disable_feed' ) );
  }

}
