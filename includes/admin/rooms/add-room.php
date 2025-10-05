<?php
if (!defined('ABSPATH')) exit;

global $wpdb;
$room_table = $wpdb->prefix.'abeg_rooms';
$categories = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}abeg_room_categories");
$characteristics = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}abeg_room_characteristics");
$options = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}abeg_room_options");

// Handle Add Room
if(isset($_POST['abeg_add_room'])){

    $char_ids = isset($_POST['characteristics']) ? array_map('intval', $_POST['characteristics']) : [];
    $opt_ids = isset($_POST['options']) ? array_map('intval', $_POST['options']) : [];

    $image_id = intval($_POST['main_image']);
    $main_image = $image_id ? wp_get_attachment_url($image_id) : '';

    $extra_images = isset($_POST['extra_images']) ? maybe_serialize(explode(',', $_POST['extra_images'])) : '';
    $extra_captions = isset($_POST['extra_images_caption']) ? maybe_serialize($_POST['extra_images_caption']) : '';
    $adults_charges = isset($_POST['adults_charges']) ? maybe_serialize($_POST['adults_charges']) : '';

    $wpdb->insert($room_table, [
        'name'=>sanitize_text_field($_POST['name']),
        'status'=>in_array($_POST['status'],['published','draft']) ? $_POST['status'] : 'draft',
        'units'=>intval($_POST['units']),
        'adults_min'=>intval($_POST['adults_min']),
        'adults_max'=>intval($_POST['adults_max']),
        'children_min'=>intval($_POST['children_min']),
        'children_max'=>intval($_POST['children_max']),
        'total_people_min'=>intval($_POST['total_min']),
        'total_people_max'=>intval($_POST['total_max']),
        'category_id'=>intval($_POST['category']),
        'characteristics'=>maybe_serialize($char_ids),
        'options'=>maybe_serialize($opt_ids),
        'last_units_threshold'=>intval($_POST['last_units_threshold']),
        'suggested_occupancy'=>sanitize_text_field($_POST['suggested_occupancy']),
        'custom_price'=>floatval($_POST['custom_price']),
        'price_label'=>sanitize_text_field($_POST['price_label']),
        'price_subtext'=>wp_kses_post($_POST['price_subtext']),
        'enable_request_info'=>isset($_POST['enable_request_info']) ? 1:0,
        'show_availability_calendar'=>isset($_POST['show_availability_calendar'])?1:0,
        'show_seasons_calendar'=>isset($_POST['show_seasons_calendar'])?1:0,
        'layout_style'=>sanitize_text_field($_POST['layout_style']),
        'main_image'=>$main_image,
        'extra_images'=>$extra_images,
        'extra_images_captions'=>$extra_captions,
        'adults_charges'=>$adults_charges,
        'short_description'=>sanitize_textarea_field($_POST['short_description']),
        'description'=>wp_kses_post($_POST['description']),
        'enable_geocoding'=>isset($_POST['enable_geocoding'])?1:0,
        'custom_page_title'=>sanitize_text_field($_POST['custom_page_title']),
        'keywords_meta'=>sanitize_text_field($_POST['keywords_meta']),
        'description_meta'=>sanitize_textarea_field($_POST['description_meta']),
    ]);

    echo '<div class="notice notice-success"><p>'.__('Room added successfully!','awesome-booking').'</p></div>';
}
?>

<form method="post" enctype="multipart/form-data">

<h2><?php _e('Units & Occupancy','awesome-booking'); ?></h2>
<p><label><?php _e('Room Name','awesome-booking'); ?></label><input type="text" name="name" required></p>
<p><label><?php _e('Room Status','awesome-booking'); ?></label>
<select name="status">
<option value="published"><?php _e('Published / Available','awesome-booking'); ?></option>
<option value="draft"><?php _e('Draft / Unavailable','awesome-booking'); ?></option>
</select></p>
<p><label><?php _e('Room Units','awesome-booking'); ?></label><input type="number" name="units" min="1" value="1"></p>

<h3><?php _e('Adults','awesome-booking'); ?></h3>
<p><label><?php _e('Min','awesome-booking'); ?></label><input type="number" name="adults_min" min="1" value="1"></p>
<p><label><?php _e('Max','awesome-booking'); ?></label><input type="number" name="adults_max" min="1" value="1"></p>

<h3><?php _e('Children','awesome-booking'); ?></h3>
<p><label><?php _e('Min','awesome-booking'); ?></label><input type="number" name="children_min" min="0" value="0"></p>
<p><label><?php _e('Max','awesome-booking'); ?></label><input type="number" name="children_max" min="0" value="0"></p>

<h3><?php _e('Total People','awesome-booking'); ?></h3>
<p><label><?php _e('Min Total','awesome-booking'); ?></label><input type="number" name="total_min" min="1" value="1"></p>
<p><label><?php _e('Max Total','awesome-booking'); ?></label><input type="number" name="total_max" min="1" value="1"></p>

<h2><?php _e('Categories, Characteristics & Options','awesome-booking'); ?></h2>
<p><label><?php _e('Room Category','awesome-booking'); ?></label>
<select name="category">
<option value="0"><?php _e('Select Category','awesome-booking'); ?></option>
<?php foreach($categories as $cat) echo '<option value="'.esc_attr($cat->id).'">'.esc_html($cat->name).'</option>'; ?>
</select></p>

<h3><?php _e('Characteristics','awesome-booking'); ?></h3>
<?php foreach($characteristics as $char): ?>
<label><input type="checkbox" name="characteristics[]" value="<?php echo $char->id; ?>"> <?php echo esc_html($char->name); ?></label>
<?php endforeach; ?>

<h3><?php _e('Options','awesome-booking'); ?></h3>
<?php foreach($options as $opt): ?>
<label><input type="checkbox" name="options[]" value="<?php echo $opt->id; ?>"> <?php echo esc_html($opt->name); ?> (<?php echo esc_html($opt->price); ?>$)</label>
<?php endforeach; ?>

<h3><?php _e('Adults Charges / Discounts','awesome-booking'); ?></h3>
<div id="abeg_adults_charges_wrap"></div>

<h2><?php _e('Room Parameters','awesome-booking'); ?></h2>
<p><label><?php _e('Last Units Threshold','awesome-booking'); ?></label><input type="number" name="last_units_threshold" min="0" value="0"></p>
<p><label><?php _e('Suggested Occupancy','awesome-booking'); ?></label><input type="text" name="suggested_occupancy"></p>
<p><label><?php _e('Custom Starting From Price','awesome-booking'); ?></label><input type="number" step="0.01" name="custom_price"></p>
<p><label><?php _e('Custom Price Label','awesome-booking'); ?></label><input type="text" name="price_label" placeholder="Per Night"></p>
<p><label><?php _e('Custom Price Sub-Text','awesome-booking'); ?></label><textarea name="price_subtext"></textarea></p>
<p><label><input type="checkbox" name="enable_request_info"> <?php _e('Enable Request Information','awesome-booking'); ?></label></p>
<p><label><input type="checkbox" name="show_availability_calendar"> <?php _e('Availability Calendars with Prices','awesome-booking'); ?></label></p>
<p><label><input type="checkbox" name="show_seasons_calendar"> <?php _e('Show Seasons Calendar','awesome-booking'); ?></label></p>
<p><label><?php _e('Layout Style','awesome-booking'); ?></label>
<select name="layout_style">
<option value="grid"><?php _e('Grid','awesome-booking'); ?></option>
<option value="list"><?php _e('List','awesome-booking'); ?></option>
</select></p>

<h2><?php _e('Photos & Descriptions','awesome-booking'); ?></h2>
<p><label><?php _e('Room Main Image','awesome-booking'); ?></label>
<input type="text" name="main_image" id="abeg_room_main_image" class="regular-text" readonly>
<button class="button abeg_upload_image_button"><?php _e('Upload Image','awesome-booking'); ?></button></p>

<h3><?php _e('Room Extra Images','awesome-booking'); ?></h3>
<div id="abeg_extra_images_wrap">
<button class="button abeg_bulk_upload_button"><?php _e('Upload Images','awesome-booking'); ?></button>
<div class="abeg_extra_images_list"></div>
</div>
<input type="hidden" name="extra_images" id="abeg_extra_images_input">

<p><label><?php _e('Short Description','awesome-booking'); ?></label><textarea name="short_description"></textarea></p>
<p><label><?php _e('Room Description','awesome-booking'); ?></label><textarea name="description"></textarea></p>

<h2><?php _e('Geographic Information','awesome-booking'); ?></h2>
<p><label><input type="checkbox" name="enable_geocoding"> <?php _e('Enable Geocoding','awesome-booking'); ?></label></p>

<h2><?php _e('Settings (SEO)','awesome-booking'); ?></h2>
<p><label><?php _e('Custom Page Title','awesome-booking'); ?></label><input type="text" name="custom_page_title"></p>
<p><label><?php _e('Keywords Meta Tag','awesome-booking'); ?></label><input type="text" name="keywords_meta"></p>
<p><label><?php _e('Description Meta Tag','awesome-booking'); ?></label><textarea name="description_meta"></textarea></p>

<p><button type="submit" name="abeg_add_room" class="button button-primary"><?php _e('Add Room','awesome-booking'); ?></button></p>
</form>

<script>
jQuery(document).ready(function($){
    // Main image upload
    $('.abeg_upload_image_button').click(function(e){
        e.preventDefault();
        var frame = wp.media({title:'<?php _e("Select Room Image","awesome-booking"); ?>',button:{text:'<?php _e("Use this image","awesome-booking"); ?>'},multiple:false});
        frame.on('select', function(){
            var attachment = frame.state().get('selection').first().toJSON();
            $('#abeg_room_main_image').val(attachment.id);
        });
        frame.open();
    });

    // Bulk extra images
    var extra_images = [];
    $('.abeg_bulk_upload_button').click(function(e){
        e.preventDefault();
        var frame = wp.media({title:'<?php _e("Select Extra Images","awesome-booking"); ?>',multiple:true});
        frame.on('select', function(){
            var selection = frame.state().get('selection');
            selection.map(function(attachment){
                attachment = attachment.toJSON();
                if(extra_images.indexOf(attachment.id) === -1){
                    extra_images.push(attachment.id);
                    $('.abeg_extra_images_list').append(
                        '<div class="abeg_extra_image_item">'+
                        '<img src="'+attachment.url+'" width="100">'+
                        '<input type="text" name="extra_images_caption['+attachment.id+']" placeholder="Image Caption">'+
                        '<button class="button abeg_remove_image" data-id="'+attachment.id+'">Remove</button>'+
                        '</div>'
                    );
                }
            });
            $('#abeg_extra_images_input').val(extra_images.join(','));
        });
        frame.open();
    });

    $(document).on('click','.abeg_remove_image',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        extra_images = extra_images.filter(function(el){ return el != id; });
        $('#abeg_extra_images_input').val(extra_images.join(','));
        $(this).closest('.abeg_extra_image_item').remove();
    });

    // Dynamic adult charges table
    function abeg_update_adults_charges(){
        var min = parseInt($('input[name="adults_min"]').val()) || 1;
        var max = parseInt($('input[name="adults_max"]').val()) || 1;
        var html = '';
        if(max>min){
            html += '<table class="widefat"><thead><tr><th><?php _e("Adults","awesome-booking"); ?></th><th><?php _e("Charge / Discount","awesome-booking"); ?></th></tr></thead><tbody>';
            for(var i=min;i<=max;i++){
                html += '<tr><td>'+i+'</td><td><input type="number" name="adults_charges['+i+']" step="0.01" value="0"></td></tr>';
            }
            html += '</tbody></table>';
        } else {
            html = '<p><?php _e("No adult charges available. Increase max adults to enable.","awesome-booking"); ?></p>';
        }
        $('#abeg_adults_charges_wrap').html(html);
    }
    $('input[name="adults_min"], input[name="adults_max"]').on('input', abeg_update_adults_charges);
    abeg_update_adults_charges();
});
</script>

<style>
.abeg_extra_image_item{display:inline-block;margin:5px;position:relative;}
.abeg_extra_image_item input{display:block;width:100px;margin-top:5px;}
.abeg_extra_image_item button{margin-top:5px;}
</style>
