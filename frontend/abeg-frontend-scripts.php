<?php
if(!defined('ABSPATH')) exit;

add_action('wp_enqueue_scripts', function(){
    wp_enqueue_style('abeg-frontend-css',ABEG_URL.'assets/css/frontend.css');
    wp_enqueue_script('abeg-frontend-js',ABEG_URL.'assets/js/frontend.js',['jquery','jquery-ui-datepicker'],'1.0',true);
    wp_localize_script('abeg-frontend-js','abeg_ajax',['ajax_url'=>admin_url('admin-ajax.php')]);
});
