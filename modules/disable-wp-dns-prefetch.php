<?php
/**
 * Remove <link rel='dns-prefetch' href='//s.w.org'> from head
 */
add_filter('wp_resource_hints', function($hints, $relation_type) {
  if ('dns-prefetch' === $relation_type) {
    return array_diff(wp_dependencies_unique_hosts(), $hints);
  }
  return $hints;
}, 10, 2);
