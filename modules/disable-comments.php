<?php

namespace WP_Clean\DisableComments

// Remove comments in admin menu
function action_remove_admin_menus() {
  remove_menu_page( 'edit-comments.php' );
  remove_submenu_page( 'options-general.php', 'options-discussion.php' );
}

add_action( 'admin_menu' , __NAMESPACE__ . '\\action_remove_admin_menus' );

// Remove comments column from pages
function custom_pages_columns( $defaults ) {
  unset( $defaults[ 'comments' ] );
  return $defaults;
}

add_filter( 'manage_pages_columns', __NAMESPACE__ . '\\custom_pages_columns' );

//Remove comments from admin bar
function admin_bar_render() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
}

add_action( 'wp_before_admin_bar_render', __NAMESPACE__ . '\\admin_bar_render' );
