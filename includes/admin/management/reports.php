<?php
if (!defined('ABSPATH')) exit;
?>
<div class="wrap">
    <h2><?php _e('Reports Overview', 'awesome-booking'); ?></h2>
    <p>Get an overview of booking statistics and revenue performance.</p>

    <div class="abeg-reports">
        <div class="abeg-report-card">
            <h3>Total Bookings</h3>
            <p><strong>154</strong></p>
        </div>
        <div class="abeg-report-card">
            <h3>Total Revenue</h3>
            <p><strong>$12,480</strong></p>
        </div>
        <div class="abeg-report-card">
            <h3>Average Booking Value</h3>
            <p><strong>$81</strong></p>
        </div>
        <div class="abeg-report-card">
            <h3>Cancelled Bookings</h3>
            <p><strong>9</strong></p>
        </div>
    </div>

    <table id="report-table" class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th><?php _e('Booking ID', 'awesome-booking'); ?></th>
                <th><?php _e('Customer', 'awesome-booking'); ?></th>
                <th><?php _e('Room', 'awesome-booking'); ?></th>
                <th><?php _e('Amount', 'awesome-booking'); ?></th>
                <th><?php _e('Status', 'awesome-booking'); ?></th>
                <th><?php _e('Date', 'awesome-booking'); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#1001</td>
                <td>John Doe</td>
                <td>Deluxe Suite</td>
                <td>$250</td>
                <td>Completed</td>
                <td>2025-10-02</td>
            </tr>
            <tr>
                <td>#1002</td>
                <td>Sarah Khan</td>
                <td>Standard Room</td>
                <td>$120</td>
                <td>Pending</td>
                <td>2025-10-03</td>
            </tr>
        </tbody>
    </table>
</div>

<style>
.abeg-reports {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}
.abeg-report-card {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    width: 220px;
    text-align: center;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.abeg-report-card h3 {
    margin: 0;
    font-size: 15px;
}
.abeg-report-card p {
    font-size: 20px;
    margin: 5px 0 0;
}
</style>

<script>
jQuery(document).ready(function($){
    $('#report-table').DataTable();
});
</script>
