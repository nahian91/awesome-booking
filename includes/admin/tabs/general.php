<h2><?php _e('General Settings', 'awesome-booking'); ?></h2>
<form method="post" action="options.php">
    <?php
    settings_fields('abeg_general_settings');
    do_settings_sections('abeg_general_settings');
    submit_button(__('Save Settings', 'awesome-booking'));
    ?>
</form>
