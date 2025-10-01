<?php
function abeg_settings_page(){
    if(isset($_POST['abeg_save_settings'])){
        update_option('abeg_currency',sanitize_text_field($_POST['abeg_currency']));
        echo '<div class="updated notice"><p>Settings saved.</p></div>';
    }
    $currency = get_option('abeg_currency','USD');
    ?>
    <div class="wrap"><h1>Awesome Booking Settings</h1>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th>Currency</th>
                    <td><input type="text" name="abeg_currency" value="<?php echo esc_attr($currency);?>" /></td>
                </tr>
            </table>
            <p><input type="submit" name="abeg_save_settings" class="button button-primary" value="Save Settings" /></p>
        </form>
    </div>
    <?php
}
