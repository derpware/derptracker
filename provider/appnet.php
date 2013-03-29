<?php
class AppnetProvider extends DataProvider {
	protected $name = "appnet";
	
	protected function fetchData() {
		$appnetmeta = file_get_contents("https://alpha-api.app.net/stream/0/users/".$this->config["userid"]);
		$appnetraw 	= file_get_contents("https://alpha-api.app.net/stream/0/users/".$this->config["userid"]."/posts");

		$jsonmeta 	= json_decode($appnetmeta, 1);
		$jsonraw 	= json_decode($appnetraw, 1);

		$this->metadata = array(
			"following" 		=> $jsonmeta["data"]["counts"]["following"],
			"followers"			=> $jsonmeta["data"]["counts"]["followers"],
			"posts"				=> $jsonmeta["data"]["counts"]["posts"],
			"stars" 			=> $jsonmeta["data"]["counts"]["stars"]
			);

		$this->rawdata = array(
			"postid"			=> $jsonraw["data"]["0"]["id"],
			"post"				=> $jsonraw["data"]["0"]["text"]
			);
	}
	

}
