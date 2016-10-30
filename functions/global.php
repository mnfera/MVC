<?php

function __autoload($class_name) {
	
	$file = ABSPATH.'/classes/'.$class_name.'.class.php';
	
	if (!file_exists($file)) {
		require_once ABSPATH.'/includes/404.php';
		return;
	} else {
		require_once $file;
	}
	
}