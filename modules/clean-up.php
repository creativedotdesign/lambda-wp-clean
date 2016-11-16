<?php
/*
 * Remove admin bar
 */
add_filter('show_admin_bar', '__return_false');


/**
 * Remove admin footer text
 */
add_filter('admin_footer_text', '__return_false');


/**
 * Remove the extra meta from your HTML head tag
 */
add_action('init', function() {
  remove_action('wp_head', 'feed_links_extra', 3); // Remove the links to the extra feeds such as category feeds
  remove_action('wp_head', 'feed_links', 2); // Remove the links to the general feeds: Post and Comment Feed
  remove_action('wp_head', 'rsd_link'); // Remove the link to the Really Simple Discovery service endpoint, EditURI link
  remove_action('wp_head', 'wlwmanifest_link'); // Remove the link to the Windows Live Writer manifest file.
  remove_action('wp_head', 'index_rel_link'); // Remove Index link
  remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Remove Prev link
  remove_action('wp_head', 'start_post_rel_link', 10, 0); // Remove Start link
  remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Remove relational links for the posts adjacent to the current post.
  remove_action('wp_head', 'wp_generator'); // Remove the XHTML generator that is generated on the wp_head hook, WP version
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  remove_action('wp_head', 'rel_canonical');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
});


/**
 * Remove 'text/css' and 'text/javascript' from enqueued stylesheets and scripts
 */
add_filters(['style_loader_tag', 'script_loader_tag'], function($input) {
  $input = preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $input );
  return str_replace( "'", '"', $input);
});


/**
 * Remove unnecessary self-closing tags
 */
add_filters(['style_loader_tag', 'script_loader_tag'], function ($input) {
  return str_replace(' />', '>', $input);
});


/**
 *  Remove style and script versions from urls
 */
add_filters(['style_loader_src', 'script_loader_src'], function($src) {
  return $src ? esc_url(remove_query_arg('ver', $src)) : false;
}, 15, 1);


/*
 * Remove thumbnail width and height dimensions
 */
add_filters(['post_thumbnail_html', 'image_send_to_editor'], function($html) {
  $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
  return $html;
}, 10);


/**
 * Remove WP logo from admin bar
 */
add_action('wp_before_admin_bar_render', function() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_node('wp-logo');
});


/**
 * Add and remove body_class() classes
 */
add_filter('body_class', function($classes) {
  // Add post/page slug if not present
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Remove unnecessary classes
  $home_id_class  = 'page-id-' . get_option('page_on_front');
  $remove_classes = array('page-template-default', $home_id_class);
  $classes        = array_diff($classes, $remove_classes);
  return $classes;
});
