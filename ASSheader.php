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
        <link href="css/header_menu.css" rel="stylesheet" type="text/css"/>
        <script src="https://kit.fontawesome.com/dfb98cae41.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fa-solid fa-bars"></i>
            </label>

            <label class="logo"><a href="HomepageAfterLogin.php">Football <span style="color:red">Club</span></a></label>
            <ul> 
                <li><a href="ticketmenu.php"><?php echo"Buy Ticket"?></a></li>
                <li><a href="profile.php" class="drop">Account</a></li>
                <li><a href="viewcart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                <li><a href="logout.php"><i class="fa-sharp fa-solid fa-arrow-right-from-bracket"></i></a></li>
            </ul> 
             </nav>
    </body>
</html>