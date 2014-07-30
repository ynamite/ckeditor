<?php
// module: ckeditor_image_in

// imagetypes for this module
$imageTypes = array('rex_mediapool_detail');

// get image title for hint "set title in mediapool"
$media = OOMedia::getMediaByFileName('REX_FILE[1]');

// media description
if (OOMedia::isValid($media)) {
	$mediaDescription = $media->getDescription();
} else {
	$mediaDescription = '';
}

if (!function_exists('rex_getImageTypeDescription')) {
	function rex_getImageTypeDescription($imageType) {
		global $REX;

		$query = 'SELECT * FROM '. $REX['TABLE_PREFIX'] .'679_types WHERE name LIKE "' . $imageType . '"';

		$sql = rex_sql::factory();
		$sql->setQuery($query);

		if ($sql->getRows() > 0) {
			return $sql->getValue('description');
		} else {
			return $imageType;
		}
	}
}
?>

<div id="rex-module">
	<div id="tabs">
		<ul>
			<li><a href="#text-tab">Text</a></li>
			<li><a href="#image-tab">Bild</a></li>
		</ul>
		<div id="text-tab">
			<textarea id="ckeditor1" name="VALUE[1]" style="visibility: hidden; height: 459px;">REX_VALUE[1]</textarea>
		</div>
		<div id="image-tab">
			<div class="top-margin">REX_MEDIA_BUTTON[id="1" category=""]</div>
		
			<?php
			if ('REX_FILE[1]' != '') {
				echo '<img src="' . $REX['HTDOCS_PATH'] . 'redaxo/index.php?rex_img_type=rex_mediabutton_preview&rex_img_file=REX_FILE[1]' . '" title="" alt="" />';
				echo '<div class="spacer"></div>';
			}
			?>

			<h2>Ausrichtung:</h2>
			<select name="VALUE[7]" id="alignment">
				<option value="image float left" <?php if ('REX_VALUE[7]' == 'image float left') echo 'selected'; ?>>links vom Text</option>
				<option value="image float right" <?php if ('REX_VALUE[7]' == 'image float right') echo 'selected'; ?>>rechts vom Text</option>
			</select>
		
			<div class="spacer"></div>
			<div class="spacer small"></div>

			<label for="imagetype-check"><input id="imagetype-check" type="checkbox" name="VALUE[2]" value="resize" <?php if ('REX_VALUE[2]' == 'resize') echo 'checked'; ?> /> <span>Bildtyp:</span></label><br />
			<select id="imagetype" name="VALUE[3]">
				<?php
				for ($i = 0; $i < count($imageTypes); $i++) {
					if ('REX_VALUE[3]' == $imageTypes[$i]) {
						$selectedAttribute = ' selected="selected"';
					}
				
					echo '<option value="' . $imageTypes[$i] . '"' . $selectedAttribute . '>' . rex_getImageTypeDescription($imageTypes[$i]) . '</option>';
					unset($selectedAttribute);
				}
				?>
			</select>
		
			<div class="spacer"></div>
			<div class="spacer small"></div>

			<label for="linktype-check"><input id="linktype-check" type="checkbox" name="VALUE[4]" value="link" <?php if ('REX_VALUE[4]' == 'link') echo 'checked'; ?> /> <span>Link:</span></label><br />
			<select id="linktype" name="VALUE[8]">
				<option value="imglink"<?php if ('REX_VALUE[8]' == 'imglink') echo ' selected'; ?>>Link auf Original-Bild
				<option value="internlink"<?php if ('REX_VALUE[8]' == 'internlink') echo ' selected'; ?>>Interner Link
				<option value="externlink"<?php if ('REX_VALUE[8]' == 'externlink') echo ' selected'; ?>>Externer Link
		  	</select>

			<div id="boxes">
				<div id="box-linktype"><?php if ($mediaDescription == '') { ?><h2>Hinweis:</h2><span>Der Bild-Untertitel kann unter "Beschreibung" des Bildes im Medienpool gesetzt werden.</span><?php } else { echo '<h2>Bild-Untertitel:</h2><span>' . $mediaDescription . '</span>'; } ?></div>
			  	<div id="box-intern">REX_LINK_BUTTON[1]</div>
				<div id="box-extern">
					<input id="externlink" type="text" name="VALUE[5]" value="<?php if (REX_IS_VALUE[5]) { echo 'REX_VALUE[5]'; } else { echo "http://"; }  ?>" size="40" />
					<div class="spacer"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
#rex-module label {
	display: block;
	float: left;
	padding-right: 10px;
	white-space: nowrap;
}

#rex-module label span {
	vertical-align: middle;
}

#rex-module label input[type="checkbox"],
#rex-module label input[type="radio"] {
	vertical-align: middle;
}

#rex-module h2 {
	font-weight: bold;
	font-size: 13px;
	margin-bottom: 1px;
}

#rex-module h2 span {
	font-weight: normal;
}

#rex-module h2.optional:after {
	content: " (optional)";
	font-weight: normal;
}

#rex-module .spacer {
	height: 15px;
	display: block;
	clear: both;
}

#rex-module .spacer.small {
	height: 6px;
}

#rex-module .spacer.medium {
	height: 10px;
}

#rex-module ul,
#rex-module ol {
	margin-top: 0;
	margin-bottom: 0;
}

#rex-module div.clearer {
	clear: both;
}

#rex-module #image-tab {
	display: none;
}

#rex-module #tabs {
	visibility: hidden;
	min-height: 531px;
}

#rex-module .top-margin {
	margin-top: 5px;
}

#rex-module #imagetype,
#rex-module #linktype,
#rex-module #alignment {
	margin-top: 3px;
}

#rex-module #box-linktype,
#rex-module #box-intern,
#rex-module #box-extern {
	display: none;
}

#rex-module #boxes {
	margin: 14px 0 1px 0; 
	display: block;
}

#rex-module #box-linktype span {
	font-size: 12px; 
	font-style: italic;
}

#rex-module label {
	font-weight: bold;
}
</style>

<script type="text/javascript">
jQuery(document).ready(function($) {
    CKEDITOR.replace('ckeditor1', {
        height: 400,
        fillEmptyBlocks: false,
        forcePasteAsPlainText: true,
        entities: false,
        linkShowTargetTab: false,
        format_tags: 'p;h2;h3',
        removePlugins: 'elementspath,image2',
        extraPlugins: 'rex_help',
        removeDialogTabs: 'link:advanced',
        toolbar: [
            ['Format'],
            ['Bold', 'Italic'],
            ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
            ['Link', 'Unlink', 'Anchor'],
            ['Table'],
            ['PasteText', 'PasteFromWord'],
            ['rex_help']
            // no comma after last entry!!!
        ]
        // no comma after last entry!!!
    });
});
</script>

<script type="text/javascript">
jQuery(document).ready(function($) {
	// onchange: linktype 
	$('#linktype').change(function() {
		$('#box-intern').hide();
		$('#box-extern').hide();
		$('#box-linktype').hide();
		
		if ($('#linktype-check').attr('checked')) {
	  		if ($(this).val() == "imglink") {
				$('#box-linktype').show();
			} else if ($(this).val() == "internlink") {
				$('#box-intern').show();
			} else if ($(this).val() == "externlink") {
				$('#box-extern').show();
			}
		}
	});
	
	// init: linktype
	$('#box-intern').hide();
	$('#box-extern').hide();
	$('#box-linktype').hide(); 

	if ($('#linktype-check').attr('checked')) {
		if ($("#linktype").val() == "imglink") {
			$('#box-linktype').show();
		} else if ($("#linktype").val() == "internlink") {
			$('#box-intern').show();
		} else if ($("#linktype").val() == "externlink") {
			$('#box-extern').show();
		}
	}

	$('#linktype-check').change(function() {
  		if($(this).attr('checked')){
			$('#linktype').prop('disabled', false);
			$('#linktype').change();
		} else {
			$('#linktype').prop('disabled', true);
			$('#linktype').change();
		}
	});

	$('#linktype-check').change();

	// onchange: imagetype
	$('#imagetype-check').change(function() {
  		if($(this).attr('checked')){
			$('#imagetype').prop('disabled', false);
		} else {
			$('#imagetype').prop('disabled', true);
		}
	});
	
	$('#imagetype-check').change();

	// init: imagetype
	$('#imagetype-check').change(function() {
  		if($(this).attr('checked')){
			$('#imagetype').prop('disabled', false);
		} else {
			$('#imagetype').prop('disabled', true);
		}
	}); 

	// tabs
	if ($.ui) {
		$( "#tabs" ).tabs({
			cookie: {
				expires: 1
			}
		});
	}

	$('#image-tab').css('display','block');
	$('#tabs').css('visibility','visible');
	$('#rex-module #tabs').css('min-height', '10px');
});
</script>
