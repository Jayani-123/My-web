<?php

class DiscordUser {  
    public $id;  
    public $code;    
  
    
      
    public function __construct($id, $code)    
    {    
        $this->id = $id;  
        $this->username = $code;  
     
    }   
}  
