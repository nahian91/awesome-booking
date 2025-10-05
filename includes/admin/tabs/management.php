<?php
if (!defined('ABSPATH')) exit;

$sub_tab = isset($_GET['sub']) ? sanitize_text_field($_GET['sub']) : 'customers';
?>
<h2 class="nav-tab-wrapper abeg-sub-tabs">
    <a href="?page=awb_dashboard&tab=management&sub=customers" class="nav-tab <?php echo $sub_tab==='customers' ? 'nav-tab-active' : ''; ?>">Customers</a>
    <a href="?page=awb_dashboard&tab=management&sub=reports" class="nav-tab <?php echo $sub_tab==='reports' ? 'nav-tab-active' : ''; ?>">Reports</a>
    <a href="?page=awb_dashboard&tab=management&sub=analytics" class="nav-tab <?php echo $sub_tab==='analytics' ? 'nav-tab-active' : ''; ?>">Analytics</a>
</h2>

<div class="abeg-subtab-content">
    <?php
    switch($sub_tab){
        case 'customers':
            echo '<h3>Customers</h3><p>Manage your customer database.</p>';
            break;
        case 'reports':
            echo '<h3>Reports</h3><p>View detailed booking and revenue reports.</p>';
            break;
        case 'analytics':
            echo '<h3>Analytics</h3><p>View performance and trends.</p>';
            break;
    }
    ?>
</div>
