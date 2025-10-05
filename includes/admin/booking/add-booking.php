<?php
if (!defined('ABSPATH')) exit;
?>
<div class="wrap">
    <h2><?php _e('Add New Booking', 'awesome-booking'); ?></h2>
    <form method="post" action="">
        <table class="form-table">
            <tr>
                <th><label><?php _e('Customer Name', 'awesome-booking'); ?></label></th>
                <td><input type="text" name="abeg_customer" class="regular-text"></td>
            </tr>
            <tr>
                <th><label><?php _e('Room', 'awesome-booking'); ?></label></th>
                <td>
                    <select name="abeg_room">
                        <option>Deluxe Suite</option>
                        <option>Standard Room</option>
                        <option>Family Room</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label><?php _e('Check-in Date', 'awesome-booking'); ?></label></th>
                <td><input type="date" name="abeg_checkin"></td>
            </tr>
            <tr>
                <th><label><?php _e('Check-out Date', 'awesome-booking'); ?></label></th>
                <td><input type="date" name="abeg_checkout"></td>
            </tr>
            <tr>
                <th><label><?php _e('Total Amount', 'awesome-booking'); ?></label></th>
                <td><input type="number" name="abeg_amount" step="0.01"></td>
            </tr>
            <tr>
                <th><label><?php _e('Status', 'awesome-booking'); ?></label></th>
                <td>
                    <select name="abeg_status">
                        <option>Pending</option>
                        <option>Confirmed</option>
                        <option>Cancelled</option>
                    </select>
                </td>
            </tr>
        </table>
        <p><input type="submit" class="button-primary" value="<?php _e('Save Booking', 'awesome-booking'); ?>"></p>
    </form>
</div>
