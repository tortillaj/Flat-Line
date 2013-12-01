<header class="header--article">
  <h1>
    <a href="<?php the_permalink() ?>" rel="bookmark" itemprop="url" title="<?php the_title_attribute(); ?>">
      <?php echo Template::page_title(); ?>
    </a>
  </h1>
  <?php include locate_template( 'templates/meta/meta-author-date.php' ) ?>
</header>