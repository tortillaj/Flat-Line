<section class="content--article" itemprop="articleBody">
  <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full', array('class' => 'thumbnail')); } ?>
  <?php the_content(); ?>
</section>