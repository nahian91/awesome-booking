<?php
if (!defined('ABSPATH')) exit;
?>
<div class="wrap">
    <h2><?php _e('Analytics Dashboard', 'awesome-booking'); ?></h2>
    <p>Visual representation of booking performance and trends.</p>

    <canvas id="bookingChart" width="600" height="250"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    jQuery(document).ready(function($){
        const ctx = document.getElementById('bookingChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Bookings per Month',
                    data: [10, 20, 15, 25, 18, 30],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
    </script>
</div>
