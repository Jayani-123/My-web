<?php

class PageLogList
{
    public function output($pagelogDetails)
    { include "header.php";
      ?>
<div class="container">
<h3> Page Log Details</h3>
<?php include "PageSearch.php";?>
                            <?php
                        foreach ($pagelogDetails as $id => $logDetail )  
                        {   echo "Log id: ".$logDetail ->id."<br/>";
                            echo "Username: ".$logDetail ->username."<br/>";
                            echo "Timestamp: ".$logDetail ->logtimestamp."<br/>";
                            echo "IP Address: ".$logDetail ->ip_address."<br/>";
                            echo "Requested URL: ".$logDetail ->request_url."<br/>";
                            echo "Access Allowed: ".$logDetail ->access_allowed."<br/><hr>";                           

                        }  
                        ?>

        </body>
        </div>
        </html>
        <?php
    
}
}