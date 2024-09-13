<?php
class PageLog {  
    public $id;  
    public  $session_id; 
    public $username;    
    public $logtimestamp;  
    public $ip_address;  
    public $request_url; 
    public $access_allowed; 
    public $discord_code; 
         
    public function __construct($id,$session_id,$username, $logtimestamp,$ip_address,$request_url,$access_allowed,$discord_code)    
    {    
        $this->id = $id;  
        $this->session_id = $session_id;  
        $this->username = $username;  
        $this->logtimestamp =$logtimestamp; 
        $this->ip_address = $ip_address; 
        $this->request_url= $request_url; 
        $this->access_allowed= $access_allowed;  
        $this->discord_code= $discord_code;  
    }   
}  
