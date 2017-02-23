<?php
	$func = rex_request('func', 'string');
	
	if ($func == '') {
		$list = rex_list::factory("SELECT `id`, `name`, `description` FROM `".rex::getTablePrefix()."ckeditor_profiles` ORDER BY `id` ASC");
		$list->addTableAttribute('class', 'table-striped');
		$list->setNoRowsMessage($this->i18n('profiles_norowsmessage'));
		
		// icon column
		$thIcon = '<a href="'.$list->getUrl(['func' => 'add']).'" title="'.$this->i18n('column_hashtag').' '.rex_i18n::msg('add').'"><i class="rex-icon rex-icon-add-action"></i></a>';
		$tdIcon = '<i class="rex-icon fa-file-text-o"></i>';
		$list->addColumn($thIcon, $tdIcon, 0, ['<th class="rex-table-icon">###VALUE###</th>', '<td class="rex-table-icon">###VALUE###</td>']);
		$list->setColumnParams($thIcon, ['func' => 'edit', 'id' => '###id###']);
		
		$list->setColumnLabel('name', $this->i18n('profiles_column_name'));
		$list->setColumnLabel('description', $this->i18n('profiles_column_description'));
		
		$list->setColumnParams('name', ['id' => '###id###', 'func' => 'edit']);
		
		$list->removeColumn('id');
		
		$content = $list->get();
		
		$fragment = new rex_fragment();
		$fragment->setVar('content', $content, false);
		$content = $fragment->parse('core/page/section.php');
		
		echo $content;
	} else if ($func == 'add' || $func == 'edit') {
		$id = rex_request('id', 'int');
		
		if ($func == 'edit') {
			$formLabel = $this->i18n('profiles_formcaption_edit');
		} elseif ($func == 'add') {
			$formLabel = $this->i18n('profiles_formcaption_add');
		}
		
		$form = rex_form::factory(rex::getTablePrefix().'ckeditor_profiles', '', 'id='.$id);		
	
		$field = $form->addTextField('name');
		$field->setLabel($this->i18n('profiles_label_name'));
	
	
		$field = $form->addTextField('description');
		$field->setLabel($this->i18n('profiles_label_description'));
	
	
		$field = $form->addTextAreaField('jscode');
		$field->setAttribute('class', 'codemirror');
		$field->setAttribute('data-codemirror-mode', 'text/javascript');
		$field->setLabel($this->i18n('profiles_label_jscode'));
		
		if ($func == 'edit') {
			$form->addParam('id', $id);
		}
		
		$content = $form->get();
		
		$fragment = new rex_fragment();
		$fragment->setVar('class', 'edit', false);
		$fragment->setVar('title', $formLabel, false);
		$fragment->setVar('body', $content, false);
		$content = $fragment->parse('core/page/section.php');
		
		echo $content;
	}
?>
