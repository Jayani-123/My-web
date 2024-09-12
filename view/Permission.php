<?php
class Permission
{
    public function output($allUser)
    {
        // Include the header
        include "header.php"; 
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>User Permissions</title>

        </head>
        <body>
        <div class="container">
        <h3>User Acess Information</h3>
        
        <!-- Table to display user data -->
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>IP Address</th>
                    <th>Access Level</th>
                    <th>Change Access Level</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Iterate over each user and display their information in table rows
                foreach ($allUser as $user) {  
                    echo "<tr>";
                    echo "<td>" . $user->username . "</td>";
                    echo "<td>" . $user->email . "</td>";
                    echo "<td>" . $user->password . "</td>";
                    echo "<td>" . $user->ip_address . "</td>";
                    echo "<td>" . $user->access_level . "</td>";
                    echo "<td>
                    <select name='access_update' id='access_update_$user->id'>
                            <option value='admin'" . ($user->access_level == 'admin' ? ' selected' : '') . ">admin</option>
                            <option value='basic'" . ($user->access_level == 'basic' ? ' selected' : '') . ">basic</option>
                            <option value='moderator'" . ($user->access_level == 'moderator' ? ' selected' : '') . ">moderator</option>
                        </select>
                            <a href='#' onclick=\"updateUser($user->id)\" class='btn btn-sm btn-primary'>Update</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <script>
            function updateUser(userId) {
                // Get the selected access level from the select dropdown
                var accessLevel = document.getElementById('access_update_' + userId).value;
                
                // Redirect to the updated URL with both parameters: updateid and access_level
                window.location.href = 'index.php?action=update&updateid=' + userId + '&access_update=' + accessLevel;
            }
        </script>
</div>
        </body>
        </html>
        <?php
    }
}
?>