<?php
class AppnetProvider extends DataProvider {
	protected $name = "appnet";
	
	function getData() {
		global $appnet;

		$appnet = file_get_contents("https://alpha-api.app.net/stream/0/users/".$this->config["userid"]);

		$json = json_decode($appnet, 1);

		$data = array(
			"following" 		=> $json["data"]["counts"]["following"],
			"followers"			=> $json["data"]["counts"]["followers"],
			"posts"				=> $json["data"]["counts"]["posts"],
			"stars" 			=> $json["data"]["counts"]["stars"]
			);
		return $data;
	}
}
