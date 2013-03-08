<?php

abstract class DataProvider {
	protected $config;
	protected $name = "unknown";
	
	public abstract function getData();
	
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
