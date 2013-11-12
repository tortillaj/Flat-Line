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

    if ( is_search() ) {
      $content = self::embolden_replace( $content );
    }

    return $content . ' <a href="' . get_permalink() . '">Read More &raquo;</a>';
  }

  /*
   * Smartly truncate text
   *
   * @param $input        text to shorten
   * @param $ellipses     should ellipses be added
   * @param $strip_html   strip HTML tags
   * @param $length       number of characters in truncated text
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

    // TODO: create excerpt length variable in Theme Options

    // find last space within length
    $last_space   = strrpos( substr( $input, 0, $length ), ' ' );
    $trimmed_text = substr( $input, 0, $last_space );

    // add ellipses (...)
    if ( $ellipses ) {
      $trimmed_text .= '&#8230;';
    }

    return $trimmed_text;
  }

  /*
   * Highlight searched terms in search results
   *
   * @param $subject text to embolden replace
   */
  public static function embolden_replace( $subject )
  {
    $search       = get_search_query();
    $search_terms = explode( " ", $search );
    $patterns     = array();
    $replacements = array();
    foreach ( $search_terms as $key => $value ) {
      $patterns[ ]     = '/' . strtolower( $value ) . '/';
      $patterns[ ]     = '/' . strtoupper( $value ) . '/';
      $patterns[ ]     = '/' . ucwords( $value ) . '/';
      $replacements[ ] = '<strong class="search-result">' . strtolower( $value ) . '</strong>';
      $replacements[ ] = '<strong class="search-result">' . strtoupper( $value ) . '</strong>';
      $replacements[ ] = '<strong class="search-result">' . ucwords( $value ) . '</strong>';
    }
    $subject = preg_replace( $patterns, $replacements, strip_tags( $subject ) );
    return $subject;
  }

}