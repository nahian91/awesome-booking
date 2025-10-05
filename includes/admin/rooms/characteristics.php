<?php
if (!defined('ABSPATH')) exit;

global $wpdb;

// Table for characteristics
$table = $wpdb->prefix.'abeg_room_characteristics';
$wpdb->query("CREATE TABLE IF NOT EXISTS $table (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    PRIMARY KEY(id)
) {$wpdb->get_charset_collate()}");

// Handle Add
if(isset($_POST['abeg_add_characteristic'])){
    $wpdb->insert($table, [
        'name' => sanitize_text_field($_POST['name']),
        'description' => sanitize_textarea_field($_POST['description'])
    ]);
    echo '<div class="notice notice-success"><p>'.__('Characteristic added!', 'awesome-booking').'</p></div>';
}

// Handle Delete
if(isset($_GET['delete'])){
    $wpdb->delete($table, ['id'=>intval($_GET['delete'])]);
    echo '<div class="notice notice-success"><p>'.__('Characteristic deleted!', 'awesome-booking').'</p></div>';
}

$characteristics = $wpdb->get_results("SELECT * FROM $table");
?>

<h3><?php _e('Add Characteristic', 'awesome-booking'); ?></h3>
<form method="post">
    <p>
        <label><?php _e('Name', 'awesome-booking'); ?></label>
        <input type="text" name="name" required>
    </p>
    <p>
        <label><?php _e('Description', 'awesome-booking'); ?></label>
        <textarea name="description"></textarea>
    </p>
    <p>
        <button type="submit" name="abeg_add_characteristic" class="button button-primary"><?php _e('Add', 'awesome-booking'); ?></button>
    </p>
</form>

<h3><?php _e('All Characteristics', 'awesome-booking'); ?></h3>
<table class="widefat fixed striped">
    <thead>
        <tr>
            <th><?php _e('Name', 'awesome-booking'); ?></th>
            <th><?php _e('Description', 'awesome-booking'); ?></th>
            <th><?php _e('Action', 'awesome-booking'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($characteristics as $char): ?>
        <tr>
            <td><?php echo esc_html($char->name); ?></td>
            <td><?php echo esc_html($char->description); ?></td>
            <td>
                <a href="?page=awb_dashboard&tab=rooms&subtab=characteristics&delete=<?php echo $char->id; ?>" class="button"><?php _e('Delete', 'awesome-booking'); ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
