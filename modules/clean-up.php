<?php
namespace WP_Clean\CleanUp

add_filter( 'show_admin_bar', '__return_false' ); //Remove admin bar
add_filter( 'admin_footer_text' , '__return_false' ); //Remove admin footer text

//Remove the extra meta from your HTML head tag
function action_remove_wp_head_extras() {
  remove_action( 'wp_head', 'feed_links_extra', 3 ); // Remove the links to the extra feeds such as category feeds
  remove_action( 'wp_head', 'feed_links', 2 ); // Remove the links to the general feeds: Post and Comment Feed
  remove_action( 'wp_head', 'rsd_link' ); // Remove the link to the Really Simple Discovery service endpoint, EditURI link
  remove_action( 'wp_head', 'wlwmanifest_link' ); // Remove the link to the Windows Live Writer manifest file.
  remove_action( 'wp_head', 'index_rel_link' ); // Remove Index link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Remove Prev link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Remove Start link
  remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Remove relational links for the posts adjacent to the current post.
  remove_action( 'wp_head', 'wp_generator' ); // Remove the XHTML generator that is generated on the wp_head hook, WP version
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
  remove_action( 'wp_head', 'rel_canonical' );
  remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
}

add_action( 'init', __NAMESPACE__ . '\\action_remove_wp_head_extras' );

// Remove 'text/css' and 'text/javascript' from enqueued stylesheets and scripts
function filter_type_remove( $input ) {
  $input = preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $input );
  return str_replace( "'", '"', $input );
}

add_filter( 'style_loader_tag', __NAMESPACE__ . '\\filter_type_remove' );
add_filter( 'script_loader_tag', __NAMESPACE__ . '\\filter_type_remove' );

// Remove unnecessary self-closing tags
function remove_self_closing_tags($input) {
  return str_replace(' />', '>', $input);
}

add_filter( 'style_loader_tag', __NAMESPACE__ . '\\remove_self_closing_tags' );

// Remove style and script versions from source code URL's
function filter_remove_version_script_style( $target_url ) {
  if ( strpos( $target_url, 'ver=' ) ) { // check if "ver=" argument exists in the url or not
     $target_url = remove_query_arg( 'ver', $target_url );
  }
  return $target_url;
}

add_filter( 'style_loader_src', __NAMESPACE__ . '\\filter_remove_version_script_style', 20000 );
add_filter( 'script_loader_src', __NAMESPACE__ . '\\filter_remove_version_script_style', 20000 );

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function filter_remove_thumbnail_dimensions( $html ) {
  $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
  return $html;
}

add_filter( 'post_thumbnail_html', __NAMESPACE__ . '\\filter_remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', __NAMESPACE__ . '\\filter_remove_thumbnail_dimensions', 10 );

//Remove WP logo from admin bar
function admin_bar_render() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_node('wp-logo');
}

add_action( 'wp_before_admin_bar_render', __NAMESPACE__ . '\\admin_bar_render' );

// Add and remove body_class() classes
function body_class($classes) {
  // Add post/page slug if not present
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }
  // Remove unnecessary classes
  $home_id_class = 'page-id-' . get_option('page_on_front');
  $remove_classes = [
    'page-template-default',
    $home_id_class
  ];
  $classes = array_diff($classes, $remove_classes);
  return $classes;
}

add_filter( 'body_class', __NAMESPACE__ . '\\body_class' );
