<?php

/*
 * Register nav menus
 */
register_nav_menus( array( 'main-nav'   => __( 'The Main Menu', 'dawn' ),
                           'footer-nav' => __( 'The Footer Menu', 'dawn' ),
                           'grid-links' => __( 'Grid Links', 'dawn' ) ) );


/*
 * Define main nav menus
 */
function dawn_main_nav()
{
  wp_nav_menu( array( 'container'       => false,
                      'container_class' => 'menu',
                      'menu'            => __( 'The Main Menu', 'dawn' ),
                      'menu_class'      => 'nav top-nav',
                      'theme_location'  => 'main-nav',
                      'before'          => '',
                      'after'           => '',
                      'link_before'     => '',
                      'link_after'      => '',
                      'depth'           => 0,
                      'fallback_cb'     => 'dawn_main_nav_fallback' ) );
}


/*
 * This is the main fallback menu
 */
function dawn_main_nav_fallback()
{
  wp_page_menu( array( 'show_home'   => false,
                       'sort_column' => 'menu_order',
                       'menu_class'  => 'nav top-nav',
                       'include'     => '',
                       'exclude'     => '',
                       'echo'        => true,
                       'link_before' => '',
                       'link_after'  => '' ) );
}

/*
 * Define footer nav menus
 */
function dawn_footer_nav()
{
  wp_nav_menu( array( 'container'       => false,
                      'container_class' => 'menu',
                      'menu'            => __( 'The Footer Menu', 'dawn' ),
                      'menu_class'      => 'nav footer-nav',
                      'theme_location'  => 'footer-nav',
                      'before'          => '',
                      'after'           => '',
                      'link_before'     => '',
                      'link_after'      => '',
                      'depth'           => 0,
                      'fallback_cb'     => 'dawn_footer_nav_fallback' ) );
}


/*
 * This is the footer fallback menu
 */
function dawn_footer_nav_fallback()
{
  wp_page_menu( array( 'show_home'   => false,
                       'sort_column' => 'menu_order',
                       'menu_class'  => 'nav footer-nav',
                       'include'     => '',
                       'exclude'     => '',
                       'echo'        => true,
                       'link_before' => '',
                       'link_after'  => '' ) );
}

/*
 * Define grid links
 */
function dawn_grid_links()
{
  wp_nav_menu( array( 'container'       => false,
                      'container_class' => 'menu',
                      'menu'            => __( 'Grid Links', 'dawn' ),
                      'menu_class'      => 'nav grid-links',
                      'theme_location'  => 'grid-links',
                      'before'          => '',
                      'after'           => '',
                      'link_before'     => '',
                      'link_after'      => '',
                      'depth'           => 0,
                      'fallback_cb'     => 'dawn_grid_links_fallback' ) );
}


/*
 * This is the grid links fallback
 */
function dawn_grid_links_fallback()
{
  wp_page_menu( array( 'show_home'   => false,
                       'sort_column' => 'menu_order',
                       'menu_class'  => 'nav grid-links',
                       'include'     => '',
                       'exclude'     => '',
                       'echo'        => true,
                       'link_before' => '',
                       'link_after'  => '' ) );
}


/*
 * Remove extra classes and ID from menu items
 */
add_filter( 'nav_menu_css_class', 'dawn_css_attributes_filter', 100, 1 );
add_filter( 'nav_menu_item_id', 'dawn_css_attributes_filter', 100, 1 );
function dawn_css_attributes_filter( $var )
{
  return is_array( $var ) ? array_intersect( $var, array( 'menu-item-has-children' ) ) : '';
}