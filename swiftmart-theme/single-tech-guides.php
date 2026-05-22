<?php
/** Single: Tech Guides CPT — with related-guides sidebar */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<div class="container section" style="display:grid;grid-template-columns:1fr 280px;gap:32px">
    <article class="post-single" style="padding:0">
        <?php while ( have_posts() ) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <div class="post-meta"><?php echo esc_html( get_the_date() ); ?></div>
            <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); } ?>
            <div class="post-content"><?php the_content(); ?></div>
        <?php endwhile; ?>
    </article>
    <aside class="related-guides">
        <h3 style="color:var(--sm-navy)">Related Guides</h3>
        <?php
        $terms = wp_get_post_terms( get_the_ID(), 'guide-category', array( 'fields' => 'ids' ) );
        if ( $terms ) :
            $related = new WP_Query( array(
                'post_type'      => 'tech-guides',
                'posts_per_page' => 5,
                'post__not_in'   => array( get_the_ID() ),
                'tax_query'      => array( array( 'taxonomy' => 'guide-category', 'field' => 'term_id', 'terms' => $terms ) ),
            ) );
            if ( $related->have_posts() ) : ?>
                <ul style="list-style:none;padding:0">
                    <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                        <li style="padding:10px 0;border-bottom:1px solid var(--sm-border)">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endwhile; wp_reset_postdata(); ?>
                </ul>
            <?php else : ?>
                <p>No related guides yet.</p>
            <?php endif;
        endif; ?>
    </aside>
</div>
<?php get_footer();
