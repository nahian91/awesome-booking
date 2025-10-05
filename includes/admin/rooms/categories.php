<?php
if (!defined('ABSPATH')) exit;

global $wpdb;
$table = $wpdb->prefix.'abeg_room_categories';

// Add new category
if(isset($_POST['abeg_add_category'])){
    $wpdb->insert($table, ['name'=>sanitize_text_field($_POST['name'])]);
    echo '<div class="notice notice-success"><p>'.__('Category added!', 'awesome-booking').'</p></div>';
}

// Delete category
if(isset($_GET['delete'])){
    $wpdb->delete($table, ['id'=>intval($_GET['delete'])]);
    echo '<div class="notice notice-success"><p>'.__('Category deleted!', 'awesome-booking').'</p></div>';
}

$categories = $wpdb->get_results("SELECT * FROM $table");
?>

<h3><?php _e('Add Category', 'awesome-booking'); ?></h3>
<form method="post">
    <input type="text" name="name" required>
    <button type="submit" name="abeg_add_category" class="button button-primary"><?php _e('Add', 'awesome-booking'); ?></button>
</form>

<h3><?php _e('All Categories', 'awesome-booking'); ?></h3>
<table class="widefat fixed striped">
    <thead>
        <tr>
            <th><?php _e('Category Name', 'awesome-booking'); ?></th>
            <th><?php _e('Actions', 'awesome-booking'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categories as $cat): ?>
        <tr>
            <td><?php echo esc_html($cat->name); ?></td>
            <td>
                <a href="?page=awb_dashboard&tab=rooms&subtab=categories&delete=<?php echo $cat->id; ?>" class="button"><?php _e('Delete', 'awesome-booking'); ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
