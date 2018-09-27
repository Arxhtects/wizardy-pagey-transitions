<?php
/*
Plugin name: Wizardy Pagey Transitions
Plugin URL: https://www.archtects.co.uk
Description: Wordpress Page Transitions
Author: Scott Chambers
Author URL: https://www.archtects.co.uk
version: 0.01
*/

function include_jquery() {
    #Check if Jquery Has been Set
    if (! wp_script_is('jquery', 'enqueued')) { #TODO ADD JQUERY TO ASSSETS
        wp_enqueue_script( 'jquery_include', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array( 'jquery' ) );
    }
    wp_enqueue_script('javascript_code', '/wp-content/plugins/wizardy-pagey-transitions/assets/js/javascript.js');
}

function hook_header() {
    
}

#Add Actions
add_action('wp_enqueue_scripts', 'include_jquery');
add_action('wp_head', 'hook_header')

?>