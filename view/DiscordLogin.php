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
  <div class="container py-5 h-100">
  <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
      <div class="card shadow-2-strong bg-light" style="border-radius: 1rem;">
        <div class="card-body p-5 text-center">
<button class="btn btn-primary" type="button"><i class="bi bi-discord"></i></button>

<a href="https://discord.com/oauth2/authorize?client_id=1283049993837744129&response_type=code&redirect_uri=https%3A%2F%2Flab-d00a6b41-7f81-4587-a3ab-fa25e5f6d9cf.australiaeast.cloudapp.azure.com%3A7107%2FAssignment%2Findex.php%3Faction%3DdiscordInfo&scope=identify+guilds">
Discord Login</a>
</div>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>
</html>
<?php
    }
}
?>

