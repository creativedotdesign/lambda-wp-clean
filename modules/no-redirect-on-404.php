<?php
namespace WP_Clean\NoRedirect;

// Return 404 on no url match. Prevents WP from fuzzy matches
function filter_no_redirect_on_404( $redirect_url ) {
  if ( is_404() ) {
    return false;
  }
  return $redirect_url;
}

add_filter( 'redirect_canonical', __NAMESPACE__ . '\\filter_no_redirect_on_404' );
