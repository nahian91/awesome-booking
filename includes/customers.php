<?php
function abeg_customers_page(){
    global $wpdb;
    $customers = $wpdb->get_results("
        SELECT DISTINCT abeg_customer_name, abeg_customer_email
        FROM {$wpdb->postmeta}
        WHERE meta_key IN ('abeg_customer_name','abeg_customer_email')
        GROUP BY abeg_customer_email
        ORDER BY abeg_customer_name ASC
    ");
    ?>
    <div class="wrap"><h1>Customers</h1>
        <table class="widefat striped abeg-table">
            <thead><tr><th>Name</th><th>Email</th></tr></thead>
            <tbody>
            <?php
            if($customers){
                foreach($customers as $c){
                    echo "<tr><td>".esc_html($c->abeg_customer_name)."</td><td>".esc_html($c->abeg_customer_email)."</td></tr>";
                }
            } else { echo "<tr><td colspan='2'>No customers found.</td></tr>"; }
            ?>
            </tbody>
        </table>
    </div>
    <?php
}
