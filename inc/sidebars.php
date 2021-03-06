<?php

/*
 * Activate the sidebars 
 */

function dawn_register_sidebars()
{
  register_sidebar( array(
                         'id'            => 'sidebar_primary',
                         'name'          => __( 'Primary Sidebar', 'dawn' ),
                         'description'   => __( 'The first (primary) sidebar.', 'dawn' ),
                         'before_widget' => '<section class="widget %2$s">',
                         'after_widget'  => '</div></section>',
                         'before_title'  => '<h5 class="widget-title">',
                         'after_title'   => '</h5><div class="widget-inner">',
                    ) );
  register_sidebar( array(
                         'id'            => 'sidebar_footer',
                         'name'          => __( 'Footer Sidebar', 'dawn' ),
                         'description'   => __( 'The footer sidebar.', 'dawn' ),
                         'before_widget' => '<section class="widget %2$s">',
                         'after_widget'  => '</div></section>',
                         'before_title'  => '<h5 class="widget-title">',
                         'after_title'   => '</h5><div class="widget-inner">',
                    ) );
}

add_action( 'widgets_init', 'dawn_register_sidebars' );