<?php

class DisableEmojIcons extends WP_UnitTestCase {

  function test_add_theme_support() {
    $this->assertTrue( current_theme_supports( 'WP_Clean-disable-emojicons' ) );
  }

  function test_action_disable_wp_emojicons() {
    $this->assertNotFalse( has_action( 'init', 'WP_Clean\\DisableEmojIcons\action_disable_wp_emojicons' ) );
    $this->assertFalse( has_action( 'wp_head', 'print_emoji_detection_script' ) );
    $this->assertFalse( has_action( 'admin_print_scripts', 'print_emoji_detection_script' ) );
    $this->assertFalse( has_action( 'admin_print_styles', 'print_emoji_styles' ) );
    $this->assertFalse( has_action( 'wp_print_styles', 'print_emoji_styles' ) );
    $this->assertFalse( has_action( 'wp_mail', 'wp_staticize_emoji_for_email' ) );
    $this->assertFalse( has_action( 'the_content_feed', 'wp_staticize_emoji' ) );
    $this->assertFalse( has_action( 'comment_text_rss', 'wp_staticize_emoji' ) );
  }

  function test_filter_disable_emojicons_tinymce() {
    $this->assertNotFalse( has_filter( 'tiny_mce_plugins', 'WP_Clean\\DisableEmojIcons\filter_disable_emojicons_tinymce' ) );
  }

}
