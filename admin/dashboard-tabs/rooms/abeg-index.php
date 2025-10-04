<?php
if(!defined('ABSPATH')) exit;

// Detect which sub-tab (optional)
$sub_tab = isset($_GET['sub']) ? sanitize_text_field($_GET['sub']) : 'all';
?>

<h2 class="nav-tab-wrapper abeg-sub-tabs">
    <a href="?page=abeg-dashboard&tab=rooms&sub=all" class="nav-tab <?php echo $sub_tab==='all'?'nav-tab-active':''; ?>">All Rooms</a>
    <a href="?page=abeg-dashboard&tab=rooms&sub=add" class="nav-tab <?php echo $sub_tab==='add'?'nav-tab-active':''; ?>">Add Room</a>
</h2>

<div class="abeg-room__content">
<?php
// Direct load files
if($sub_tab === 'all'){
    include ABEG_PATH . 'admin/dashboard-tabs/rooms/abeg-all.php';
} elseif($sub_tab === 'add'){
    include ABEG_PATH . 'admin/dashboard-tabs/rooms/abeg-add.php';
} else {
    echo '<p class="abeg-error">Invalid sub-tab selected.</p>';
}
?>
</div>
