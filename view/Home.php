<?php
class Home
{
    public function output($userDetails)
    { include "header.php";
      ?>
<div class="container" >

            <?php 

      if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    // User is logged in
    echo "<h3><i class='bi bi-person'></i> Welcome, " . htmlspecialchars($_SESSION['username']) . "</h3>";

} ?>
          <hr>
          <table class="table ">
                <?php
                        foreach ($userDetails as $id => $user)  
                        {   echo "<tr>";
                            echo "<td>Username:</td>";
                            echo "<td>".$user->username."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>Email:</td>";
                            echo "<td>".$user->email."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>Password:</td>";
                            echo "<td>".$user->password."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>IP Address:</td>";
                            echo "<td>".$user->ip_address."</td>";
                            echo "</tr>";                        
                            
                        }  
                        ?>
                          </table>
<div class='container style="color: #ff5733;' >
    <h5>GEO Details</h5>
<?php include "guzzle.php";?>
</div>
  <?php
    }
}
