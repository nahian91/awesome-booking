<?php
if(!defined('ABSPATH')) exit;
$rooms = get_posts(['post_type'=>'abeg_room','posts_per_page'=>-1]);
?>
<div class="abeg-room-picker">
    <h3 class="abeg-room-picker__title">Select Room & Dates</h3>
    <form id="abeg-room-booking-form">
        <input type="text" name="user_name" placeholder="Your Name" class="abeg-input" required>
        <input type="email" name="user_email" placeholder="Your Email" class="abeg-input" required>
        <select id="abeg_room_id" class="abeg-input" required>
            <option value="">-- Select Room --</option>
            <?php foreach($rooms as $room): ?>
                <option value="<?php echo esc_attr($room->ID); ?>"><?php echo esc_html($room->post_title); ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" id="abeg_booking_dates" name="dates[]" class="abeg-input" placeholder="Select Dates" required>
        <button type="submit" class="abeg-btn">Book Now</button>
    </form>
    <div id="abeg-room-booking-msg"></div>
</div>
