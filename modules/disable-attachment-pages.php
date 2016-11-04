<?php
/*
 * No attachement pages. Return user to parent post or 404 if orphan
 */
add_action('template_redirect', function() {
  global $wp_query, $post;
  if (is_attachment()) {
    $post_parent = $post->post_parent;
    if ($post_parent) {
      wp_redirect(get_permalink($post->post_parent), 301);
      exit;
    }
    $wp_query->set_404();
    return;
  }
});
