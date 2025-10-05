<?php
if (!defined('ABSPATH')) exit;
global $wpdb;
$subtab = isset($_GET['subtab']) ? sanitize_text_field($_GET['subtab']) : 'all_rooms';

?>
<h2 class="nav-tab-wrapper abeg-sub-tabs">
    <a href="?page=awb_dashboard&tab=rooms&subtab=add_room" class="nav-tab <?php echo $subtab=='add_room'?'nav-tab-active':''; ?>"><?php _e('Add Room','awesome-booking'); ?></a>
    <a href="?page=awb_dashboard&tab=rooms&subtab=all_rooms" class="nav-tab <?php echo $subtab=='all_rooms'?'nav-tab-active':''; ?>"><?php _e('All Rooms','awesome-booking'); ?></a>
    <a href="?page=awb_dashboard&tab=rooms&subtab=categories" class="nav-tab <?php echo $subtab=='categories'?'nav-tab-active':''; ?>"><?php _e('Categories','awesome-booking'); ?></a>
    <a href="?page=awb_dashboard&tab=rooms&subtab=characteristics" class="nav-tab <?php echo $subtab=='characteristics'?'nav-tab-active':''; ?>"><?php _e('Characteristics','awesome-booking'); ?></a>
    <a href="?page=awb_dashboard&tab=rooms&subtab=options" class="nav-tab <?php echo $subtab=='options'?'nav-tab-active':''; ?>"><?php _e('Options','awesome-booking'); ?></a>
</h2>

<div class="abeg-subtab-content">
<?php
switch($subtab){
    case 'add_room':
        include ABEG_PLUGIN_PATH.'includes/admin/rooms/add-room.php';
        break;
    case 'all_rooms':
        include ABEG_PLUGIN_PATH.'includes/admin/rooms/all-rooms.php';
        break;
    case 'categories':
        include ABEG_PLUGIN_PATH.'includes/admin/rooms/categories.php';
        break;
    case 'characteristics':
        include ABEG_PLUGIN_PATH.'includes/admin/rooms/characteristics.php';
        break;
    case 'options':
        include ABEG_PLUGIN_PATH.'includes/admin/rooms/options.php';
        break;
}
?>
</div>
