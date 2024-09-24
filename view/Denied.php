<?php
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
    <title>Denied</title>
</head>

<body>
    <h1>404 Forbidden</h1>
    <p>You do not have permission</p>
</body>
</html>
<?php
    }
}

?>