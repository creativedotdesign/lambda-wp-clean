<?php
/**
 * Plugin Name: Lambda WP Clean
 * Plugin URI: https://github.com/danimalweb/wp-clean
 * Description: WordPress plugin to clean up unused functionality and extra bloat.
 * Author: Daniel Hewes
 * Version: 0.2
 * Author URI: http://lambdacreatives.com/
 */


/**
 * Module include based on add_theme_support value
 */
add_action('after_setup_theme', function() {
  foreach (glob(__DIR__ . '/modules/*.php') as $file) {
    if (current_theme_supports('wp-clean-' . basename($file, '.php'))) {
      require_once $file;
    }
  }
});


/**
 * Hooks a single callback to multiple tags
 */
function add_filters($tags, $function, $priority = 10, $accepted_args = 1) {
  foreach ((array) $tags as $tag) {
    add_filter($tag, $function, $priority, $accepted_args);
  }
}


/**
 * Add multiple actions to a closure
 *
 * @param $tags
 * @param $function_to_add
 * @param int $priority
 * @param int $accepted_args
 *
 * @return bool true
 */
function add_actions($tags, $function_to_add, $priority = 10, $accepted_args = 1) {
  //add_action() is just a wrapper around add_filter(), so we do the same
  return add_filters($tags, $function_to_add, $priority, $accepted_args);
}
