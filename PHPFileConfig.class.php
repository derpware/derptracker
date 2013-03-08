<?php
require_once(BASE_PATH.'/config.php');	

class PHPFileConfig extends ConfigProvider {
	public function get($name) {
		global $$name;
		return $$name;
	}
	
	public function put($name, $config) {
		return false;
	}
}
