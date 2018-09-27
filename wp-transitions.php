<?php
/*
Plugin name: Wizardy Pagey Transitions
Plugin URL: https://www.archtects.co.uk
Description: Wordpress Page Transitions
Author: Scott Chambers
Author URL: https://www.archtects.co.uk
version: 0.4 Beta
*/

//add the retrived input and apply it to code
function hook_header() { ?>
    <script>var usersetting = "<?php echo get_option('postSettings'); ?>";</script>
<?php }

function include_jquery() {
    #Check if Jquery Has been Set
    if ( !wp_script_is('jquery', 'enqueued')) { #TODO ADD JQUERY TO ASSSETS
        wp_enqueue_script( 'jquery_include', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array( 'jquery' ) );
    }
    wp_enqueue_script('javascript_code', '/wp-content/plugins/wizardy-pagey-transitions/assets/js/javascript.js');
}

#Adds plugin to menu
if ( !function_exists("wp_transitions")) {
    function wp_transitions() {
                        //Page Title                //Menu Title                 //cap var         //Url             //function             //icon                   //position
        add_menu_page( 'Wizardy Pagey Transitions', 'Wizardy Pagey Transitions', 'manage_options', 'wp_transitions', 'wp_transitions_page', 'dashicons-editor-code', 4 );
        
    }
}

#creates page
if ( !function_exists("wp_transitions_page")) {
    function wp_transitions_page() { ?>
        <h1>Wizardy Pagey Transitions</h1>
        <form method="post" action="options.php">
            <?php settings_fields('infoSettings'); ?>
            <?php do_settings_sections('infoSettings'); ?>
            <input type="text" name="postSettings" value="<?php echo get_option('postSettings'); ?>"/>
            <?php submit_button(); ?>
        </form>
    <?php }
}

if( !function_exists("update_postSettings")) {
    function update_postSettings() {
        register_setting('infoSettings', 'postSettings');
    }
}

#Add Actions
add_action('wp_head', 'hook_header');
add_action('wp_enqueue_scripts', 'include_jquery');
add_action('admin_menu', 'wp_transitions');
add_action('admin_init', 'update_postSettings');
?>