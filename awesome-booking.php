<?php
/**
 * Plugin Name: Awesome Booking
 * Description: Hotel booking plugin (standalone, no WooCommerce).
 * Version: 1.0
 * Author: Abdullah Nahian
 * Text Domain: awesome-booking
 */

if(!defined('ABSPATH')) exit;

define('ABEG_PATH', plugin_dir_path(__FILE__));
define('ABEG_URL', plugin_dir_url(__FILE__));


// Install: create bookings table
register_activation_hook(__FILE__, function(){
    global $wpdb;
    $table = $wpdb->prefix.'abeg_bookings';
    $charset = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        room_id BIGINT UNSIGNED NOT NULL,
        user_name VARCHAR(255) NOT NULL,
        user_email VARCHAR(255) NOT NULL,
        booking_dates TEXT NOT NULL,
        status ENUM('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY(id)
    ) $charset;";
    require_once ABSPATH.'wp-admin/includes/upgrade.php';
    dbDelta($sql);
});

// Include admin dashboard
require_once ABEG_PATH.'admin/abeg-dashboard.php';

// Include AJAX handlers
require_once ABEG_PATH.'core/abeg-ajax.php';

// Include frontend scripts
require_once ABEG_PATH.'frontend/abeg-frontend-scripts.php';
