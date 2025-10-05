<?php
if (!defined('ABSPATH')) exit;

// Shortcode: [abeg_booking_form]
add_shortcode('abeg_booking_form', 'abeg_booking_form_shortcode');

function abeg_booking_form_shortcode($atts) {
    ob_start();

    // Include the template
    include ABEG_PLUGIN_PATH . 'templates/frontend/booking-form-template.php';

    // Enqueue frontend assets
    wp_enqueue_style('abeg-frontend-css', ABEG_PLUGIN_URL . 'assets/css/frontend.css', [], '1.0');
    wp_enqueue_script('abeg-frontend-js', ABEG_PLUGIN_URL . 'assets/js/frontend.js', ['jquery'], '1.0', true);

    return ob_get_clean();
}
