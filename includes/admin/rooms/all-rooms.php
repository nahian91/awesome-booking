<?php
if (!defined('ABSPATH')) exit;

global $wpdb;
$room_table = $wpdb->prefix . 'abeg_rooms';
$categories = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}abeg_room_categories");
$characteristics = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}abeg_room_characteristics");
$options = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}abeg_room_options");

// ---------------------
// Enqueue DataTables & Admin JS
// ---------------------
function abeg_admin_enqueue_scripts_rooms($hook)
{
    if (strpos($hook, 'abeg-rooms') === false) return;

    // DataTables CSS
    wp_enqueue_style('abeg-datatables-css', 'https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css');

    // DataTables JS (depends on jQuery)
    wp_enqueue_script('abeg-datatables-js', 'https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js', ['jquery'], false, true);

    // Inline initialization script
    wp_add_inline_script('abeg-datatables-js', "
        jQuery(document).ready(function($){
            if($('#abeg_rooms_table').length){
                $('#abeg_rooms_table').DataTable({
                    pageLength: 10,
                    responsive: true,
                    columnDefs: [{ orderable: false, targets: 7 }]
                });
            }
        });
    ");
}
add_action('admin_enqueue_scripts', 'abeg_admin_enqueue_scripts_rooms');

// ---------------------
// Handle Delete Room
// ---------------------
if (isset($_GET['delete_room'])) {
    $room_id = intval($_GET['delete_room']);
    $wpdb->delete($room_table, ['id' => $room_id]);
    echo '<div class="notice notice-success"><p>' . __('Room deleted successfully!', 'awesome-booking') . '</p></div>';
}

// ---------------------
// Check Edit Room
// ---------------------
$edit_room = null;
if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $edit_room = $wpdb->get_row("SELECT * FROM $room_table WHERE id=$edit_id");
}

// ---------------------
// Handle Add / Update Room
// ---------------------
if (isset($_POST['abeg_add_room'])) {
    $char_ids = isset($_POST['characteristics']) ? array_map('intval', $_POST['characteristics']) : [];
    $opt_ids = isset($_POST['options']) ? array_map('intval', $_POST['options']) : [];
    $main_image = intval($_POST['main_image']) ? wp_get_attachment_url(intval($_POST['main_image'])) : '';
    $extra_images = isset($_POST['extra_images']) ? maybe_serialize(explode(',', $_POST['extra_images'])) : '';
    $extra_captions = isset($_POST['extra_images_caption']) ? maybe_serialize($_POST['extra_images_caption']) : '';
    $adults_charges = isset($_POST['adults_charges']) ? maybe_serialize($_POST['adults_charges']) : '';

    $data = [
        'name' => sanitize_text_field($_POST['name']),
        'status' => in_array($_POST['status'], ['published', 'draft']) ? $_POST['status'] : 'draft',
        'units' => intval($_POST['units']),
        'adults_min' => intval($_POST['adults_min']),
        'adults_max' => intval($_POST['adults_max']),
        'children_min' => intval($_POST['children_min']),
        'children_max' => intval($_POST['children_max']),
        'total_people_min' => intval($_POST['total_min']),
        'total_people_max' => intval($_POST['total_max']),
        'category_id' => intval($_POST['category']),
        'characteristics' => maybe_serialize($char_ids),
        'options' => maybe_serialize($opt_ids),
        'last_units_threshold' => intval($_POST['last_units_threshold']),
        'suggested_occupancy' => sanitize_text_field($_POST['suggested_occupancy']),
        'custom_price' => floatval($_POST['custom_price']),
        'price_label' => sanitize_text_field($_POST['price_label']),
        'price_subtext' => wp_kses_post($_POST['price_subtext']),
        'enable_request_info' => isset($_POST['enable_request_info']) ? 1 : 0,
        'show_availability_calendar' => isset($_POST['show_availability_calendar']) ? 1 : 0,
        'show_seasons_calendar' => isset($_POST['show_seasons_calendar']) ? 1 : 0,
        'layout_style' => sanitize_text_field($_POST['layout_style']),
        'main_image' => $main_image,
        'extra_images' => $extra_images,
        'extra_images_captions' => $extra_captions,
        'adults_charges' => $adults_charges,
        'short_description' => sanitize_textarea_field($_POST['short_description']),
        'description' => wp_kses_post($_POST['description']),
        'enable_geocoding' => isset($_POST['enable_geocoding']) ? 1 : 0,
        'custom_page_title' => sanitize_text_field($_POST['custom_page_title']),
        'keywords_meta' => sanitize_text_field($_POST['keywords_meta']),
        'description_meta' => sanitize_textarea_field($_POST['description_meta']),
    ];

    if ($edit_room) {
        $wpdb->update($room_table, $data, ['id' => $edit_room->id]);
        echo '<div class="notice notice-success"><p>' . __('Room updated successfully!', 'awesome-booking') . '</p></div>';
    } else {
        $wpdb->insert($room_table, $data);
        echo '<div class="notice notice-success"><p>' . __('Room added successfully!', 'awesome-booking') . '</p></div>';
    }
}

// ---------------------
// Display Add/Edit Room Form
// ---------------------
if (isset($_GET['tab']) && $_GET['tab'] == 'add_room') : ?>
    <h2><?php echo $edit_room ? __('Edit Room', 'awesome-booking') : __('Add Room', 'awesome-booking'); ?></h2>
    <form method="post">
        <p><label><?php _e('Room Name', 'awesome-booking'); ?></label>
            <input type="text" name="name" required value="<?php echo esc_attr($edit_room->name ?? ''); ?>">
        </p>
        <p><label><?php _e('Status', 'awesome-booking'); ?></label>
            <select name="status">
                <option value="published" <?php selected($edit_room->status ?? '', 'published'); ?>><?php _e('Published / Available', 'awesome-booking'); ?></option>
                <option value="draft" <?php selected($edit_room->status ?? '', 'draft'); ?>><?php _e('Draft / Unavailable', 'awesome-booking'); ?></option>
            </select>
        </p>
        <p><label><?php _e('Units', 'awesome-booking'); ?></label>
            <input type="number" name="units" min="1" value="<?php echo esc_attr($edit_room->units ?? 1); ?>">
        </p>
        <p><label><?php _e('Adults Min / Max', 'awesome-booking'); ?></label>
            <input type="number" name="adults_min" min="1" value="<?php echo esc_attr($edit_room->adults_min ?? 1); ?>"> -
            <input type="number" name="adults_max" min="1" value="<?php echo esc_attr($edit_room->adults_max ?? 1); ?>">
        </p>
        <p><label><?php _e('Children Min / Max', 'awesome-booking'); ?></label>
            <input type="number" name="children_min" min="0" value="<?php echo esc_attr($edit_room->children_min ?? 0); ?>"> -
            <input type="number" name="children_max" min="0" value="<?php echo esc_attr($edit_room->children_max ?? 0); ?>">
        </p>
        <p><label><?php _e('Total People Min / Max', 'awesome-booking'); ?></label>
            <input type="number" name="total_min" min="1" value="<?php echo esc_attr($edit_room->total_people_min ?? 1); ?>"> -
            <input type="number" name="total_max" min="1" value="<?php echo esc_attr($edit_room->total_people_max ?? 1); ?>">
        </p>
        <p><label><?php _e('Category', 'awesome-booking'); ?></label>
            <select name="category">
                <option value="0"><?php _e('Select Category', 'awesome-booking'); ?></option>
                <?php foreach ($categories as $cat) echo '<option value="' . $cat->id . '" ' . selected($edit_room->category_id ?? 0, $cat->id, false) . '>' . esc_html($cat->name) . '</option>'; ?>
            </select>
        </p>

        <p><label><?php _e('Characteristics', 'awesome-booking'); ?></label><br>
            <?php
            $edit_chars = $edit_room ? maybe_unserialize($edit_room->characteristics) : [];
            foreach ($characteristics as $char) : ?>
                <label><input type="checkbox" name="characteristics[]" value="<?php echo $char->id; ?>" <?php echo in_array($char->id, $edit_chars) ? 'checked' : ''; ?>> <?php echo esc_html($char->name); ?></label>
            <?php endforeach; ?>
        </p>

        <p><label><?php _e('Options', 'awesome-booking'); ?></label><br>
            <?php
            $edit_opts = $edit_room ? maybe_unserialize($edit_room->options) : [];
            foreach ($options as $opt) : ?>
                <label><input type="checkbox" name="options[]" value="<?php echo $opt->id; ?>" <?php echo in_array($opt->id, $edit_opts) ? 'checked' : ''; ?>> <?php echo esc_html($opt->name); ?> (<?php echo esc_html($opt->price); ?>$)</label>
            <?php endforeach; ?>
        </p>

        <p><label><?php _e('Short Description', 'awesome-booking'); ?></label>
            <textarea name="short_description"><?php echo esc_textarea($edit_room->short_description ?? ''); ?></textarea>
        </p>
        <p><label><?php _e('Room Description', 'awesome-booking'); ?></label>
            <textarea name="description"><?php echo esc_textarea($edit_room->description ?? ''); ?></textarea>
        </p>

        <p><button type="submit" name="abeg_add_room" class="button button-primary"><?php echo $edit_room ? __('Update Room', 'awesome-booking') : __('Add Room', 'awesome-booking'); ?></button></p>
    </form>

<?php else : ?>
    <h2><?php _e('All Rooms', 'awesome-booking'); ?></h2>
    <table id="abeg_rooms_table" class="display" style="width:100%">
        <thead>
            <tr>
                <th><?php _e('ID', 'awesome-booking'); ?></th>
                <th><?php _e('Room Name', 'awesome-booking'); ?></th>
                <th><?php _e('Category', 'awesome-booking'); ?></th>
                <th><?php _e('Units', 'awesome-booking'); ?></th>
                <th><?php _e('Adults', 'awesome-booking'); ?></th>
                <th><?php _e('Children', 'awesome-booking'); ?></th>
                <th><?php _e('Status', 'awesome-booking'); ?></th>
                <th><?php _e('Actions', 'awesome-booking'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rooms = $wpdb->get_results("SELECT * FROM $room_table ORDER BY id DESC");
            foreach ($rooms as $room) :
                $cat_name = $room->category_id ? $wpdb->get_var("SELECT name FROM {$wpdb->prefix}abeg_room_categories WHERE id={$room->category_id}") : __('No Category', 'awesome-booking'); ?>
                <tr>
                    <td><?php echo intval($room->id); ?></td>
                    <td><?php echo esc_html($room->name); ?></td>
                    <td><?php echo esc_html($cat_name); ?></td>
                    <td><?php echo intval($room->units); ?></td>
                    <td><?php echo intval($room->adults_min) . ' - ' . intval($room->adults_max); ?></td>
                    <td><?php echo intval($room->children_min) . ' - ' . intval($room->children_max); ?></td>
                    <td><?php echo esc_html(ucfirst($room->status)); ?></td>
                    <td>
                        <a href="?page=abeg-rooms&tab=add_room&edit=<?php echo $room->id; ?>" class="button button-small"><?php _e('Edit', 'awesome-booking'); ?></a>
                        <a href="?page=abeg-rooms&tab=all_rooms&delete_room=<?php echo $room->id; ?>" class="button button-small" onclick="return confirm('<?php _e('Are you sure?', 'awesome-booking'); ?>')"><?php _e('Delete', 'awesome-booking'); ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
