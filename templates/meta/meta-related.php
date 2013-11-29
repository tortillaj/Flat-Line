<?php
$categories = Template::related( 'categories' );
$terms = Template::related( 'terms' );
$tags = Template::related( 'tags' );
?>

<?php if ( !empty( $categories ) || !empty( $terms ) || !empty( $tags ) ): ?>
  <section class="meta meta--related">

    <?php if ( !empty( $categories ) ): ?>
      <nav class="categories">
        <h5>Categorized</h5>
        <?php echo $categories; ?>
      </nav>
    <?php endif; ?>

    <?php if ( !empty( $terms ) ): ?>
      <nav class="terms">
        <h5>Posted In</h5>
        <?php echo $terms; ?>
      </nav>
    <?php endif; ?>

    <?php if ( !empty( $tags ) ): ?>
      <nav class="tags">
        <h5>Tagged</h5>
        <?php echo $tags; ?>
      </nav>
    <?php endif; ?>

  </section>
<?php endif; ?>