<?php
if(!defined('ABSPATH')) exit;

// Detect sub-tab
$sub_tab = isset($_GET['sub']) ? sanitize_text_field($_GET['sub']) : 'all';

// Allowed sub-tabs
$allowed_tabs = ['all','pending','confirmed','cancelled','calendar'];

// Fallback to 'all' if invalid
if(!in_array($sub_tab, $allowed_tabs)){
    $sub_tab = 'all';
}
?>

<h2 class="nav-tab-wrapper abeg-sub-tabs">
    <a href="?page=abeg-dashboard&tab=bookings&sub=all" class="nav-tab <?php echo $sub_tab==='all'?'nav-tab-active':''; ?>">All</a>
    <a href="?page=abeg-dashboard&tab=bookings&sub=pending" class="nav-tab <?php echo $sub_tab==='pending'?'nav-tab-active':''; ?>">Pending</a>
    <a href="?page=abeg-dashboard&tab=bookings&sub=confirmed" class="nav-tab <?php echo $sub_tab==='confirmed'?'nav-tab-active':''; ?>">Confirmed</a>
    <a href="?page=abeg-dashboard&tab=bookings&sub=cancelled" class="nav-tab <?php echo $sub_tab==='cancelled'?'nav-tab-active':''; ?>">Cancelled</a>
    <a href="?page=abeg-dashboard&tab=bookings&sub=calendar" class="nav-tab <?php echo $sub_tab==='calendar'?'nav-tab-active':''; ?>">Calendar</a>
</h2>

<div class="abeg-booking__content">
<?php
// Direct load files safely
if($sub_tab === 'all'){
    include ABEG_PATH . 'admin/dashboard-tabs/bookings/abeg-all.php';
} elseif($sub_tab === 'pending'){
    include ABEG_PATH . 'admin/dashboard-tabs/bookings/abeg-pending.php';
} elseif($sub_tab === 'confirmed'){
    include ABEG_PATH . 'admin/dashboard-tabs/bookings/abeg-confirmed.php';
} elseif($sub_tab === 'cancelled'){
    include ABEG_PATH . 'admin/dashboard-tabs/bookings/abeg-cancelled.php';
} elseif($sub_tab === 'calendar'){
    include ABEG_PATH . 'admin/dashboard-tabs/bookings/abeg-calendar.php';
} else {
    echo '<p class="abeg-error">Invalid sub-tab selected.</p>';
}
?>
</div>
