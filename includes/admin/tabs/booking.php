<?php
if (!defined('ABSPATH')) exit;

$sub_tab = isset($_GET['sub']) ? sanitize_text_field($_GET['sub']) : 'all-bookings';
?>
<div class="wrap">
    <h2><?php _e('Booking Management', 'awesome-booking'); ?></h2>

    <h2 class="nav-tab-wrapper abeg-sub-tabs">
        <a href="?page=awb_dashboard&tab=booking&sub=all-bookings" class="nav-tab <?php echo $sub_tab=='all-bookings' ? 'nav-tab-active' : ''; ?>">
            <?php _e('All Bookings', 'awesome-booking'); ?>
        </a>
        <a href="?page=awb_dashboard&tab=booking&sub=add-booking" class="nav-tab <?php echo $sub_tab=='add-booking' ? 'nav-tab-active' : ''; ?>">
            <?php _e('Add Booking', 'awesome-booking'); ?>
        </a>
        <a href="?page=awb_dashboard&tab=booking&sub=calendar" class="nav-tab <?php echo $sub_tab=='calendar' ? 'nav-tab-active' : ''; ?>">
            <?php _e('Calendar View', 'awesome-booking'); ?>
        </a>
        <a href="?page=awb_dashboard&tab=booking&sub=payments" class="nav-tab <?php echo $sub_tab=='payments' ? 'nav-tab-active' : ''; ?>">
            <?php _e('Payments', 'awesome-booking'); ?>
        </a>
    </h2>

    <div class="abeg-tab-content">
        <?php
        switch ($sub_tab) {
            case 'all-bookings':
                include ABEG_PLUGIN_PATH . 'includes/admin/booking/all-bookings.php';
                break;
            case 'add-booking':
                include ABEG_PLUGIN_PATH . 'includes/admin/booking/add-booking.php';
                break;
            case 'calendar':
                include ABEG_PLUGIN_PATH . 'includes/admin/booking/calendar.php';
                break;
            case 'payments':
                include ABEG_PLUGIN_PATH . 'includes/admin/booking/payments.php';
                break;
        }
        ?>
    </div>
</div>
