<?php
// enable php errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// these lines are to import the Guzzle plugin via Composer (autoload.php)
require 'vendor/autoload.php';
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\BadResponseException;


// we wrap the code in a try-catch, because we want to detect any errors
try 
{
	// A Client object is what we use to make requests -- it is almost like a web browser effectively
	$client = new GuzzleHttp\Client(['verify' => false]);

	// Request URL 
	$guzzle_domain = "https://ip-to-location1.p.rapidapi.com/myip?ip="; 
	
	$ip_address='149.167.183.103';
	$url = $guzzle_domain.$ip_address;
	
    $settings=['headers' => [
		'x-rapidapi-host' => 'ip-to-location1.p.rapidapi.com',
		'x-rapidapi-key' => '70a48b70efmshbbbc7c48b96c900p1d3b90jsn1bcdcbb9c724',
	]
    ];
	// Above was all set up, now actually make the request
	$response = $client->request('GET', $url, $settings);
	
	// Check the result, and handle the data
	if($response->getStatusCode() == 200) 
	{
		$user_location = json_decode($response->getBody(), true);
		//var_dump($json);
		 // Decode the response and display the user information

		 json_encode($user_location, JSON_PRETTY_PRINT);
		// display values from the array
		
		echo "<p>IP Address: {$user_location["ip"]}</p>";
		echo "<p>Range: " . implode(', ', $user_location["geo"]["range"]) . "</p>"; 
		echo "<p>Country: {$user_location["geo"]["country"]}</p>";
		echo "<p>Region: {$user_location["geo"]["region"]}</p>";
		echo "<p>EU: {$user_location["geo"]["eu"]}</p>";
		echo "<p>Timezone: {$user_location["geo"]["timezone"]}</p>";
		echo "<p>City: {$user_location["geo"]["city"]}</p>";
		echo "<p>ll: " . implode(', ', $user_location["geo"]["ll"]) . "</p>"; 
		echo "<p>Metro: {$user_location["geo"]["metro"]}</p>";
		echo "<p>Area: {$user_location["geo"]["area"]}</p>";
			}
	else 
	{
		echo "Error : " . $response->getStatusCode();
	}
}
catch (Exception $e) 
{
	echo "Error [RES]: \n";
	print_r($e->getResponse());
} 


?>