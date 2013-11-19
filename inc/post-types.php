<?php

function dawn_create_post_types()
{
  $types = array( array( 'slug'        => 'notes',
                         'single'      => 'Note',
                         'plural'      => 'Notes',
                         'has_archive' => false,
                         'supports'    => array( 'title', 'editor' ) ),
                  array( 'slug'        => 'experiments',
                         'single'      => 'Experiment',
                         'plural'      => 'Experiments',
                         'has_archive' => false,
                         'supports'    => array( 'title', 'editor', 'thumbnail', 'comments' ) ),
                  array( 'slug'        => 'demos',
                         'single'      => 'Demo',
                         'plural'      => 'Demos',
                         'has_archive' => false,
                         'supports'    => array( 'title', 'editor' ) ) );

  $default_options = array( 'public' => true, 'show_in_admin_bar' => true, 'publicly_queryable' => true );

  foreach ( $types as $type ) {
    $options = array( 'supports'    => $type['supports'],
                      'has_archive' => $type['has_archive'],
                      'labels'      => dawn_build_labels( $type ) );

    register_post_type( $type['slug'], array_merge( $default_options, $options ) );
  }

  dawn_create_taxonomies();

}

function dawn_create_taxonomies()
{

  $taxonomies = array( array( 'slug' => 'language', 'single' => 'Language', 'plural' => 'Languages' ),
                       array( 'slug' => 'framework', 'single' => 'framework', 'plural' => 'Frameworks' ) );

  foreach ( $taxonomies as $t ) {

    $args = array( 'hierarchical'      => true,
                   'show_ui'           => true,
                   'show_in_nav_menus' => true,
                   'show_admin_column' => true,
                   'labels'            => dawn_build_labels( $t ),
                   'rewrite'           => array( 'hierarchical' => true ) );

    switch ( $t['slug'] ) {
      case 'language':
        register_taxonomy( $t['slug'], array( 'notes', 'experiments', 'demos' ), $args );
        break;
      case 'framework':
        register_taxonomy( $t['slug'], array( 'notes', 'experiments' ), $args );
        break;
    }

  }
}

// make the post types
add_action( 'init', 'dawn_create_post_types' );

// include all the post types in the RSS feed
function dawn_include_post_types_in_main_feed( $qv )
{
  if ( isset( $qv['feed'] ) ) {
    $qv['post_type'] = get_post_types();
  }
  return $qv;
}

add_filter( 'request', 'dawn_include_post_types_in_main_feed' );


// function to build labels
function dawn_build_labels( $type )
{
  $labels = array( 'name'          => $type['plural'],
                   'singular_name' => $type['single'],
                   'menu_name'     => $type['plural'],
                   'add_new'       => "Add New " . $type['single'],
                   'edit_item'     => "Edit " . $type['single'],
                   'all_items'     => "All " . $type['plural'],
                   'new_item'      => "New " . $type['single'],
                   'view_item'     => "View " . $type['single'],
                   'search_items'  => "Search " . $type['plural'] );
  return $labels;
}

function dawn_remove_all_meta_boxes()
{
  // remove_meta_box( 'areas-of-expertisediv', 'post', 'side' );

}

add_action( 'admin_menu', 'dawn_remove_all_meta_boxes' );

function dawn_remove_menu_pages()
{
  remove_menu_page( 'link-manager.php' );
  remove_menu_page( 'edit.php' );
}

add_action( 'admin_menu', 'dawn_remove_menu_pages' );


