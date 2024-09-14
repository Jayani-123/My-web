<?php
class DiscordLogin
{  
    public function output()
    { include "header.php";

        ?>
<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>DiscordLogin</title>
</head>
<body>
<div class='container'>
<p>Please press the Link to go to discord page</p>
<a href="https://discord.com/oauth2/authorize?client_id=1283049993837744129&response_type=code&redirect_uri=https%3A%2F%2Flab-d00a6b41-7f81-4587-a3ab-fa25e5f6d9cf.australiaeast.cloudapp.azure.com%3A7107%2FAssignment%2Findex.php%3Faction%3DdiscordInfo&scope=identify+guilds">
Login Discord</a>
                               
</div>
</body>
</html>
<?php
    }
}
?>

