<?php

class PageLogJSON
{
    public function output($pagelogDetails)
    { include "header.php";
      ?>
<div class="container">
<h3> Page Log Details</h3>
    <?php include "PageSearch.php";?>
                            <?php                      
                            $json_array[]=$pagelogDetails;
                            echo json_encode($json_array, JSON_PRETTY_PRINT);
                     
                        ?>

        </body>
        </div>
        </html>
        <?php
    
}
}