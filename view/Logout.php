<?php
class Logout
{
    public function output()
    { 
      session_unset(); // Unset all session variables
      session_destroy(); // Destroy the session
      include "header.php";
        ?>
<!doctype html>
<html lang='en'>
<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <title>Logout</title>

</head>

<body>
  <div class='container py-5 h-100'>
  <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
      <div class="card shadow-2-strong bg-light" style="border-radius: 1rem;">
        <div class="card-body p-5 text-center">
            <h3 class="mb-5">Logout Successfully</h3>
            <p><a href="index.php?action=login" class="btn btn-primary">Login again</a></p>
        </div>

          </div>
        </div>
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