<?php
/**
 * Remove posts in admin menu
 */
add_action('admin_menu', function() {
  remove_menu_page('edit.php');
});


/*
 * Remove New Post from admin bar
 */
add_action('admin_bar_menu', function() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_node('new-post');
}, 999);


/**
 * Check requests for post_tpe and redirect to dashboard
 */
add_action('init', function() {
  global $pagenow, $wp;
  switch($pagenow) {
    case 'edit.php':
    case 'edit-tags.php':
    case 'post-new.php':
      if (!array_key_exists('post_type', $_GET) && !array_key_exists('taxonomy', $_GET) && !$_POST) {
        wp_safe_redirect(get_admin_url(), 301);
        exit;
      }
    break;
  }
});


/**
 * Remove Posts from search
 */
add_filter('pre_get_posts', function($query) {
  if (!is_search() || !$query->is_main_query()) {
    return $query;
  }

  $post_types = get_post_types(['exclude_from_search' => false]);

  if (array_key_exists('post', $post_types)) {
    // exclude post_type `post` from the query results */
    unset($post_types['post']);
  }

  $query->set('post_type', array_values($post_types));

  return $query;
});


/*
 * Checks the SQL statement to see if we are trying to fetch post_type `post`
 */
add_action('posts_results', function($posts = []) {
  global $wp_query;
  $look_for = "wp_posts.post_type = 'post'";
  $instance = strpos($wp_query->request, $look_for);

  if ($instance !== false) {
    $posts = []; // we are querying for post type `post`
  }

  return $posts;
});
