<?php
if (!defined('ABSPATH')) exit;
?>
<div class="wrap">
    <h2><?php _e('Payments Overview', 'awesome-booking'); ?></h2>
    <table id="payments-table" class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th><?php _e('Payment ID', 'awesome-booking'); ?></th>
                <th><?php _e('Booking ID', 'awesome-booking'); ?></th>
                <th><?php _e('Customer', 'awesome-booking'); ?></th>
                <th><?php _e('Amount', 'awesome-booking'); ?></th>
                <th><?php _e('Method', 'awesome-booking'); ?></th>
                <th><?php _e('Date', 'awesome-booking'); ?></th>
                <th><?php _e('Status', 'awesome-booking'); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#PMT001</td>
                <td>#BK001</td>
                <td>John Doe</td>
                <td>$240</td>
                <td>Credit Card</td>
                <td>2025-10-01</td>
                <td>Completed</td>
            </tr>
            <tr>
                <td>#PMT002</td>
                <td>#BK002</td>
                <td>Sarah Khan</td>
                <td>$160</td>
                <td>bKash</td>
                <td>2025-10-02</td>
                <td>Pending</td>
            </tr>
        </tbody>
    </table>
</div>

<script>
jQuery(document).ready(function($){
    $('#payments-table').DataTable();
});
</script>
