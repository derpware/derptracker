<?php
require_once 'config.php';
require_once 'lib/cosm/PachubeAPI.php';

if($foursquare["active"])
	include('foursquare.php');

if($trakt["active"])
	include('trakt.php');
