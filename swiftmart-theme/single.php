<?php
/** Single blog post */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>

<article class="post-single">
    <?php while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <div class="post-meta">
            <?php echo esc_html( get_the_date() ); ?> ·
            <?php the_author(); ?> ·
            <?php the_category( ', ' ); ?>
        </div>
        <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); } ?>
        <div class="post-content"><?php the_content(); ?></div>
    <?php endwhile; ?>

    <?php
    // Related posts
    $cats = wp_get_post_categories( get_the_ID() );
    if ( $cats ) :
        $related = new WP_Query( array(
            'category__in'   => $cats,
            'post__not_in'   => array( get_the_ID() ),
            'posts_per_page' => 3,
            'no_found_rows'  => true,
        ) );
        if ( $related->have_posts() ) : ?>
            <section class="related-posts">
                <h2 class="section-title">Related Posts</h2>
                <div class="grid grid-3">
                    <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                        <article class="post-card">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium', array( 'loading' => 'lazy' ) ); ?></a>
                            <div class="post-card-body">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            </div>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </section>
        <?php endif;
    endif; ?>
</article>

<?php get_footer();
