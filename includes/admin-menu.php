<?php
add_action('admin_menu','abeg_admin_menu');
function abeg_admin_menu(){
    add_menu_page('Awesome Bookings','Bookings','manage_options','abeg_dashboard','abeg_dashboard_page','dashicons-calendar-alt',2);
    add_submenu_page('abeg_dashboard','General','General','manage_options','abeg_dashboard','abeg_dashboard_page');
    add_submenu_page('abeg_dashboard','Customers','Customers','manage_options','abeg_customers','abeg_customers_page');
    add_submenu_page('abeg_dashboard','Reports','Reports','manage_options','abeg_reports','abeg_reports_page');
    add_submenu_page('abeg_dashboard','Settings','Settings','manage_options','abeg_settings','abeg_settings_page');
}
