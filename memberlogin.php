<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){
    
    //retrieve value from user input and checks with database
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM user_form WHERE email = '$email' AND password = '$pass'") or die('query failed');

   //check if member account exists
   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:memberportal.php');
   }else{
      $message[] = 'Incorrect email or password!';
   }

}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
        <link href="css/assignment.css" rel="stylesheet" type="text/css"/>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
    <?php
        include './header.php';
    ?>
    
    
    <div style="margin-left: 630px; margin-bottom: -150px;">
        <button>
            <a href="memberlogin.php"><span>Member</span></a>
        </button>
        <button>
            <a href="adminlogin.php"><span>Admin</span></a>
        </button>
    </div>
 
    <div class="form-container">
        
   <form action="" method="post" enctype="multipart/form-data">
        <h3>Member Login</h3>
        <?php
        //error message
        if(isset($message)){
            foreach($message as $message){
                echo '<div class="message">'.$message.'</div>';
            }
        }
        ?>
        <input type="email" name="email" placeholder="enter email" class="box" required>
        <input type="password" name="password" placeholder="enter password" class="box" required>
        <input type="submit" name="submit" value="Login now" class="btn">
        <p>Don't have an account? <a href="signup.php">Register now</a></p>
    </form>
</div>
    <footer>
                <hr style="color: white;">
        <div class="contain">
            <a href="https://www.facebook.com/tarumtkl/?locale=ms_MY" class="btn">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/Vulcux" class="btn">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.tarc.edu.my/" class="btn">
                <i class="fab fa-google"></i>
            </a>
            <a href="https://www.instagram.com/tarumt_penang/" class="btn">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.youtube.com/@tarumt" class="btn">
                <i class="fab fa-youtube"></i>
            </a>           
        </div>
            
        <div class="footer-basic">       
            <p class="copyright">TAR UMT FILM © 2023</p>
        </div>
            
        <div>
            <a href="#" class="to-top">Back to top</a>
        </div>
        </footer>
</body>
</html>