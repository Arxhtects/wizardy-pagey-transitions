<?php
/*
Plugin name: Wizardy Pagey Transitions
Plugin URL: https://www.archtects.co.uk
Description: Wordpress Page Transitions
Author: Archtects
Author URL: https://www.archtects.co.uk
version: 0.62.1 Beta
*/

//add the retrived input and apply it to code
function hook_header() { 
    $postSettings = get_option('postSettings'); 
    $ajaxLoad = get_option('ajaxSettings');
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

#creates page
if ( !function_exists("wp_transitions_page")) { //Sets up the option page
    function wp_transitions_page() { ?>
        <h1>Wizardy Pagey Transitions</h1>
        <form method="post" action="options.php">
            <?php settings_fields('infoSettings'); //Creates the fields to save to ?> 
            <?php do_settings_sections('infoSettings'); ?>
            Off: <input name="postSettings" type="radio" value="0" <?php checked('0', get_option('postSettings')); ?> /><br />
            Fade Out: <input name="postSettings" type="radio" value="show-opacity" <?php checked('show-opacity', get_option('postSettings')); ?> /><br />
            Slide Down: <input name="postSettings" type="radio" value="show-slide-down" <?php checked('show-slide-down', get_option('postSettings')); ?> /> <br />
            Slide Left: <input name="postSettings" type="radio" value="show-slide-left" <?php checked('show-slide-left', get_option('postSettings')); ?> />
            <hr style="margin-top: 20px;">
            <h5>Alpha: Ajax Settings For Loading Pages Ascyn [Very Alpha(Doesnt work with trasitions currently)]</h5>
            Off: <input name="ajaxSettings" type="radio" value="0" <?php checked('0', get_option( 'ajaxSettings')); ?> /><br />
            On: <input name="ajaxSettings" type="radio" value="1" <?php checked('1', get_option('ajaxSettings')); ?> />
            <?php submit_button(); ?>
        </form>
    <?php }
}

if( !function_exists("update_postSettings")) { //Saves the settings that come from the selection radio buttons
    function update_postSettings() {
        register_setting('infoSettings', 'postSettings');
        register_setting('infoSettings', 'ajaxSettings');
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
?>