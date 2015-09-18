<?php
namespace WP_Clean\CleanUp

add_filter( 'xmlrpc_enabled', '__return_false' );

// Remove x-pingback HTTP header
function filter_remove_header_pingback ( $headers ) {
  unset( $headers[ 'X-Pingback' ] );
  return $headers;
}

add_filter( 'wp_headers', __NAMESPACE__ . '\\filter_remove_header_pingback' );

// disable pingbacks
function filter_disable_pingback ( $methods ) {
  unset( $methods['pingback.ping'] );
  return $methods;
}

add_filter( 'xmlrpc_methods', __NAMESPACE__ . '\\filter_disable_pingback' );
