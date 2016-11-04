<?php
/*
 * Remove dashboard widgets
 */
add_action('admin_init', function() {
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
  remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
  remove_meta_box('dashboard_right_now', 'dashboard', 'side');
  remove_meta_box('dashboard_activity', 'dashboard', 'side');
  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
  remove_meta_box('dashboard_primary', 'dashboard', 'normal');
  remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
  remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

  remove_action('welcome_panel', 'wp_welcome_panel');
});


/**
 * Remove 'Drao Boxes Here' on Dashbord Admin
 */
add_action('admin_footer', function() {
?><style type="text/css">
   #dashboard-widgets .meta-box-sortables.ui-sortable.empty-container {
     display: none !important;
   }
 </style><?php
});
