<?php

/*
Written by Jamie Murphy - jamiemurphyit@gmail.com
Released under GNU V3 

Expected Input:

$inputarray['requestpage'] =  '/brmacs.cgi?brmacs=y'; 
$inputarray['expectedpage'] =  'http://ipaddress:port/brmacs.cgi?brmacs=y';  
$inputarray['loginurl'] =  'http://ipaddress:port/login.cgi'; 	 
$inputarray['username']	= 'ubnt';
$inputarray['password']	= 'ubnt';
$inputarray['cookiefile'] = '/location/of/cookies.txt';

	
$extrapages[0]['page-name'] = 'status';
$extrapages[0]['page-url'] = 'http://ipaddress:port/status.cgi?';

$extrapages[1]['page-name'] = 'stations';
$extrapages[1]['page-url'] = 'http://ipaddress:port/sta.cgi?';


Supports HTTPS and offset ports. 



*/



function get_pages_from_ubnt_airos_device($inputarray, $extrapages= ''){


	$sessioncreate = curl_init();
	curl_setopt($sessioncreate, CURLOPT_URL, $inputarray['loginurl']);
	curl_setopt($sessioncreate, CURLOPT_COOKIEFILE, $inputarray['cookiefile']);
	curl_setopt($sessioncreate, CURLOPT_COOKIEJAR, $inputarray['cookiefile']);
	curl_setopt($sessioncreate, CURLOPT_FOLLOWLOCATION, 1);

	curl_setopt($sessioncreate, CURLOPT_CONNECTTIMEOUT ,3); 
	curl_setopt($sessioncreate, CURLOPT_TIMEOUT, 3); //timeout in seconds

	curl_setopt($sessioncreate, CURLOPT_SSL_VERIFYPEER, FALSE);     
	curl_setopt($sessioncreate, CURLOPT_SSL_VERIFYHOST, 2); 
	curl_setopt($sessioncreate, CURLOPT_HTTPHEADER,array("Expect:  "));
	curl_setopt($sessioncreate, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($sessioncreate, CURLOPT_POST, 1);
	$result = curl_exec($sessioncreate);
	curl_close($sessioncreate);


	$crl = curl_init();

	curl_setopt($crl, CURLOPT_URL, $inputarray['loginurl']);
	curl_setopt($crl, CURLOPT_COOKIEFILE, $inputarray['cookiefile']);
	curl_setopt($crl, CURLOPT_COOKIEJAR, $inputarray['cookiefile']);
	curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, FALSE);    
	curl_setopt($crl, CURLOPT_CONNECTTIMEOUT ,3); 
	curl_setopt($crl, CURLOPT_TIMEOUT, 3); //timeout in seconds
	curl_setopt($crl, CURLOPT_SSL_VERIFYHOST, 2); 
	curl_setopt($crl, CURLOPT_HTTPHEADER,array("Expect:  "));
	curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($crl, CURLOPT_POST, 1);
	// This array will hold the field names and values for the post data
	$postdata = array(
		"username" => $inputarray['username'],
		"password" => $inputarray['password'],
		"redirect" => $inputarray['loginurl'],
		"uri" => $inputarray['requestpage']
	);
	//Use tamper data or a similar addon to find the post parameters needed, you may need more or less than the example
	//Tell curl we're going to send $postdata as the POST data
	curl_setopt($crl, CURLOPT_POSTFIELDS, $postdata);
	$result = curl_exec($crl);
	$headers = curl_getinfo($crl);
	curl_close($crl);



	if ($headers['url'] == $inputarray['expectedpage']) {
			$reply['auth'] = 'true';
			$reply['url'] = $headers['url'];
			$reply['page'] = $result;
		
		
		 //echo 'loggedin';
	} else if ($headers['url'] == $inputarray['loginurl']) {
			$reply['auth'] = 'false';
			$reply['url'] = $headers['url'];
			$reply['page'] = $result;
			return $reply;
		
	} else {
			$reply['auth'] = 'debug';
			$reply['url'] = $headers['url'];
			$reply['page'] = $result;
			return $reply;
		
	}


	if(!empty($extrapages)){
		foreach($extrapages as $page){
		
			$cfg = curl_init();
			curl_setopt($cfg, CURLOPT_URL, $page['page-url']);
			curl_setopt($cfg, CURLOPT_COOKIEFILE, $inputarray['cookiefile']);
			curl_setopt($cfg, CURLOPT_COOKIEJAR, $inputarray['cookiefile']);
			curl_setopt($cfg, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($cfg, CURLOPT_SSL_VERIFYPEER, FALSE);    
			curl_setopt($cfg, CURLOPT_CONNECTTIMEOUT ,3); 
			curl_setopt($cfg, CURLOPT_TIMEOUT, 3); //timeout in seconds
			curl_setopt($cfg, CURLOPT_SSL_VERIFYHOST, 2); 
			curl_setopt($cfg, CURLOPT_HTTPHEADER,array("Expect:  "));
			curl_setopt($cfg, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($cfg, CURLOPT_POST, 1);
			$pagename = 'page-'.$page['page-name'];
			$reply[$pagename] = curl_exec($cfg);
			
			curl_close($cfg);
		}

	}


	return $reply;
}

