<?php
namespace WP_Clean\RemoveDashboardWidgets;

// Remove unnecessary dashboard widgets
function remove_dashboard_widgets() {
  remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_right_now', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_activity', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
  remove_action( 'welcome_panel', 'wp_welcome_panel' );
}

add_action( 'admin_init', __NAMESPACE__ . '\\remove_dashboard_widgets' );
