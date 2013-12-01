<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<?php get_template_part( 'templates/head' ); ?>

<body <?php body_class(); ?>>

<div class="container">

  <!--[if lt IE 10]>
  <div class="alert alert-warning"><?php _e( 'You are using an <strong>outdated</strong> browser. Please <a
      href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'dawn' ); ?>
  </div><![endif]-->

  <?php get_template_part( 'templates/document', 'header' ); ?>

  <div class="main <?php echo dawn_main_class(); ?>" role="main">

    <a class="logo" href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo( 'name' ); ?></a>

    <nav role="navigation" id="mainNavigationContainer" class="nav nav--main">
      <?php dawn_main_nav(); ?>
    </nav>

    <?php if ( have_posts() ) : ?>

      <?php if ( is_search() || is_archive() ): ?>
        <header class="header--archive">
          <h1><?php echo Template::page_title(); ?></h1>
        </header>
      <?php endif; ?>

      <?php while ( have_posts() ) : the_post(); ?>
        <?php include dawn_template_path(); ?>
      <?php endwhile; ?>

      <?php echo Template::paginate(); ?>

    <?php else: ?>
      <?php get_template_part( 'templates/content/content', 'notfound' ); ?>
    <?php endif; ?>

    <?php if ( dawn_display_sidebar() ): ?>
      <?php include dawn_sidebar_path(); ?>
    <?php endif; ?>

    <?php get_template_part( 'templates/document', 'footer' ); ?>

  </div>

</div>

<?php wp_footer(); ?>

</body>
</html>
