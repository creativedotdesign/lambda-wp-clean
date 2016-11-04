<?php
/**
 * Disbale RSS feeds
 */
add_actions([
  'do_feed',
  'do_feed_rdf',
  'do_feed_rss',
  'do_feed_rss2',
  'do_feed_atom',
  'do_feed_rss2_comments',
  'do_feed_atom_comments'
], function() {
  global $wp_query;
  $wp_query->set_404();
  status_header(404);
  wp_die(__('No feed available. Please visit the <a href="' . esc_url(home_url('/')) . '">homepage</a>'));
}, 1);
