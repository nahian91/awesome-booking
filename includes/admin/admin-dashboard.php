<?php
if (!defined('ABSPATH')) exit;

add_action('admin_menu', 'abeg_admin_menu');

function abeg_admin_menu() {
    add_menu_page(
        __('Awesome Booking', 'awesome-booking'), // Page title
        __('Awesome Booking', 'awesome-booking'), // Menu title
        'manage_options',                         // Capability
        'awb_dashboard',                          // Menu slug
        'abeg_admin_tabs_page',                   // Callback
        'dashicons-admin-home',                   // Icon
        56                                        // Position
    );
}

// Admin page with tabs
function abeg_admin_tabs_page() {
    $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'general';
    ?>
    <div class="wrap abeg-admin-wrap">
        <h1><?php _e('Awesome Booking', 'awesome-booking'); ?></h1>

        <h2 class="nav-tab-wrapper abeg-tabs">
            <a href="?page=awb_dashboard&tab=general" class="nav-tab <?php echo $active_tab=='general' ? 'nav-tab-active' : ''; ?>">
                <?php _e('General', 'awesome-booking'); ?>
            </a>
            <a href="?page=awb_dashboard&tab=rooms" class="nav-tab <?php echo $active_tab=='rooms' ? 'nav-tab-active' : ''; ?>">
                <?php _e('Rooms', 'awesome-booking'); ?>
            </a>
            <a href="?page=awb_dashboard&tab=booking" class="nav-tab <?php echo $active_tab=='booking' ? 'nav-tab-active' : ''; ?>">
                <?php _e('Booking', 'awesome-booking'); ?>
            </a>
            <a href="?page=awb_dashboard&tab=analytics" class="nav-tab <?php echo $active_tab=='analytics' ? 'nav-tab-active' : ''; ?>">
                <?php _e('Analytics', 'awesome-booking'); ?>
            </a>
            <a href="?page=awb_dashboard&tab=shortcodes" class="nav-tab <?php echo $tab=='shortcodes'?'nav-tab-active':''; ?>"><?php _e('Shortcodes', 'awesome-booking'); ?></a>
        </h2>

        <div class="abeg-tab-content">
            <?php
            switch($active_tab){
                case 'general':
                    include ABEG_PLUGIN_PATH.'includes/admin/tabs/general.php';
                    break;
                case 'rooms':
                    include ABEG_PLUGIN_PATH.'includes/admin/tabs/rooms.php';
                    break;
                case 'booking':
                    include ABEG_PLUGIN_PATH.'includes/admin/tabs/booking.php';
                    break;
                case 'analytics':
                    include ABEG_PLUGIN_PATH.'includes/admin/tabs/analytics.php';
                    break;
                case 'shortcodes':
                    include ABEG_PLUGIN_PATH.'includes/admin/tabs/shortcodes.php';
                    break;
            }
            ?>
        </div>
    </div>
    <?php
}
