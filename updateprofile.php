<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){

   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

   mysqli_query($conn, "UPDATE `user_form` SET name = '$update_name', email = '$update_email' WHERE id = '$user_id'") or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         echo "<script>alert('Old Password Not Matched!')</script>";
      }elseif($new_pass != $confirm_pass){
         echo "<script>alert('Confirmed Password Not Matched!')</script>";
      }else{
         mysqli_query($conn, "UPDATE `user_form` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
         echo "<script>alert('Password Updated Successfully!')</script>";
      }
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `user_form` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         echo "<script>alert('Image Updated Successfully!')</script>";
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
   <title>update profile</title>

   <!-- custom css file link  -->
   <link href="css/assignment.css" rel="stylesheet" type="text/css"/>
   <style>
		body {
			margin: 0;
			padding: 0;
			background: black;
			font-family: Arial, sans-serif;
                        
		}

		.container {
			margin: 80px auto;
			width: 400px;
			background: #fff;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0px 0px 10px rgba(0,0,0,0.5);
		}

		.container h1 {
			text-align: center;
			font-size: 36px;
			margin-bottom: 20px;
		}

		.form-group {
			margin-bottom: 20px;
		}

		.form-group label {
			display: block;
			font-size: 18px;
			margin-bottom: 5px;
		}

		.form-group input[type="text"],
		.form-group input[type="password"] {
			width: 95%;
			padding: 10px;
			font-size: 16px;
			border: none;
			border-radius: 5px;
			background: #f2f2f2;
			box-shadow: 0px 0px 5px rgba(0,0,0,0.2);
		}

		.form-group input[type="submit"] {
			width: 100%;
			padding: 10px;
			font-size: 18px;
			border: none;
			border-radius: 5px;
			background: #3498db;
			color: #fff;
			cursor: pointer;
		}

		.form-group input[type="submit"]:hover {
			background: #2980b9;
		}

		.form-group .login-link {
			display: block;
			margin-top: 20px;
			font-size: 16px;
			text-align: center;
			color: #666;
			text-decoration: none;
		}

		.form-group .login-link:hover {
			color: #000;
			text-decoration: underline;
		}

		.register-link {
			display: block;
			margin-top: 20px;
			font-size: 16px;
			text-align: center;
			color: #3498db;
			text-decoration: none;
		}

		.register-link:hover {
			color: #2980b9;
			text-decoration: underline;
		}

		.error-message {
			color: #f00;
			margin-bottom: 10px;
		}
                
                footer{
                margin-top: 100px;
            }
            
            .contain{
                position: relative;
                top: 90px;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                max-width: 1200px;
                text-align: center;
            }
            
            .contain .btn{
                display: inline-block;
                width: 70px;
                height: 70px;
                background: #fff;
                box-shadow: 0 5px 15px -5px #aaa;
                margin: 10px;
                border-radius: 30%;
                overflow: hidden;
                position: relative;
                color: #42d2ff;
            }
            
            .contain .btn i{
                position: relative;
                z-index: 4;
                line-height: 70px;
                font-size: 26px;
                transition: 0.3s ease-in-out;
            }
            
            .contain .btn::before{
                content: "";
                position: absolute;
                width: 120%;
                height: 120%;
                background: linear-gradient(#00c6ff, #0072ff);
                transform: rotate(45deg);
                left: -110%;
                top: 90%;
            }
            
            .contain .btn:hover i{
                color: #fff;
                transform: scale(1.3);
            }
            
            .contain .btn:hover::before{
                animation: onHover 0.7s 1;
                left: -10%;
                top: -10%;
            }
            
            .footer-basic .copyright {
                margin-top: -80px;
                text-align:center;
                font-size:16px;
                color:grey;
                margin-bottom:0;
            }
            
            .to-top{
                color:white;
                padding-top:1.8em;
                display:inline-block;/* or block */
                position:relative;
                border-color:white;
                text-decoration:none;
                transition:all .3s ease-out;
                right: 44%;
                margin-top: 50px;
            }
            .to-top:before{
                content:'▲';
                font-size:.9em;
                position:absolute;
                top:0;
                left:50%;
                margin-left:-.7em;
                border:solid .13em white;
                border-radius:10em;
                width:1.4em;
                height:1.4em;
                line-height:1.3em;
                border-color:inherit;
                transition:transform .5s ease-in;
            }
            .to-top:hover{
                color: cyan;
                border-color: cyan;
            }
            .to-top:hover:before{
        	transform: rotate(360deg);
            }

            @keyframes onHover{
                0%{
                    left: -110%;
                    top: 90%;
                }
                50%{
                    left: 10%;
                    top: -30%;
                }
                100%{
                    left: -10%;
                    top: -10%;
                }                          
            }
            
            .wrapper{
                display: inline-flex;
                background: #fff;
                height: 80px;
                width: 350px;
                align-items: center;
                justify-content: space-evenly;
                border-radius: 5px;
                padding: 20px 15px;
            }
            .wrapper .option{
                background: #fff;
                height: 100%;
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: space-evenly;
                margin: 0 10px;
                border-radius: 5px;
                cursor: pointer;
                padding: 0 10px;
                border: 0px;
                transition: all 0.3s ease;
            }
            .wrapper .option .dot{
                height: 20px;
                width: 20px;
                background: #d9d9d9;
                border-radius: 50%;
                position: relative;
            }   
            .wrapper .option .dot::before{
                position: absolute;
                content: "";
                top: 4px;
                left: 4px;
                width: 12px;
                height: 12px;
                background: #0069d9;
                border-radius: 50%;
                opacity: 0;
                transform: scale(1.5);
                transition: all 0.3s ease;
            }
            input[type="radio"]{
                display: none;
            }
            #option-1:checked:checked ~ .option-1,
            #option-2:checked:checked ~ .option-2{
                border-color: grey;
                background: grey;
            }
            #option-1:checked:checked ~ .option-1 .dot,
            #option-2:checked:checked ~ .option-2 .dot{
                background: #fff;
            }
            #option-1:checked:checked ~ .option-1 .dot::before,
            #option-2:checked:checked ~ .option-2 .dot::before{
                opacity: 1;
                transform: scale(1);
            }   
            .wrapper .option span{
                font-size: 20px;
                color: #808080;
            }
            #option-1:checked:checked ~ .option-1 span,
            #option-2:checked:checked ~ .option-2 span{
                color: #fff;
            }
	</style>

</head>
<body>
   
<div class="update-profile">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <span>username :</span>
            <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box">
            <span>your email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
            <span>update your pic :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
         </div>
      </div>
      <input type="submit" value="update profile" name="update_profile" class="btn">
      <a href="home.php" class="delete-btn">go back</a>
   </form>

</div>

</body>
</html>