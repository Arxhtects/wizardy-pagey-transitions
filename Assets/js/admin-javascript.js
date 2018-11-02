jQuery(document).ready(function() {
    var clicked = false; //variable that is changed if you clicked on the dark toggle
    var $ = jQuery; //change jQuery to $ with use of var

    if ($("#toggle_dark:checked").length > 0) { //check if the dark switch is already checked.
        $("#wpwrap").addClass("dark"); 
        clicked = true; 
        $(".darktoggle_switch").children(".switch").addClass("on");
        $(".wp-has-current-submenu").addClass("dark_arrow"); //add admin menu class. Arrow blend for background color change
    } 

    if($(".radio_set:checked").length > 0) { //check to see if it has already been checked
        $(".radio_set:checked").siblings(".switch").addClass("on");
    }
    if($(".radio_ajax_set:checked").length > 0) { //check to see if the setting has already been checked
        $(".radio_ajax_set:checked").siblings(".switch").addClass("on");
        $("#lbltxt").text("On");
    } else {        
        $("#lbltxt").text("Off");
    }

    $(".wpt_label_").click(function() { 
        $(".wpt_label_").children(".switch").removeClass("on");
        if ($(this).children("input:checked").length > 0) {
            $(this).children(".switch").addClass("on");
        }
    });
    
    $(".wpt_load_label_").click(function() { 
        $(".wpt_load_label_").children(".switch").removeClass("on");
        if ($(this).children("input:checked").length > 0) {
            $(this).children(".switch").addClass("on");
        }
    });

    $(".wpt_ajax_label_").click(function() {
        $(".wpt_ajax_label_").children(".switch").removeClass("on");
        if ($(this).children("input:checked").length > 0) {
            $(this).children(".switch").addClass("on");
            $("#lbltxt").text("On");
        } else {
            $("#lbltxt").text("Off");
        }
    });

    //dark toggle code
    $("#toggle_dark").click(function() { // TODO: change layout of function more simplistic
        if (clicked == false) {
            $("#wpwrap").addClass("dark");
            $(".darktoggle_switch").children(".switch").addClass("on");
            $(".wp-has-current-submenu").addClass("dark_arrow");
            clicked = true;
        } else {
            $("#wpwrap").removeClass("dark");
            $(".darktoggle_switch").children(".switch").removeClass("on");
            $(".wp-has-current-submenu").removeClass("dark_arrow");
            clicked = false;
        }
    });
    //console.log(clicked);
});