<?php
if (!defined('ABSPATH')) exit;

global $wpdb;

// Table for options
$table = $wpdb->prefix.'abeg_room_options';
$wpdb->query("CREATE TABLE IF NOT EXISTS $table (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) DEFAULT 0,
    PRIMARY KEY(id)
) {$wpdb->get_charset_collate()}");

// Handle Add
if(isset($_POST['abeg_add_option'])){
    $wpdb->insert($table, [
        'name' => sanitize_text_field($_POST['name']),
        'price' => floatval($_POST['price'])
    ]);
    echo '<div class="notice notice-success"><p>'.__('Option added!', 'awesome-booking').'</p></div>';
}

// Handle Delete
if(isset($_GET['delete'])){
    $wpdb->delete($table, ['id'=>intval($_GET['delete'])]);
    echo '<div class="notice notice-success"><p>'.__('Option deleted!', 'awesome-booking').'</p></div>';
}

$options = $wpdb->get_results("SELECT * FROM $table");
?>

<h3><?php _e('Add Option', 'awesome-booking'); ?></h3>
<form method="post">
    <p>
        <label><?php _e('Name', 'awesome-booking'); ?></label>
        <input type="text" name="name" required>
    </p>
    <p>
        <label><?php _e('Price', 'awesome-booking'); ?></label>
        <input type="number" name="price" step="0.01" value="0">
    </p>
    <p>
        <button type="submit" name="abeg_add_option" class="button button-primary"><?php _e('Add', 'awesome-booking'); ?></button>
    </p>
</form>

<h3><?php _e('All Options', 'awesome-booking'); ?></h3>
<table class="widefat fixed striped">
    <thead>
        <tr>
            <th><?php _e('Name', 'awesome-booking'); ?></th>
            <th><?php _e('Price', 'awesome-booking'); ?></th>
            <th><?php _e('Action', 'awesome-booking'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($options as $opt): ?>
        <tr>
            <td><?php echo esc_html($opt->name); ?></td>
            <td><?php echo esc_html($opt->price); ?></td>
            <td>
                <a href="?page=awb_dashboard&tab=rooms&subtab=options&delete=<?php echo $opt->id; ?>" class="button"><?php _e('Delete', 'awesome-booking'); ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
