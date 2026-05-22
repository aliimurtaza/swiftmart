<?php
/** Homepage template (used when site shows latest posts OR as front page). */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>

<section class="hero">
    <div class="container">
        <h1>Premium Tech Accessories, Delivered Fast</h1>
        <p>Chargers, cables, earbuds and smart gadgets engineered for everyday performance. Free delivery across Pakistan on orders over PKR 3,000.</p>
        <div class="hero-ctas">
            <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn">Shop Now</a>
            <a href="<?php echo esc_url( home_url( '/tech-guides' ) ); ?>" class="btn btn-outline">Browse Guides</a>
        </div>
    </div>
</section>

<?php /* FEATURED CATEGORIES */ ?>
<section class="section">
    <div class="container">
        <h2 class="section-title">Shop by Category</h2>
        <p class="section-sub">Find the perfect accessory for every device.</p>
        <div class="grid grid-4">
            <?php
            if ( taxonomy_exists( 'product_cat' ) ) :
                $cats = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => false, 'number' => 4, 'exclude' => array( get_option( 'default_product_cat' ) ) ) );
                foreach ( $cats as $cat ) :
                    $thumb_id  = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                    $image_url = $thumb_id ? wp_get_attachment_url( $thumb_id ) : 'https://placehold.co/400x300/1A3C6E/ffffff?text=' . urlencode( $cat->name );
                    ?>
                    <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="cat-card">
                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $cat->name ); ?>" loading="lazy">
                        <div class="cat-card-body">
                            <h3><?php echo esc_html( $cat->name ); ?></h3>
                            <p><?php echo esc_html( $cat->count ); ?> products</p>
                        </div>
                    </a>
                <?php endforeach; endif; ?>
        </div>
    </div>
</section>

<?php /* FEATURED PRODUCTS */ ?>
<section class="section" style="background:#f8fafc">
    <div class="container">
        <h2 class="section-title">Featured Products</h2>
        <p class="section-sub">Hand-picked best sellers this week.</p>
        <?php
        if ( shortcode_exists( 'products' ) ) {
            echo do_shortcode( '[products limit="4" columns="4" visibility="featured"]' );
        }
        ?>
    </div>
</section>

<?php /* BLOG PREVIEW STRIP */ ?>
<section class="section">
    <div class="container">
        <h2 class="section-title">From the Blog</h2>
        <p class="section-sub">Tech tips, buyer guides, and product updates.</p>
        <div class="grid grid-3">
            <?php
            $q = swiftmart_get_recent_posts( 3 );
            if ( $q->have_posts() ) :
                while ( $q->have_posts() ) : $q->the_post(); ?>
                    <article class="post-card">
                        <a href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); }
                            else { echo '<img src="https://placehold.co/400x300/2E6DB4/fff?text=Blog" alt="" loading="lazy">'; } ?>
                        </a>
                        <div class="post-card-body">
                            <div class="post-meta"><?php echo esc_html( get_the_date() ); ?></div>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></p>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata();
            endif; ?>
        </div>
    </div>
</section>

<?php get_footer();
