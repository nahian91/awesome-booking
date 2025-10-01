<?php
function abeg_reports_page(){
    $bookings = get_posts(['post_type'=>'abeg_booking','posts_per_page'=>-1]);
    $currency = get_option('abeg_currency','USD');

    $total_revenue=0;
    $status_counts=['Pending'=>0,'Confirmed'=>0,'Cancelled'=>0];
    $monthly_revenue=[];

    foreach($bookings as $b){
        $status = get_post_meta($b->ID,'abeg_status',true) ?: 'Pending';
        $status_counts[$status]++;

        $room_id = intval(get_post_meta($b->ID,'abeg_room_id',true));
        $room_price = floatval(get_post_meta($room_id,'abeg_price',true));
        $guests = intval(get_post_meta($b->ID,'abeg_guests',true));
        $checkin = get_post_meta($b->ID,'abeg_checkin',true);
        $checkout = get_post_meta($b->ID,'abeg_checkout',true);
        $nights = max(1,(strtotime($checkout)-strtotime($checkin))/(60*60*24));
        $rev = $room_price * $nights * $guests;

        $total_revenue += $rev;

        $month = date('Y-m', strtotime($checkin));
        if(!isset($monthly_revenue[$month])) $monthly_revenue[$month] = 0;
        $monthly_revenue[$month] += $rev;
    }
    ?>
    <div class="wrap">
        <h1>Booking Reports</h1>

        <h2>Summary</h2>
        <table class="widefat striped">
            <tbody>
                <tr><th>Total Revenue</th><td><?php echo $currency.' '.number_format($total_revenue,2);?></td></tr>
                <tr><th>Pending Bookings</th><td><?php echo $status_counts['Pending'];?></td></tr>
                <tr><th>Confirmed Bookings</th><td><?php echo $status_counts['Confirmed'];?></td></tr>
                <tr><th>Cancelled Bookings</th><td><?php echo $status_counts['Cancelled'];?></td></tr>
            </tbody>
        </table>

        <h2>Monthly Revenue</h2>
        <canvas id="abegMonthlyRevenueChart" width="400" height="200"></canvas>

        <script>
            var monthlyLabels = <?php echo json_encode(array_keys($monthly_revenue));?>;
            var monthlyData = <?php echo json_encode(array_values($monthly_revenue));?>;
        </script>
    </div>
    <?php
}
