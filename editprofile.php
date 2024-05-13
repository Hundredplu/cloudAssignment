<?php
require_once 'config/Con.php';
require_once 'config/helperR&L.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME);

session_start();
$memberID = $_SESSION['id'];

if(isset($_POST['update_profile'])){
   $updateName = $_POST['update_name'];
   
   mysqli_query($conn, "UPDATE `profile` SET username = '$updateName' WHERE id = '$memberID'") ;

   $old_pass = $_POST['old_pass'];
   $update_pass = md5($_POST['update_pass']);
   $new_pass = md5($_POST['new_pass']);
   $confirm_pass = md5($_POST['confirm_pass']);

    if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }
      elseif($new_pass != $confirm_pass){
         $message[] = 'Confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `profile` SET password = '$confirm_pass' WHERE id = '$memberID'");
         $message[] = 'Password updated successfully!';
          
      }
   
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Profile</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin/css/adminProfile.css">

</head>
<body>
<div class="update-profile">

   
   <?php
      $select = mysqli_query($conn, "SELECT * FROM `profile` WHERE id = '$memberID'") ;
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

    <form action="" method="post" enctype="multipart/form-data" >
      <?php
         
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <span>Username :</span>
            <input type="text" name="update_name" value="<?php echo $fetch['username']; ?>" class="box">
            <span>Email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box" disabled>
            
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>New password :</span>
            <input type="password" name="new_pass" placeholder="Please enter new password." class="box">
            <span>Confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="Confirm new password." class="box">
         </div>
      </div>
      <input type="submit" value="Update profile" name="update_profile" class="btn">
      <a href="profile.php" class="delete-btn">Back</a>
   </form>

</div>

</body>
</html>