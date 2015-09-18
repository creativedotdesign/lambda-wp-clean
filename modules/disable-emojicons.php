<?php
namespace WP_Clean\DisableEmojIcons

// remove all actions related to emojis
function action_disable_wp_emojicons() {
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
}

add_action( 'init', __NAMESPACE__ . '\\action_disable_wp_emojicons' );

// fRemove TinyMCE emojis
function filter_disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

add_filter( 'tiny_mce_plugins', __NAMESPACE__ . '\\filter_disable_emojicons_tinymce' );
