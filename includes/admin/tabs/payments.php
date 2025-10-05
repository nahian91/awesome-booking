<?php
if (!defined('ABSPATH')) exit;

$sub_tab = isset($_GET['sub']) ? sanitize_text_field($_GET['sub']) : 'methods';
?>
<h2 class="nav-tab-wrapper abeg-sub-tabs">
    <a href="?page=awb_dashboard&tab=payments&sub=methods" class="nav-tab <?php echo $sub_tab==='methods'?'nav-tab-active':''; ?>">Methods</a>
    <a href="?page=awb_dashboard&tab=payments&sub=transactions" class="nav-tab <?php echo $sub_tab==='transactions'?'nav-tab-active':''; ?>">Transactions</a>
    <a href="?page=awb_dashboard&tab=payments&sub=refunds" class="nav-tab <?php echo $sub_tab==='refunds'?'nav-tab-active':''; ?>">Refunds</a>
</h2>

<div class="abeg-inner-tab-content">
    <?php
    switch($sub_tab){
        case 'transactions':
            include ABEG_PLUGIN_PATH.'includes/admin/payments/transactions.php';
            break;
        case 'refunds':
            include ABEG_PLUGIN_PATH.'includes/admin/payments/refunds.php';
            break;
        default:
            include ABEG_PLUGIN_PATH.'includes/admin/payments/methods.php';
            break;
    }
    ?>
</div>
