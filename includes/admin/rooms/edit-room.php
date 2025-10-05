<?php
if (!defined('ABSPATH')) exit;

global $wpdb;
$table = $wpdb->prefix.'abeg_rooms';
$room_id = intval($_GET['id']);
$room = $wpdb->get_row("SELECT * FROM $table WHERE id=$room_id");

if(!$room){
    echo '<p>'.__('Room not found', 'awesome-booking').'</p>';
    return;
}

// Handle update
if(isset($_POST['abeg_update_room'])){
    $wpdb->update($table, [
        'name' => sanitize_text_field($_POST['name']),
        'price' => floatval($_POST['price']),
        'max_occupancy' => intval($_POST['max_occupancy']),
        'category_id' => intval($_POST['category']),
        'description' => sanitize_textarea_field($_POST['description'])
    ], ['id'=>$room_id]);

    echo '<div class="notice notice-success"><p>'.__('Room updated successfully!', 'awesome-booking').'</p></div>';
}

// Get categories
$categories = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}abeg_room_categories");
?>
<form method="post">
    <p>
        <label><?php _e('Room Name', 'awesome-booking'); ?></label>
        <input type="text" name="name" value="<?php echo esc_attr($room->name); ?>" required>
    </p>
    <p>
        <label><?php _e('Price per Night', 'awesome-booking'); ?></label>
        <input type="number" name="price" step="0.01" value="<?php echo esc_attr($room->price); ?>" required>
    </p>
    <p>
        <label><?php _e('Max Occupancy', 'awesome-booking'); ?></label>
        <input type="number" name="max_occupancy" value="<?php echo esc_attr($room->max_occupancy); ?>" required>
    </p>
    <p>
        <label><?php _e('Category', 'awesome-booking'); ?></label>
        <select name="category">
            <option value="0"><?php _e('Select Category', 'awesome-booking'); ?></option>
            <?php foreach($categories as $cat){
                $selected = $room->category_id == $cat->id ? 'selected' : '';
                echo '<option value="'.esc_attr($cat->id).'" '.$selected.'>'.esc_html($cat->name).'</option>';
            } ?>
        </select>
    </p>
    <p>
        <label><?php _e('Description', 'awesome-booking'); ?></label>
        <textarea name="description"><?php echo esc_textarea($room->description); ?></textarea>
    </p>
    <p>
        <button type="submit" name="abeg_update_room" class="button button-primary"><?php _e('Update Room', 'awesome-booking'); ?></button>
    </p>
</form>
