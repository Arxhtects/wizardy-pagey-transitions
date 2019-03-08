<?php
/*
Plugin name: Wizardy Pagey Transitions
Plugin URL: https://www.archtects.co.uk
Description: Wordpress Page Transitions
Author: Archtects
Author URL: https://www.archtects.co.uk
version: 0.69.7 Beta
*/

//add the retrived input and apply it to code
function hook_header() { 
    $postSettings = get_option('postSettings'); 
    $loadingSettings = get_option('loadingSettings');
    $ajaxLoad = get_option('ajaxSettings');
    $darktoggle = get_option('darktoggle');
    $transitionBgColor = get_option('transitionBgColor');
    $loadBgColor = get_option('loadBgColor');
    $loadBgColor2 = get_option('loadBgColor2');
    $loadBgColor3 = get_option('loadBgColor3');
    if ($loadBgColor == null || $loadBgColor == "") { $loadBgColor = "#000"; }
    if ($loadBgColor2 == null || $loadBgColor2 == "") { $loadBgColor2 = "#000"; }
    if ($loadBgColor3 == null || $loadBgColor3 == "") { $loadBgColor3 = "#000"; }
    if ($transitionBgColor == null || $transitionBgColor == "") {
        $transitionBgColor = "#f2f3f4";
    }?>
    
        
    <?php if($postSettings != "0") { ?>
        <style>
            <?php if($loadingSettings != "0") { ?>
            .<?php echo $loadingSettings; ?> {
                <?php if($loadingSettings == "basic-circle" || $loadingSettings == "two-halfs-circle") { ?>
                border: 5px solid <?php echo $loadBgColor; ?>;
                <?php } else if($loadingSettings == "one-quater-circle") { ?>
                border-bottom: 5px solid <?php echo $loadBgColor; ?> !important;
                <?php } else if($loadingSettings == "split-circle") { ?>
                border-bottom: 5px solid <?php echo $loadBgColor; ?> !important;
                <?php } else if($loadingSettings == "split-ring") { ?> 
                border-bottom: 5px solid <?php echo $loadBgColor; ?> !important;
                border-top: 5px solid <?php echo $loadBgColor; ?> !important;
                <?php } else if($loadingSettings == "three-bars") { ?>
                background-color: <?php echo $loadBgColor; ?>;
                <?php } ?>
            }
            <?php if($loadingSettings == "split-circle" || $loadingSettings == "split-ring" || $loadingSettings == "three-bars") { ?>
                .<?php echo $loadingSettings; ?>::before {
                    <?php if($loadingSettings == "split-circle") { ?>
                        border-top: 5px solid <?php echo $loadBgColor2; ?> !important;
                    <?php } else if($loadingSettings == "split-ring") { ?> 
                        border-bottom: 5px solid <?php echo $loadBgColor2; ?> !important;
                        border-top: 5px solid <?php echo $loadBgColor2; ?> !important;
                    <?php } else if($loadingSettings == "three-bars") { ?> 
                        background-color: <?php echo $loadBgColor2; ?>;
                    <?php } ?>
                }
            <?php if($loadingSettings == "three-bars") { ?>
            .three-bars::after {   
                background-color: <?php echo $loadBgColor3; ?>;
            }
            <?php } ?>
            <?php } ?>
            <?php } ?>
            #wpt_loading {
                background: <?php echo $transitionBgColor; ?> !important;
            }
            <?php if(strpos($postSettings, 'split') !== false) { ?>
                .bgoverride::after {
                    background-color: <?php echo $transitionBgColor; ?> !important;
                }
           <?php } ?>
        </style>
    <?php  } ?>
    <script>
        var usersetting = "<?php echo $postSettings; ?>";
        var loadingsettings = "<?php echo $loadingSettings; ?>"
        var ajaxload = "<?php echo $ajaxLoad ?>";
    </script>
    <?php if ($postSettings != "0" && $loadingSettings != "0") {
        echo "<div id='wpt_load_anim'></div>";
    }
    if ($postSettings != "0") {
        echo "<div id='wpt_loading'></div>"; //Div is set here. It will be first item added to the body tag. WP Moves it.
    }
}

function include_jquery() {
    #Check if Jquery Has been Set
    if ( !wp_script_is('jquery', 'enqueued')) { #TODO ADD JQUERY TO ASSSETS
        wp_enqueue_script( 'jquery_include', 'https://code.jquery.com/jquery-3.3.1.min.js', array( 'jquery' ) );
    }
    wp_enqueue_script('javascript_code', '/wp-content/plugins/wizardy-pagey-transitions/Assets/js/javascript.js');
    wp_enqueue_style('style_code', '/wp-content/plugins/wizardy-pagey-transitions/Assets/css/wpt-style.css');
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
            wp_enqueue_script( 'jquery_include', 'https://code.jquery.com/jquery-3.3.1.min.js', array( 'jquery' ) );
        }
        wp_enqueue_style('style_code', '/wp-content/plugins/wizardy-pagey-transitions/Assets/css/wpt-admin-style.css');
        wp_enqueue_script('javascript_code', '/wp-content/plugins/wizardy-pagey-transitions/Assets/js/admin-javascript.js');
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
            <h4>Loading Transitions</h4>
                <fieldset id="postSettings">
                    <div class="wpt_switch_wrap"><label class="wpt_label_">Turn Off: <input class="radio_set" name="postSettings" type="radio" value="0" <?php checked('0', get_option('postSettings')); ?> /><div class="switch"></div></label></div>
                    <div class="wpt_switch_wrap"><label class="wpt_label_">Fade Out: <input class="radio_set" name="postSettings" type="radio" value="show-opacity" <?php checked('show-opacity', get_option('postSettings')); ?> /><div class="switch"></div></label><div class="expand_colorselect"><strong>Color:</strong><br /><input class="transitionBgColor" type="text" name="transitionBgColor" value="<?php echo get_option('transitionBgColor'); ?>"/></div></div>
                    <div class="wpt_switch_wrap"><label class="wpt_label_">Slide Down: <input class="radio_set" name="postSettings" type="radio" value="show-slide-down" <?php checked('show-slide-down', get_option('postSettings')); ?> /><div class="switch"></div></label><div class="expand_colorselect"><strong>Color:</strong><br /><input class="transitionBgColor" type="text" name="transitionBgColor" value="<?php echo get_option('transitionBgColor'); ?>"/></div></div>
                    <div class="wpt_switch_wrap"><label class="wpt_label_">Slide Left: <input class="radio_set" name="postSettings" type="radio" value="show-slide-left" <?php checked('show-slide-left', get_option('postSettings')); ?> /><div class="switch"></div></label><div class="expand_colorselect"><strong>Color:</strong><br /><input class="transitionBgColor" type="text" name="transitionBgColor" value="<?php echo get_option('transitionBgColor'); ?>"/></div></div>
                    <div class="wpt_switch_wrap"><label class="wpt_label_">Horizontal Split: <input class="radio_set" name="postSettings" type="radio" value="split-mid-middle" <?php checked('split-mid-middle', get_option('postSettings')); ?> /><div class="switch"></div></label><div class="expand_colorselect"><strong>Color:</strong><br /><input class="transitionBgColor" type="text" name="transitionBgColor" value="<?php echo get_option('transitionBgColor'); ?>"/></div></div>
                    <div class="wpt_switch_wrap"><label class="wpt_label_">Vertical Split: <input class="radio_set" name="postSettings" type="radio" value="split-left-middle" <?php checked('split-left-middle', get_option('postSettings')); ?> /><div class="switch"></div></label><div class="expand_colorselect"><strong>Color:</strong><br /><input class="transitionBgColor" type="text" name="transitionBgColor" value="<?php echo get_option('transitionBgColor'); ?>"/></div></div> 
                </fieldset>
            </div>
            <div class="loading_settings_wrapper">
            <h4>Loading Circles</h4>
                <fieldset id="loadingSettings">
                    <div class="wpt_switch_wrap"><label class="wpt_load_label_">Turn Off: <input class="radio_set" name="loadingSettings" type="radio" value="0" <?php checked('0', get_option('loadingSettings')); ?> /><div class="switch"></div></label></div>
                    <div class="wpt_switch_wrap"><label class="wpt_load_label_">Basic Circle: <input class="radio_set" name="loadingSettings" type="radio" value="basic-circle" <?php checked('basic-circle', get_option('loadingSettings')); ?> /><div class="switch"></div></label><div class="expand_colorselect"><strong>Color:</strong><br /><input class="loadBgColor" type="text" name="loadBgColor" value="<?php echo get_option('loadBgColor'); ?>"/></div></div>
                    <div class="wpt_switch_wrap"><label class="wpt_load_label_">Two Halves: <input class="radio_set" name="loadingSettings" type="radio" value="two-halfs-circle" <?php checked('two-halfs-circle', get_option('loadingSettings')); ?> /><div class="switch"></div></label><div class="expand_colorselect"><strong>Color:</strong><br /><input class="loadBgColor" type="text" name="loadBgColor" value="<?php echo get_option('loadBgColor'); ?>"/></div></div>
                    <div class="wpt_switch_wrap"><label class="wpt_load_label_">One Quater: <input class="radio_set" name="loadingSettings" type="radio" value="one-quater-circle" <?php checked('one-quater-circle', get_option('loadingSettings')); ?> /><div class="switch"></div></label><div class="expand_colorselect"><strong>Color:</strong><br /><input class="loadBgColor" type="text" name="loadBgColor" value="<?php echo get_option('loadBgColor'); ?>"/></div></div>
                    <div class="wpt_switch_wrap"><label class="wpt_load_label_">Split Circle: <input class="radio_set" name="loadingSettings" type="radio" value="split-circle" <?php checked('split-circle', get_option('loadingSettings')); ?> /><div class="switch"></div></label><div class="expand_colorselect"><strong>Color:</strong><br /><input class="loadBgColor" type="text" name="loadBgColor" value="<?php echo get_option('loadBgColor'); ?>"/> <strong>Color:</strong><br /><input class="loadBgColor2" type="text" name="loadBgColor2" value="<?php echo get_option('loadBgColor2'); ?>"/></div></div>
                    <div class="wpt_switch_wrap"><label class="wpt_load_label_">Bolt Turn: <input class="radio_set" name="loadingSettings" type="radio" value="split-ring" <?php checked('split-ring', get_option('loadingSettings')); ?> /><div class="switch"></div></label><div class="expand_colorselect"><strong>Color:</strong><br /><input class="loadBgColor" type="text" name="loadBgColor" value="<?php echo get_option('loadBgColor'); ?>"/> <strong>Color:</strong><br /><input class="loadBgColor2" type="text" name="loadBgColor2" value="<?php echo get_option('loadBgColor2'); ?>"/></div></div>
                </fieldset>
            </div>
            <div class="loading_settings_wrapper">
            <h4>Loading Bars</h4>
                <fieldset id="loadingSettings">
                    <div class="wpt_switch_wrap"><label class="wpt_load_label_">Three Bars: <input class="radio_set" name="loadingSettings" type="radio" value="three-bars" <?php checked('three-bars', get_option('loadingSettings')); ?> /><div class="switch"></div></label><div class="expand_colorselect"><strong>Color:</strong><br /><input class="loadBgColor" type="text" name="loadBgColor" value="<?php echo get_option('loadBgColor'); ?>"/> <strong>Color:</strong><br /><input class="loadBgColor2" type="text" name="loadBgColor2" value="<?php echo get_option('loadBgColor2'); ?>"/> <strong>Color:</strong><br /><input class="loadBgColor3" type="text" name="loadBgColor3" value="<?php echo get_option('loadBgColor3'); ?>"/></div></div>
                </fieldset>
            </div>
            <h4>Alpha: Ajax Page load Settings</h4><br />
            <div class="wpt_switch_wrap"><label class="wpt_ajax_label_"><p id="lbltxt"></p><input class="radio_ajax_set" name="ajaxSettings" type="checkbox" value="1" <?php checked('1', get_option('ajaxSettings')); ?> /><div class="switch"></div></label></div>
            <label class="darktoggle_switch"><input id="toggle_dark" name="darktoggle" type="checkbox" value="dark" <?php checked('dark', get_option('darktoggle')); ?> /><div class="switch"></div><label>
            <!--Hidden input field for the color inputs-->
            <input id="transition-background-color" type="hidden" name="transitionBgColor" value="<?php echo get_option('transitionBgColor'); ?>"/>
            <input id="loading-color" type="hidden" name="loadBgColor" value="<?php echo get_option('loadBgColor'); ?>"/>
            <input id="loading-color2" type="hidden" name="loadBgColor2" value="<?php echo get_option('loadBgColor2'); ?>"/>
            <input id="loading-color3" type="hidden" name="loadBgColor3" value="<?php echo get_option('loadBgColor3'); ?>"/>
            
            <?php submit_button(); ?>
        </form>
    <?php }
}

if( !function_exists("update_postSettings")) { //Saves the settings that come from the selection radio buttons
    function update_postSettings() {
        register_setting('infoSettings', 'postSettings');
        register_setting('infoSettings', 'loadingSettings');
        register_setting('infoSettings', 'ajaxSettings');
        register_setting('infoSettings', 'darktoggle');
        register_setting('infoSettings', 'transitionBgColor');
        register_setting('infoSettings', 'loadBgColor');
        register_setting('infoSettings', 'loadBgColor2');
        register_setting('infoSettings', 'loadBgColor3');
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
add_filter('admin_init', 'update_postSettings');
add_action('admin_head', 'load_admin_style');
?>
