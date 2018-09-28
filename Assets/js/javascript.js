$(document).ready(function() {
    //class name set here
    var class_name = "transition_link"
    var pageWrap = "page" //wordpress wrapper div id
    console.log(usersetting);
    //console.log(ajaxload);

    window.setTimeout(function(){ //Timeout function so adding class isnt so quick
        $("#wpt_loading").addClass('show-opacity');
    }, 350);


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
        if (ajaxload == "1") { //if settings set to on do following
            var addressValue = $(this).attr("href"); //gets links value
            $.ajax({url: addressValue, success: function(result){
                $("#"+pageWrap).html(result);//load page into the main div as html
            }});
            return false //forces link to not work
        }
        $("#wpt_loading").removeClass('show-opacity');
    });    
});