<?php
/**
 * Plugin Name: WP Clean
 * Plugin URI:
 * Description: Clean up unused WordPress functions for cleaner theme development.
 * Author: Daniel Hewes
 * Version: 0.1
 * Author URI: http://lambdacreatives.com/
 */

require_once( 'class-wp-clean.php' );

add_action('plugins_loaded', array('WP_Clean', 'init'));
