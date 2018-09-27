$(document).ready(function() {
    //class name set here
    var class_name = "transition_link" 
    console.log(usersetting);

    $("a").each(function() { //Check to see if link has target blank
        if ($("this").attr("target" == "_blank")) {
            //ignore this link
        } else {
            $("a").addClass(class_name);
        }
    });

    //remove all classes from admin divs/admin links.   
    $("#wpadminbar a").removeClass(class_name);
    $("a[href*='wp-']").removeClass(class_name);

    $("."+class_name).click(function() {//page transition function
        alert("test");
    });
});