<?php
if (!defined('ABSPATH')) exit;

add_action('admin_menu', 'abeg_admin_menu');

function abeg_admin_menu() {
    add_menu_page(
        __('Awesome Booking', 'awesome-booking'),
        __('Awesome Booking', 'awesome-booking'),
        'manage_options',
        'awb_dashboard',
        'abeg_admin_tabs_page',
        'dashicons-admin-home',
        56
    );
}

function abeg_admin_tabs_page() {
    $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'general';
    ?>
    <div class="wrap abeg-admin-wrap">
        <h1><?php _e('Awesome Booking', 'awesome-booking'); ?></h1>

        <h2 class="nav-tab-wrapper abeg-tabs">
            <a href="?page=awb_dashboard&tab=general" class="nav-tab <?php echo $active_tab=='general'?'nav-tab-active':''; ?>">General</a>
            <a href="?page=awb_dashboard&tab=rooms" class="nav-tab <?php echo $active_tab=='rooms'?'nav-tab-active':''; ?>">Rooms</a>
            <a href="?page=awb_dashboard&tab=booking" class="nav-tab <?php echo $active_tab=='booking'?'nav-tab-active':''; ?>">Booking</a>
            <a href="?page=awb_dashboard&tab=management" class="nav-tab <?php echo $active_tab=='management'?'nav-tab-active':''; ?>">Management</a>
            <a href="?page=awb_dashboard&tab=payments" class="nav-tab <?php echo $active_tab=='payments'?'nav-tab-active':''; ?>">Payments</a>
            <a href="?page=awb_dashboard&tab=shortcodes" class="nav-tab <?php echo $active_tab=='shortcodes'?'nav-tab-active':''; ?>">Shortcodes</a>
            <a href="?page=awb_dashboard&tab=settings" class="nav-tab <?php echo $active_tab=='settings'?'nav-tab-active':''; ?>">Settings</a>
        </h2>

        <div class="abeg-tab-content">
            <?php
            switch($active_tab){
                case 'payments':
                    include ABEG_PLUGIN_PATH.'includes/admin/tabs/payments.php';
                    break;
                case 'settings':
                    include ABEG_PLUGIN_PATH.'includes/admin/tabs/settings.php';
                    break;
                case 'rooms':
                    include ABEG_PLUGIN_PATH.'includes/admin/tabs/rooms/all-rooms.php';
                    break;
                case 'booking':
                    include ABEG_PLUGIN_PATH.'includes/admin/tabs/bookings/all-bookings.php';
                    break;
                case 'management':
                    include ABEG_PLUGIN_PATH.'includes/admin/tabs/management/customers.php';
                    break;
                default:
                    include ABEG_PLUGIN_PATH.'includes/admin/tabs/general.php';
                    break;
            }
            ?>
        </div>
    </div>
<?php
}
