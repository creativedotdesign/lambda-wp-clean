<?php
namespace WP_Clean\DisablePosts

// Remove posts in admin menu
function action_remove_menus() {
  remove_menu_page( 'edit.php' );
}

add_action( 'wp_before_admin_bar_render', __NAMESPACE__ . '\\admin_bar_render' );
