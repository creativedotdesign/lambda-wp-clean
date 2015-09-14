<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'WP_Clean' ) ) {

  class WP_Clean {

    public static function init() {

      $self = new self();

      // Disable the theme / plugin text editor in Admin
      if ( !defined( 'DISALLOW_FILE_EDIT' ) ) {
        define( 'DISALLOW_FILE_EDIT' , true );
      }

      add_action( 'admin_menu' , array( $self, 'action_remove_menus' ) );
      add_filter( 'manage_pages_columns', array( $self, 'custom_pages_columns' ) );
      add_filter( 'style_loader_tag', array( $self, 'filter_type_remove' ) );
      add_filter( 'script_loader_tag', array( $self, 'filter_type_remove' ) );
      add_filter( 'style_loader_src', array( $self, 'filter_remove_version_script_style' ), 20000 );
      add_filter( 'script_loader_src', array( $self, 'filter_remove_version_script_style' ), 20000 );
      add_filter( 'post_thumbnail_html', array( $self, 'filter_remove_thumbnail_dimensions'), 10 ); // Remove width and height dynamic attributes to thumbnails
      add_filter( 'image_send_to_editor', array( $self, 'filter_remove_thumbnail_dimensions'), 10 ); // Remove width and height dynamic attributes to post images
      add_filter( 'redirect_canonical', array( $self, 'filter_no_redirect_on_404' ) );
      add_action( 'template_redirect', array( $self, 'action_attachement_template_redirect' ) );
      add_action( 'template_redirect', array( $self, 'action_author_template_redirect' ) );
      add_action( 'init', array( $self, 'action_disable_wp_emojicons' ) );
      add_filter( 'tiny_mce_plugins', array( $self, 'filter_disable_emojicons_tinymce' ) );
      add_filter( 'show_admin_bar', '__return_false' ); //Remove admin bar
      add_action( 'init', array( $self, 'action_remove_wp_head_extras' ) );
      add_action( 'do_feed', array( $self, 'action_disable_feed'), 1 );
      add_action( 'do_feed_rdf', array( $self, 'action_disable_feed'), 1 );
      add_action( 'do_feed_rss', array( $self, 'action_disable_feed'), 1 );
      add_action( 'do_feed_rss2', array( $self, 'action_disable_feed'), 1 );
      add_action( 'do_feed_atom', array( $self, 'action_disable_feed'), 1 );
      add_action( 'do_feed_rss2_comments', array( $self, 'action_disable_feed'), 1  );
      add_action( 'do_feed_atom_comments', array( $self, 'action_disable_feed'), 1 );
      add_action( 'parse_query', array( $self, 'action_disable_search' ) );
      add_filter( 'get_search_form', create_function( '$a', "return null;" ) );
      add_filter( 'wp_headers', array( $self, 'filter_remove_header_pingback' ) );
      add_filter( 'xmlrpc_methods', array( $self, 'filter_disable_pingback' ) );
      add_filter( 'xmlrpc_enabled', '__return_false' );
      add_action( 'admin_init', array( $self, 'remove_dashboard_widgets' ) );
      add_filter( 'body_class', array( $self, 'body_class' ) );
      add_filter( 'style_loader_tag', array( $self, 'remove_self_closing_tags' ) );
      add_action( 'wp_before_admin_bar_render', array( $self, 'admin_bar_render' ) );

    }

    // Remove comments and posts in admin menu
    function action_remove_menus() {
      remove_menu_page( 'edit-comments.php' );
      remove_menu_page( 'edit.php' );
      remove_menu_page( 'options-discussion.php' );
    }

    // Remove comments column from pages
    function custom_pages_columns( $defaults ) {
      unset( $defaults[ 'comments' ] );
      return $defaults;
    }

    // Remove 'text/css' and 'text/javascript' from enqueued stylesheets and scripts
    function filter_type_remove( $input ) {
      $input = preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $input );
      return str_replace( "'", '"', $input );
    }

    // Remove unnecessary self-closing tags
    function remove_self_closing_tags($input) {
      return str_replace(' />', '>', $input);
    }

    // Remove style and script versions from source code URL's
    function filter_remove_version_script_style( $target_url ) {
    	if ( strpos( $target_url, 'ver=' ) ) { // check if "ver=" argument exists in the url or not
    	   $target_url = remove_query_arg( 'ver', $target_url );
    	}
      return $target_url;
    }

    // Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
    function filter_remove_thumbnail_dimensions( $html ) {
      $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
      return $html;
    }

    // Return 404 on no url match. Prevents WP from fuzzy matches
    function filter_no_redirect_on_404( $redirect_url ) {
      if ( is_404() ) {
        return false;
      }
      return $redirect_url;
    }

    // No attachement pages. Return user to parent post or 404 if orphan
    function action_attachement_template_redirect () {
      global $wp_query, $post;
      if ( is_attachment() ) {
        $post_parent = $post->post_parent;
        if ( $post_parent ) {
            wp_redirect( get_permalink( $post->post_parent ), 301 );
            exit;
        }
        $wp_query->set_404();
        return;
      }
    }

    // No author pages. Send to 404
    function action_author_template_redirect() {
      if ( is_author() ) {
        $wp_query->set_404();
      }
    }

    // remove all actions related to emojis
    function action_disable_wp_emojicons() {
      remove_action( 'admin_print_styles', 'print_emoji_styles' );
      remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
      remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
      remove_action( 'wp_print_styles', 'print_emoji_styles' );
      remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
      remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
      remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    }

    // fRemove TinyMCE emojis
    function filter_disable_emojicons_tinymce( $plugins ) {
      if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
      } else {
        return array();
      }
    }

    //Remove the extra meta from your HTML head tag
    function action_remove_wp_head_extras() {
      remove_action( 'wp_head', 'feed_links_extra', 3 ); // Remove the links to the extra feeds such as category feeds
      remove_action( 'wp_head', 'feed_links', 2 ); // Remove the links to the general feeds: Post and Comment Feed
      remove_action( 'wp_head', 'rsd_link' ); // Remove the link to the Really Simple Discovery service endpoint, EditURI link
      remove_action( 'wp_head', 'wlwmanifest_link' ); // Remove the link to the Windows Live Writer manifest file.
      remove_action( 'wp_head', 'index_rel_link' ); // Remove Index link
      remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Remove Prev link
      remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Remove Start link
      remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Remove relational links for the posts adjacent to the current post.
      remove_action( 'wp_head', 'wp_generator' ); // Remove the XHTML generator that is generated on the wp_head hook, WP version
      remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
      remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
      remove_action( 'wp_head', 'rel_canonical' );
      remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
    }

    // Disbale RSS feeds
    function action_disable_feed() {
      global $wp_query;
      $wp_query->set_404();
      status_header(404);
      wp_die( __( 'No feed available, please visit the <a href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ) );
    }

    // Disable search, no more ?s=something
    function action_disable_search( $query, $error = true ) {
      if ( is_search() ) {
        $query->is_search     = false;
        $query->query_vars[s] = false;
        $query->query[s]      = false;
        if ( $error == true )
          $query->is_404 = true;
      }
    }

    // Remove x-pingback HTTP header
    function filter_remove_header_pingback ( $headers ) {
      unset( $headers[ 'X-Pingback' ] );
      return $headers;
    }

    // disable pingbacks
     function filter_disable_pingback ( $methods ) {
    	unset( $methods['pingback.ping'] );
    	return $methods;
    }

    // Remove unnecessary dashboard widgets
    function remove_dashboard_widgets() {
      remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
      remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
      remove_meta_box('dashboard_right_now', 'dashboard', 'side');
      remove_meta_box('dashboard_activity', 'dashboard', 'side');
      remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
      remove_meta_box('dashboard_primary', 'dashboard', 'normal');
      remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
      remove_action( 'welcome_panel', 'wp_welcome_panel' );
    }

    //Remove comments and WP logo from admin bar
    function admin_bar_render() {
      global $wp_admin_bar;
      $wp_admin_bar->remove_menu('comments');
      $wp_admin_bar->remove_node('wp-logo');
    }

    // Add and remove body_class() classes
    function body_class($classes) {
      // Add post/page slug if not present
      if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
          $classes[] = basename(get_permalink());
        }
      }
      // Remove unnecessary classes
      $home_id_class = 'page-id-' . get_option('page_on_front');
      $remove_classes = [
        'page-template-default',
        $home_id_class
      ];
      $classes = array_diff($classes, $remove_classes);
      return $classes;
    }

  } // End of WP_Clean class

} // End of class_exists wrapper
