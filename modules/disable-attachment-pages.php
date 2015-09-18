<?php
namespace WP_Clean\DisableAttachmentPages;

// No attachement pages. Return user to parent post or 404 if orphan
function action_attachement_template_redirect () {
  global $wp_query, $post;
  if ( is_attachment() ) {
    $post_parent = $post->post_parent;
    if ( $post_parent ) {
        wp_redirect( get_permalink( $post->post_parent ), 301 );
        exit;
    }
    $wp_query->set_404();
    return;
  }
}

add_action( 'template_redirect', __NAMESPACE__ . '\\action_attachement_template_redirect' );
