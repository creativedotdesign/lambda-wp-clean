<?php

class SampleTest extends WP_UnitTestCase {

  function test_add_theme_support() {

    global $_wp_theme_features;

    $this->assertContains('WP_Clean-disable-feed', $_wp_theme_features);
    $this->assertNotFalse( has_action( 'do_feed_rss2_comments', 'WP_Clean\DisableFeed\\disable_feed' ) );


    $this->assertContains('WP_Clean-disable-posts', $_wp_theme_features);
    $this->assertNotFalse( has_action( 'wp_before_admin_bar_render', 'WP_Clean\DisablePosts\\action_remove_menus' ) );


    //    $this->assertEquals( 10, has_action( 'do_feed_rss2_comments', 'WP_Clean\DisableFeed\\disable_feed' ) );


  }

  function test_clean_up() {

    global $_wp_theme_features;

    $this->assertContains('WP_Clean-clean-up', $_wp_theme_features);

    $this->assertTrue( has_filter( 'show_admin_bar' ) );
    $this->assertTrue( has_filter( 'admin_footer_text' ) );


    $this->assertNotFalse( has_action( 'init', 'WP_Clean\CleanUp\\action_remove_wp_head_extras' ) );


    $this->assertFalse( has_action( 'wp_head', 'feed_links_extra' ) );
    $this->assertFalse( has_action( 'wp_head', 'feed_links' ) );

  }

}
