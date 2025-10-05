<?php
if (!defined('ABSPATH')) exit;
?>
<div class="wrap">
    <h2><?php _e('All Bookings', 'awesome-booking'); ?></h2>

    <table id="bookings-table" class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th><?php _e('Booking ID', 'awesome-booking'); ?></th>
                <th><?php _e('Customer', 'awesome-booking'); ?></th>
                <th><?php _e('Room', 'awesome-booking'); ?></th>
                <th><?php _e('Check-in', 'awesome-booking'); ?></th>
                <th><?php _e('Check-out', 'awesome-booking'); ?></th>
                <th><?php _e('Status', 'awesome-booking'); ?></th>
                <th><?php _e('Amount', 'awesome-booking'); ?></th>
                <th><?php _e('Actions', 'awesome-booking'); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#BK001</td>
                <td>John Doe</td>
                <td>Deluxe Suite</td>
                <td>2025-10-08</td>
                <td>2025-10-10</td>
                <td><span class="abeg-status-complete">Completed</span></td>
                <td>$240</td>
                <td><a href="#" class="button">View</a></td>
            </tr>
            <tr>
                <td>#BK002</td>
                <td>Sarah Khan</td>
                <td>Standard Room</td>
                <td>2025-10-05</td>
                <td>2025-10-07</td>
                <td><span class="abeg-status-pending">Pending</span></td>
                <td>$160</td>
                <td><a href="#" class="button">View</a></td>
            </tr>
        </tbody>
    </table>
</div>

<style>
.abeg-status-complete { color: #0a0; font-weight: 600; }
.abeg-status-pending { color: #e90; font-weight: 600; }
</style>

<script>
jQuery(document).ready(function($){
    $('#bookings-table').DataTable();
});
</script>
