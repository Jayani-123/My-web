<?php
// Ensure this is the very first line in your PHP file to avoid headers already being sent.
//http_response_code(403); // This sets the response code to 403 Forbidden.

// Optionally, you can also send the status using the header function for HTTP/1.1
header('HTTP/1.0 403 Forbidden');

class Denied
{  
    public function output()
    {

        ?>
<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Login</title>
</head>

<body>
</body>
</html>
<?php
    }
}

?>