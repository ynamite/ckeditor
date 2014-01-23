jQuery(document).ready( function($) {
    $('div.rex-form-content-editmode-edit-slice #REX_FORM').submit(function() {
		//this is the foreach loop
		for (var i in CKEDITOR.instances) {
			// strip empty paragraphs out if there are any, can also be done via php in output module
		    var data = CKEDITOR.instances[i].getData();
		    var doDataUpdate = false;

		    if (data.indexOf("&nbsp;") != -1) {
		        // replace &nbsp;
		        data = data.replace(/&nbsp;/g, "");

		        doDataUpdate = true;
		    }

		    if (data.indexOf("<br />\n<br />") != -1 || data.indexOf("<br />\r\n<br />") != -1 || data.indexOf("<br /><br />") != -1) {
		        // replace multiple <br>s with a single one
		        data = data.replace(/(<br\s*\/?>\s*)+/igm, "<br />\n");

		        doDataUpdate = true;
		    }

		    if (data.match(/(<(?!br)(\w)[^>]*>)(\s*<br\s*\/?>\s*)+/igm)) {
		        // replace leading <br>s
		        data = data.replace(/(<(?!br)(\w)[^>]*>)(\s*<br\s*\/?>\s*)+/igm, '$1');

		        doDataUpdate = true;
		    }

		    if (data.match(/(\s*<br\s*\/?>\s*)+(<\/(?!br)(\w)>)/igm)) {
		        // replace trailing <br>s
		        data = data.replace(/(\s*<br\s*\/?>\s*)+(<\/(?!br)(\w)>)/igm, '$2');

		        doDataUpdate = true;
		    }

		    if (data.match(/(<p>(\s|&nbsp;|<br\s*\/?>)*<\/p>)/igm)) {
		        // replace empty paragraphs
		        data = data.replace(/(<p>(\s|&nbsp;|<br\s*\/?>)*<\/p>)/igm, '');

		        doDataUpdate = true;
		    }

		    if (doDataUpdate) {
		        CKEDITOR.instances[i].setData(data);
		    }
		}

		return true;
    });
});    
