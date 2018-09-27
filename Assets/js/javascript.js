$(document).ready(function() {
    var class_name = "test"

    $('a').each(function() { //Check to see if link has target blank
        if ($('this').attr('target' == '_blank')) {
            //ignore this link
        } else {
            $('a').addClass(class_name);
        }
    });
    //remove all classes from admin divs.
    $("#wpadminbar a").removeClass(class_name);
});