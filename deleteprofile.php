<?php

require_once 'config/helperR&L.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME);

session_start();
$memberID = $_SESSION['id'];

if(isset($_POST['delete_profile'])){
    echo ("<script> window.alert('Confirm Delete?'); window.location.href='HomepageBeforeLogin.php'  </script>");
    
   mysqli_query($conn, "DELETE FROM `profile` WHERE id = '$memberID'") ;
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Delete Profile</title>

   <!-- custom css file link  -->
   <link href="admin/css/adminProfile.css" rel="stylesheet" type="text/css"/>
</head>
<body>
   
<div class="update-profile">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM `profile` WHERE id = '$memberID'") ;
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
       
      <div class="flex">
         <div class="inputBox">
            <span>User ID :</span>
            <input type="text" name="update_id" value="<?php echo $fetch['id']; ?>" class="box" disabled>
            <span>Name :</span>
            <input type="text" name="update_name" value="<?php echo $fetch['username']; ?>" class="box" disabled>
            <span>Email :</span>
            <input type="text" name="update_email" value="<?php echo $fetch['email']; ?>" class="box" disabled>
            <span>Password :</span>
            <input type="text" name="old_pass" value="<?php echo $fetch['password']; ?>" class="box" disabled>
         </div>
         <div class="inputBox">
            
         </div>
      </div>
      <input type="submit" value="Delete account" name="delete_profile" class="btn">
      <a href="profile.php" class="delete-btn">Back</a>
   </form>

</div>

</body>
</html>