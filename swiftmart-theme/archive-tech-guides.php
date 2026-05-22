<?php
/** Archive: Tech Guides CPT */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<div class="container section">
    <h1 class="section-title">Tech Guides</h1>
    <p class="section-sub">In-depth product usage guides written by our team.</p>
    <?php if ( have_posts() ) : ?>
        <div class="grid grid-3">
            <?php while ( have_posts() ) : the_post(); ?>
                <article class="post-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); }
                        else { echo '<img src="https://placehold.co/400x300/1A3C6E/fff?text=Tech+Guide" alt="" loading="lazy">'; } ?>
                    </a>
                    <div class="post-card-body">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p>No tech guides yet.</p>
    <?php endif; ?>
</div>
<?php get_footer();
