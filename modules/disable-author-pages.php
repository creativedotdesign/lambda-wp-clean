<?php
/**
 * No author pages. Send to 404
 */
add_action('template_redirect', function() {
  global $wp_query;
  if (is_author()) {
    $wp_query->set_404();
  }
});
