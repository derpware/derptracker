<?php

require_once 'config.php';
require_once 'lib/trakt/trakt.php';
require_once 'lib/cosm/PachubeAPI.php';

$pachube = new PachubeAPI($cosm["apikey"]);

$traktapi = new Trakt($trakt["apikey"]);
$traktapi->setAuth($trakt["username"], $trakt["password"]);

$episodesWatched 	= $traktapi->userProfile($trakt["username"])["stats"]["episodes"]["watched"];
$showsWatched		= $traktapi->userProfile($trakt["username"])["stats"]["shows"]["watched"];
$moviesWatched		= $traktapi->userProfile($trakt["username"])["stats"]["movies"]["watched"];
$friends			= $traktapi->userProfile($trakt["username"])["stats"]["friends"];

$pachube->updateDatastream("csv", $trakt["feedid"], "episodes_watched", $episodesWatched);
$pachube->updateDatastream("csv", $trakt["feedid"], "shows_watched", $showsWatched);
$pachube->updateDatastream("csv", $trakt["feedid"], "movies_watched", $moviesWatched);
$pachube->updateDatastream("csv", $trakt["feedid"], "friends", $friends);