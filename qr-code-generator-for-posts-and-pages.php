<?php
/*
Plugin Name: QR Code Generator for All Post Types
Description: Adds a "Generate QR Code" link in the admin area to create a QR code for posts, pages, products, and all custom post types.
Version: 1.4
Author: SourceCodePlugins
Author URI: https://sourcecode.es
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: qr-code-generator-for-posts-and-pages
*/

// Hook into all post types dynamically
add_action('admin_init', 'register_qr_code_link_filters');

function register_qr_code_link_filters() {
    $post_types = get_post_types(['public' => true], 'names'); // Get all public post types
    foreach ($post_types as $post_type) {
        add_filter("post_row_actions", 'add_qr_code_link_to_post_types', 10, 2); // For posts
        add_filter("page_row_actions", 'add_qr_code_link_to_post_types', 10, 2); // For pages
        if ($post_type !== 'post' && $post_type !== 'page') {
            add_filter("{$post_type}_row_actions", 'add_qr_code_link_to_post_types', 10, 2); // For custom post types
        }
    }
}

function add_qr_code_link_to_post_types($actions, $post) {
    $post_types = get_post_types(['public' => true], 'names'); // Get all public post types
    if (in_array($post->post_type, $post_types)) {
        $qr_code_url = add_query_arg(array(
            'qr_code_post' => $post->ID,
            '_wpnonce' => wp_create_nonce('generate_qr_code_nonce'),
        ), admin_url('admin.php'));
        $actions['generate_qr'] = '<a href="' . esc_url($qr_code_url) . '">Generate QR Code</a>';
    }
    return $actions;
}

add_action('admin_init', 'generate_qr_code_for_post');

function generate_qr_code_for_post() {
    if (isset($_GET['qr_code_post']) && isset($_GET['_wpnonce'])) {
        // Verify nonce
        $nonce = sanitize_text_field(wp_unslash($_GET['_wpnonce']));
        if (!wp_verify_nonce($nonce, 'generate_qr_code_nonce')) {
            wp_die('Security check failed');
        }

        // Check permissions
        if (!current_user_can('edit_posts')) {
            wp_die('You do not have permission to perform this action');
        }

        $post_id = intval($_GET['qr_code_post']);
        $post_url = get_permalink($post_id);

        if ($post_url) {
            // Generate the QR code
            $qr_code_image = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($post_url) . '&size=200x200';

            // Output the QR code as an image
            header('Content-Type: text/html');
            echo '<div style="text-align: center; padding-top: 50px;">';
            echo '<h1>QR Code for ' . esc_html(get_the_title($post_id)) . '</h1>';
            echo '<p><img src="' . esc_url($qr_code_image) . '" alt="QR Code"></p>';
            echo '<p><a href="' . esc_url(admin_url('edit.php?post_type=' . get_post_type($post_id))) . '">Back to All Items</a></p>';
            echo '</div>';
            exit;
        }
    }
}
