jQuery(document).ready(function() {
    var clicked = false; //variable that is changed if you clicked on the dark toggle
    var $ = jQuery; //change jQuery to $ with use of var

        $(".transitionBgColor").keyup(function(){ 
            $(".transitionBgColor").val($(this).val());
            $("#transition-background-color").val($(this).val());
        });

        $(".loadBgColor").keyup(function() {
            $(".loadBgColor").val($(this).val());
            $("#loading-color").val($(this).val());
        });

        $(".loadBgColor2").keyup(function() {
            $(".loadBgColor2").val($(this).val());
            $("#loading-color2").val($(this).val());
        });
        
        $(".loadBgColor3").keyup(function() {
            $(".loadBgColor3").val($(this).val());
            $("#loading-color3").val($(this).val());
        });
        
    if ($("#toggle_dark:checked").length > 0) { //check if the dark switch is already checked.
        $("#wpwrap").addClass("dark"); 
        clicked = true; 
        $(".darktoggle_switch").children(".switch").addClass("on");
        $(".wp-has-current-submenu").addClass("dark_arrow"); //add admin menu class. Arrow blend for background color change
    } 

    if($(".radio_set:checked").length > 0) { //check to see if it has already been checked
        $(".radio_set:checked").siblings(".switch").addClass("on");
        $(".radio_set:checked").parent().next(".expand_colorselect").addClass("expand");
    }
    if($(".radio_ajax_set:checked").length > 0) { //check to see if the setting has already been checked
        $(".radio_ajax_set:checked").siblings(".switch").addClass("on");
        $("#lbltxt").text("On");
    } else {        
        $("#lbltxt").text("Off");
    }

    $(".wpt_label_").click(function() { 
        $(".wpt_label_").children(".switch").removeClass("on");
        $(".wpt_label_").siblings(".expand_colorselect").removeClass("expand");
        if ($(this).children("input:checked").length > 0) {
            $(this).children(".switch").addClass("on");
            $(this).siblings(".expand_colorselect").addClass("expand");
        }
    });
    
    $(".wpt_load_label_").click(function() { 
        $(".wpt_load_label_").children(".switch").removeClass("on");
        $(".wpt_load_label_").siblings(".expand_colorselect").removeClass("expand");
        if ($(this).children("input:checked").length > 0) {
            $(this).children(".switch").addClass("on");
            $(this).siblings(".expand_colorselect").addClass("expand");
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