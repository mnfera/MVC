<?php

/**
 * Classe responsável por carregar o framework e executá-lo.
 * @author Mikael Nilton.
 */
class MVC {
	private $controller;
	private $action;
	private $parameters;
	private $not_found = "/includes/404.php";
	
	public function __construct(){
		$this->get_url_data();
		if (!$this->controller){
			require_once ABSPATH."/controllers/HomeController.class.php";
			$this->controller = new HomeController($this->parameters);
			$this->controller->index();
			return;
		}
		if(!file_exists(ABSPATH.'/controllers/'.$this->controller.'.class.php')){
			require_once ABSPATH.$this->not_found;
			return;
		}
		require_once ABSPATH.'/controllers/'.$this->controller.'.class.php';
		if(!class_exists($this->controller)){
			require_once ABSPATH.$this->not_found;
			return;
		}
		$this->controller = new $this->controller($this->parameters);
		if (!$this->action && method_exists($this->controller, 'index')){
			$this->controller->index();
			return;
		}
		if (method_exists($this->controller, $this->action)){
			$this->controller->{$this->action}();
			return;
		}
		require_once ABSPATH.$this->not_found;
	}
	
	public function get_url_data(){
		if(isset($_GET['path'])) {
			$path = $_GET['path'];
			$path = rtrim($path, '/');
			$path = filter_var($path, FILTER_SANITIZE_URL);
			$path = explode('/', $path);
			$this->controller = (isset($path[0]) && !empty($path[0])) ? ucfirst(strtolower($path[0])) : null;
			$this->controller .= "Controller";
			$this->action = (isset($path[1]) && !empty($path[1])) ? strtolower($path[1]) : null;
			if(isset($path[2]) && !empty($path[2])){
				unset($path[0]);
				unset($path[1]);
				$this->parameters = array_values($path);
			}
		}
	}
}