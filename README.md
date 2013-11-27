UBNT-AirOS
==========

Function to get information from UBNT(Ubiquiti) AirOS (AirMAX) Devices.


Example in example.php

Known Useful pages in AirOS Devices (tested at 5.5.4) Any older versions should work but may return information as an HTML page rather than JSON.

*Raw:*
-Config File (USEFUL) - http://ip:port/getcfg.sh?
-Board Info - http://ip:port/getboardinfo.sh

*JSON:*
-Status information - http://ip:port/status.cgi?
-List of Stations - http://ip:port/sta.cgi?
-Throughput - http://ip:port/ifstats.cgi?
-Interfaces with status - http://ip:port/iflist.cgi?
-Bridge Table - http://ip:port/brmacs.cgi?brmacs=y

*HTML:*
-Arp Table - http://ip:port/arp.cgi?id=1385541198137
-Routes Table - http://ip:port/sroutes.cgi
-Log - http://ip:port/log.cgi
