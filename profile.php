<?php
require_once 'config/Con.php';
require_once 'config/helperR&L.php';
session_start();
$memberID = $_SESSION['id'];
//$adminEmail = $_SESSION['email'];
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME);

 $select = mysqli_query($conn, "SELECT * FROM `profile` WHERE id = '$memberID'");
 if(mysqli_num_rows($select) > 0){
 $fetch = mysqli_fetch_assoc($select);
 }
        
                       
$conn->close();

?>


<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile</title>
        <link href="css/profile.css" rel="stylesheet" type="text/css"/>
        <link href="css/header.css" rel="stylesheet" type="text/css"/>
        <link href="css/footer.css" rel="stylesheet" type="text/css"/>
    </head>
    <?php
        include'./Header.php'
        ?>
    <body>
        <h2>Profile Information</h2>
       
        <div class="row">
        <table class="profile">
          <tr>
              <th>User ID</th>
              <td><?php echo $fetch['id']?></td>
          <tr>
              <th>Username</th>
              <td><?php echo $fetch['username']?></td>
              
          </tr>
          <tr>
              <th>Email</th>
              <td><?php echo $fetch['email']?></td>
              
          </tr>
           <tr>
              <th>Password</th>
              <td><input type="password" value="<?php echo $fetch['password']?>" disabled></td>
              
          </tr>
          
        </table>
           <a href="editprofile.php" >
              <input type="button" value="Update Profile" class="button"/>
          </a>
          
        </div>
    </body>
    <?php include'footer.php'?>
</html>