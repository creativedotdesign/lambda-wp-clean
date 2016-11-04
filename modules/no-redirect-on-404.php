<?php
/**
 * Return 404 on no url match. Prevents WP from fuzzy matches
 */
add_filter('redirect_canonical', function($redirect_url) {
  if (is_404()) {
    return false;
  }
  return $redirect_url;
});
