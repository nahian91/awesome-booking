<?php
if(!defined('ABSPATH')) exit;
global $wpdb;
$table = $wpdb->prefix.'abeg_bookings';
$total = $wpdb->get_var("SELECT COUNT(*) FROM $table");
$pending = $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE status='pending'");
$confirmed = $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE status='confirmed'");
$cancelled = $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE status='cancelled'");
?>
<h2>Overview</h2>
<div class="abeg-stats">
    <div class="abeg-stat"><strong>Total Bookings:</strong> <?php echo $total; ?></div>
    <div class="abeg-stat"><strong>Pending:</strong> <?php echo $pending; ?></div>
    <div class="abeg-stat"><strong>Confirmed:</strong> <?php echo $confirmed; ?></div>
    <div class="abeg-stat"><strong>Cancelled:</strong> <?php echo $cancelled; ?></div>
</div>
