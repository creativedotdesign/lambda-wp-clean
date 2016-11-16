<?php

add_action('wp_enqueue_scripts', function() {
  $jquery_version = wp_scripts()->registered['jquery-core']->ver;

  wp_deregister_script('jquery');
  wp_register_script(
    'jquery',
    'https://code.jquery.com/jquery-' . $jquery_version . '.min.js',
    [],
    null,
    true
  );

  add_filter('script_loader_src', 'jquery_local_fallback', 10, 2);
}, 101);


/**
 * Output the local fallback immediately after jQuery's <script>
 *
 * @link http://wordpress.stackexchange.com/a/12450
 */
function jquery_local_fallback($src, $handle = null) {
  static $add_jquery_fallback = false;
  if ($add_jquery_fallback) {
    echo '<script>(window.jQuery && jQuery.noConflict()) || document.write(\'<script src="' . $add_jquery_fallback .'"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }
  if ($handle === 'jquery') {
    $add_jquery_fallback = apply_filters('script_loader_src', \includes_url('/js/jquery/jquery.js'), 'jquery-fallback');
  }
  return $src;
}
add_action('wp_head', __NAMESPACE__ . '\\jquery_local_fallback');
