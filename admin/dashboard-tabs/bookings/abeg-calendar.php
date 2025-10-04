<?php
if(!defined('ABSPATH')) exit;
?>
<div class="abeg-box abeg-calendar-box">
  <h3 class="abeg-box__title">Booking Calendar</h3>
  <div id="abeg-booking-calendar" class="abeg-calendar"><p>Loading calendar...</p></div>
</div>
<script>
jQuery(document).ready(function($){
    function abeg_load_calendar(month='', year=''){
        $('#abeg-booking-calendar').html('<p>Loading calendar...</p>');
        $.post(ajaxurl, { action:'abeg_get_bookings_calendar', month:month, year:year }, function(response){
            $('#abeg-booking-calendar').html(response);
        });
    }
    abeg_load_calendar();
    $(document).on('click', '.abeg-calendar-nav a', function(e){
        e.preventDefault();
        abeg_load_calendar($(this).data('month'), $(this).data('year'));
    });
});
</script>
