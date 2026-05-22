<?php
/** Wrapper used for all WooCommerce pages — gives shop a sidebar layout. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<div class="container">
    <?php if ( is_shop() || is_product_category() || is_product_tag() ) : ?>
        <div class="shop-layout">
            <aside class="shop-sidebar">
                <h3>Categories</h3>
                <?php
                $cats = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => true ) );
                if ( $cats && ! is_wp_error( $cats ) ) {
                    echo '<ul>';
                    foreach ( $cats as $c ) {
                        echo '<li><a href="' . esc_url( get_term_link( $c ) ) . '">' . esc_html( $c->name ) . ' (' . intval( $c->count ) . ')</a></li>';
                    }
                    echo '</ul>';
                }
                if ( is_active_sidebar( 'shop-sidebar' ) ) { dynamic_sidebar( 'shop-sidebar' ); }
                ?>
            </aside>
            <div class="shop-main"><?php woocommerce_content(); ?></div>
        </div>
    <?php else : ?>
        <div class="section"><?php woocommerce_content(); ?></div>
    <?php endif; ?>
</div>
<?php get_footer();
