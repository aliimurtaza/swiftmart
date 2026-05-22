<?php
/** Main index / blog archive fallback */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>

<div class="container section">
    <h1 class="section-title"><?php single_post_title(); ?></h1>
    <?php if ( have_posts() ) : ?>
        <div class="grid grid-3">
            <?php while ( have_posts() ) : the_post(); ?>
                <article class="post-card">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large' ); ?></a>
                    <div class="post-card-body">
                        <div class="post-meta"><?php echo esc_html( get_the_date() ); ?> · <?php the_author(); ?></div>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
        <div style="margin-top:32px;text-align:center"><?php the_posts_pagination(); ?></div>
    <?php else : ?>
        <p><?php esc_html_e( 'No posts found.', 'swiftmart' ); ?></p>
    <?php endif; ?>
</div>

<?php get_footer();
