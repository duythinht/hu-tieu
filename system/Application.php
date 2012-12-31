<?php

function __autoload($name) {
	global $config;

	$core_class = $config['system'].'/core/' . $name . '.php';
	$controller_class = $config['application'].DIRECTORY_SEPARATOR.$config['controller'].DIRECTORY_SEPARATOR.$name.'.php';
	$model_class = $config['application'].DIRECTORY_SEPARATOR.$config['model'].DIRECTORY_SEPARATOR.$name.'.php';

	//Try to load core library, controller, or model
	if (file_exists($core_class)) {
		require_once $core_class;
	} elseif (file_exists($controller_class)) {
		require_once $controller_class;
	} elseif (file_exists($model_class)) {
		require_once $model_class;
	} else {
		throw new Exception("Unable to load $name");
	}
}

class Application {

	public function run()
	{
		$this->route();
	}

	private function route()
	{
		global $config;
		$context = $_SERVER['PATH_INFO'];
		$segment = explode('/', $context);

		if (!empty($segment[1])) {
			$controller = $segment[1];	
		} else {
			$controller = $config['default_controller'];
		}
		
		if (!empty($segment[2])) {
			$method = $segment[2];	
		} else {
			$method = 'index';
		}
		
		$x = new $controller();
		$x->$method();
	}

}