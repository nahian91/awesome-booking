<?php
/*
Plugin Name: Awesome Booking
Plugin URI: https://yourwebsite.com
Description: Complete hotel booking system - free version.
Version: 1.1
Author: AwesomePlugins
Author URI: https://yourwebsite.com
Text Domain: abeg
*/

if(!defined('ABSPATH')) exit; // Prevent direct access

// Define plugin path
define('ABEG_PATH', plugin_dir_path(__FILE__));
define('ABEG_URL', plugin_dir_url(__FILE__));

// Include all files
require_once ABEG_PATH.'includes/cpts.php';
require_once ABEG_PATH.'includes/admin-menu.php';
require_once ABEG_PATH.'includes/dashboard.php';
require_once ABEG_PATH.'includes/customers.php';
require_once ABEG_PATH.'includes/settings.php';
require_once ABEG_PATH.'includes/reports.php';
require_once ABEG_PATH.'includes/booking-actions.php';
require_once ABEG_PATH.'includes/emails.php';

// Enqueue admin CSS & JS
add_action('admin_enqueue_scripts', function($hook){
    wp_enqueue_style('abeg-admin-css', ABEG_URL.'assets/css/admin.css');
    wp_enqueue_script('chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', [], null, true);
    wp_enqueue_script('abeg-charts', ABEG_URL.'assets/js/charts.js', ['chart-js'], null, true);
});
