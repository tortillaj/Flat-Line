<header class="article-header">
  <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'list-view-thumbnail', array('class' => 'thumbnail thumbnail--excerpt')); } ?>
  <h2>
    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
      <?php echo Template::title(); ?>
    </a>
  </h2>
</header>