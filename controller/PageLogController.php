<?php
// Enable PHP errors
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once("model/PageLogModel.php");  
include_once("view/PageLogList.php");
include_once("view/PageLogTable.php");
include_once("view/PageLogXML.php");
include_once("view/PageLogJSON.php");
include_once("view/ViewBackToHome.php");
include_once("view/DiscordLogin.php");
include_once("view/DiscordInfo.php");

class PageLogController 
{  
    public $pagelogmodel;   

    public function __construct()    
    {    
        $this->pagelogmodel = new PageLogModel();  
    } 

    public function StorePageLogList()  
    {   $this->pagelogmodel->StorePageLog() ;
   
    }
   

    public function pageLogList($action, $search = null) {
        if ($action === 'pageloglist') {
            // Fetch all logs if no search parameter
            $pagelogDetails = is_null($search) ? $this->pagelogmodel->getAllPageLogs() : $this->pagelogmodel->getPageLogs($search);
    
            if ($pagelogDetails) {
                $pageloglist = new PageLogList();
                $pageloglist->output($pagelogDetails);
            } else {
        
                $viewBack = new ViewBackToHome();
                $viewBack->output();
                
            }
        } else {
            // Handle invalid actions
            echo "Invalid action.";
        }
    }
    public function pageLogTable($action, $search = null)  
    {    if ($action === 'pagelogtable') {
        // Fetch all logs if no search parameter
        $pagelogDetails = is_null($search) ? $this->pagelogmodel->getAllPageLogs() : $this->pagelogmodel->getPageLogs($search);

        if ($pagelogDetails) {
            $pagelogtable = new PageLogTable();
            $pagelogtable->output($pagelogDetails);
        } else {
            // Handle case where no page logs are found
            $viewBack = new ViewBackToHome();
            $viewBack->output();

        }
    } else {
        // Handle invalid actions
        echo "Invalid action.";
    }}

    public function pageLogJSON($action, $search = null)  
    {    if ($action === 'pagelogjson') {
        // Fetch all logs if no search parameter
        $pagelogDetails = is_null($search) ? $this->pagelogmodel->getAllPageLogs() : $this->pagelogmodel->getPageLogs($search);

        if ($pagelogDetails) {
            $pagelogjson = new PageLogJSON();
            $pagelogjson->output($pagelogDetails);
        } else {
            // Handle case where no page logs are found
            $viewBack = new ViewBackToHome();
            $viewBack->output();
    

        }
    } else {
        // Handle invalid actions
        echo "Invalid action.";
    }}
        
       
public function pageLogXML()  
{   $pagelogDetails= $this->pagelogmodel->getAllPageLogs(); 
    $pagelogXML = new PageLogXML();
    $pagelogXML->output($pagelogDetails);
}


public function discordLogin()  
{   
    $discordCode = $this->pagelogmodel-> getdiscordLogs(); 
    if ($discordCode ==null ){
        $discordLogin = new DiscordLogin();
        $discordLogin ->output();
    }
    else {
    $discordInfo = new DiscordInfo();
    $discordInfo->output($discordCode);
}

} 
public function discordInfo($discordCode )  
{   
    $discordInfo = new DiscordInfo();
    $discordInfo->output($discordCode);
    }

}
