<?php
if (rex::isBackend() && rex::getUser() instanceof rex_user) {
	// apply patches
	if ($this->getConfig('patches_applied') == 0) {
		rex_ckeditor::applyPatches();
		$this->setConfig('patches_applied', 1);
	}

	rex_view::addCssFile($this->getAssetsUrl('backend.css'));
	rex_view::addJsFile($this->getAssetsUrl('vendor/ckeditor.js'));

	//if (rex_request('page') != 'mediapool' && rex_request('page') != 'linkmap') { // needed for new redaxo.js patching the link dialog etc., as outehwise insertLink() etc. is definied twice
		rex_view::addJsFile($this->getAssetsUrl('redaxo.js'));
	//}

	if ($this->getConfig('smart_strip') == 1) {
		rex_view::addJsFile($this->getAssetsUrl('smart_strip.js'));
	}

	rex_extension::register('OUTPUT_FILTER', function($ep) {
		$sql = rex_sql::factory();
		$result = $sql->setQuery("SELECT `name`, `jscode` FROM `" . rex::getTablePrefix() . "ckeditor_profiles` ORDER BY `id` ASC")->getArray();

		$jsInitCode = "<script type=\"text/javascript\">
		$(document).on('rex:ready', function (event, container) {
			var profiles = {};
		";

		foreach ($result as $row) {
			$jsInitCode .=	"profiles['" . $row['name'] . "'] = " . $row['jscode'] . ";

			";
		}

		if (isset($result[0])) {
			$defaultProfile = $result[0]['name'];
		} else {
			$defaultProfile = '';
		}

		$jsInitCode .= "
			var i = 0;
			var defaultProfile = '" . $defaultProfile . "';

			if (defaultProfile !== '') {
				$('.ckeditor').each(function() {
					i++;

					// if id of textarea is missing set one, otherwise ckeditor replace will not work
					if (!$(this).attr('id')) {
						$(this).attr('id', 'ckeditor-' + i);
					}

					var textareaId = $(this).attr('id');
					var ckeditorConfig;

					// set config object
					if ($(this).attr('data-ckeditor-profile') && $(this).attr('data-ckeditor-profile') in profiles) {
						ckeditorConfig = profiles[$(this).attr('data-ckeditor-profile')];
					} else {
						ckeditorConfig = profiles[defaultProfile];
					}
			
					// overwrite height if necessary
					if ($(this).attr('data-ckeditor-height')) {
						ckeditorConfig.height = $(this).attr('data-ckeditor-height');
					}";
	
					$rexHelpPluginFile = rex_path::addonAssets('ckeditor') . 'vendor/plugins/rex_help/plugin.js';				

					if (file_exists($rexHelpPluginFile)) { // if user updates assets without reinstall missing rex_help plugin will create js error
						$jsInitCode .= "
						ckeditorConfig.extraPlugins = ckeditorConfig.extraPlugins + ',rex_help';
						";
					} else {
						$jsInitCode .= "
						ckeditorConfig.extraPlugins = ckeditorConfig.extraPlugins.replace(/rex_help/g,'');
						";
					}

					$jsInitCode .= "
					CKEDITOR.replace(textareaId, ckeditorConfig);
				});
			}
		});
		</script>";

		return str_replace('</head>', $jsInitCode . '</head>', $ep->getSubject());
	});
}

