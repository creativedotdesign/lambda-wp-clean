<?php
/**
 * Disable search, no more ?s=something
 */
add_action('parse_query', function($query, $error = true) {
  if (is_search()) {
    $query->is_search     = false;
    $query->query_vars[s] = false;
    $query->query[s]      = false;
    if ($error == true) {
      $query->is_404 = true;
    }
  }
});

add_filter('get_search_form', '__return_false');
