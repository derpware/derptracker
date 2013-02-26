# DerpTracker
The derptracker tracks all your derp data from all those derp post privacy services you use and love. Currently supported services are in the "Services" section of this README. If you want to see more services, create an issue, or just build them and send us a pull request. If you are even more awesome, you do both, so we know somebody is working on something.

## Services
Derp services this thing supports:
* App.net
* Foursquare
* put.io
* trakt.tv
* Withings

## Installation
1. Download the code.
2. Put it on some server or other derp computer that runs 24/7.
3. Get a Cosm API key and put it in config.php
4. Set up individual services in config.php. Take a look at the [wiki](https://github.com/derpware/derptracker/wiki) to see how.
5. Call cron.php from a cron job somewhat regularly, like every five minutes.

## License
Licensed under MIT license. For details, see the LICENSE file
