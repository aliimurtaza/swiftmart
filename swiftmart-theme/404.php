<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<section class="error-404 container">
    <h1>404</h1>
    <h2>Page Not Found</h2>
    <p>The page you’re looking for doesn’t exist or has been moved.</p>
    <?php get_search_form(); ?>
    <p style="margin-top:24px">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn">Back to Home</a>
        <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn" style="background:var(--sm-navy)">Visit Shop</a>
    </p>
</section>
<?php get_footer();
