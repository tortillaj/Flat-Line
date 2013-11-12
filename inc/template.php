<?php

class Template
{

  /*
   * Get the excerpt of shorten the content
   *
   * @param $post object
   */
  public static function excerpt( $post = null )
  {
    if ( $post === null ) {
      global $post;
    }

    $content = (!empty($post->post_excerpt)) ? self::shorten( $post->post_excerpt ) : self::shorten( $post->post_content );

    return $content . ' <a href="' . get_permalink() . '">Read More &raquo;</a>';
  }

  /*
   * Smartly truncate text
   */
  public static function shorten( $input, $ellipses = true, $strip_html = true, $length = 300 )
  {

    // strip tags, if desired
    if ( $strip_html ) {
      $input = strip_tags( $input );
    }

    // no need to trim, already shorter than trim length
    if ( strlen( $input ) <= $length ) {
      return $input;
    }

    // find last space within length
    $last_space   = strrpos( substr( $input, 0, $length ), ' ' );
    $trimmed_text = substr( $input, 0, $last_space );

    // add ellipses (...)
    if ( $ellipses ) {
      $trimmed_text .= '&#8230;';
    }

    return $trimmed_text;
  }

}