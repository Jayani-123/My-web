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

        // Prepare SQL insert statement
        $stmt = $conn->prepare("INSERT INTO page_logs (session_id, username, logtimestamp, ip_address, request_url, access_allowed) 
                                VALUES (?, ?, ?, ?, ?, ?)");
        
        // Bind the parameters (s = string, )
        $stmt->bind_param("ssssss", $session_id, $username, $logtimestamp, $ip_address, $request_url, $access_allowed);
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
           $arr[$row['id']] = new PageLog($row['id'],$row['session_id'], $row['username'],$row['logtimestamp'],$row['ip_address'],$row['request_url'],$row['access_allowed']);
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
           $arr[$row['id']] = new PageLog($row['id'],$row['session_id'], $row['username'],$row['logtimestamp'],$row['ip_address'],$row['request_url'],$row['access_allowed']);
       }
      
       return $arr;
     }   
}
