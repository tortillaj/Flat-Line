<?php

function dawn_root_relative_url( $input )
{
  preg_match( '|https?://([^/]+)(/.*)|i', $input, $matches );

  if ( isset($matches[1]) && isset($matches[2]) && $matches[1] === $_SERVER['SERVER_NAME'] ) {
    return wp_make_link_relative( $input );
  } else {
    return $input;
  }
}

function dawn_enable_root_relative_urls()
{
  return ! (is_admin() || in_array( $GLOBALS['pagenow'], array( 'wp-login.php',
                                                                'wp-register.php' ) )) && current_theme_supports( 'dawn-relative-urls' );
}

if ( dawn_enable_root_relative_urls() ) {
  $dawn_rel_filters = array(
    'bloginfo_url',
    'the_permalink',
    'wp_list_pages',
    'wp_list_categories',
    'dawn_wp_nav_menu_item',
    'the_content_more_link',
    'the_tags',
    'get_pagenum_link',
    'get_comment_link',
    'month_link',
    'day_link',
    'year_link',
    'tag_link',
    'the_author_posts_link',
    'script_loader_src',
    'style_loader_src'
  );

  add_filters( $dawn_rel_filters, 'dawn_root_relative_url' );
}
