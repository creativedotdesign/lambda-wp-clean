<?php

class CleanUp extends WP_UnitTestCase {

  function test_theme_support() {
    $this->assertTrue( current_theme_supports( 'WP_Clean-clean-up' ) );
  }

  function test_admin_bar() {
    $this->assertTrue( has_filter( 'show_admin_bar' ) );
  }

  function test_admin_footer_text() {
    $this->assertTrue( has_filter( 'admin_footer_text' ) );
  }

  function test_action_remove_wp_head_extras() {
    $this->assertNotFalse( has_action( 'init', 'WP_Clean\CleanUp\\action_remove_wp_head_extras' ) );
  }

  function test_feed_links_extra() {
    $this->assertFalse( has_action( 'wp_head', 'feed_links_extra' ) );
  }

  function test_feed_links() {
    $this->assertFalse( has_action( 'wp_head', 'feed_links' ) );
  }

  function test_rsd_link() {
    $this->assertFalse( has_action( 'wp_head', 'rsd_link' ) );
  }

  function test_wlwmanifest_link() {
    $this->assertFalse( has_action( 'wp_head', 'wlwmanifest_link' ) );
  }

  function test_index_rel_link() {
    $this->assertFalse( has_action( 'wp_head', 'index_rel_link' ) );
  }

  function test_parent_post_rel_link() {
    $this->assertFalse( has_action( 'wp_head', 'parent_post_rel_link' ) );
  }

  function test_start_post_rel_link() {
    $this->assertFalse( has_action( 'wp_head', 'start_post_rel_link' ) );
  }

  function test_adjacent_posts_rel_link() {
    $this->assertFalse( has_action( 'wp_head', 'adjacent_posts_rel_link' ) );
  }

  function test_wp_generator() {
    $this->assertFalse( has_action( 'wp_head', 'wp_generator' ) );
  }

  function test_adjacent_posts_rel_link_wp_head() {
    $this->assertFalse( has_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' ) );
  }

  function test_rel_canonical() {
    $this->assertFalse( has_action( 'wp_head', 'rel_canonical' ) );
  }

  function test_wp_shortlink_wp_head() {
    $this->assertFalse( has_action( 'wp_head', 'wp_shortlink_wp_head' ) );
  }

  function test_filter_type_remove() {
    $this->assertNotFalse( has_filter( 'style_loader_tag', 'WP_Clean\CleanUp\\filter_type_remove' ) );
    $this->assertNotFalse( has_filter( 'script_loader_tag', 'WP_Clean\CleanUp\\filter_type_remove' ) );
  }

  function test_remove_self_closing_tags() {
    $this->assertNotFalse( has_filter( 'style_loader_tag', 'WP_Clean\CleanUp\\remove_self_closing_tags' ) );
  }

  function test_filter_remove_version_script_style() {
    $this->assertNotFalse( has_filter( 'style_loader_src', 'WP_Clean\CleanUp\\filter_remove_version_script_style' ) );
    $this->assertNotFalse( has_filter( 'script_loader_src', 'WP_Clean\CleanUp\\filter_remove_version_script_style' ) );
  }

  function test_filter_remove_thumbnail_dimensions() {
    $this->assertNotFalse( has_filter( 'post_thumbnail_html', 'WP_Clean\CleanUp\\filter_remove_thumbnail_dimensions' ) );
    $this->assertNotFalse( has_filter( 'image_send_to_editor', 'WP_Clean\CleanUp\\filter_remove_thumbnail_dimensions' ) );
  }

  function test_admin_bar_render() {
    $this->assertNotFalse( has_filter( 'wp_before_admin_bar_render', 'WP_Clean\CleanUp\\admin_bar_render' ) );
  }

  function test_body_class() {
    $this->assertNotFalse( has_filter( 'body_class', 'WP_Clean\CleanUp\\body_class' ) );
  }

}
