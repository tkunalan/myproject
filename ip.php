<?php
/*
$http_client_ip = $_SERVER['SERVER_CLIENT_IP'];
$http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
$remote_addr = $_SERVER['REMOTE_ADDR'];
*/
function userIp($ip){

	$ip;
	$city;
	$region;
	$country;
	
	if(!empty($ip)){
		
		$user_ip = $ip;
		$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
		$ip = $user_ip;
		$city = $geo["geoplugin_city"];
		$region = $geo["geoplugin_regionName"];
		$country = $geo["geoplugin_countryName"];
		
		
	}else if(!empty($http_x_forwarded_for)){
		
		$user_ip = $http_x_forwarded_for;
		$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
		$ip = $user_ip;
		$city = $geo["geoplugin_city"];
		$region = $geo["geoplugin_regionName"];
		$country = $geo["geoplugin_countryName"];
		
		
	}else{

		echo $ip = $ip;
	}
	
	return "Your IP: ".$ip."</br> City: ".$city."</br> Region: ".$region."</br> Country: ".$country."</br>";
}
 
echo userIp('112.134.51.187')
?>