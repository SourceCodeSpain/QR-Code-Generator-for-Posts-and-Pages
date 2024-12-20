=== QR Code Generator for All Post Types ===
Contributors: sourcecodeplugins
Tags: QR code, posts, pages, products, custom post types
Requires at least: 5.0
Tested up to: 6.7.1
Stable tag: 1.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Easily generate QR codes for your posts, pages, WooCommerce products, and all custom post types directly from the WordPress admin interface.

== Description ==
Easily generate QR codes for your posts, pages, WooCommerce products, and all custom post types directly from the WordPress admin interface. This plugin adds a "Generate QR Code" link to the admin list for all public post types, allowing you to quickly create QR codes for sharing URLs.

== Features ==
* Supports all public post types, including posts, pages, and WooCommerce products.
* Automatically detects custom post types and adds support without additional configuration.
* Securely generates QR codes using nonce verification and permission checks.
* Provides an easy-to-use admin interface with links for quick QR code generation.

== Installation ==
1. Upload the `qr-code-generator-for-posts-and-pages` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Navigate to the admin area for any post type (e.g., Posts, Pages, Products, or custom types) and look for the "Generate QR Code" link.

== Frequently Asked Questions ==
= What does this plugin do? =
It adds a "Generate QR Code" link to the row actions of all public post types in the WordPress admin. Clicking the link generates a QR code for the post/page/product URL.

= Does it work with WooCommerce products? =
Yes, the plugin supports WooCommerce products by default.

= Does it work with custom post types? =
Yes, the plugin automatically detects and supports all public custom post types.

= How secure is it? =
The plugin uses WordPress nonces to verify requests and ensure only authorized users can generate QR codes.

== External services ==

This plugin connects to an API to create a QR code based on the page's URL.

It sends the page/post/cpt URL to the API at https://qrserver.com. No personal, website or user information is sent to the API other than the URL.


== Changelog ==
= 1.4 =
* Added dynamic support for all public custom post types.
* Refactored filters to ensure compatibility with custom post types.
* Improved security checks for QR code generation.
* Updated back links to dynamically adapt to different post types.

= 1.3 =
* Added support for all custom post types.
* Updated descriptions to reflect full compatibility.

= 1.2 =
* Added support for WooCommerce products.

= 1.1 =
* Initial release with support for posts and pages.

== Upgrade Notice ==
= 1.3 =
This update adds support for custom post types, making the plugin compatible with any public post type in WordPress.
