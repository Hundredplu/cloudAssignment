<?php
include './config/helperR&L.php';
require_once 'config/Con.php';
//connect
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME);

//check if user clicked the submit button
if(isset($_POST['submit'])){ 
    $username = mysqli_real_escape_string($conn,$_POST['username']); 
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    
    //validation
    if(empty($email)){
        $error[] = "Please enter an email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Invalid email format!";
    }
    
    if(empty($error)){
    $select = "SELECT * FROM profile WHERE email = '$email' && 
            password = '$password'";
    $result = mysqli_query($conn, $select);
    if($result -> num_rows>0){
        $error[] = 'User already exist!'; 
    }else{
        if($password != $cpassword){
           $error[] = 'Password not matched!'; 
        }else{
         $insert = "INSERT INTO profile(username, email, password) 
                    VALUES('$username','$email','$password')";
         mysqli_query($conn, $insert);
         echo "<script>alert('Successfully Registered! Head to Login.');
         window.location.href='Login.php';
         </script>";
        
        }
       }    
    }
}
    
?>


<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <link href="css/form.css" rel="stylesheet" type="text/css"/>
        <script>
        function showHint(str) {
         if (str.length == 0) {
          document.getElementById("txtHint").innerHTML = "";
         return;
        }else {
             var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
         document.getElementById("txtHint").innerHTML = this.responseText;
         }
     };
    xmlhttp.open("GET", "gethint.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>
    </head>
    <?php include'HeaderB4.php' ?>
    <body>
        <div class="container">
            <div class="form-box">
                 
                 <form action="" method="post">
                     <header>Register</header>
                     <?php
                         if(isset($error)){
                            foreach($error as $error){
                            echo'<span class="error-msg">'.$error.'</span>';
                            }
                         }
                     ?>
                    
                     <div class="input">
                         <label for="username">Username</label>
                         <input type="text" name="username" id="username" autocomplete="off" onkeyup="showHint(this.value)" required>
                         <p>Suggestions: <span id="txtHint"></span></p>
                     </div>
                     
                     <div class="input">
                         <label for="email">Email</label>
                         <input type="text" name="email" id="email" autocomplete="off" required>
                     </div>
                     
                     <div class="input">
                         <label for="password">Password</label>
                         <input type="password" name="password" id="password" autocomplete="off" required>
                     </div>
                     <div class="input">
                         <label for="password">Confirm Password</label>
                         <input type="password" name="cpassword" id="cpassword" autocomplete="off" required>
                     </div>
                     
                     <div class="field">
                         <input type="submit" name="submit" class="btn" value="Register" required>
                     </div>
                     
                     <div class="links">
                         Already have account? <a href="Login.php" style="text-decoration: none">Login Now</a>
                     </div>
                 </form>
            </div>
        </div>
    </body>
    <?php include'footer.php' ?>
</html> 