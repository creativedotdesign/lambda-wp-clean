<?php
namespace WP_Clean\DisableAuthorPages

// No author pages. Send to 404
function action_author_template_redirect() {
  if ( is_author() ) {
    $wp_query->set_404();
  }
}

add_action( 'template_redirect', __NAMESPACE__ . '\\action_author_template_redirect' );
