
<?php
// Import the Guzzle plugin via Composer (autoload.php)
require 'vendor/autoload.php';

// Import necessary Guzzle classes
use GuzzleHttp\Client; // Import the Guzzle Client
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\BadResponseException;

class DiscordInfo
{
    public function output($discord_token)
    {
        include "header.php";
   
        // HTML structure
        ?>
        <!doctype html>
        <html lang='en'>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <title>DiscordInfo</title>
        </head>
        <body>
        <div class='container'>
            
        <?php
        

        try {
            // Initialize the Guzzle client
            $client = new Client(['verify' => false]);
            
            // Discord API and OAuth2 credentials
            $API_ENDPOINT = 'https://discord.com/api/v10';
            $CLIENT_ID = '1283049993837744129';
            $CLIENT_SECRET = 'QCD1-sTl-K2RgWMEl1ma6MCnjZfYijEF';
            $REDIRECT_URI = 'https://lab-d00a6b41-7f81-4587-a3ab-fa25e5f6d9cf.australiaeast.cloudapp.azure.com:7107/Assignment/index.php?action=discordLogin';
            //$code = $discord_code ;
            $code =$_SESSION['discord_code'] ;

            // The correct token request URL
            $url = $API_ENDPOINT . '/oauth2/token';
           
            if($discord_token== null){
                
            // Make the POST request to exchange the authorization code for an access token
            $response = $client->request('POST', $url, [
                'form_params' => [
                    'grant_type'    => 'authorization_code',
                    'code'          => $code,
                    'redirect_uri'  => $REDIRECT_URI,
                    'client_id'     => $CLIENT_ID,
                    'client_secret' => $CLIENT_SECRET
                ],
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ]
            ]);
        
            // Check for a successful response and display the result
            if ($response->getStatusCode() == 200) {
                // Decode the JSON response body
                $json = json_decode($response->getBody(), true);
            }}
            
                // Extract the access token from the decoded JSON response
                if (isset($json['access_token'])|| isset($discord_token)) {
                    $access_token = isset($json['access_token']) ? $json['access_token'] : $discord_token;
                   
                    // Make another GET request to fetch the authenticated user's details
                    $discord_users_url = 'https://discord.com/api/users/@me';

                    // Set the authorization header with the access token
                    $response_user = $client->request('GET', $discord_users_url, [
                        'headers' => [
                            'Authorization' => "Bearer {$access_token}"
                        ]
                    ]);

                    // Decode the response and display the user information
                    $user_info = json_decode($response_user->getBody(), true);

                    // Fetch the user's guilds (servers)
                    $discord_servers = 'https://discord.com/api/users/@me/guilds';

                    // Set the authorization header with the access token
                    $response_server = $client->request('GET', $discord_servers, [
                        'headers' => [
                            'Authorization' => "Bearer {$access_token}"
                        ]
                    ]);

                    // Decode the server information
                    $server_info = json_decode($response_server->getBody(), true);

                    // Extract and display user information
                    $discord_name = isset($user_info['username']) ? $user_info['username'] : 'N/A';
                    $discord_id = isset($user_info['id']) ? $user_info['id'] : 'N/A';
                    $avatar = isset($user_info['avatar']) ? $user_info['avatar'] : '';

                    // Construct the Discord avatar URL
                    $discord_avatar_url = $avatar ? "https://cdn.discordapp.com/avatars/{$discord_id}/{$avatar}.jpeg" : '';

                    // Display the user info
                    echo "<h5>Welcome  {$discord_name}</h5> <br>";
                    echo "<img src='{$discord_avatar_url}' alt='Discord Avatar' />";
                    echo "<br><br>";

                    // Display server info
                    echo "<h5>Your Discord Server Names</h5> <br>";
                    if (is_array($server_info)) {
                        $i = 1;
                        foreach ($server_info as $server) {
                            $server_name = isset($server['name']) ? $server['name'] : 'N/A';
                            echo "<p>{$i}. {$server_name}</p>";
                            $i++;
                        }
                    } else {
                        echo "<p>Server info is not available.</p>";
                    }

                } else {
                    echo "Access token not found in the response.";
                }
            
            
        } catch (RequestException $e) {
            // Handle general errors
            echo 'General Error: ' . $e->getMessage();
        } catch (Exception $e) {
            // Handle general errors
            echo 'General Error: ' . $e->getMessage();
        }
        ?>

        </div>
        </body>
        </html>
        <?php
    }
}
?>
