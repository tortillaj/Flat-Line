<?php

class Template
{

  /*
   * Get the post / page title
   *
   * @param $post object
   */
  public static function title( $post = null )
  {
    if ( $post === null ) {
      global $post;
    }

    $title = $post->post_title;

    if ( is_search() ) {
      $title = self::embolden_replace( $title );
    }

    return $title;

  }

  /*
   * Get the post / page title
   *
   * @param $post object
   */
  public static function page_title( $pass_through = true, $post = null )
  {
    global $wp_query;

    if ( $post === null ) {
      global $post;
    }

    if ( is_search() ) {
      $search_terms = get_search_query();
      $title        = 'Found ' . $wp_query->found_posts . ' matches <span class="sub-title">Search for "<em>' . $search_terms . '</em>"</span>';
    }
    //else if ( is_home() || is_front_page() ) {
      //$title = "";
    //}
    else if ( is_tax() ) {
      $term  = get_term_by( "slug", $wp_query->query_vars['term'], $wp_query->query_vars['taxonomy'] );
      $title = ( $term->description != "" ) ? $term->name . ' <span class="sub-title">' . $term->description . '</span>' : $term->name;
    }
    else if ( is_tag() ) {
      $title = "Tagged: " . single_tag_title( '', false );
    }
    else if ( is_category() ) {
      $categories = get_the_category();
      $title      = "Category: " . $categories[0]->name;
    }
    else if ( is_author() ) {
      $title = self::co_authors( false );
    }
    else if ( is_archive() ) {
      $title = "Archives";
    }
    else {
      $title = $post->post_title;
    }


    if ( !$pass_through ) {
      if (!is_home() && !is_front_page()) {
        $title .= " | ";
      }
      $title .= "James Cole | Web Developer";
    }

    return $title;

  }

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

    $content = ( !empty( $post->post_excerpt ) ) ? self::shorten( $post->post_excerpt ) : self::shorten( $post->post_content );

    if ( is_search() ) {
      $content = self::embolden_replace( $content );
    }

    return '<p>' . $content . '<a class="readmore" href="' . get_permalink() . '">Read More &rarr;</a></p>';

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
      $patterns[]     = '/' . strtolower( $value ) . '/';
      $patterns[]     = '/' . strtoupper( $value ) . '/';
      $patterns[]     = '/' . ucwords( $value ) . '/';
      $replacements[] = '<strong class="search-result">' . strtolower( $value ) . '</strong>';
      $replacements[] = '<strong class="search-result">' . strtoupper( $value ) . '</strong>';
      $replacements[] = '<strong class="search-result">' . ucwords( $value ) . '</strong>';
    }
    $subject = preg_replace( $patterns, $replacements, strip_tags( $subject ) );
    return $subject;
  }

  /*
   * Pagination (older posts / newer posts links)
   */
  public static function paginate()
  {
    global $wp_query;

    if ( $wp_query->max_num_pages > 1 ): ?>
      <nav role="navigation" class="nav--pagination">
        <?php next_posts_link( '<span class="meta-nav">&larr;</span> Older posts' ); ?>
        <?php previous_posts_link( 'Newer posts <span class="meta-nav">&rarr;</span>' ); ?>
      </nav>
    <?php endif;
  }

  /*
   *  Use the Co-Authors plugin if installed
   *
   * @param $links boolean indicate if the author names should be links to their pages
   */
  public static function co_authors( $links = true )
  {
    if ( function_exists( 'coauthors' ) && function_exists( 'coauthors_posts_links' ) ) {
      if ( !$links ) {
        coauthors();
      }
      else {
        coauthors_posts_links();
      }
    }
    else {
      if ( !$links ) {
        get_the_author();
      }
      else {
        the_author_posts_link();
      }
    }
  }

  /*
   * List of current posts / post types
   *
   * @param $types array of post types
   */
  public static function recent_posts( $types = array( 'post' ) )
  {
    global $post;
    $current_post = $post;
    $return       = '';

    $args = array( 'post_type'      => $types,
                   'orderby'        => 'date',
                   'post_status'    => 'publish',
                   'posts_per_page' => 5 );

    $posts = new WP_Query( $args );

    if ( $posts->have_posts() ) {
      while ( $posts->have_posts() ) {
        $posts->the_post();
        $class = ( $current_post->ID == $post->ID && ( !is_archive() && !is_home() ) ) ? 'current' : '';
        $return .= '<a class="' . $class . '" href="' . get_permalink() . '" rel="bookmark" title="' . the_title_attribute( 'echo=0' ) . '">' . get_the_title() . '<time>' . get_the_date( 'F j, Y' ) . '</time></a>';
      }
    }

    return $return;
  }

  /*
   * Return most recent post
   *
   * @param $types array of post types
   */
  public static function latest_post( $types = array( 'post' ) )
  {
    $args = array( 'post_type'      => $types,
                   'orderby'        => 'date',
                   'post_status'    => 'publish',
                   'posts_per_page' => 1 );

    $post = new WP_Query( $args );

    return $post;
  }

  /*
   * List post / page categories, tags and terms
   *
   * @param $type string can be 'terms', 'tags', or 'categories'
   */
  public static function related( $type )
  {
    global $post;
    $links = array();

    switch ( $type ) {
      case 'terms':
        // collect the terms
        $terms = wp_get_object_terms( $post->ID, array( 'language', 'framework' ) );
        if ( !empty( $terms ) ) {
          foreach ( $terms as $t ) {
            $links[] = '<a class="term" href="' . get_term_link( $t ) . '">' . $t->name . '</a>';
          }
        }
        break;
      case 'tags':
        // collect the tags
        $tags = get_the_tags( $post->ID );
        if ( !empty( $tags ) ) {
          foreach ( $tags as $t ) {
            $links[] = '<a class="tag" href="' . get_tag_link( $t->term_id ) . '">' . $t->name . '</a>';
          }
        }
        break;
      case 'categories':
        $categories = get_the_category( $post->ID );
        if ( !empty( $categories ) ) {
          foreach ( $categories as $c ) {
            $links[] = '<a class="category" href="' . get_category_link( $c->term_id ) . '">' . $c->name . '</a>';
          }
        }
        break;
    }

    return implode( $links, ", " );
  }

}