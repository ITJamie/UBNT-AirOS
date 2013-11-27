<?php

require('airos_function.php');

// Here are the minimum requirements to login and get back the first page. Supports http and https and offset ports.
$inputarray['username']	= 'ubnt';
$inputarray['password']	= 'ubnt';
$inputarray['cookiefile'] = '/home/user/airos/cookies/192.168.1.2.txt';

$inputarray['requestpage'] =  '/brmacs.cgi?brmacs=y'; 
$inputarray['expectedpage'] =  'https://192.168.1.2:8443/brmacs.cgi?brmacs=y';  
$inputarray['loginurl'] =  'http://192.168.1.2:8443/login.cgi'; 	 


// Here you can request extra pages once the first page has been logged into. This is not required.
$extrapages[0]['page-name'] = 'status';
$extrapages[0]['page-url'] = 'http://192.168.1.2:8443/status.cgi?';

$extrapages[1]['page-name'] = 'stations';
$extrapages[1]['page-url'] = 'http://192.168.1.2:8443/sta.cgi?';


$reply = get_pages_from_ubnt_airos_device($inputarray, $extrapages);


print_r($reply);
