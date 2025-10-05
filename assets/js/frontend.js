jQuery(document).ready(function($){
    function calculatePrice(){
        var roomID = $('#abeg_room').val();
        var checkin = new Date($('#abeg_checkin').val());
        var checkout = new Date($('#abeg_checkout').val());
        if(!roomID || !checkin || !checkout || checkout <= checkin) {
            $('#abeg_total_price').text('$0');
            return;
        }

        var nights = (checkout - checkin)/(1000*60*60*24);
        var price = 0;

        // Get room price (for simplicity using data-price)
        price = parseFloat($('#abeg_room option:selected').data('price')) * nights;
        $('#abeg_total_price').text('$'+price.toFixed(2));
    }

    $('#abeg_room, #abeg_checkin, #abeg_checkout').on('change keyup', calculatePrice);

    // Submit form via AJAX (optional)
    $('#abeg-booking-form').on('submit', function(e){
        e.preventDefault();
        alert('Booking submitted! (You can integrate AJAX here)');
    });
});
