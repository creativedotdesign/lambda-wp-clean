<?php
/*
 * Disable JSON API (v2.x only)
 */
add_action('init', function() {
  add_filter('json_enabled', '__return_false');
  add_filter('json_jsonp_enabled', '__return_false');

  add_filter('rest_enabled', '__return_false');
  add_filter('rest_jsonp_enabled', '__return_false');
});

/**
 * Remove JSON API from head
 */
add_action('init',  function() {
  remove_action('wp_head', 'rest_output_link_wp_head', 10);
  remove_action('template_redirect', 'rest_output_link_header', 11, 0);

  remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

  // Remove the REST API endpoint.
  remove_action('rest_api_init', 'wp_oembed_register_route');

  // Turn off oEmbed auto discovery.
  add_filter('embed_oembed_discover', '__return_false');

  // Don't filter oEmbed results.
  remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

  // Remove oEmbed discovery links.
  remove_action('wp_head', 'wp_oembed_add_discovery_links');

  // Remove oEmbed-specific JavaScript from the front-end and back-end.
  remove_action('wp_head', 'wp_oembed_add_host_js');

  // Remove all embeds rewrite rules.
  add_filter('rewrite_rules_array', 'disable_embeds_rewrites');
});
