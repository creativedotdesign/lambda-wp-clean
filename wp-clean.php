<?php
/**
 * Plugin Name: WP Clean
 * Plugin URI: https://github.com/danimalweb/wp-clean
 * Description: WordPress plugin to clean up unused functionality and extra bloat.
 * Author: Daniel Hewes
 * Version: 0.2
 * Author URI: http://lambdacreatives.com/
 */

require_once 'wp-multifilter.php';

add_action('after_setup_theme', function() {
  foreach (glob(__DIR__ . '/modules/*.php') as $file) {
    if (current_theme_supports('wp-clean-' . basename($file, '.php'))) {
      require_once $file;
    }
  }
});
