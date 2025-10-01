<?php
add_action('save_post_abeg_booking','abeg_new_booking_email',10,3);
function abeg_new_booking_email($post_id, $post, $update){
    if($update) return;
    $admin_email = get_option('admin_email');
    $room_id = intval(get_post_meta($post_id,'abeg_room_id',true));
    $room = $room_id ? get_post($room_id)->post_title : 'N/A';
    $checkin = get_post_meta($post_id,'abeg_checkin',true);
    $checkout = get_post_meta($post_id,'abeg_checkout',true);
    $guests = intval(get_post_meta($post_id,'abeg_guests',true));
    $status = get_post_meta($post_id,'abeg_status',true) ?: 'Pending';
    $subject = "New Booking Created: #{$post_id}";
    $message = "Booking ID: {$post_id}\nRoom: {$room}\nCheck-in: {$checkin}\nCheck-out: {$checkout}\nGuests: {$guests}\nStatus: {$status}\nView: ".admin_url("post.php?post={$post_id}&action=edit");
    wp_mail($admin_email, $subject, $message);
}

add_action('update_post_meta', 'abeg_booking_status_email', 10, 4);
function abeg_booking_status_email($meta_id, $post_id, $meta_key, $meta_value){
    if($meta_key !== 'abeg_status') return;
    $post_type = get_post_type($post_id);
    if($post_type != 'abeg_booking') return;
    $old_status = get_metadata('post', $post_id, 'abeg_status', true);
    if($old_status == $meta_value) return;

    $room_id = intval(get_post_meta($post_id,'abeg_room_id',true));
    $room = $room_id ? get_post($room_id)->post_title : 'N/A';
    $checkin = get_post_meta($post_id,'abeg_checkin',true);
    $checkout = get_post_meta($post_id,'abeg_checkout',true);
    $guests = intval(get_post_meta($post_id,'abeg_guests',true));

    $admin_email = get_option('admin_email');
    $subject_admin = "Booking #{$post_id} Status Updated";
    $message_admin = "Booking #{$post_id} status changed to {$meta_value}.\nRoom: {$room}\nCheck-in: {$checkin}\nCheck-out: {$checkout}\nGuests: {$guests}\nView: ".admin_url("post.php?post={$post_id}&action=edit");
    wp_mail($admin_email, $subject_admin, $message_admin);

    $customer_email = get_post_meta($post_id,'abeg_customer_email',true);
    if($customer_email){
        $subject_customer = "Your Booking #{$post_id} is {$meta_value}";
        $message_customer = "Dear Customer,\nYour booking for room '{$room}' from {$checkin} to {$checkout} has been {$meta_value}.\nGuests: {$guests}\nThank you!";
        wp_mail($customer_email, $subject_customer, $message_customer);
    }
}
