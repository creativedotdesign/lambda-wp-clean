<?php
/**
 * Remove comments in admin menu
 */
add_action('admin_menu', function() {
  remove_menu_page('edit-comments.php');
  remove_submenu_page('options-general.php', 'options-discussion.php');
});


/*
 * Remove comments column from pages
 */
add_filter('manage_pages_columns', function($defaults) {
  unset($defaults['comments']);
  return $defaults;
});


/**
 * Removes comments from post and pages
 */
add_action('init', function() {
  remove_post_type_support('post', 'comments');
  remove_post_type_support('page', 'comments');
}, 100);


/*
 * Remove comments from admin bar
 */
add_action('wp_before_admin_bar_render', function() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
});
