jQuery(document).ready(function() {
    var clicked = false; //variable that is changed if you clicked on the dark toggle

    if (jQuery("#toggle_dark:checked").length > 0) { jQuery("#wpwrap").addClass("dark"); clicked = true; jQuery(".darktoggle_switch").children(".switch").addClass("on");} 

    if(jQuery(".radio_set:checked").length > 0) {
        jQuery(".radio_set:checked").siblings(".switch").addClass("on");
    }
    if(jQuery(".radio_ajax_set:checked").length > 0) {
        jQuery(".radio_ajax_set:checked").siblings(".switch").addClass("on");
        jQuery("#lbltxt").text("On");
    } else {        
        jQuery("#lbltxt").text("Off");
    }

    jQuery(".wpt_label_").click(function() {
        jQuery(".wpt_label_").children(".switch").removeClass("on");
        if (jQuery(this).children("input:checked").length > 0) {
            jQuery(this).children(".switch").addClass("on");
        }
    });
    jQuery(".wpt_ajax_label_").click(function() {
        jQuery(".wpt_ajax_label_").children(".switch").removeClass("on");
        if (jQuery(this).children("input:checked").length > 0) {
            jQuery(this).children(".switch").addClass("on");
            jQuery("#lbltxt").text("On");
        } else {
            jQuery("#lbltxt").text("Off");
        }
    });

    //dark toggle code
    jQuery("#toggle_dark").click(function() {
        if (clicked == false) {
            jQuery("#wpwrap").addClass("dark");
            jQuery(".darktoggle_switch").children(".switch").addClass("on");
            clicked = true;
        } else {
            jQuery("#wpwrap").removeClass("dark");
            jQuery(".darktoggle_switch").children(".switch").removeClass("on");
            clicked = false;
        }
    });
    //console.log(clicked);
});