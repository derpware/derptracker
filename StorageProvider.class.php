<?php

abstract class StorageProvider {
	protected $config;
	protected $name = "unknown";
	
	public abstract function putData($data, $provider);
	
	function __construct() {
		$this->config = ConfigProvider::getInstance()->get($this->name);
	}
	
	function getName() {
		return $this->name;
	}
	
	function isActive() {
		return $this->config["active"];
	}
}
