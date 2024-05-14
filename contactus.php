<?php
include './payment/connect.php';
//check variable exists
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $content = $_POST['feedbackContent'];
    
    //insert valeies into DB
        $sql = "INSERT INTO feedback(name,email,feedbackContent) VALUES ('$name','$email','$content')";
        $result = mysqli_query($con, $sql);
        if($result){
            //redirect & success message as a query parameter
            header('location: aboutus.php?message=success');
            exit();
        }else{
            //unsuccesful, error message
            die(mysqli_error($con));
        }
}
   //if ($result) {
   // echo "Data inserted successfully";
   // } else {
   // echo "Error: " . $sql . "<br>" . mysqli_error($con);
   // }     
   // }

?>




<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;
background-color: black;
}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid gray;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: limegreen;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: darkgreen;
}

.container {

  border-radius: 5px;
  background-color: lightgoldenrodyellow;
  padding: 20px;
  width: 1200px;
  margin-left: 120px;
  margin-top: -20px;
}
button.cancelFeedback {
  float:right;
  margin-right: 0px;
  margin-top: -50px;
  background-color: green; 
  border: none;
  padding: 8px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 15px;
  transition-duration: 0.4s;
  cursor: pointer;
  background-color: white; 
  color: black; 
  border: 2px solid blueviolet;
  border-radius: 8px;
}


button.cancelFeedback:hover {
  background-color: blueviolet;
  color: white;
}

 footer{
                margin-top: 100px;
            }

        .contain{
                position: relative;
                top: 100px;
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



</style>
</head>
<body>
    <?php
    include './header.php';
    
    ?>


<div class="container">
    <h3 style="font-size: 30px; padding-left: 2px;margin-top: 10px;">Contact Form</h3>
   <form action="" method="POST">
   <button class="cancelFeedback" onclick="cancelFeedback()">Back</button>  
   <br><label for="name">Name</label>
    <br><input type="text" id="name" name="name" placeholder="Your name..." style="width: 300px;" required>
    <br><label for="email">Email Address</label>
    <br><br><input type="email" id="email" name="email" placeholder="Your email..." style="width: 500px;height:40px; padding-left: 10px;" required>
          
    <br><br><label for="subject">Content</label>
    <br><textarea id="content" name="feedbackContent" placeholder="Tell us more" style="height:200px;" required></textarea>

    <input type="submit" name="submit" value="Submit">
  </form>
</div>
</body>

<script>
  //Cancel Checkout function
  //if user click confirm, they will link to movies.php
  function cancelFeedback() {
  var confirmation = confirm("Are you sure you want to go back?");
  if (confirmation) {
  alert("Have a Nice Day !");
  window.location.href = "aboutus.php";
    }
 }
 



 
 </script>
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
</html>