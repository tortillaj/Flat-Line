<?php

/*
 * Add theme features
 */

add_theme_support( 'html5' );
add_theme_support( 'nice-search' );
add_theme_support( 'rewrites' );
add_theme_support( 'dawn-relative-urls' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'menus' );
add_theme_support( 'jquery-cdn' );

// Add post formats (http://codex.wordpress.org/Post_Formats)
// add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));


/**
 * .main classes
 */
function dawn_main_class()
{
  if ( dawn_display_sidebar() ) {
    $class = '';
  }
  else {
    $class = '';
  }

  if ( is_search() || is_archive() || is_archive() ) {
    $class .= ' list-view';
  }

  return $class;
}

/**
 * .sidebar classes
 */
function dawn_sidebar_class()
{
  return '';
}


/**
 * Define which pages shouldn't have the sidebar
 *
 * See inc/sidebar.php for more details
 */
function dawn_display_sidebar()
{
  $sidebar_config = new Dawn_Sidebar(

  // WP conditionals with no sidebars
    array(),

    // singular page templates with no sidebars
    array(),

    // singular post types with no sidebars
    array()

  );

  return apply_filters( 'dawn_display_sidebar', $sidebar_config->display );
}
