<?php
namespace WP_Clean\DisablePosts;

// Remove posts in admin menu
function action_remove_menus() {
  remove_menu_page( 'edit.php' );
}

add_action( 'admin_menu', __NAMESPACE__ . '\\action_remove_menus' );
