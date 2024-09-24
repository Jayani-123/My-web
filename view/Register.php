<?php

class Register
{
    public function output()
    {
        include "header.php";
        ?>
<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Signup</title>
</head>

<body>
    <div class='container py-5 h-100'>
        <div class='row d-flex justify-content-center align-items-center h-100'>
            <div class='col-12 col-md-8 col-lg-6 col-xl-5'>
                <div class='card shadow-2-strong bg-light' style='border-radius: 1rem;'>
                    <div class='card-body p-5 text-center'>

                        <div id='form'>
                            <h3 class='mb-5'>Signup to Avatar Community</h3>
                            <form id="signupform" action='index.php?action=register' method='POST'>
                                <div class="row g-3">
                                    <div class="col mb-3">
                                        <input type="text" class="form-control" placeholder="Username" aria-label="username" name="username">
                                    </div>
                                </div>
                                <div class="col mb-3">
                                    <input type="text" class="form-control" placeholder="Email" aria-label="email" id="email" name="email">
                                    <p id="error-message" style="color:red;"></p>
                                </div>
                                <div class="col mb-3">
                                <select class="form-select form-select" aria-label="community" id="community" name="community" >
                                    <option selected>Select the community you would like to join</option>
                                    <option value="Air">Air Nomads</option>
                                    <option value="Water">Water Tribe</option>
                                    <option value="Earth">Earth Kingdom</option>
                                    <option value="Fire">Fire Nation</option>
                                    </select>
                                 </div>
                                <div class="col mb-3">
                                    <input type="password" class="form-control" placeholder="Password" aria-label="password" id="password" name="password">
                                    <p id="error-message1" style="color:red;"></p>
                                </div>
                                <div class="col mb-3">
                                    <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Cpassword" id="cpassword" name="cpassword">
                                    <p id="error-message3" style="color:red;"></p>
                                </div>
                                <div class="col mb-3">
                                    <input type="text" class="form-control" placeholder="Enter Your IP Address" aria-label="ip_address" id="ip_address" name="ip_address">
                                    <a href = "https://whatismyipaddress.com" target="_blank">Click to find IP Address</a>
                                    <p id="error-message2" style="color:red;"></p>
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit">Signup</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function validateEmail(email) {
        // Regular expression for basic email validation
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailPattern.test(email);
    }

    function validatePassword(password) {
        // Regular expression for password validation
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        return passwordPattern.test(password);
    }

    function validateIPAddress(ip_address) {
        // Regular expression for basic IP address validation
        const ipAddressPattern = /^(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])$/;
        return ipAddressPattern.test(ip_address);
    }

    document.getElementById('signupform').addEventListener('submit', function(event) {
        const emailInput = document.getElementById('email').value;
        const ip_addressInput = document.getElementById('ip_address').value;
        const passwordInput = document.getElementById('password').value;
        const cpasswordInput = document.getElementById('cpassword').value;

        const errorMessage = document.getElementById('error-message');
        const errorMessage1 = document.getElementById('error-message1');
        const errorMessage2 = document.getElementById('error-message2');
        const errorMessage3 = document.getElementById('error-message3');

        let valid = true;

        // Validate email
        if (!validateEmail(emailInput)) {
            event.preventDefault(); // Prevent form submission if email is invalid
            errorMessage.textContent = 'Invalid email address.';
            errorMessage.style.color = 'red';
            valid = false;
        } else {
            errorMessage.textContent = ''; // Clear the error if the email is valid
        }

        // Validate password
        if (!validatePassword(passwordInput)) {
            event.preventDefault(); // Prevent form submission if password is invalid
            errorMessage1.textContent = 'Invalid password. Must be at least 8 characters long, include an uppercase letter, a lowercase letter, a number, and a special character.';
            errorMessage1.style.color = 'red';
            valid = false;
        } else {
            errorMessage1.textContent = ''; // Clear the error if the password is valid
        }

        // Validate confirm password
        if (passwordInput !== cpasswordInput) {
            event.preventDefault(); // Prevent form submission if passwords do not match
            errorMessage3.textContent = 'Passwords do not match.';
            errorMessage3.style.color = 'red';
            valid = false;
        } else {
            errorMessage3.textContent = ''; // Clear the error if passwords match
        }

        // Validate IP address
        if (!validateIPAddress(ip_addressInput)) {
            event.preventDefault(); // Prevent form submission if IP address is invalid
            errorMessage2.textContent = 'Invalid IP address.';
            errorMessage2.style.color = 'red';
            valid = false;
        } else {
            errorMessage2.textContent = ''; // Clear the error if the IP address is valid
        }

        return valid; // Return the overall validity
    });
    </script>

</body>

</html>
<?php
    }
}
?>
