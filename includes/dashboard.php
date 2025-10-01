<?php
function abeg_dashboard_page(){
    $bookings = get_posts(['post_type'=>'abeg_booking','posts_per_page'=>-1,'orderby'=>'ID','order'=>'DESC']);
    $rooms = get_posts(['post_type'=>'abeg_room','posts_per_page'=>-1]);
    $currency = get_option('abeg_currency','USD');

    $total=$pending=$confirmed=$cancelled=$total_revenue=0;
    $room_revenue=[];
    foreach($rooms as $r) $room_revenue[$r->post_title]=0;

    $today = date('Y-m-d');
    $today_total=$today_confirmed=$today_revenue=0;

    foreach($bookings as $b){
        $status=get_post_meta($b->ID,'abeg_status',true) ?: 'Pending';
        $guests=intval(get_post_meta($b->ID,'abeg_guests',true));
        $room_id=intval(get_post_meta($b->ID,'abeg_room_id',true));
        $room_price=floatval(get_post_meta($room_id,'abeg_price',true));
        $room_title = $room_id? get_post($room_id)->post_title:'N/A';
        $checkin=get_post_meta($b->ID,'abeg_checkin',true);
        $checkout=get_post_meta($b->ID,'abeg_checkout',true);
        $nights=max(1,(strtotime($checkout)-strtotime($checkin))/(60*60*24));
        $booking_revenue = $room_price * $nights * $guests;
        $total_revenue += $booking_revenue;
        if(isset($room_revenue[$room_title])) $room_revenue[$room_title]+=$booking_revenue;

        if($status=='Pending') $pending++; elseif($status=='Confirmed') $confirmed++; elseif($status=='Cancelled') $cancelled++;
        $total++;

        if($checkin==$today){
            $today_total++;
            if($status=='Confirmed') $today_confirmed++;
            $today_revenue+=$booking_revenue;
        }
    }

    arsort($room_revenue);
    $base_url = admin_url('edit.php?post_type=abeg_booking');
    $today_total_url = $base_url.'&abeg_checkin_filter='.$today;
    $today_confirmed_url = $base_url.'&abeg_checkin_filter='.$today.'&abeg_status_filter=Confirmed';
    ?>
    <div class="wrap">
        <h1>Awesome Booking Dashboard</h1>
        <div class="abeg-cards">
            <a href="<?php echo $today_total_url;?>" style="text-decoration:none;">
                <div class="abeg-card" style="background:#2980b9;">
                    <h3><?php echo $today_total;?></h3><p>Total Bookings</p>
                </div>
            </a>
            <a href="<?php echo $today_confirmed_url;?>" style="text-decoration:none;">
                <div class="abeg-card" style="background:#27ae60;">
                    <h3><?php echo $today_confirmed;?></h3><p>Confirmed Bookings</p>
                </div>
            </a>
            <div class="abeg-card" style="background:#f39c12;">
                <h3><?php echo $currency.' '.number_format($today_revenue,2);?></h3><p>Revenue</p>
            </div>
        </div>

        <table class="widefat striped abeg-table">
            <tbody>
                <tr><th>Total Bookings</th><td><?php echo $total;?></td></tr>
                <tr><th>Pending</th><td><?php echo $pending;?></td></tr>
                <tr><th>Confirmed</th><td><?php echo $confirmed;?></td></tr>
                <tr><th>Cancelled</th><td><?php echo $cancelled;?></td></tr>
                <tr><th>Total Revenue</th><td><?php echo $currency.' '.number_format($total_revenue,2);?></td></tr>
            </tbody>
        </table>

        <h2>Booking Status Chart</h2>
        <canvas id="abegStatusChart" width="400" height="200"></canvas>

        <h2>Revenue Per Room</h2>
        <canvas id="abegRoomRevenueChart" width="400" height="200"></canvas>
    </div>

    <script>
        var abegStatusData = [<?php echo $pending;?>,<?php echo $confirmed;?>,<?php echo $cancelled;?>];
        var abegRoomLabels = <?php echo json_encode(array_keys($room_revenue));?>;
        var abegRoomData = <?php echo json_encode(array_values($room_revenue));?>;
    </script>
    <?php
}
