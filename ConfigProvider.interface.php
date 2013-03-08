<?php

abstract class ConfigProvider {
	private static $instance;
	
	public static function create($class) {
		self::$instance = new $class();
	}
	
	public static function getInstance() {
		return self::$instance;
	}
	
	public abstract function get($name);
	public abstract function put($name, $config);
}
