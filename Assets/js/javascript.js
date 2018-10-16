$(document).ready(function() {
    //class name set here
    var class_name = "transition_link";
    var pageWrap = "page"; //wordpress wrapper div id
    //console.log(ajaxload);

    if (usersetting.match("^split-mid")) { $("#wpt_loading").addClass("split_ver_wpt_load"); } //Different css class for split div
    if (usersetting.match("^split-left")) { $("#wpt_loading").addClass("split_hor_wpt_load"); }

    window.setTimeout(function(){ //Timeout function so adding class isnt so quick
        $("#wpt_loading").addClass(usersetting); //comes from var set from phpsettings
    }, 250);
    
    $("a").each(function() { //Check to see if link has target blank
        if ($("this").attr("target" == "_blank")) {
            //ignore this link
        } else {
            $("a").addClass(class_name);
        }
    });

    //remove all classes from admin divs/admin links/anchor links.   
    $("#wpadminbar a").removeClass(class_name);
    $("a[href*='wp-']").removeClass(class_name);
    $("a[href*='#'").removeClass(class_name);

    $("."+class_name).click(function() {//page transition after onclick function
        var addressValue = $(this).attr("href"); //gets links value
        if (usersetting != "0" && ajaxload != "1") {
                window.setTimeout(function(){
                    window.location.href=addressValue; //wait till animation finished
                }, 480);
            $("#wpt_loading").removeClass(usersetting);
        } else if(ajaxload == "1") {
            $.ajax({async: true, url: addressValue, success: function(result){
                $("#"+pageWrap).html(result); //load page into the main div as html
            }});
            $("#wpt_loading").removeClass(usersetting);
        }
    return false //forces link to not work
    }); 
});