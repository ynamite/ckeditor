<?php
// post vars
$page = rex_request('page', 'string');
$subpage = rex_request('subpage', 'string');

// layout top
require($REX['INCLUDE_PATH'] . '/layout/top.php');

// title
rex_title($REX['ADDON']['name']['ckeditor'] . ' <span style="font-size:14px; color:silver;">' . $REX['ADDON']['version']['ckeditor'] . '</span>');
?>

<?php
// Daten einlesen
$moduleInput = rex_get_file_contents($REX["INCLUDE_PATH"] . "/addons/ckeditor/module/input.php");
$moduleOutput = rex_get_file_contents($REX["INCLUDE_PATH"] . "/addons/ckeditor/module/output.php");

// Ist Modul schon vorhanden ?
$searchtext = 'module: ckeditor_default_in';

$gm = rex_sql::factory();
$gm->setQuery('select * from ' . $REX['TABLE_PREFIX'] . 'module where eingabe LIKE "%' . $searchtext . '%"');

$module_id = 0;
$module_name = "";

foreach($gm->getArray() as $module) {
  $module_id = $module["id"];
  $module_name = $module["name"];
}

if (isset($_REQUEST["install"]) && $_REQUEST["install"] == 1) {
  $ckeditor_module_name = "Texteditor (CKEditor)";

  $mi = rex_sql::factory();
  // $mi->debugsql = 1;
  $mi->setTable("rex_module");
  $mi->setValue("eingabe", addslashes($moduleInput));
  $mi->setValue("ausgabe", addslashes($moduleOutput));

  if (isset($_REQUEST["module_id"]) && $module_id == $_REQUEST["module_id"]) {
	// altes Module aktualisieren
    $mi->setWhere('id="' . $module_id . '"');
    $mi->update();

 	// article updaten
	rex_generateAll();
	
    echo rex_info($I18N->msg('module_updated').' | '.$I18N->msg('delete_cache_message'));
  }else {
	// neues Modul einf&uuml;gen
    $mi->setValue("name", $ckeditor_module_name);
    $mi->insert();
    $module_id = (int) $mi->getLastId();
	
    echo rex_info($I18N->msg('ckeditor_module_added', $ckeditor_module_name));
  }
}
?>

<div class="rex-addon-output">
	<h2 class="rex-hl2"><?php echo $I18N->msg('ckeditor_addon_help'); ?></h2>
	<div class="rex-area-content">
		<p class="logo"><a href="http://ckeditor.com"><img src="../files/addons/ckeditor/ckeditor.png" /></a><br /><a class="extern" href="http://ckeditor.com">ckeditor.com</a></p>
	</div>
</div>

<div class="rex-addon-output">
	<h2 class="rex-hl2"><?php echo $I18N->msg('ckeditor_install_module'); ?></h2>
	<div class="rex-area-content">
		<p><?php echo $I18N->msg('ckeditor_requirement'); ?></p>
		<ul>
		<?php
			if ($module_id > 0) {
				if (!isset($_REQUEST["install"])) {
					echo '<li><a href="index.php?page=ckeditor&amp;subpage=setup&amp;install=1&amp;module_id=' . $module_id . '">' . $I18N->msg('ckeditor_module_update') . '</a></li>';
				}
    		} else {
				if (!isset($_REQUEST["install"])) {
					echo '<li><a href="index.php?page=ckeditor&amp;subpage=setup&amp;install=1">' . $I18N->msg('ckeditor_module_install') . '</a></li>';
				}
			}
		?>		
		</ul>
		<p class="headline"><?php echo $I18N->msg('ckeditor_module_input'); ?><br /><?php rex_highlight_string($moduleInput); ?></p>
		<p>&nbsp;</p>
		<p class="headline"><?php echo $I18N->msg('ckeditor_module_output'); ?><br /><?php rex_highlight_string($moduleOutput); ?></p>
	</div>
</div>

<style type="text/css">
#rex-page-ckeditor p.logo {
	text-align: center;
	margin: 10px 0;
}
#rex-page-ckeditor p.logo img {
	margin-bottom: 5px;
}

#rex-page-ckeditor p.headline {
	margin-bottom: 5px;
	font-weight: bold;
}

#rex-page-ckeditor a.extern {
	font-size: 16px;
	background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAA8CAYAAACq76C9AAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAFFSURBVHjaYtTpO/CfAQcACCAmBjwAIIAY//9HaNTtP4hiCkAAMeGSAAGAAGJCl7hcaM8IYwMEEBMuCRAACCAmXBIgABBAKA5CBwABhNcrAAGEVxIggPBKAgQQXkmAAMIrCRBAeCUBAgivJEAA4ZUECCC8kgABhFcSIIDwSgIEEF5JgADCKwkQQHglAQIIryRAAOGVBAggvJIAAYRXEiCA8EoCBBBeSYAAwisJEEB4JQECiAVbNoABgADCqxMggPDmMoAAwpvLAAIIby4DCCC8uQwggPDmMoAAwpvLAAIIr1cAAgivJEAA4ZUECCC8kgABhFcSIIDwSgIEEF5JgADCKwkQQHglAQIIryRAAOGVBAggvJIAAYRXEiCA8EoCBBBeSYAAwisJEEB4JQECCK8kQADhlQQIILySAAGEVxIggPBKAgQYAARTLlfrU5G2AAAAAElFTkSuQmCC) no-repeat right 3px;
	padding-right: 10px;
}
</style>

<?php 
// layout bottom
require($REX['INCLUDE_PATH'] . '/layout/bottom.php');
?>
