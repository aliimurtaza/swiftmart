<?php
/**
 * SwiftMart Theme Functions
 *
 * @package SwiftMart
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'SWIFTMART_VERSION', '1.0.0' );
define( 'SWIFTMART_DIR', get_template_directory() );
define( 'SWIFTMART_URI', get_template_directory_uri() );

/* -------------------------------------------------------------------------
 * 1. Theme setup
 * ------------------------------------------------------------------------- */
function swiftmart_setup() {
    load_theme_textdomain( 'swiftmart', SWIFTMART_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'custom-logo', array( 'height' => 60, 'width' => 200, 'flex-height' => true, 'flex-width' => true ) );
    add_theme_support( 'responsive-embeds' );

    // WooCommerce
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'swiftmart' ),
        'footer'  => __( 'Footer Menu', 'swiftmart' ),
    ) );
}
add_action( 'after_setup_theme', 'swiftmart_setup' );

/* -------------------------------------------------------------------------
 * 2. Enqueue styles & scripts
 * ------------------------------------------------------------------------- */
function swiftmart_assets() {
    wp_enqueue_style( 'swiftmart-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', array(), null );
    wp_enqueue_style( 'swiftmart-style', get_stylesheet_uri(), array(), SWIFTMART_VERSION );
    wp_enqueue_script( 'swiftmart-main', SWIFTMART_URI . '/assets/js/main.js', array( 'jquery' ), SWIFTMART_VERSION, true );

    wp_localize_script( 'swiftmart-main', 'swiftmart_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'swiftmart_nonce' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'swiftmart_assets' );

/* -------------------------------------------------------------------------
 * 3. Mini-cart fragment (live count)
 * ------------------------------------------------------------------------- */
function swiftmart_cart_fragment( $fragments ) {
    if ( ! function_exists( 'WC' ) ) { return $fragments; }
    ob_start();
    $count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
    ?>
    <span class="cart-count"><?php echo esc_html( $count ); ?></span>
    <?php
    $fragments['span.cart-count'] = ob_get_clean();
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'swiftmart_cart_fragment' );

/* -------------------------------------------------------------------------
 * 4. Custom Post Type: Tech Guides + Taxonomy
 * ------------------------------------------------------------------------- */
function swiftmart_register_tech_guides() {
    $labels = array(
        'name'               => __( 'Tech Guides', 'swiftmart' ),
        'singular_name'      => __( 'Tech Guide', 'swiftmart' ),
        'add_new'            => __( 'Add New Guide', 'swiftmart' ),
        'add_new_item'       => __( 'Add New Tech Guide', 'swiftmart' ),
        'edit_item'          => __( 'Edit Tech Guide', 'swiftmart' ),
        'all_items'          => __( 'All Tech Guides', 'swiftmart' ),
        'menu_name'          => __( 'Tech Guides', 'swiftmart' ),
    );
    register_post_type( 'tech-guides', array(
        'labels'            => $labels,
        'public'            => true,
        'has_archive'       => true,
        'menu_icon'         => 'dashicons-book-alt',
        'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'rewrite'           => array( 'slug' => 'tech-guides' ),
        'show_in_rest'      => true,
    ) );

    register_taxonomy( 'guide-category', 'tech-guides', array(
        'labels'            => array(
            'name'          => __( 'Guide Categories', 'swiftmart' ),
            'singular_name' => __( 'Guide Category', 'swiftmart' ),
        ),
        'hierarchical'      => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'guide-category' ),
    ) );
}
add_action( 'init', 'swiftmart_register_tech_guides' );

/* -------------------------------------------------------------------------
 * 5. ACF — Product custom fields (programmatic fallback if ACF active)
 *    If you prefer the ACF UI, import /inc/acf-export.json instead.
 * ------------------------------------------------------------------------- */
function swiftmart_register_acf_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) { return; }

    acf_add_local_field_group( array(
        'key'      => 'group_swiftmart_product',
        'title'    => 'SwiftMart Product Details',
        'fields'   => array(
            array(
                'key'   => 'field_compatibility_list',
                'label' => 'Compatibility List',
                'name'  => 'compatibility_list',
                'type'  => 'textarea',
                'instructions' => 'List of devices/models this product is compatible with (one per line).',
            ),
            array(
                'key'   => 'field_warranty_period',
                'label' => 'Warranty Period',
                'name'  => 'warranty_period',
                'type'  => 'text',
                'placeholder' => 'e.g., 12 Months',
            ),
        ),
        'location' => array(
            array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'product' ) ),
        ),
    ) );
}
add_action( 'acf/init', 'swiftmart_register_acf_fields' );

/* Display ACF fields below product description (fallback)
 * The Specifications tab is also added (see filter below). */
function swiftmart_render_product_specs() {
    if ( ! function_exists( 'get_field' ) ) { return; }
    $compat   = get_field( 'compatibility_list' );
    $warranty = get_field( 'warranty_period' );
    if ( ! $compat && ! $warranty ) { return; }
    ?>
    <div class="swiftmart-specs">
        <h3><?php esc_html_e( 'Specifications', 'swiftmart' ); ?></h3>
        <?php if ( $warranty ) : ?>
            <p><strong><?php esc_html_e( 'Warranty Period:', 'swiftmart' ); ?></strong> <?php echo esc_html( $warranty ); ?></p>
        <?php endif; ?>
        <?php if ( $compat ) : ?>
            <p><strong><?php esc_html_e( 'Compatibility:', 'swiftmart' ); ?></strong></p>
            <p><?php echo nl2br( esc_html( $compat ) ); ?></p>
        <?php endif; ?>
    </div>
    <?php
}
add_action( 'woocommerce_after_single_product_summary', 'swiftmart_render_product_specs', 15 );

/* Add a Specifications tab on the single product page */
function swiftmart_specs_product_tab( $tabs ) {
    if ( ! function_exists( 'get_field' ) ) { return $tabs; }
    $compat   = get_field( 'compatibility_list' );
    $warranty = get_field( 'warranty_period' );
    if ( $compat || $warranty ) {
        $tabs['swiftmart_specs'] = array(
            'title'    => __( 'Specifications', 'swiftmart' ),
            'priority' => 25,
            'callback' => 'swiftmart_render_product_specs',
        );
    }
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'swiftmart_specs_product_tab' );

/* Move product meta below add-to-cart */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 35 );

/* -------------------------------------------------------------------------
 * 6. Widgets
 * ------------------------------------------------------------------------- */
function swiftmart_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Shop Sidebar', 'swiftmart' ),
        'id'            => 'shop-sidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'swiftmart_widgets_init' );

/* -------------------------------------------------------------------------
 * 7. SECURITY HARDENING
 *    Documented in README.md
 * ------------------------------------------------------------------------- */
// 7a. Disable XML-RPC
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'wp_headers', function( $headers ) { unset( $headers['X-Pingback'] ); return $headers; } );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );

// 7b. Hide WordPress version number
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );
add_filter( 'style_loader_src', 'swiftmart_remove_version_query', 9999 );
add_filter( 'script_loader_src', 'swiftmart_remove_version_query', 9999 );
function swiftmart_remove_version_query( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}

// 7c. Strip generic login error messages (avoid user enumeration)
add_filter( 'login_errors', function() { return __( 'Invalid credentials.', 'swiftmart' ); } );

// 7d. Disable REST user endpoint for unauthenticated requests
add_filter( 'rest_endpoints', function( $endpoints ) {
    if ( isset( $endpoints['/wp/v2/users'] ) ) { unset( $endpoints['/wp/v2/users'] ); }
    if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) { unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ); }
    return $endpoints;
} );

/* -------------------------------------------------------------------------
 * 8. Helper — recent posts for homepage
 * ------------------------------------------------------------------------- */
function swiftmart_get_recent_posts( $count = 3 ) {
    return new WP_Query( array(
        'post_type'      => 'post',
        'posts_per_page' => absint( $count ),
        'no_found_rows'  => true,
    ) );
}
