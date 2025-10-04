<?php
if(!defined('ABSPATH')) exit;

add_action('admin_menu', function(){
    add_menu_page(
        'Awesome Booking',
        'Awesome Booking',
        'manage_options',
        'abeg-dashboard',
        'abeg_render_dashboard_page',
        'dashicons-hotel',
        50
    );
});

function abeg_render_dashboard_page(){
    $tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'overview';
    ?>
    <div class="wrap abeg-dashboard">
        <h1 class="abeg-dashboard__title">Awesome Booking</h1>
        <h2 class="nav-tab-wrapper abeg-tabs">
            <a href="?page=abeg-dashboard&tab=overview" class="nav-tab <?php echo $tab==='overview'?'nav-tab-active':''; ?>">Overview</a>
            <a href="?page=abeg-dashboard&tab=rooms" class="nav-tab <?php echo $tab==='rooms'?'nav-tab-active':''; ?>">Rooms</a>
            <a href="?page=abeg-dashboard&tab=bookings" class="nav-tab <?php echo $tab==='bookings'?'nav-tab-active':''; ?>">Bookings</a>
            <a href="?page=abeg-dashboard&tab=settings" class="nav-tab <?php echo $tab==='settings'?'nav-tab-active':''; ?>">Settings</a>
            <a href="?page=abeg-dashboard&tab=reports" class="nav-tab <?php echo $tab==='reports'?'nav-tab-active':''; ?>">Reports</a>
        </h2>
        <div class="abeg-dashboard__content">
            <?php
            $file = ABEG_PATH."admin/dashboard-tabs/abeg-{$tab}.php";
            if(file_exists($file)) include $file;
            else echo '<p class="abeg-error">Invalid tab selected.</p>';
            ?>
        </div>
    </div>
    <?php
}
