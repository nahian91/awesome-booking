<?php
if (!defined('ABSPATH')) exit;

// List all shortcodes
$shortcodes = [
    ['label' => 'All Rooms', 'code' => '[abeg_all_rooms]'],
    ['label' => 'Room Search Form', 'code' => '[abeg_room_search]'],
    ['label' => 'Booking Form', 'code' => '[abeg_booking_form]'],
    ['label' => 'Room Categories', 'code' => '[abeg_room_categories]'],
];
?>

<h2><?php _e('Available Shortcodes', 'awesome-booking'); ?></h2>

<table class="widefat fixed striped">
    <thead>
        <tr>
            <th><?php _e('Shortcode Name', 'awesome-booking'); ?></th>
            <th><?php _e('Shortcode', 'awesome-booking'); ?></th>
            <th><?php _e('Action', 'awesome-booking'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($shortcodes as $sc): ?>
        <tr>
            <td><?php echo esc_html($sc['label']); ?></td>
            <td><input type="text" readonly value="<?php echo esc_attr($sc['code']); ?>" class="abeg-shortcode-input"></td>
            <td><button class="button abeg-copy-shortcode"><?php _e('Copy', 'awesome-booking'); ?></button></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
jQuery(document).ready(function($){
    $('.abeg-copy-shortcode').click(function(){
        var input = $(this).closest('tr').find('.abeg-shortcode-input')[0];
        input.select();
        input.setSelectionRange(0, 99999); // mobile
        document.execCommand("copy");
        alert('<?php _e("Shortcode copied!", "awesome-booking"); ?>');
    });
});
</script>
