<?php

class User {  
    public $id;  
    public $username;    
    public $email;  
    public $password;  
    public $ip_address; 
    public $community; 
    public $access_level; 
    
      
    public function __construct($id, $username, $email,$password,$ip_address, $community,$access_level)    
    {    
        $this->id = $id;  
        $this->username = $username;  
        $this->email = $email; 
        $this->password= $password;  
        $this->ip_address = $ip_address; 
        $this->community = $community; 
        $this->access_level= $access_level; 
    }   
}  

