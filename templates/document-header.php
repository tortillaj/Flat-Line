<header class="header--document" role="banner">
  <!--
  <nav role="navigation" id="gridLinksContainer" class="nav nav--grid-links">
    <h3>Topics</h3>
    <?php dawn_grid_links(); ?>
  </nav>
  -->
  <nav role="navigation" id="recentPostsNavigationContainer" class="nav nav--recent-posts">
    <h3>Recent</h3>
    <?php echo Template::recent_posts(array('notes', 'experiments')); ?>
  </nav>

</header>
