<?php
// Enable PHP errors
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once("model/UserModel.php");  
include_once("view/Login.php");
include_once("view/Register.php");
include_once("view/Home.php");
include_once("view/Logout.php");
include_once("view/Permission.php");
include_once("view/Denied.php");

class UserController 
{  
    public $model;   

    public function __construct()    
    {    
        $this->model = new UserModel();  
    }   
      
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
            // Retrieve the username and password from the POST request
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            // Verify login credentials using the Model's LoginVerify method
            $plain_user = $this->model->LoginVerify($username, $password);

            if ($plain_user ) {

                // If password is correct, set session variables
                $_SESSION['login'] = true;
                $_SESSION['username'] = $username;
    
                // Check if the user is logged in
                if (isset($_SESSION['login']) && $_SESSION['login'] === true)
            {   
                    // Get user details and redirect to the home page
                      
              $this->home($username); // Call home method in the controller 
              
             exit();      

            }
              
            } else {
                //If login fails, display an error message
                echo '<script>
                alert("Invalid username or password Please try again!");
                window.location.href = "index.php?action=login";
                </script>';
                $login = new Login();
                $login->output();
            }
        } else {
            // If the request is not POST, display the login form
            $login = new Login();
            $login->output();
        }
    
}
    public function register()  
    {  
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->StoreUser();
        } else{
        
        $register = new Register();
        $register->output();}
    }  
    
    public function home($username)  
    {   $userDetails = $this->model->getUserByUsername($username);
        foreach ($userDetails as $id => $user)      
        $_SESSION['access_level'] = $user->access_level;
        $home = new Home();
        $home->output($userDetails);

    } 

    public function permission()
    {
        if (isset($_SESSION['access_level']) && $_SESSION['access_level'] == 'admin') {
            // Check if the session variable 'access_level' is set and equals 'admin'
            $allUsers = $this->model->getAllUsers();  // Retrieve all users
            $permission = new Permission();  // Create an instance of the Permission class
            $permission->output($allUsers);  // Output permissions for all users
        } else {
            // Send HTTP 403 Forbidden header
            echo 'You do not have permission to access this page.';
            exit;  // Terminate script execution to prevent further processing
        }
    }
    public function update($id, $access_level)  
    {
        // First, check permissions before proceeding with any actions
        $this->permission();
    
        // If permission is granted, perform the update
        $this->model->UpdateUser($id, $access_level);
    
    
        echo '<script>
            alert("Update Successfully");
            window.location.href = "index.php?action=permission"; // Redirect to a specific page if needed
        </script>';
     
    }
    

public function logout() {

    $logout = new Logout();
    $logout->output();
}

public function denied() {

    $denied = new Denied();
    $denied->output();
}
}
