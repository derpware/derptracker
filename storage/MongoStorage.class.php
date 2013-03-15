<?php

class MongoDBStorage extends StorageProvider {

	protected $name = "mongodb";
	protected $mongo;
	protected $db;

	public function putData($data, $provider) {
		$provider = $provider->getName();
		$collection = $this->db->$provider;
		$data["_timestamp"] = new MongoDate();
		$collection->insert($data);	
	}

	public function init(){
		$this->mongo = new Mongo();
	 	$this->db = $this->mongo->derptracker; 
	}
}

