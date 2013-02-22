<?php
require_once 'lib/trakt/trakt.php';

class TraktProvider implements DataProvider {
	private $config;
	
	function __construct() {
		global $traktapi;
		$this->config = $trakt;
	}
	
	function isActive() {
		return $this->config["active"];
	}
	
	function getData() {
		$traktapi = new Trakt($trakt["apikey"]);
		$traktapi->setAuth($trakt["username"], $trakt["password"]);

		$episodesWatchedUnique  = $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["watched_unique"];
		$episodesWatched 	= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["watched"];
		$episodesScrobbles	= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["scrobbles"];
		$episodesScrobblesUnique = $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["scrobbles_unique"];
		$episodesCheckins	= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["checkins"];
		$episodesCheckinsUnique = $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["checkins_unique"];
		$episodesSeen		= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["seen"];
		$episodesUnwatched	= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["unwatched"];
		$episodesCollection	= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["collection"];
		$episodesShouts		= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["shouts"];
		$episodesLoved		= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["loved"];
		$episodesHated		= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["hated"];

		$showsLibrary		= $traktapi->userProfile($trakt["username"])["stats"]["shows"]["library"];
		$showsWatched		= $traktapi->userProfile($trakt["username"])["stats"]["shows"]["watched"];
		$showsCollection	= $traktapi->userProfile($trakt["username"])["stats"]["shows"]["collection"];
		$showsShouts		= $traktapi->userProfile($trakt["username"])["stats"]["shows"]["shouts"];
		$showsLoved		= $traktapi->userProfile($trakt["username"])["stats"]["shows"]["loved"];
		$showsHated		= $traktapi->userProfile($trakt["username"])["stats"]["shows"]["hated"];

		$moviesWatchedUnique	= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["watched_unique"];
		$moviesWatched		= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["watched"];
		$moviesScrobbles	= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["scrobbles"];
		$moviesScrobblesUnique	= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["scrobbles_unique"];
		$moviesCheckins		= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["checkins"];
		$moviesCheckinsUnique	= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["checkins_unique"];
		$moviesSeen		= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["seen"];
		$moviesLibrary		= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["library"];
		$moviesUnwatched	= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["unwatched"];
		$moviesCollection	= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["collection"];
		$moviesShouts		= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["shouts"];
		$moviesLoved		= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["loved"];
		$moviesHated		= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["hated"];

		$friends			= $traktapi->userProfile($trakt["username"])["stats"]["friends"];

		$data = array(
			"episodes_watched_unique" => $episodesWatchedUnique,
			"episodes_watched" => $episodesWatched,
			"episodes_scrobbles" => $episodesScrobbles,
			"episodes_scrobbles_unique" => $episodesScrobblesUnique,
			"episodes_checkins" => $episodesCheckins,
			"episodes_checkins_unique" => $episodesCheckinsUnique,
			"episodes_seen" => $episodesSeen,
			"episodes_unwatched" => $episodesUnwatched,
			"episodes_collection" => $episodesCollection,
			"episodes_shouts" => $episodesShouts,
			"episodes_loved" => $episodesLoved,
			"episodes_hated" => $episodesHated,
		
			"shows_library" => $showsLibrary,
			"shows_watched" => $showsWatched,
			"shows_collection" => $showsCollection,
			"shows_shouts" => $showsShouts,
			"shows_loved" => $showsLoved,
			"shows_hated" => $showsHated,
			
			"movies_watched_unique" => $moviesWatchedUnique,
			"movies_watched" => $moviesWatched,
			"movies_scrobbles" => $moviesScrobbles,
			"movies_scrobbles_unique" => $moviesScrobblesUnique,
			"movies_checkins" => $moviesCheckins,
			"movies_checkins_unique" => $moviesCheckinsUnique,
			"movies_seen" => $moviesSeen,
			"movies_library" => $moviesLibrary,
			"movies_unwatched" => $moviesUnwatched,
			"movies_collection" => $moviesCollection,
			"movies_shouts" => $moviesShouts,
			"movies_loved" => $moviesLoved,
			"movies_hated" => $moviesHated,
			
			"friends" => $friends
		);
		
		return $data;
	}
}
