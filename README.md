UBNT-AirOS
==========

Function to get information from UBNT(Ubiquiti) AirOS (AirMAX) Devices.


Example in example.php

Known Useful pages in AirOS Devices (tested at 5.5.4) Any older versions should work but may return information as an HTML page rather than JSON.

Config File (USEFUL)	- Raw  - http://ip:port/getcfg.sh?
Board Info				- Raw  - http://ip:port/getboardinfo.sh
Status information 		- JSON - http://ip:port/status.cgi?
List of Stations 		- JSON - http://ip:port/sta.cgi?
Throughput 				- JSON - http://ip:port/ifstats.cgi?
Interfaces with status 	- JSON - http://ip:port/iflist.cgi?
Bridge Table 			- JSON - http://ip:port/brmacs.cgi?brmacs=y
Arp Table 				- HTML - http://ip:port/arp.cgi?id=1385541198137
Routes Table 			- HTML - http://ip:port/sroutes.cgi
Log 					- HTML - http://ip:port/log.cgi
