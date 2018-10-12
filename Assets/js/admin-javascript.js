jQuery(document).ready(function() {
    //jQuery("#wpwrap").addClass("dark");

    if(jQuery(".radio_set:checked").length > 0) {
        jQuery(".radio_set:checked").siblings(".switch").addClass("on");
    }
    if(jQuery(".radio_ajax_set:checked").length > 0) {
        jQuery(".radio_ajax_set:checked").siblings(".switch").addClass("on");
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
        }
    });
});