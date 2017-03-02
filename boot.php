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

	rex_view::addJsFile($this->getAssetsUrl('smart_strip.js'));

	rex_extension::register('OUTPUT_FILTER', function($ep) {
		$sql = rex_sql::factory();
		$result = $sql->setQuery("SELECT `name`, `jscode`, `smartstrip` FROM `" . rex::getTablePrefix() . "ckeditor_profiles` ORDER BY `id` ASC")->getArray();

		$jsInitCode = "
		<script type=\"text/javascript\">
		function rex_ckeditor_init_all() {
			var i = 0;

			$('.ckeditor').each(function() {
				i++;

				// if id of textarea is missing set one, otherwise ckeditor replace will not work
				if (!$(this).attr('id')) {
					$(this).attr('id', 'ckeditor-' + i);
				}

				var textareaId = $(this).attr('id');

				rex_ckeditor_init(textareaId);
			});
		}

		function rex_ckeditor_init(textareaId) {
			var jTextarea = $('#' + textareaId);
			var profiles = {};
			var smartStripSettings = {};
		";

		foreach ($result as $row) {
			$jsInitCode .=	"profiles['" . $row['name'] . "'] = " . $row['jscode'] . ";

			";

			$jsInitCode .=	"smartStripSettings['" . $row['name'] . "'] = " . $row['smartstrip'] . ";

			";
		}

		if (isset($result[0])) {
			$defaultProfileName = $result[0]['name'];
		} else {
			$defaultProfileName = '';
		}

		$jsInitCode .= "
			var defaultProfileName = '" . $defaultProfileName . "';

			if (defaultProfileName !== '' && $('#' + textareaId).length) {
				var ckeditorConfig;
				var currentProfileName;

				// set config object
				if (jTextarea.attr('data-ckeditor-profile') && jTextarea.attr('data-ckeditor-profile') in profiles) {
					currentProfileName = jTextarea.attr('data-ckeditor-profile');
				} else {
					currentProfileName = defaultProfileName;
				}

				ckeditorConfig = profiles[currentProfileName];

				// add smart strip class
				if (smartStripSettings[currentProfileName] === 1) {
					jTextarea.addClass('ckeditor-smartstrip');
				}
		
				// overwrite height if necessary
				if (jTextarea.attr('data-ckeditor-height')) {
					ckeditorConfig.height = jTextarea.attr('data-ckeditor-height');
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
			}
		}

		function rex_ckeditor_destroy_all() {
			for (name in CKEDITOR.instances) {
				CKEDITOR.instances[name].destroy(true);
			}
		}

		function rex_ckeditor_destroy(instanceName) {
			for (name in CKEDITOR.instances) {
				CKEDITOR.instances[instanceName].destroy(true);
			}
		}

		$(document).on('rex:ready', function (event, container) {
			rex_ckeditor_init_all();
		});
		</script>";

		return str_replace('</head>', $jsInitCode . '</head>', $ep->getSubject());
	});
}


