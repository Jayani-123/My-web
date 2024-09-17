<?php
// Enable PHP errors
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include_once("DBConn.php");  
include_once("User.php");  
  
class UserModel 
{ 


    public function StoreUser() 
    { global $conn;

    if (isset($_POST['submit'])) {
        $plain_username = mysqli_real_escape_string($conn, $_POST['username']);
        $plain_password = trim($_POST['password']);
        $plain_cpassword = trim($_POST['cpassword']);
        $plain_email = mysqli_real_escape_string($conn, $_POST['email']);
        $plain_ip_address =  $_POST['ip_address'];
        $plain_access_level = 'basic'; // Default access level for new users

        if ($plain_password !== $plain_cpassword) {
            echo '<script>
                alert("Passwords do not match!");
                window.location.href = "index.php?action=register";
                </script>';
            exit();
        }
        //encrypt data
        $username = $this->encryptdata( $plain_username);
        $ip_address = $this->encryptdata( $plain_ip_address);
        $email= $this->encryptdata( $plain_email);
        $access_level= $this->encryptdata( $plain_access_level);
  
        //Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $count_user = $result->num_rows;

        if ($count_user == 0) {
            
            // Hash the password
            $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);   
                        
            $stmt = $conn->prepare("INSERT INTO users (username, password, ip_address, email, access_level) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $hashed_password, $ip_address, $email, $access_level);
            if ($stmt->execute()) {
                echo '<script>
                    alert("Signup Successful!");
                    window.location.href = "index.php?action=login";
                    </script>';
            } else {
                echo "Error: " . $stmt->error; // This will show the actual error from MySQL
                echo '<script>
                    alert("Signup Failed. Please try again.");
                    window.location.href = "index.php?action=register";
                    </script>';
            }
        } else {
            echo '<script>
                alert("User already exists!");
                window.location.href = "index.php?action=login";
                </script>';
        }
    
}
}

public function LoginVerify($plain_username, $password) {
    global $conn;
   
    $username = $this->encryptdata( $plain_username);
   
    // Prepare the SQL query to retrieve user details based on username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
   
    $result = $stmt->get_result();

    //Check if the user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
         $hashed_password = $user['password'];
         $plain_user = $this->getUserByUsername($plain_username) ;
        
        //Verify the provided user input hashed password against the hashed password
        if (password_verify($password, $hashed_password )) {
            return $plain_user; // Password is correct
        } else {
            return false; // Password is incorrect
        }
    } else {
        return false; // Username does not exist
     }
}

public function getUserByUsername($plain_username) 
{
    global $conn;
    
    // Encrypt the username
    $username = $this->encryptdata($plain_username);

    // Prepare the SQL query using prepared statements
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the encrypted username as a string
    $stmt->bind_param("s", $username);  // "s" for string, even though stored as BLOB
    
    // Execute the query
    $stmt->execute();
    // Fetch the result
    $result = $stmt->get_result();
    
    $arr = array();
    // Loop through the results
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        // Decrypt the binary data for each field
        $plain_username    = $this->decryptdata($row['username']);
        $plain_email       = $this->decryptdata($row['email']);
        $plain_ip_address  = $this->decryptdata($row['ip_address']);
        $plain_access_level= $this->decryptdata($row['access_level']);
        
        // Create a new User object and store it in the array
        $arr[$row['id']] = new User($row['id'], $plain_username,$plain_email,$row['password'],$plain_ip_address,$plain_access_level);
    }

    // Return the array of User objects
    return $arr;
}

      public function getAllUsers() 
      { 
         global $conn;
 
         $sql = "SELECT * FROM users ";
 
         $result = $conn->query($sql);
 
         $arr = array();
         while($row = $result->fetch_array(MYSQLI_ASSOC))
         {
            // Decrypt the binary data for each field
            $plain_username    = $this->decryptdata($row['username']);
            $plain_email       = $this->decryptdata($row['email']);
            $plain_ip_address  = $this->decryptdata($row['ip_address']);
            $plain_access_level= $this->decryptdata($row['access_level']);
            $arr[$row['id']] = new User($row['id'], $plain_username,$plain_email,$row['password'],$plain_ip_address,$plain_access_level);
        
            }
         return $arr;
       }   

       public function UpdateUser($updateid,$plain_updateacess) 
       { $updateacess = $this->encryptdata( $plain_updateacess);
          global $conn;
    
          $sql = "UPDATE users SET access_level = '$updateacess' WHERE id = '$updateid'";
  
          $result = $conn->query($sql);

        }   
        
        public function encryptdata($plainText)
        {
            $priv_key_raw = file_get_contents("/home/kit214/private.pem");
            $passphrase=trim(file_get_contents("/home/kit214/crypt_password.txt"));
            $priv_key = openssl_get_privatekey($priv_key_raw, $passphrase);
            // Encrypt the plain text using the private key
            openssl_private_encrypt($plainText, $encryptedText, $priv_key);
           
            $encryptedText=base64_encode($encryptedText);   
            return $encryptedText;
        }
        
        public function decryptdata($encryptedText)
        {   $encryptedText=base64_decode($encryptedText);   
            $pub_key=file_get_contents("/home/kit214/public.pem");
            openssl_public_decrypt($encryptedText, $decryptedText, $pub_key);
                  
            return $decryptedText;
        }

} 
