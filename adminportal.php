<?php
//memberportal and adminportal

//establish connection to database
include 'config.php';
//retrieve session
session_start();
$admin_id = $_SESSION['admin_id'];

//if session is empty, redirect user to login
if(!isset($admin_id)){
   header('location:adminlogin.php');
};

//destroy session if user click on logout button
if(isset($_POST['btnLogout'])){
   session_unset();
   session_destroy();
   header('location:adminlogin.php');
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
	<div class="container">
		<div class="sidebar">
			<h2>Admin Portal</h2>
			<ul>
				<li><a href="adminportal.php">Profile</a></li>
                                <li><a href="moviespage.php">Movies</a></li>
                                <li><a href="eventlist.php">Event List</a></li>
                                <li><a href="customerbookinginfo.php">Booking List</a></li>
                                <li><a href="adminlist.php">Admin List</a></li>
                                <li><a href="memberlist.php">Member List</a></li>
                                <li><a href="adminSignup.php">Create Admin Account</a></li>
                                <li><a href="./payment/display.php">Check Payment List</a></li>
                                <li><a href="./feedback/feedbacklist.php">Check Feedback List</a></li>
			</ul>
		</div>
		<div class="container">

                    <div class="profile">
                        <?php
                        //retrieve user details according to id
                            $select = mysqli_query($conn, "SELECT * FROM admin WHERE adminID = '$admin_id'") or die('query failed');
                            if(mysqli_num_rows($select) > 0){
                            $fetch = mysqli_fetch_assoc($select);
                            }
                            if($fetch['adminImage'] == ''){
                                echo '<img src="images/default-avatar.png">';
                            }else{
                                echo '<img src="images/'.$fetch['adminImage'].'">';
                            }
                        ?>
                        <h3><?php echo $fetch['adminName']; ?></h3>
                        <a href="updateadmin.php" class="btn">Update profile</a>
                        <form action="" method="POST">
                            <input style="color: white; font-size: 20px; margin-top: 10px; background-color: orangered; width: 100%; height: 50px; border-radius: 5px; cursor: pointer;" type="submit" class="logout" value="Logout" name="btnLogout" />
                        </form>
                    </div>

                </div>
	</div>
    </body>
</html>
