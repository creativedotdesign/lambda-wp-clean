<?php
namespace WP_Clean\DisableFeed;

// Disbale RSS feeds
function disable_feed() {
  global $wp_query;
  $wp_query->set_404();
  status_header(404);
  wp_die( __( 'No feed available, please visit the <a href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ) );
}

add_action( 'do_feed', __NAMESPACE__ . '\\disable_feed', 1 );
add_action( 'do_feed_rdf', __NAMESPACE__ . '\\disable_feed', 1 );
add_action( 'do_feed_rss', __NAMESPACE__ . '\\disable_feed', 1 );
add_action( 'do_feed_rss2', __NAMESPACE__ . '\\disable_feed', 1 );
add_action( 'do_feed_atom', __NAMESPACE__ . '\\disable_feed', 1 );
add_action( 'do_feed_rss2_comments', __NAMESPACE__ . '\\disable_feed', 1  );
add_action( 'do_feed_atom_comments', __NAMESPACE__ . '\\disable_feed', 1 );
