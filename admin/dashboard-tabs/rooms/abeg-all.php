<?php
if(!defined('ABSPATH')) exit;
$rooms = get_posts(['post_type'=>'abeg_room','posts_per_page'=>-1]);
echo '<h2>All Rooms</h2>';
echo '<table class="widefat striped"><thead><tr><th>Room</th><th>Price</th><th>Actions</th></tr></thead><tbody>';
foreach($rooms as $room){
    $price = get_post_meta($room->ID,'_abeg_room_price',true);
    $edit_link = get_edit_post_link($room->ID);
    echo '<tr>';
    echo '<td>'.esc_html($room->post_title).'</td>';
    echo '<td>'.esc_html($price).'</td>';
    echo '<td><a href="'.esc_url($edit_link).'">Edit</a></td>';
    echo '</tr>';
}
echo '</tbody></table>';
