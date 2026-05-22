<?php
/** Footer template */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
</main>

<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <h4>SwiftMart</h4>
                <p>Premium electronics accessories — chargers, cables, earbuds, smart gadgets.</p>
            </div>
            <div class="footer-col">
                <h4><?php esc_html_e( 'Quick Links', 'swiftmart' ); ?></h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/shop' ) ); ?>">Shop</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/tech-guides' ) ); ?>">Tech Guides</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Blog</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4><?php esc_html_e( 'Contact', 'swiftmart' ); ?></h4>
                <ul>
                    <li>Email: support@swiftmart.local</li>
                    <li>Phone: +92 300 0000000</li>
                    <li>Lahore · Karachi · Islamabad</li>
                </ul>
            </div>
            <div class="footer-col newsletter">
                <h4><?php esc_html_e( 'Newsletter', 'swiftmart' ); ?></h4>
                <form onsubmit="event.preventDefault();alert('Demo only');">
                    <input type="email" placeholder="Your email" aria-label="Email">
                    <button type="submit" class="btn">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> SwiftMart. All rights reserved.
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
