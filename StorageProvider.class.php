<?php

abstract class StorageProvider {
	protected $config;
	protected $name = "unknown";
	
	public abstract function putData($data, $provider);
	
	public function __construct() {
		$this->config = ConfigProvider::getInstance()->get($this->name);
		$this->init();
	}
	
	public function init() {}
	
	public function getName() {
		return $this->name;
	}
	
	function isActive() {
		return $this->config["active"];
	}
}
