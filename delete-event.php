<?php
//memberportal and adminportal

include 'config.php';
session_start();
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:adminlogin.php');
};

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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
		
                #rcorners1 {
         border-radius: 25px;
         background: white;
         width: 960px;
         height: 515px;
         margin-bottom: 10px;
         margin-top: 10px;
        }

        .vl {
        border-block-end: 5px solid green;
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
                        
                        th.header {
                            border: 1px solid black;
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
                                
			</ul>
		</div>
            <div class="main">
                <?php
        require_once './config/helper2.php';
        ?>
        
        <?php
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            //get method, retrieve record from DB
            (isset($_GET["movid"]))?
            $movieid = trim($_GET["movid"]):
                $movieid = "";
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $sql = "SELECT * FROM movies
                    WHERE mvid = '$movieid'";
            $result = $con->query($sql);
        if($record = $result->fetch_object()){
            //record found
                $movieid = $record->mvid;
                $mvtitle = $record->title;
                $img = $record->cover_img;               
                $des = $record->description;
                $mvduration = $record->duration;
                $showing = $record->date_showing;
                $end = $record->end_date;
            printf("<div id='rcorners1' class='vl'>
                    <h1 style='margin-left: 360px;'>Delete Movie</h1>
                    <p style='margin-left: 25px; font-size: 20px;'>Are you sure you want to delete the following Customer Details?</p>
                    <table border = 1 style='margin-left: 25px;'>
                    <tr>
                    <td style='font-size: 20px;'>Movie ID :</td>
                    <td style='font-size: 20px;'>%s</td>
                    </tr>
                    
                    <tr style='height: 70px;'>
                    <td style='font-size: 20px;'>Movie Title :</td>
                    <td style='font-size: 20px;'>%s</td>
                    </tr>
                    
                    <tr>
                    <td style='font-size: 20px;'>Image :</td>
                    <td style='font-size: 20px;'>%s</td>
                    </tr>
                    
                    <tr style='height: 70px;'>
                    <td style='font-size: 20px;'>Description :</td>
                    <td style='font-size: 20px;'>%s</td>
                    </tr>
                    
                    <tr>
                    <td style='font-size: 20px;'>Duration :</td>
                    <td style='font-size: 20px;'>%s</td>
                    </tr>
                    
                    <tr style='height: 70px;'>
                    <td style='font-size: 20px;'>Showing Date :</td>
                    <td style='font-size: 20px;'>%s</td>
                    </tr>
                    
                    <tr>
                    <td style='font-size: 20px;'>End Date :</td>
                    <td style='font-size: 20px;'>%s</td>
                    </tr>
                    
                    </table>
                    <form style='margin-left: 25px;' action = '' method = 'POST' enctype='multipart/form-data'>
                    <input type='hidden' name='hfid' value='$movieid' />
                    <input type='hidden' name='hftitle' value='$mvtitle' />
                    <input type='hidden' name='hfdes' value='$des' />
                    <input type='hidden' name='hfduration' value='$mvduration' />
                    <input style='padding: 9px 25px; background-color: rgba(0, 136, 169, 1); border: none; border-radius: 50px; cursor: pointer; transition: all 0.3s ease 0s; margin-top: 30px; font-size: 15px;' type='submit' value='Yes' name='btnYes' />
                    <input style='padding: 9px 25px; background-color: rgba(0, 136, 169, 1); border: none; border-radius: 50px; cursor: pointer; transition: all 0.3s ease 0s; margin-top: 30px; font-size: 15px;' type='button' value='Cancel' name='btnCancel' onclick = 'location = \"eventlist.php\"' />  
                    </form>
                    </div>
                    ", $movieid, $mvtitle, $img, $des, $mvduration, $showing, $end, $mvtitle, $des, $mvduration);
         }
         else{
             //record not found
                echo "<div class = 'error'>
                    Unable to retrieve record.
                    [ <a href = 'eventlist.php'>
                    Back to list</a> ]
                    </div>";
            }
            $con->close();
            $result->free();
       }
        else{
            //post method, delete record
            //retrieve hidden field
            $movieid = trim($_POST["hfid"]);
            $mvtitle = trim($_POST["hftitle"]);
            $des = trim($_POST["hfdes"]);
            $mvduration = trim($_POST["hfduration"]);
            
            //STEP 1 : connection
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            //STEP 2 : SQL statement
            $sql = "DELETE FROM movies WHERE mvid = ?";
            
            //STEP 3 : Run SQl
            $statement = $con->prepare($sql);
            $statement->bind_param("s", $movieid);
            $statement->execute();
            if($statement->affected_rows > 0) {
                //record deleted
                echo "<div class = 'info'><a href = 'eventlist.php'>Back to list</a>
                          Movie ID $movieid is deleted</div>";
            }else {
                //unable to delete
                echo "<div class='error'><a href = 'eventlist.php'>Back to list</a>
                          unable to delete records</div>";
            }
            $con->close();
            $statement->close();
        }
        ?>
	</div>
    </body>
</html>