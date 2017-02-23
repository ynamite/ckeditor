<?php
class rex_ckeditor {
	public static function applyPatches() {
		// anti flicker patch
		$contentsCSSFile = file_get_contents(rex_path::addonAssets('ckeditor', 'vendor/contents.css'));

		$regex = array(
		"`^([\t\s]+)`ism"=>'',
		"`^\/\*(.+?)\*\/`ism"=>"",
		"`([\n\A;]+)\/\*(.+?)\*\/`ism"=>"$1",
		"`([\n\A;\s]+)//(.+?)[\n\r]`ism"=>"$1\n",
		"`(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+`ism"=>"\n"
		);
		$buffer = preg_replace(array_keys($regex), $regex, $contentsCSSFile);
		$buffer = preg_replace("/[\r\n]+/", "\n", $buffer);
		$buffer = preg_replace("/\s+/", ' ', $buffer);
		$buffer = str_replace('"', '\'', $buffer);
		$buffer = str_replace('font-size: 12px;', 'font-size: 13px !important; line-height: 1.6;', $buffer);

		$jsFile = rex_path::addonAssets('ckeditor', 'vendor/ckeditor.js');
		$ckjs = file_get_contents($jsFile);
		//$ckjs = str_replace('a.push("html{cursor:text;*cursor:auto}");', 'a.push("html{cursor:text;*cursor:auto}body{font-family: sans-serif, Arial, Verdana;font-size:13px !important;color: #333;background-color: #fff;margin: 20px;line-height: 1.6em;}a{color: #0782C1;font-weight:normal;}ol,ul,dl {*margin-right: 0px; padding: 0 40px; }h1,h2,h3,h4,h5,h6 { font-weight: normal; line-height: 1.2em;}");', $ckjs);

		// margin for images
		$buffer = 'img{margin:10px;}' . $buffer;

		$ckjs = str_replace('a.push("html{cursor:text;*cursor:auto}");', 'a.push("html{cursor:text;*cursor:auto}' . $buffer . '");', $ckjs);
		file_put_contents($jsFile, $ckjs);

		// copy extra plugins
		rex_dir::copy(rex_path::addon('ckeditor', 'install/plugins'), rex_path::addonAssets('ckeditor', 'vendor/plugins'));

		// copy extra plugins from project addon
		$extraPluginsPath = rex_path::addon('project', 'install/ckeditor/plugins');

		if (file_exists($extraPluginsPath)) {
			rex_dir::copy($extraPluginsPath, rex_path::addonAssets('ckeditor', 'vendor/plugins'));
		}
	}

	public static function replaceImageTags($html, $mediaType) {
		return preg_replace_callback("/(<img[^>]*src *= *[\"']?)([^\"']*)/i", function($matches) use ($mediaType) {
			$mediaFile = basename($matches[2]);
			
			if (method_exists('rexx','getMediaManagerFile')) {
				$src = rexx::getMediaManagerFile($mediaFile, $mediaType);
			} else {
				$src = '/index.php?rex_media_type=' . $mediaType . '&amp;rex_media_file=' . $mediaFile;
			}

			return $matches[1] . $src;
		}, $html);
	}
}
