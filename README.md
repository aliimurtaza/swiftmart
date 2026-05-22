#SwiftMart — WordPress + WooCommerce Project

SwiftMart is a modern eCommerce website built using WordPress and WooCommerce. It is designed for selling electronics and accessories with a clean UI, fast performance, and responsive shopping experience.

Brand Colors: Deep Navy #1A3C6E | Electric Blue #2E6DB4

---

##Project Overview

SwiftMart is a custom WordPress theme integrated with WooCommerce to provide a complete online shopping experience including products, cart, checkout, and blog system.

This project focuses on UI design, performance, and structured eCommerce functionality using WordPress core + plugins.

---

##Features

- Custom homepage (Hero section, Featured Products, Categories, Blog section)
- WooCommerce shop and product pages
- Add to Cart and Checkout system (plugin-based)
- Responsive product grid layout (4/2/1 columns)
- Tech Guides Custom Post Type
- Product specifications using ACF fields
- SEO optimized structure (Yoast SEO)
- Clean and modern UI design

---

##Setup Instructions

### Requirements:
- WordPress 6.4+
- PHP 8.1+
- MySQL 8+
- Local server (XAMPP / LocalWP / Laragon)

###Installation Steps:

1. Copy `swiftmart-theme` into:
2. 
2. Activate theme:
Appearance → Themes → SwiftMart

3. Install required plugins:
- WooCommerce
- Advanced Custom Fields
- Yoast SEO

4. If database is provided:
Import `swiftmart_db.sql`

5. Go to:
Settings → Permalinks → Save Changes

---

## Plugins Used

- WooCommerce (eCommerce system)
- Advanced Custom Fields (custom product fields)
- Yoast SEO (SEO optimization)
- WP Super Cache (performance optimization)
- Limit Login Attempts (security)

> ⚠️ Note: Login system is handled by default WordPress authentication and optional security plugins. No custom login system is developed.

---

##Custom Features

###Tech Guides
Custom Post Type for tech tutorials and guides with categories.

###Product System
- Product title, price, description, image
- ACF fields for specifications
- Clean WooCommerce product layout

###WooCommerce Integration
- Fully plugin-based cart system
- Checkout and order management via WooCommerce
- Styled product cards and shop grid

---

##Security Features

- Login attempt limitation via plugin
- Secure login URL (via plugin)
- XML-RPC disabled (if configured)
- File editing disabled (optional hardening)

---

## ⚡ Performance & SEO

- Lightweight custom theme
- Lazy loading images
- Optimized CSS/JS structure
- Yoast SEO integration
- Fast loading layout

---

## 📁 Project Structure
swiftmart-theme/
├── style.css
├── functions.php
├── header.php
├── footer.php
├── front-page.php
├── woocommerce/
├── assets/


---

##Final Note

SwiftMart is a modern WooCommerce-based eCommerce theme focused on design, performance, and scalability. All eCommerce functionality (cart, checkout, orders.
