<?php
/*
Plugin name: Wizardy Pagey Transitions
Plugin URL: https://www.archtects.co.uk
Description: Wordpress Page Transitions
Author: Archtects
Author URL: https://www.archtects.co.uk
version: 0.68.6 Beta
*/

//add the retrived input and apply it to code
function hook_header() { 
    $postSettings = get_option('postSettings'); 
    $ajaxLoad = get_option('ajaxSettings');
    $darktoggle = get_option('darktoggle');
    ?>
    <script>
        var usersetting = "<?php echo $postSettings; ?>";
        var ajaxload = "<?php echo $ajaxLoad ?>";
    </script>
    <?php if ($postSettings != "0") {
        echo "<div id='wpt_loading'></div>"; //Div is set here. It will be first item added to the body tag. WP Moves it.
    }
}

function include_jquery() {
    #Check if Jquery Has been Set
    if ( !wp_script_is('jquery', 'enqueued')) { #TODO ADD JQUERY TO ASSSETS
        wp_enqueue_script( 'jquery_include', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array( 'jquery' ) );
    }
    wp_enqueue_script('javascript_code', '/wp-content/plugins/wizardy-pagey-transitions/assets/js/javascript.js');
    wp_enqueue_style('style_code', '/wp-content/plugins/wizardy-pagey-transitions/assets/css/wpt-style.css');
}

#Adds plugin to menu
if ( !function_exists("wp_transitions")) {
    function wp_transitions() {
                          //Page Title                 //Menu Title                 //cap var          //Url               //function
        add_options_page( 'Wizardy Pagey Transitions', 'Wizardy Pagey Transitions', 'manage_options', 'wp_transitions_page', 'wp_transitions_page' );
    }
}

function load_admin_style($hook) {
    $current_screen = get_current_screen();
    if ( strpos($current_screen->base, 'wp_transitions_page') === false) {
        return;
    } else {
        if ( !wp_script_is('jquery', 'enqueued')) { #TODO ADD JQUERY TO ASSSETS
            wp_enqueue_script( 'jquery_include', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array( 'jquery' ) );
        }
        wp_enqueue_style('style_code', '/wp-content/plugins/wizardy-pagey-transitions/assets/css/wpt-admin-style.css');
        wp_enqueue_script('javascript_code', '/wp-content/plugins/wizardy-pagey-transitions/assets/js/admin-javascript.js');
    }
}

#creates page
if ( !function_exists("wp_transitions_page")) { //Sets up the option page
    function wp_transitions_page() { ?>
    
        <h1>Wizardy Pagey Transitions</h1>
        <form id="wp_transition_settings_form" method="post" action="options.php">
            <?php settings_fields('infoSettings'); //Creates the fields to save to ?> 
            <?php do_settings_sections('infoSettings'); ?>
            <div id="top_settings_wrapper">
                <div class="wpt_switch_wrap"><label class="wpt_label_">Turn Off: <input class="radio_set" name="postSettings" type="radio" value="0" <?php checked('0', get_option('postSettings')); ?> /><div class="switch"></div></label></div>
                <div class="wpt_switch_wrap"><label class="wpt_label_">Fade Out: <input class="radio_set" name="postSettings" type="radio" value="show-opacity" <?php checked('show-opacity', get_option('postSettings')); ?> /><div class="switch"></div></label></div>
                <div class="wpt_switch_wrap"><label class="wpt_label_">Slide Down: <input class="radio_set" name="postSettings" type="radio" value="show-slide-down" <?php checked('show-slide-down', get_option('postSettings')); ?> /><div class="switch"></div></label></div>
                <div class="wpt_switch_wrap"><label class="wpt_label_">Slide Left: <input class="radio_set" name="postSettings" type="radio" value="show-slide-left" <?php checked('show-slide-left', get_option('postSettings')); ?> /><div class="switch"></div></label></div>
                <div class="wpt_switch_wrap"><label class="wpt_label_">Horizontal Split: <input class="radio_set" name="postSettings" type="radio" value="split-mid-middle" <?php checked('split-mid-middle', get_option('postSettings')); ?> /><div class="switch"></div></label></div>
                <div class="wpt_switch_wrap"><label class="wpt_label_">Vertical Split: <input class="radio_set" name="postSettings" type="radio" value="split-left-middle" <?php checked('split-left-middle', get_option('postSettings')); ?> /><div class="switch"></div></label></div> 
            </div>
            <h4>Alpha: Ajax Settings For Loading Pages Ascyn [Very Alpha(Doesnt work with trasitions currently)]</h4><br />
            <div class="wpt_switch_wrap"><label class="wpt_ajax_label_"><p id="lbltxt"></p><input class="radio_ajax_set" name="ajaxSettings" type="checkbox" value="1" <?php checked('1', get_option('ajaxSettings')); ?> /><div class="switch"></div></label></div>
            <label class="darktoggle_switch"><input id="toggle_dark" name="darktoggle" type="checkbox" value="dark" <?php checked('dark', get_option('darktoggle')); ?> /><div class="switch"></div><label>
            <?php submit_button(); ?>
        </form>
    <?php }
}

if( !function_exists("update_postSettings")) { //Saves the settings that come from the selection radio buttons
    function update_postSettings() {
        register_setting('infoSettings', 'postSettings');
        register_setting('infoSettings', 'ajaxSettings');
        register_setting('infoSettings', 'darktoggle');
    }
}

// Add links to the Wordpress "Plugins Page"
function plugin_meta($links, $file) {
    $plugin = plugin_basename(__FILE__); //gets name of the plugin
        if ($file == $plugin) {
            return array_merge($links, array(sprintf('<a href="options-general.php?page=wp_transitions_page">Settings</a> | <a href="https://github.com/Arxhtects/wizardy-pagey-transitions" target="_blank">GitHub</a> | <a href="https://www.archtects.co.uk" target="_blank">Portfolio</a>')));
        }
    return $links; //returns the other links ie: Version and name of author with new ones
}

#Add Actions
add_filter('plugin_row_meta', 'plugin_meta', 10, 2);
add_action('wp_head', 'hook_header');
add_action('wp_enqueue_scripts', 'include_jquery');
add_action('admin_menu', 'wp_transitions');
add_action('admin_init', 'update_postSettings');
add_action('admin_head', 'load_admin_style');
?>