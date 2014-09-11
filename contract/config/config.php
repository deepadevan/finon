<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

$config = array(
	'module_path'			=>	'contract',
	'module_name'			=>	'Contract',
	'module_description'	=>	'A simple Contract maintains .',
	'module_author'			=>	'Euphontec',
	'module_homepage'		=>	'http://euphontec.com/',
	'module_version'		=>	'0.1',
	'module_config'			=>	array(
		'dashboard_widget'	=>	'tasks/dashboard_widget',
		'settings_view'		=>	'tasks/task_settings/display',
		'settings_save'		=>	'tasks/task_settings/save',
		'dashboard_menu'	=>	'tasks/header_menu'
	)
);

?>