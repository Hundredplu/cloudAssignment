<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Header</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;500&display=swap');

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

li, a, button {
    font-family: "Montserrat", sans-serif;
    font-weight: 500;
    font-size: 20px;
    color: white;
    text-decoration: none;
}

header {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 30px 10%;
}

.logo {
    cursor: pointer;
    margin-right: auto;
}

.navlinks {
    list-style-type: none;
}

.navlinks li {
    display: inline-block;
    padding: 0 20px;
}

.navlinks li a {
    transition: all 0.3s ease 0s;
}

.navlinks li a:hover {
    color: blue;
}

button {
    padding: 9px 25px;
    background-color: rgba(0, 136, 169, 1);
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease 0s;
}

button:hover {
    background-color: rgba(0, 136, 169, 0.8);
}
        
    </style>
</head>
<body>
    <header>
        <img style="width: 300px; margin-top: 50px;" class="logo" src="./images/tarumtlogo.png" alt="logo" onclick="location='moviespage.php'">
        <nav>
            <ul class="navlinks">
                <li><a class="links" href="moviespage.php">Movies</a></li>
                <li><a class="links" href="reserve.php">Book Now</a></li>
                <li><a class="links" href="aboutus.php">About Us</a></li>
            </ul>
        </nav>
        <a href="memberlogin.php"><button>Login</button></a>
        <a href="signup.php"><button style="margin-left: 10px; margin-right: 10px;">Sign Up</button></a>
        <a href="memberportal.php"><button ><i class="fas fa-user-alt"></i></button></a>
    </header>
</body>
</html>
