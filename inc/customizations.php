<?php

/*
 *
 * Customizations to native WP
 *
 */

/**
 * Alter posts classes
 */
function dawn_alter_post_class( $classes )
{
  $post_classes = array();
  foreach ($classes as $class) {
    if (false !== strpos($class, 'type')) {
      $post_classes[] = $class;
    }
    if (false !== strpos($class, 'post') && strpos($class, 'post') === 0) {
      $post_classes[] = $class;
    }
    if (false !== strpos($class, 'page') && strpos($class, 'page') === 0) {
      $post_classes[] = $class;
    }
  }
  return $post_classes;
}

add_filter( 'post_class', 'dawn_alter_post_class' );