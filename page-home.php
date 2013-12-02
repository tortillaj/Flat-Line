<?php
/*
 * Template Name: Home Page
 */

global $post;
$latest = Template::latest_post(array('notes', 'experiments'));
$post = $latest->post;
setup_postdata($post);
?>

  <article <?php post_class(); ?>  itemscope itemtype="http://schema.org/BlogPosting">
    <?php include(locate_template( 'templates/meta/meta-basic.php' )); ?>
    <?php include(locate_template( 'templates/common/common-full-title.php' )); ?>
    <?php include(locate_template( 'templates/common/common-content.php' )); ?>
    <?php include(locate_template( 'templates/content/content-post-footer.php' )); ?>
  </article>
<?php include( locate_template( 'templates/common/common-comments.php' ) ); ?>