function insertLink(link, name) {
    jQuery('.rex-url input').val(link);
    jQuery('.rex-protocol option:last').attr("selected", "selected");
}

function insertFileLink(link) {
    jQuery('.rex-url input').val("/" + link);
    // only for link dialog
    jQuery('.rex-protocol option:last').attr("selected", "selected");
}

function getParam(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");

    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");

        if (pair[0] == variable) {
            return pair[1];
        }
    }

    return(false);
}

   
