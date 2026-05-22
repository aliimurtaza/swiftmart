<?php
/** Header template */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$cart_count = ( function_exists( 'WC' ) && WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" role="banner">
    <div class="container header-inner">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
            <?php if ( has_custom_logo() ) { the_custom_logo(); } else { ?>
                Swift<span>Mart</span>
            <?php } ?>
        </a>

        <nav class="main-nav" id="primary-nav" role="navigation" aria-label="Primary">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'fallback_cb'    => function() {
                    echo '<ul><li><a href="' . esc_url( home_url( '/' ) ) . '">Home</a></li>';
                    echo '<li><a href="' . esc_url( home_url( '/shop' ) ) . '">Shop</a></li>';
                    echo '<li><a href="' . esc_url( home_url( '/tech-guides' ) ) . '">Tech Guides</a></li>';
                    echo '<li><a href="' . esc_url( home_url( '/blog' ) ) . '">Blog</a></li>';
                    echo '<li><a href="' . esc_url( home_url( '/contact' ) ) . '">Contact</a></li></ul>';
                },
            ) );
            ?>
        </nav>

        <div class="header-actions">
            <?php if ( function_exists( 'wc_get_cart_url' ) ) : ?>
                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="mini-cart" aria-label="Cart">
                    🛒 <span class="cart-count"><?php echo esc_html( $cart_count ); ?></span>
                </a>
            <?php endif; ?>
            <button class="menu-toggle" aria-controls="primary-nav" aria-expanded="false">☰</button>
        </div>
    </div>
</header>

<main id="content" class="site-main">
