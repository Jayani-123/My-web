<?php

class Login
{  
    public function output()
    { include "header.php";

        ?>
<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Login</title>
</head>

<body>
    <div class='row d-flex justify-content-center align-items-center py-5 h-100'>
        <div class='col-12 col-md-8 col-lg-6 col-xl-5'>
            <div class='card shadow-3-strong bg-light' style='border-radius: 1rem;'>
                <div class='card-body p-5 text-center'>
                    <div id='form'>
                        <h4 class='mb-5'>Login to Avatar Community</h4>
                        <form name='form' action='index.php?action=login' method='POST'>
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="User Name" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-6 text-left">
                                    <a href="index.php?action=register" class="btn btn-link">Create an Account</a>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="submit" class="btn btn-primary btn-block">Log in</button>
                                </div>
                            </div>
                        </form>
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
