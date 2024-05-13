
<?php
require_once './config/helperR&L.php';
require_once 'config/Con.php';
session_start();
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME);

if(isset($_POST['submit'])){
    
    $username = $_POST['username']; // capture string
    $email = $_POST['email'];
    $password = md5($_POST['password']);
  
      //validation
    if(empty($email)){
        $error[] = "Please enter an email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Invalid email format!";
    }
    
    if(empty($error)){
    $select = "SELECT * FROM profile WHERE username = '$username' && email = '$email' &&
            password = '$password'";
    
    $result = mysqli_query($conn, $select);
    
    if($result -> num_rows>0){
        $row = mysqli_fetch_array($result);
        $_SESSION['id'] = $row['id'];
        $_SESSION['User_username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        header('location:HomepageAfterLogin.php');
          
    }else{
        $error[] = 'Incorrect email or password!';
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
        <title>Login</title>
        <link href="css/form.css" rel="stylesheet" type="text/css"/>
    </head>
    <?php include'HeaderB4.php' ?>
    <body>
        <!-- <div class="choice">
             <a href="Login.php" class="button">Member</a>
             <a href="admin/adminLogin.php" class="button">Admin </a>
        </div> -->
        <div class="container">
            
            <div class="box form-box">
                  
                 <form action="" method="post">
                     
                     
                     <header>Member Login</header>
                      <?php
                        if(isset($error)){
                          foreach($error as $error){
                             echo'<span class="error-msg">'.$error.'</span>';
                          }
                          }
                      ?>
                     <div class="field input">
                         <label for="username">Username</label>
                         <input type="text" name="username" id="username" autocomplete="off" required>
                     </div>
                     
                     <div class="field input">
                         <label for="email">Email</label>
                         <input type="text" name="email" id="email" autocomplete="off" required>
                     </div>
                     
                     <div class="field input">
                         <label for="password">Password</label>
                         <input type="password" name="password" id="password" autocomplete="off" required>
                     </div>
                     
                     <div class="field">
                         <input type="submit" name="submit" class="btn" value="Login" required>
                     </div>
                     
                     <div class="links">
                         Don't have account? <a href="Register.php" style="text-decoration: none">Sign Up Now</a>
                     </div>
                     
                 </form>
            </div>
        </div>
    </body>
    <?php include 'footer.php' ?>
</html>

