<?php
if(!defined('ABSPATH')) exit;
global $wpdb;
$table = $wpdb->prefix.'abeg_bookings';
$bookings = $wpdb->get_results("SELECT * FROM $table WHERE status='confirmed' ORDER BY created_at DESC");
echo '<h2>Confirmed Bookings</h2>';
foreach($bookings as $b){
    echo '<p>'.$b->user_name.' - '.get_the_title($b->room_id).' - '.implode(', ', maybe_unserialize($b->booking_dates)).'</p>';
}
