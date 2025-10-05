<?php
if (!defined('ABSPATH')) exit;
?>
<div class="wrap">
    <h2><?php _e('Booking Calendar View', 'awesome-booking'); ?></h2>
    <div id="calendar"></div>
</div>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
            { title: 'John Doe - Deluxe Suite', start: '2025-10-08', end: '2025-10-10' },
            { title: 'Sarah Khan - Standard Room', start: '2025-10-05', end: '2025-10-07' }
        ]
    });
    calendar.render();
});
</script>
