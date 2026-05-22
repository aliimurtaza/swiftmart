<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<div class="container section">
    <h1 class="section-title"><?php the_archive_title(); ?></h1>
    <p class="section-sub"><?php the_archive_description(); ?></p>
    <?php if ( have_posts() ) : ?>
        <div class="grid grid-3">
            <?php while ( have_posts() ) : the_post(); ?>
                <article class="post-card">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?></a>
                    <div class="post-card-body">
                        <div class="post-meta"><?php echo esc_html( get_the_date() ); ?></div>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>
<?php get_footer();
