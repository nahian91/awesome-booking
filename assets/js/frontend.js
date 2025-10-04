var abeg_unavailable_dates=[];

jQuery(document).ready(function($){
    $('#abeg_booking_dates').datepicker({
        numberOfMonths:2,
        minDate:0,
        beforeShowDay:function(date){
            let ds = $.datepicker.formatDate('yy-mm-dd', date);
            return [!abeg_unavailable_dates.includes(ds), abeg_unavailable_dates.includes(ds)?'abeg-unavailable':'',''];
        }
    });

    $('#abeg_room_id').change(function(){
        let room_id=$(this).val();
        if(!room_id) return;
        $.post(abeg_ajax.ajax_url,{action:'abeg_get_unavailable_dates',room_id:room_id},function(r){
            abeg_unavailable_dates=r.data||[];
            $('#abeg_booking_dates').datepicker('refresh');
        });
    });

    $('#abeg-room-booking-form').submit(function(e){
        e.preventDefault();
        let form = $(this);
        let data = form.serializeArray();
        data.push({name:'action', value:'abeg_add_booking'});
        $.post(abeg_ajax.ajax_url,data,function(r){
            if(r.success){
                $('#abeg-room-booking-msg').html('<p style="color:green">'+r.data+'</p>');
            }else{
                $('#abeg-room-booking-msg').html('<p style="color:red">'+r.data+'</p>');
            }
        });
    });
});
