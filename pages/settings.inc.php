<?php

$configFile = $REX['INCLUDE_PATH'] . '/addons/ckeditor/settings.inc.php';

if (rex_request('func', 'string') == 'update') {
	$smart_strip = trim(rex_request('smart_strip', 'string'));

	$REX['ADDON']['ckeditor']['settings']['smart_strip'] = $smart_strip;

	$content = '
		$REX[\'ADDON\'][\'ckeditor\'][\'settings\'][\'smart_strip\'] = "' . $smart_strip . '";
	';

	if (rex_replace_dynamic_contents($configFile, str_replace("\t", "", $content)) !== false) {
		echo rex_info($I18N->msg('ckeditor_configfile_update'));
	} else {
		echo rex_warning($I18N->msg('ckeditor_configfile_nosave'));
	}
}

if (!is_writable($configFile)) {
	echo rex_warning($I18N->msg('ckeditor_configfile_nowrite', $configFile));
}
?>

<div class="rex-addon-output">
	<div class="rex-form">

		<h2 class="rex-hl2"><?php echo $I18N->msg('ckeditor_settings'); ?></h2>

		<form action="index.php" method="post">

			<fieldset class="rex-form-col-1">
				<div class="rex-form-wrapper">
					<input type="hidden" name="page" value="ckeditor" />
					<input type="hidden" name="subpage" value="<?php echo rex_request('subpage'); ?>" />
					<input type="hidden" name="func" value="update" />

					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-text">
							<label for="smart_strip"><?php echo $I18N->msg('ckeditor_settings_smart_strip'); ?></label>
							<input type="checkbox" name="smart_strip" id="smart_strip" value="1" <?php if ($REX['ADDON']['ckeditor']['settings']['smart_strip'] == 1) { echo 'checked="checked"'; } ?>>
						</p>
					</div>

					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-submit">
							<input type="submit" class="rex-form-submit" name="sendit" value="<?php echo $I18N->msg('ckeditor_settings_save'); ?>" />
						</p>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>



