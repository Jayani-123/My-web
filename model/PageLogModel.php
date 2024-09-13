<?php
include_once("DBConn.php");   
include_once("PageLog.php");  
  
class PageLogModel 
{  
    public function StorePageLog() 
    { 
        global $conn;

        // Start the session to get the session ID
        if(session_status() === PHP_SESSION_NONE) session_start();
        $session_id = session_id();

        // Get the username (or NULL if not logged in)
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

        // Get the timestamp
        $logtimestamp = date('Y-m-d H:i:s');

        // Get the IP address
        $ip_address = $_SERVER['REMOTE_ADDR'];

        // Get the requested URL
        $request_url = $_SERVER['REQUEST_URI']; // Full URL including query parameters

        // Determine if the access is allowed or denied (this depends on your logic)
        $access_allowed = isset($_SESSION['username']) ? 'Allowed': 'Denied';


        // Storing Dicord Code
        $sql = "SELECT discord_code FROM `page_logs` WHERE session_id = ? and discord_code IS NOT NULL ORDER BY id DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',  $session_id);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        $count_user = $result->num_rows;

        if ($count_user == 0) {
            // Fallback to session if no record is found in the database
            $discord_code = isset($_SESSION['discord_code']) ? $_SESSION['discord_code'] : null;
        } else {
            // Fetch the discord_code from the database result
            if ($row = $result->fetch_assoc()) {
                $discord_code = $row['discord_code'];
            }
        }
        
        // Prepare SQL insert statement
        $stmt = $conn->prepare("INSERT INTO page_logs (session_id, username, logtimestamp, ip_address, request_url, access_allowed,discord_code) 
                                VALUES (?, ?, ?, ?, ?, ?,?)");
        
        // Bind the parameters (s = string, )
        $stmt->bind_param("sssssss", $session_id, $username, $logtimestamp, $ip_address, $request_url, $access_allowed, $discord_code);
        $stmt->execute();
        // Close the statement
        $stmt->close();
    }

    
    public function getAllPageLogs() 
    { 
       global $conn;

       $sql = "SELECT * FROM page_logs";
        
       $result = $conn->query($sql);

       $arr = array();
       while($row = $result->fetch_array(MYSQLI_ASSOC))
       {
           $arr[$row['id']] = new PageLog($row['id'],$row['session_id'], $row['username'],$row['logtimestamp'],$row['ip_address'],$row['request_url'],$row['access_allowed'],$row['discord_code']);
       }

       return $arr;
     }   

     
    public function getPageLogs($search) 
    { 
       global $conn;

       $sql = "SELECT * FROM page_logs where ip_address =  '$search'";
        
       $result = $conn->query($sql);

       $arr = array();
       while($row = $result->fetch_array(MYSQLI_ASSOC))
       {
           $arr[$row['id']] = new PageLog($row['id'],$row['session_id'], $row['username'],$row['logtimestamp'],$row['ip_address'],$row['request_url'],$row['access_allowed'],$row['discord_code']);
       }
      
       return $arr;
     }   

     public function getdiscordLogs() 
{ 
    global $conn;
    
    // Start the session to ensure we can retrieve the session_id
    if(session_status() === PHP_SESSION_NONE) session_start();
    $session_id = session_id();

    // Prepare the SQL query
    $sql = "SELECT discord_code FROM `page_logs` WHERE session_id = ? and discord_code IS NOT NULL ORDER BY id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    
    // Check if prepare was successful
    if (!$stmt) {
        echo "SQL Error: " . $conn->error;
        return null; // Early return in case of failure
    }
    
    // Bind the session_id parameter
    $stmt->bind_param('s', $session_id);
    $stmt->execute();
    
    // Fetch the result
    $result = $stmt->get_result();
    $discord_code = null; // Initialize the discord_code variable

    if ($result->num_rows == 0) {
        // Fallback to session if no record is found in the database
        $discord_code = isset($_SESSION['discord_code']) ? $_SESSION['discord_code'] : null;
    } else {
        // Fetch the discord_code from the database result
        if ($row = $result->fetch_assoc()) {
            $discord_code = $row['discord_code'];
        }
    }

    // Close the statement
    $stmt->close();
    echo $discord_code ;
    // Return the discord_code
    return $discord_code;
}

}
