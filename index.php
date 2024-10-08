<?php
// Enable PHP errors
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//Session Security
ini_set('session.use_only_cookies',1);
ini_set('session.use_strict_mode',1);
session_set_cookie_params([
    'lifetime' => 1800,
    //'domain' =>'https://lab-d00a6b41-7f81-4587-a3ab-fa25e5f6d9cf.australiaeast.cloudapp.azure.com:7107',
    'path' => '/',
    'secure' => true,
    'httponly'=>true
]

);


if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if(!isset($_SESSION['last_regeneration'])){
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }else{
        $interval = 60 * 30;
        if (time()-$_SESSION['last_regeneration'] >= $interval){
            session_regenerate_id(true);
            $_SESSION['last_regeneration'] = time();
        }
    }
    

}

// Include the Controller class
include "controller/UserController.php" ;
include "controller/PageLogController.php" ;
include_once("model/PageLogModel.php");  

// Determine the requested action (route)
$action = isset($_GET['action']) ? $_GET['action'] : 'login';
$updateid = isset($_GET['updateid']) ? $_GET['updateid'] : null;
$access_update= isset($_GET['access_update']) ? $_GET['access_update'] : null;
$search= isset($_POST['search_term']) ? $_POST['search_term'] : null;
$search= isset($_POST['search_term']) ? $_POST['search_term'] : null;
$_SESSION['discord_code'] = isset($_GET['code']) ? $_GET['code'] : null;
$_SESSION['discord_token'] = isset($_SESSION['discord_token']) ? $_SESSION['discord_token']: null;

// Create an instance of the Controller
$user_controller = new UserController();
$pagelog_controller = new PageLogController();

//To store the logs
$pagelog_controller->StorePageLogList() ;

// Handle the requested action
switch($action) {
    case 'login':
        $user_controller->login();     
        break;   

    case 'register':
        $user_controller->register();
        break;

    case 'home':
    // Check if the 'username' key exists in the $_SESSION array
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        // Retrieve the username from the session
        $username = $_SESSION['username'];
        // Call the home method of the user controller with the username
        $user_controller->home($username);
        
    } else {
        // If the 'username' key does not exist or is empty, show the login prompt
        echo '<script>
        ("Please Login!");
        window.location.href = "index.php?action=login";
        </script>';
    }
    break;


    case 'discordLogin':
        // Check if the 'username' key exists in the $_SESSION array
        if (isset($_SESSION['username']) && !empty($_SESSION['username'])&& empty($_SESSION['discord_code'])) {
            $pagelog_controller->discordLogin();
        } elseif (isset($_SESSION['discord_code'])) {
            echo '<script>
                window.location.href = "index.php?action=discordInfo";
                </script>';
            exit(); // Stop further script execution
        } else {
            // If the 'username' key does not exist or is empty, show the login prompt
            echo '<script>
                alert("Please Login to discord!");
                window.location.href = "index.php?action=login";
                </script>';
            exit(); // Stop further script execution
        }
        break;

    case 'discordInfo':
        $pagelog_controller->discordInfo($_SESSION['discord_token'] );
        break;
        
    case 'permission':
        $user_controller->permission();
        break;

    case 'update':
        if ($updateid) {
            $user_controller->update($updateid,$access_update);  // Pass the updateid to the controller
        } else {
            echo "Error: No update ID provided.";
        }
        break;
        
        case 'pageloglist':
            if (isset($_SESSION['login']) && $_SESSION['login'] === true && ($_SESSION['access_level'] == 'admin' || $_SESSION['access_level'] == 'moderator')) {
                $pagelog_controller->pageLogList($action, $search);
            } else {
                $user_controller->denied();

            exit(); // Stop further script execution
            }
            break;
    
    case 'pagelogtable':
        if (isset($_SESSION['login']) && $_SESSION['login'] === true && ($_SESSION['access_level'] == 'admin' || $_SESSION['access_level'] == 'moderator')) {
        $pagelog_controller->pageLogTable($action,$search) ;
    } else {
        $user_controller->denied();

        exit(); // Stop further script execution
     
    }
    break;

    case 'pagelogjson':
        if (isset($_SESSION['login']) && $_SESSION['login'] === true && ($_SESSION['access_level'] == 'admin' || $_SESSION['access_level'] == 'moderator')) {
        $pagelog_controller->pageLogJSON($action,$search) ;
    } else {
        $user_controller->denied();
        exit(); // Stop further script execution
    }
    break;

    case 'logout':
        $user_controller->logout();
        break;

    default:
        $user_controller->denied(); // Default action
        break;
}


include "view/footer.php"; ?>


</body>
</html>
