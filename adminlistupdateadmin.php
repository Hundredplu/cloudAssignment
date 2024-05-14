<?php
//establish connection to database
include 'config.php';
//retrieve session
session_start();
$admin_id = $_SESSION['admin_id'];

$admin_id = $_GET['updateadminid'];
$sql = "SELECT * FROM admin WHERE adminID =$admin_id";
$result = mysqli_query($conn, $sql);    
$row = mysqli_fetch_assoc($result);

$admin_id = $row['adminID'];
$admin_name = $row['adminName'];
$admin_email = $row['adminEmail'];
$admin_pass = $row['adminPassword'];
$admin_image = $row['adminImage'];

if(isset($_POST['update_profile'])){
   //retrieve value from user input
   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

   //sql statement to update record
   mysqli_query($conn, "UPDATE admin SET adminName = '$update_name', adminEmail = '$update_email' WHERE adminID = '$admin_id'") or die('query failed');

   //overwrite old password to new password
   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   //error message if user input is incorrect
   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         echo "<script>alert('Old Password Not Matched!')</script>";
      }elseif($new_pass != $confirm_pass){
         echo "<script>alert('Confirmed Password Not Matched!')</script>";
      }else{
         mysqli_query($conn, "UPDATE admin SET adminPassword = '$confirm_pass' WHERE adminID = '$admin_id'") or die('query failed');
         echo "<script>alert('Password Updated Successfully!')
               window.location = 'adminlist.php'</script>";   
      }
   }

   //update profile picture to new image uploaded by user
   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'images/'.$update_image;

   //error message if image does not fulfil certain requirements
   if(!empty($update_image)){
      if($update_image_size > 2000000){
         echo "<script>alert('Image is too large!')</script>";
      }else{
          //sql statement to update image in database
         $image_update_query = mysqli_query($conn, "UPDATE admin SET adminImage = '$update_image' WHERE adminID = '$admin_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         //image upload successful
         echo "<script>alert('Image Updated Successfully!')</script>";
      }
   }

}

?>

<!DOCTYPE html>
<html>
    <head>
	<title>Admin Portal</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/assignment.css" rel="stylesheet" type="text/css"/>
	<style>
		* {
			box-sizing: border-box;
		}
		
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}
		
		.container {
			display: flex;
			flex-direction: row;
			height: 100vh;
		}
		
		.sidebar {
			background-color: #333;
			color: #fff;
			height: 100%;
			width: 250px;
			padding: 20px;
			box-shadow: 5px 0px 5px rgba(0, 0, 0, 0.2);
			position: fixed;
			top: 0;
			left: 0;
			overflow: auto;
		}
		
		.sidebar h2 {
			margin-top: 0;
			font-size: 24px;
			padding-bottom: 10px;
			border-bottom: 1px solid #fff;
		}
		
		.sidebar ul {
			margin: 0;
			padding: 0;
			list-style: none;
		}
		
		.sidebar li {
			margin: 10px 0;
		}
		
		.sidebar a {
			color: #fff;
			text-decoration: none;
			display: block;
			padding: 10px;
			border-radius: 5px;
			transition: background-color 0.3s ease;
		}
		
		.sidebar a:hover {
			background-color: #444;
		}
		
		.main {
			flex: 1;
			padding: 20px;
			margin-left: 250px;
		}
		
		@media (max-width: 768px) {
			.container {
				flex-direction: column;
			}
			
			.main {
				margin-left: 0;
			}
			
			.sidebar {
				position: relative;
				width: 100%;
				height: auto;
				margin-bottom: 20px;
				box-shadow: none;
			}
		}
            </style>
    </head>
    <body>
	
		<div class="update-profile">

   <?php
   /*
      //retrieve user details according to id
      $select = mysqli_query($conn, "SELECT * FROM admin WHERE adminID = '$admin_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
    */
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($row['adminImage'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="images/'.$row['adminImage'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <span>Username :</span>
            <input type="text" name="update_name" value="<?php echo $row['adminName']; ?>" class="box">
            <span>Email :</span>
            <input type="email" name="update_email" value="<?php echo $row['adminEmail']; ?>" class="box" readonly>
            <span>Update your picture :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $row['adminPassword']; ?>">
            <span>Old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>New password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>Confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
         </div>
      </div>
      <input type="submit" value="Update profile" name="update_profile" class="btn">
      <a href="adminlist.php" class="delete-btn">Go back</a>
   </form>

</div>
	</div>
    </body>
</html>
