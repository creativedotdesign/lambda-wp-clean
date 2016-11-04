<?php
/*
 * Disbale XML-RPC (Maybe)
 */
add_filter('xmlrpc_enabled', '__return_false');


/**
 * Remove x-pingback HTTP header
 */
add_filter('wp_headers', function($headers) {
  unset($headers['X-Pingback']);
  return $headers;
});


/**
 * Disable pingbacks
 */
add_filter('xmlrpc_methods', function($methods) {
  unset($methods['pingback.ping']);
  return $methods;
});
