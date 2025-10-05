<?php
if (!defined('ABSPATH')) exit;

$sub_tab = isset($_GET['sub']) ? sanitize_text_field($_GET['sub']) : 'general';
?>
<h2 class="nav-tab-wrapper abeg-sub-tabs">
    <a href="?page=awb_dashboard&tab=settings&sub=general" class="nav-tab <?php echo $sub_tab==='general'?'nav-tab-active':''; ?>">General</a>
    <a href="?page=awb_dashboard&tab=settings&sub=coupons" class="nav-tab <?php echo $sub_tab==='coupons'?'nav-tab-active':''; ?>">Coupons</a>
    <a href="?page=awb_dashboard&tab=settings&sub=tax-rates" class="nav-tab <?php echo $sub_tab==='tax-rates'?'nav-tab-active':''; ?>">Tax Rates</a>
</h2>

<div class="abeg-inner-tab-content">
    <?php
    switch($sub_tab){
        case 'coupons':
            include ABEG_PLUGIN_PATH.'includes/admin/settings/coupons.php';
            break;
        case 'tax-rates':
            include ABEG_PLUGIN_PATH.'includes/admin/settings/tax-rates.php';
            break;
        default:
            include ABEG_PLUGIN_PATH.'includes/admin/settings/general-settings.php';
            break;
    }
    ?>
</div>
