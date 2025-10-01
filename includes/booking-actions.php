<?php
add_action('admin_post_abeg_update_booking_status','abeg_update_booking_status');
function abeg_update_booking_status(){
    if(!current_user_can('manage_options') || !isset($_GET['booking_id']) || !isset($_GET['status'])) wp_die('Unauthorized');
    $booking_id = intval($_GET['booking_id']);
    $status = sanitize_text_field($_GET['status']);
    if(in_array($status,['Confirmed','Cancelled'])){
        update_post_meta($booking_id,'abeg_status',$status);
        wp_redirect(admin_url('admin.php?page=abeg_dashboard'));
        exit;
    }
}

add_action('pre_get_posts','abeg_filter_bookings');
function abeg_filter_bookings($query){
    if(is_admin() && $query->is_main_query() && $query->get('post_type')=='abeg_booking'){
        $meta_query=[];
        if(isset($_GET['abeg_checkin_filter'])) $meta_query[]=['key'=>'abeg_checkin','value'=>sanitize_text_field($_GET['abeg_checkin_filter']),'compare'=>'='];
        if(isset($_GET['abeg_status_filter'])) $meta_query[]=['key'=>'abeg_status','value'=>sanitize_text_field($_GET['abeg_status_filter']),'compare'=>'='];
        if(isset($_GET['abeg_room_filter'])) $meta_query[]=['key'=>'abeg_room_id','value'=>intval($_GET['abeg_room_filter']),'compare'=>'='];
        if($meta_query) $query->set('meta_query',$meta_query);
    }
}
