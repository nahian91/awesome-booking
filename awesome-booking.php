<?php
/*
Plugin Name: Awesome Booking
Description: Hotel/Room Booking System for WordPress.
Version: 1.0
Author: Abdullah Nahian
Text Domain: awesome-booking
*/

if (!defined('ABSPATH')) exit;

define('ABEG_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('ABEG_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include Admin
require_once ABEG_PLUGIN_PATH . 'includes/admin/admin-dashboard.php';

// Enqueue admin scripts & styles
add_action('admin_enqueue_scripts', 'abeg_admin_assets');
function abeg_admin_assets($hook){
    // Only load on plugin admin page
    if(strpos($hook,'awb_dashboard') === false) return;

    wp_enqueue_style('abeg-admin-css', ABEG_PLUGIN_URL.'assets/css/admin.css', [], '1.0');
    wp_enqueue_script('abeg-admin-js', ABEG_PLUGIN_URL.'assets/js/admin.js', ['jquery'], '1.0', true);
}

register_activation_hook(__FILE__, 'abeg_create_tables');

function abeg_create_tables() {
    global $wpdb;
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $charset_collate = $wpdb->get_charset_collate();

    // Rooms table
    $table_rooms = $wpdb->prefix . 'abeg_rooms';
    $sql_rooms = "CREATE TABLE $table_rooms (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        max_occupancy INT NOT NULL,
        category_id BIGINT(20) UNSIGNED DEFAULT 0,
        description TEXT,
        image VARCHAR(255) DEFAULT NULL,
        is_featured TINYINT(1) DEFAULT 0,
        status ENUM('available','unavailable') DEFAULT 'available',
        characteristics TEXT DEFAULT NULL,
        options TEXT DEFAULT NULL,
        PRIMARY KEY(id)
    ) $charset_collate;";
    dbDelta($sql_rooms);

    // Room Categories
    $table_categories = $wpdb->prefix . 'abeg_room_categories';
    $sql_categories = "CREATE TABLE $table_categories (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        PRIMARY KEY(id)
    ) $charset_collate;";
    dbDelta($sql_categories);

    // Characteristics
    $table_characteristics = $wpdb->prefix . 'abeg_room_characteristics';
    $sql_characteristics = "CREATE TABLE $table_characteristics (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        PRIMARY KEY(id)
    ) $charset_collate;";
    dbDelta($sql_characteristics);

    // Options
    $table_options = $wpdb->prefix . 'abeg_room_options';
    $sql_options = "CREATE TABLE $table_options (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10,2) DEFAULT 0,
        PRIMARY KEY(id)
    ) $charset_collate;";
    dbDelta($sql_options);
}
