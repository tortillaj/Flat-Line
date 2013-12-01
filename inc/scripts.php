<?php

function dawn_scripts()
{

  if ( !is_admin() ) {

    wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/assets/js/build/modernizr.custom.min.js', array(), ASSETS_VERSION, false );

    if ( current_theme_supports( 'jquery-cdn' ) ) {
      wp_deregister_script( 'jquery' );
      wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js', array(), '2.0.3', true );
      add_filter( 'script_loader_src', 'dawn_jquery_local_fallback', 10, 2 );
    }

    wp_enqueue_script( 'global', get_stylesheet_directory_uri() . '/assets/js/build/global.min.js', array( 'jquery' ), ASSETS_VERSION, true );

  }

}

add_action( 'wp_enqueue_scripts', 'dawn_scripts', 100 );

/*
 * Provide a local jQuery fallback if CDN fails
 */
function dawn_jquery_local_fallback( $src, $handle = null )
{
  static $add_jquery_fallback = false;

  if ( $add_jquery_fallback ) {
    echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/js/build/jquery.min.js"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ( $handle === 'jquery' ) {
    $add_jquery_fallback = true;
  }

  return $src;
}

add_action( 'wp_head', 'dawn_jquery_local_fallback' );
