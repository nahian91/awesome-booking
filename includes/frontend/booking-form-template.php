<div class="abeg-booking-form-wrap">
    <form id="abeg-booking-form" method="post">
        <h2><?php _e('Book a Room', 'awesome-booking'); ?></h2>

        <!-- Room Selection -->
        <p>
            <label for="abeg_room"><?php _e('Select Room', 'awesome-booking'); ?></label>
            <select id="abeg_room" name="abeg_room" required>
                <option value=""><?php _e('Select a room', 'awesome-booking'); ?></option>
                <?php
                $rooms = get_posts(['post_type'=>'rooms','numberposts'=>-1]);
                foreach($rooms as $room) {
                    echo '<option value="'.esc_attr($room->ID).'">'.esc_html($room->post_title).'</option>';
                }
                ?>
            </select>
        </p>

        <!-- Check-in & Check-out -->
        <p>
            <label for="abeg_checkin"><?php _e('Check-in Date', 'awesome-booking'); ?></label>
            <input type="text" id="abeg_checkin" name="abeg_checkin" required placeholder="YYYY-MM-DD">
        </p>
        <p>
            <label for="abeg_checkout"><?php _e('Check-out Date', 'awesome-booking'); ?></label>
            <input type="text" id="abeg_checkout" name="abeg_checkout" required placeholder="YYYY-MM-DD">
        </p>

        <!-- Guests -->
        <p>
            <label for="abeg_guests"><?php _e('Guests', 'awesome-booking'); ?></label>
            <input type="number" id="abeg_guests" name="abeg_guests" value="1" min="1" required>
        </p>

        <!-- Total Price -->
        <p>
            <label><?php _e('Total Price', 'awesome-booking'); ?></label>
            <span id="abeg_total_price">$0</span>
        </p>

        <p>
            <button type="submit" class="button button-primary"><?php _e('Book Now', 'awesome-booking'); ?></button>
        </p>
    </form>

    <div id="abeg_booking_message"></div>
</div>
