<?php
/**
 * Plugin Name: WP Clean
 * Plugin URI:
 * Description: Clean up unused WordPress functions for cleaner theme development.
 * Author: Daniel Hewes
 * Version: 0.1
 * Author URI: http://lambdacreatives.com/
 */

namespace WP_Clean;

function load_modules() {
  foreach (glob(__DIR__ . '/modules/*.php') as $file) {
    if (current_theme_supports('WP_Clean-' . basename($file))) {
      require_once $file;
    }
  }
}

add_action('after_setup_theme', __NAMESPACE__ . '\\load_modules');
