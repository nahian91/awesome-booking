<?php
if(!defined('ABSPATH')) exit;
global $wpdb;
$table = $wpdb->prefix.'abeg_bookings';
$bookings = $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC");
echo '<h2>All Bookings</h2>';
echo '<table class="widefat striped"><thead><tr><th>ID</th><th>Room</th><th>User</th><th>Dates</th><th>Status</th><th>Actions</th></tr></thead><tbody>';
foreach($bookings as $b){
    echo '<tr>';
    echo '<td>'.$b->id.'</td>';
    echo '<td>'.get_the_title($b->room_id).'</td>';
    echo '<td>'.esc_html($b->user_name).' <'.$b->user_email.'></td>';
    echo '<td>'.implode(', ', maybe_unserialize($b->booking_dates)).'</td>';
    echo '<td>'.$b->status.'</td>';
    echo '<td>
        <button class="button abeg-change-status" data-id="'.$b->id.'" data-status="confirmed">Confirm</button>
        <button class="button abeg-change-status" data-id="'.$b->id.'" data-status="cancelled">Cancel</button>
    </td>';
    echo '</tr>';
}
echo '</tbody></table>';
?>
<script>
jQuery(document).ready(function($){
    $('.abeg-change-status').click(function(){
        let btn=$(this);
        $.post(ajaxurl,{
            action:'abeg_change_status',
            id: btn.data('id'),
            status: btn.data('status')
        },function(r){
            if(r.success) location.reload();
            else alert('Error');
        });
    });
});
</script>
