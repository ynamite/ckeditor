jQuery(document).ready( function($) {
    $('div.rex-form-content-editmode-edit-slice #REX_FORM').submit(function() {
		for (var i in CKEDITOR.instances) {
		    var data = CKEDITOR.instances[i].getData();
		    var doDataUpdate = false;

	        // replace &nbsp;
		    if (data.indexOf("&nbsp;") != -1) {
		        data = data.replace(/&nbsp;/g, "");
		        doDataUpdate = true;
		    }

	        // replace multiple <br>s with a single one
		    if (data.indexOf("<br />\n<br />") != -1 || data.indexOf("<br />\r\n<br />") != -1 || data.indexOf("<br /><br />") != -1) {
		        data = data.replace(/(<br\s*\/?>\s*)+/igm, "<br />\n");
		        doDataUpdate = true;
		    }

	        // replace leading <br>s
		    if (data.match(/(<(?!br)(\w)[^>]*>)(\s*<br\s*\/?>\s*)+/igm)) {
		        data = data.replace(/(<(?!br)(\w)[^>]*>)(\s*<br\s*\/?>\s*)+/igm, '$1');
		        doDataUpdate = true;
		    }

	        // replace trailing <br>s
		    if (data.match(/(\s*<br\s*\/?>\s*)+(<\/(?!br)(\w)>)/igm)) {
		        data = data.replace(/(\s*<br\s*\/?>\s*)+(<\/(?!br)(\w)>)/igm, '$2');
		        doDataUpdate = true;
		    }

	        // replace empty paragraphs
		    if (data.match(/(<p>(\s|&nbsp;|<br\s*\/?>)*<\/p>)/igm)) {
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
