<?php

$page = rex_request('page', 'string');
$subpage = rex_request('subpage', 'string');
$func = rex_request('func', 'string');

// save settings
if ($func == 'update') {
	$settings = (array) rex_post('settings', 'array', array());

	rex_ckeditor_utils::replaceSettings($settings);
	rex_ckeditor_utils::updateSettingsFile();
}
?>

<div class="rex-addon-output">
	<div class="rex-form">

		<h2 class="rex-hl2"><?php echo $I18N->msg('ckeditor_settings'); ?></h2>

		<form action="index.php" method="post">

			<fieldset class="rex-form-col-1">
				<div class="rex-form-wrapper">
					<input type="hidden" name="page" value="<?php echo $page; ?>" />
					<input type="hidden" name="subpage" value="<?php echo $subpage; ?>" />
					<input type="hidden" name="func" value="update" />

					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-text">
							<label for="smart_strip"><?php echo $I18N->msg('ckeditor_settings_smart_strip'); ?></label>
							<input type="hidden" name="settings[smart_strip]" value="0" />
							<input type="checkbox" name="settings[smart_strip]" id="smart_strip" value="1" <?php if ($REX['ADDON']['ckeditor']['settings']['smart_strip']) { echo 'checked="checked"'; } ?>>
						</p>
					</div>

					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-text">
							<label for="resize_grip"><?php echo $I18N->msg('ckeditor_settings_resize_grip'); ?></label>
							<input type="hidden" name="settings[resize_grip]" value="0" />
							<input type="checkbox" name="settings[resize_grip]" id="resize_grip" value="1" <?php if ($REX['ADDON']['ckeditor']['settings']['resize_grip']) { echo 'checked="checked"'; } ?>>
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

<style type="text/css">
#rex-page-ckeditor .rex-addon-output input[type='checkbox'] {
	width: auto;
}
</style>


