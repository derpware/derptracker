<?php

abstract class DataProvider {
	protected $config;
	protected $name = "unknown";
	
	protected $fetched = false;
	protected $metadata = false;
	protected $rawdata = false;
	
	protected abstract function fetchData();
	
	public function __construct() {
		$this->config = ConfigProvider::getInstance()->get($this->name);
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function isActive() {
		return $this->config["active"];
	}
	
	private function _fetchData() {
		if ($this->fetched !== true) {
			$this->fetchData();
			$this->fetched = true;
		}
	}
	
	public function getMetaData() {
		$this->_fetchData();
		return $this->metadata;
	}
	
	public function getRawData() {
		$this->_fetchData();
		return $this->rawdata;
	}
	
}
