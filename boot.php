<?php
if (rex::isBackend() && rex::getUser() instanceof rex_user) {
	if ($this->getConfig('patches_applied') == 0) {
		// apply patches
		rex_ckeditor::applyPatches();

		$this->setConfig('patches_applied', 1);
	}

	$profileFile = rex_ckeditor::getProfileJSFile();

	if (!file_exists($profileFile)) {
		rex_ckeditor::writeProfileJSFile();
	}
	
	rex_view::addJsFile($this->getAssetsUrl('vendor/ckeditor.js'));
	rex_view::addJsFile($profileFile); // profiles.dyn.js
	rex_view::addJsFile($this->getAssetsUrl('redaxo.js'));
	rex_view::addCssFile($this->getAssetsUrl('backend.css'));
}


