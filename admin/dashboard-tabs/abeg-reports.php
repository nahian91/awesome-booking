<?php
if(!defined('ABSPATH')) exit;
global $wpdb;
$table = $wpdb->prefix.'abeg_bookings';
$bookings = $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC LIMIT 20");
echo '<h2>Recent Bookings</h2>';
echo '<table class="widefat striped"><thead><tr><th>ID</th><th>Room</th><th>User</th><th>Dates</th><th>Status</th><th>Created</th></tr></thead><tbody>';
foreach($bookings as $b){
    echo '<tr>';
    echo '<td>'.$b->id.'</td>';
    echo '<td>'.get_the_title($b->room_id).'</td>';
    echo '<td>'.esc_html($b->user_name).' <'.$b->user_email.'></td>';
    echo '<td>'.implode(',', maybe_unserialize($b->booking_dates)).'</td>';
    echo '<td>'.$b->status.'</td>';
    echo '<td>'.$b->created_at.'</td>';
    echo '</tr>';
}
echo '</tbody></table>';
