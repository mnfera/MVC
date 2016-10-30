<?php

class View {
	
	private $path;
	
	public function __construct($path) {
		$this->path = $path;
	}
	
	public function show() {
		$abs_path = ABSPATH."/views/".$this->path.".php";
		
		if (file_exists($abs_path)) {
			require_once $abs_path;
			return;
		}
		require_once ABSPATH."/includes/404.php";
				
	}
	
	public function add_variable($name, $value) {
		$this->{$name} = $value;
	}
	
}