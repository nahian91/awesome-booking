<?php
if (!defined('ABSPATH')) exit;
?>
<div class="wrap">
    <h2><?php _e('Customers List', 'awesome-booking'); ?></h2>
    <p>Below is a list of registered hotel booking customers.</p>

    <table id="customers-table" class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th><?php _e('ID', 'awesome-booking'); ?></th>
                <th><?php _e('Name', 'awesome-booking'); ?></th>
                <th><?php _e('Email', 'awesome-booking'); ?></th>
                <th><?php _e('Phone', 'awesome-booking'); ?></th>
                <th><?php _e('Total Bookings', 'awesome-booking'); ?></th>
                <th><?php _e('Action', 'awesome-booking'); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>john@example.com</td>
                <td>+8801700000000</td>
                <td>3</td>
                <td><a href="#" class="button">View</a></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Sarah Khan</td>
                <td>sarah@example.com</td>
                <td>+8801800000000</td>
                <td>2</td>
                <td><a href="#" class="button">View</a></td>
            </tr>
        </tbody>
    </table>
</div>

<script>
jQuery(document).ready(function($){
    $('#customers-table').DataTable();
});
</script>
