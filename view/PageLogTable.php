
<?php

class PageLogTable
{
    public function output($pagelogDetails)
    { include "header.php";
      ?>
<div class="container">
    <h3> Page Log Details</h3>
    <?php include "PageSearch.php";?>
          <div class="container">
          <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Log id</th>
                    <th>Username</th>
                    <th>Timestamp</th>
                    <th>IP Address</th>
                    <th>Requested URL</th>
                    <th>Access Allowed</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Iterate over each user and display their information in table rows
                foreach ($pagelogDetails as $id => $logDetail )  {  
                    echo "<tr>";
                    echo "<td>" . $logDetail ->id . "</td>";
                    echo "<td>" . $logDetail ->username. "</td>";
                    echo "<td>" . $logDetail ->logtimestamp. "</td>";
                    echo "<td>" . $logDetail ->ip_address . "</td>";
                    echo "<td>" . $logDetail ->request_url . "</td>";
                    echo "<td>" . $logDetail ->access_allowed. "</td>";
                    echo "</tr>";

                }
                ?>
            </tbody>
        </table>
        </div>
        </html>
        <?php
    }
}
