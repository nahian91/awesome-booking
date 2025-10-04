<?php
if(!defined('ABSPATH')) exit;

/**
 * Frontend: Get unavailable dates for a room
 */
add_action('wp_ajax_abeg_get_unavailable_dates','abeg_get_unavailable_dates');
add_action('wp_ajax_nopriv_abeg_get_unavailable_dates','abeg_get_unavailable_dates');

function abeg_get_unavailable_dates(){
    global $wpdb;
    $room_id = intval($_POST['room_id'] ?? 0);
    if(!$room_id) wp_send_json_success([]);

    $table = $wpdb->prefix.'abeg_bookings';
    $results = $wpdb->get_col($wpdb->prepare(
        "SELECT booking_dates FROM $table WHERE room_id=%d AND status IN ('pending','confirmed')",
        $room_id
    ));

    $dates = [];
    foreach($results as $row){
        $dates = array_merge($dates, maybe_unserialize($row));
    }

    wp_send_json_success($dates);
}

/**
 * Frontend: Add a booking
 */
add_action('wp_ajax_abeg_add_booking','abeg_add_booking');
add_action('wp_ajax_nopriv_abeg_add_booking','abeg_add_booking');

function abeg_add_booking(){
    global $wpdb;

    $room_id = intval($_POST['room_id'] ?? 0);
    $user_name = sanitize_text_field($_POST['user_name'] ?? '');
    $user_email = sanitize_email($_POST['user_email'] ?? '');
    $dates = array_map('sanitize_text_field', $_POST['dates'] ?? []);

    if(!$room_id || !$user_name || !$user_email || empty($dates)){
        wp_send_json_error('Invalid input');
    }

    // Check availability
    $table = $wpdb->prefix.'abeg_bookings';
    $existing = $wpdb->get_col($wpdb->prepare(
        "SELECT booking_dates FROM $table WHERE room_id=%d AND status IN ('pending','confirmed')",
        $room_id
    ));

    $all_booked = [];
    foreach($existing as $row){
        $all_booked = array_merge($all_booked, maybe_unserialize($row));
    }

    foreach($dates as $d){
        if(in_array($d, $all_booked)){
            wp_send_json_error("Date $d is already booked.");
        }
    }

    // Insert booking
    $wpdb->insert($table, [
        'room_id' => $room_id,
        'user_name' => $user_name,
        'user_email' => $user_email,
        'booking_dates' => maybe_serialize($dates),
        'status' => 'pending',
        'created_at' => current_time('mysql')
    ]);

    wp_send_json_success('Booking successfully submitted!');
}

/**
 * Admin: Change booking status
 */
add_action('wp_ajax_abeg_change_status', function(){
    global $wpdb;

    $id = intval($_POST['id'] ?? 0);
    $status = sanitize_text_field($_POST['status'] ?? '');

    if(!$id || !in_array($status, ['pending','confirmed','cancelled'])){
        wp_send_json_error('Invalid status');
    }

    $table = $wpdb->prefix.'abeg_bookings';
    $wpdb->update($table, ['status'=>$status], ['id'=>$id]);

    wp_send_json_success('Status updated');
});

/**
 * Admin: Calendar AJAX (optional)
 */
add_action('wp_ajax_abeg_get_bookings_calendar', function(){
    global $wpdb;
    $month = intval($_POST['month'] ?? date('n'));
    $year = intval($_POST['year'] ?? date('Y'));

    $table = $wpdb->prefix.'abeg_bookings';
    $bookings = $wpdb->get_results("SELECT * FROM $table WHERE status IN ('pending','confirmed')");

    $booked_dates = [];
    foreach($bookings as $b){
        foreach(maybe_unserialize($b->booking_dates) as $d){
            $booked_dates[$d] = get_the_title($b->room_id);
        }
    }

    // Simple calendar output
    $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    echo '<div class="abeg-calendar-nav">';
    echo '<strong>'.date('F Y', strtotime("$year-$month-01")).'</strong>';
    echo '</div><table class="widefat striped"><tr>';
    for($d=1;$d<=$days_in_month;$d++){
        $date_str = sprintf('%04d-%02d-%02d',$year,$month,$d);
        $class = isset($booked_dates[$date_str]) ? 'abeg-booked' : '';
        echo '<td class="'.$class.'">'.$d.'</td>';
        if($d % 7 === 0) echo '</tr><tr>';
    }
    echo '</tr></table>';
    wp_die();
});
