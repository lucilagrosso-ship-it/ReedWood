<?php
/**
 * page.php — Plantilla para páginas estáticas de Reedwood
 */
get_header();
?>

<main class="rw-section rw-section--light" style="min-height:60vh;">
  <div class="rw-container">
    <?php while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1><?php the_title(); ?></h1>
        <div><?php the_content(); ?></div>
      </article>
    <?php endwhile; ?>
  </div>
</main>

<?php get_footer(); ?>
