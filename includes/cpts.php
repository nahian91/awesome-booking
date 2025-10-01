<?php
// Register CPTs
add_action('init','abeg_register_cpts');
function abeg_register_cpts(){
    register_post_type('abeg_room',[
        'labels'=>['name'=>'Rooms','singular_name'=>'Room'],
        'public'=>false,
        'show_ui'=>true,
        'show_in_menu'=>'abeg_dashboard',
        'menu_icon'=>'dashicons-building',
        'supports'=>['title','editor','custom-fields']
    ]);
    register_post_type('abeg_booking',[
        'labels'=>['name'=>'Bookings','singular_name'=>'Booking'],
        'public'=>false,
        'show_ui'=>true,
        'show_in_menu'=>'abeg_dashboard',
        'menu_icon'=>'dashicons-calendar-alt',
        'supports'=>['title','custom-fields']
    ]);
}
