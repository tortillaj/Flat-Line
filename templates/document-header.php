<header class="header-document" role="banner">

  <a class="logo" href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo( 'name' ); ?></a>

  <nav role="navigation" id="mainNavigationContainer" class="main-navigation">
    <?php dawn_main_nav(); ?>
  </nav>

  <nav role="navigation" id="recentPostsNavigationContainer" class="recent-posts-navigation">
    <?php echo Template::recent_posts(); ?>
  </nav>

</header>
