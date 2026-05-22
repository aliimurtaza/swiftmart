<?php
/**
 * Single Product Template - SwiftMart override.
 * Original: woocommerce/templates/single-product.php
 */
defined( 'ABSPATH' ) || exit;
get_header( 'shop' ); ?>

<div class="container section">
    <?php
    /**
     * woocommerce_before_main_content hook.
     */
    do_action( 'woocommerce_before_main_content' );

    while ( have_posts() ) :
        the_post();
        wc_get_template_part( 'content', 'single-product' );
    endwhile;

    do_action( 'woocommerce_after_main_content' );
    ?>
</div>

<?php get_footer( 'shop' );
