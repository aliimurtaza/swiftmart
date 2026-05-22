<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<article class="post-single">
    <?php while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <div class="post-content"><?php the_content(); ?></div>
    <?php endwhile; ?>
</article>
<?php get_footer();
