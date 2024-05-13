<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Header</title>
        <link href="css/header.css" rel="stylesheet" type="text/css"/>
        <script src="https://kit.fontawesome.com/dfb98cae41.js" crossorigin="anonymous"></script>
    </head>
    
    <body>
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">   
                <i class="fa-solid fa-bars"></i>
            </label>
            
            <label class="logo"><a href="HomepageBeforeLogin.php">Football <span style="color:red">Club</span></a></label>
            <ul> 
                <li><a href="PlsLogin.php"><?php echo"Buy Ticket"?></a></li>
                <li><a href="Login.php">Log In</a></li>
                <li><a href="PlsLogin.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                <li><a href="admin/adminLogin.php"><i class="fa-solid fa-lock"></i></a></li>
                
            </ul> 
        </nav>
        
    </body>
</html>