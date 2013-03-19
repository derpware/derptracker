<?php

abstract class StorageProvider {
	protected $config;
	protected static $name = "unknown";
	
	public abstract function putData($provider, $metadata, $rawdata);
	
	public function __construct() {
		$this->config = ConfigProvider::getInstance()->get(static::$name);
		$this->init();
	}
	
	public function init() {}
	
	public function getName() {
		return $this->name;
	}
	
	public static function isActive() {
		$config = ConfigProvider::getInstance()->get(static::$name);
		return $config["active"];
	}
}
