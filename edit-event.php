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
        global $hideForm;
        //ask server, which method used by the app?
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            //get method, retrieve record from DB
            //display output to the form
            //retrieve parameter from URL(id)
            (isset($_GET["movid"]))?
            $movieid = trim($_GET["movid"]):
                $movieid = "";
            
            //DB Step 1: connection
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            //DB Step 2: sql statement 
            $sql = "SELECT * FROM movies 
                    WHERE mvid = '$movieid'";
            
            //DB Step 3: run sql
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
            }
            else{
                //record not found
                echo "<div class = 'error'>
                    Unable to retrieve record.
                    [ <a href = 'eventlist.php'>
                    Back to list</a> ]
                    </div>";
                $hideForm = true;
            }
            $result->free();
            $con->close();         
        }
        else{
            //post method
            //update record
            
            //retrieve new input data from user
            $mvtitle = trim($_POST["txttitle"]);
            $img = $_FILES["fsimg"];
            $des = trim($_POST["txtdes"]);
            $mvduration = trim($_POST["txtduration"]);
            $showing = trim($_POST["txtshowing"]);
            $end = trim($_POST["txtend"]);
            $movieid = trim($_POST["hfmvid"]);
            
            //validation 
            $error["movtitle"] = checkTitle($mvtitle);
            $error["movdes"] = checkDes($des);
            $error["movduration"] = checkDuration($mvduration);
            
            //filter error
            $error = array_filter($error);
            
            if(empty($error)){
                //GOOD, no error, update record
                //DB Step 1: connection
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                
                //DB Step 2: sql statement
                $sql = "UPDATE movies
                        SET title = ?, cover_img = ?, description = ?, duration = ?, date_showing = ?, end_date = ?
                        WHERE mvid = ?";
                
                //DB Step 3: execute sql
                $stmt = $con->prepare($sql);
                $stmt->bind_param("sssssss", $mvtitle, $img, $des, $mvduration, $showing, $end, $movieid);
                if($stmt->execute()){
                    //record updated
                    echo "<div class='info'>
                    <a href = 'eventlist.php'>Back to lists</a>
                    Info of Movie ID $movieid is updated
                    </div> 
                    <script>window.location = 'eventlist.php'</script>";                    
                }
                else{
                    //unable to update
                    echo "<div class='error'>
                    <a href = 'eventlist.php'>Back to lists</a>
                    Unable to update records</div>";
                }
                $con->close();
                $stmt->close();
            }
            else{
                //WITH ERROR, display error msg
                echo "<ul class = 'error'>";
                foreach ($error as $value){
                    echo "<li>$value</li>";
                }
                echo "</ul>";                   
            }
        }
        ?>
                
        <?php
        //check if the user select any file?
        if (isset($_FILES['fsimg'])){
            //YES, user selected a file
            //store the image
            $img = $_FILES['fsimg'];
            
            //check if there is any upload error?
            if($img['error'] > 0){
                //this validation is done by PHP
                //WITH ERROR, handle to display error msg                
                switch ($img['error']){
                    case UPLOAD_ERR_NO_FILE:
                        $err = "No file was selected!";
                        break;
                    case UPLOAD_ERR_FROM_SIZE:
                        $err = "File uploaded is too large. Maximum 1MB allowed!";
                        break;
                    default: //other error
                        $err = "There was an error when uploading the file!";
                        break;
                }
            }
            else if($img['size'] > 2000000){
                //validation specifically, file size
                $err = "File uploaded is too large. Max 2MB allowed!";
            }
            else{
                
                $update_image = $_FILES['fsimg']['name'];
                $update_image_size = $_FILES['fsimg']['size'];
                $update_image_tmp_name = $_FILES['fsimg']['tmp_name'];
                $update_image_folder = 'images/'.$update_image;

            if(!empty($update_image)){
                if($update_image_size > 2000000){
                 echo "<script>alert('Image is too large!')</script>";
            }else{
                $image_update_query = mysqli_query($conn, "UPDATE movies SET cover_img = '$update_image' WHERE mvid = '$movieid'") or die('query failed');
            if($image_update_query){
                move_uploaded_file($update_image_tmp_name, $update_image_folder);
            }
            }
         }        
            }
            
            if(isset($err)){
                echo "<div class='error'>$err</div>";
            }
            
        }
        ?>        
        
        <?php if($hideForm == false) : ?>
        
        <div id="rcorners1" class="vl">              
                <form style="margin-left: 25px;" action="" method="post" enctype="multipart/form-data">
                <h1 style="margin-left: 370px; font-size: 40px;">Edit Page</h1>
                <table>
                <tr>
                    <td style="font-size: 25px; color: blue;">Movie ID : </td>
                    <td style="color: blue;"><?php echo $movieid; ?></td>
                    <td><input style="margin-left: 20px; font-size: 20px;" type="hidden" name="hfmvid" value="<?php echo $movieid; ?>" /></td>
                </tr>
                
                <tr style="height: 70px;">
                    <td style="font-size: 25px;">Movie Title : </td>
                    <td><input style="margin-left: 20px; font-size: 20px;" type="text" name="txttitle" value="<?php
                    echo $mvtitle
                    ?>" /></td>
                </tr>
                
                <tr>
                    <td style="font-size: 25px;">Movie Image : </td>
                    <td><input style="margin-left: 20px; font-size: 20px;" type="file" name="fsimg" /></td>
                    <td><input type="hidden" name="MAX_FILE_SIZE" value="1048576" /></td>
                </tr>
                
                <tr style="height: 70px;">
                    <td style="font-size: 25px;">Description : </td>
                    <td><input style="margin-left: 20px; font-size: 20px;" type="text" name="txtdes" value="<?php
                    echo $des
                    ?>" /></td>
                </tr>
                
                <tr>
                    <td style="font-size: 25px;">Duration : </td>
                    <td><input style="margin-left: 20px; font-size: 20px;" type="text" name="txtduration" value="<?php
                    echo $mvduration
                    ?>" /></td>
                </tr>
                
                <tr style="height: 70px;">
                    <td style="font-size: 25px;">Showing Date : </td>
                    <td><input style="margin-left: 20px; font-size: 20px;" type="date" name="txtshowing" value="<?php
                    echo $showing
                    ?>" /></td>
                </tr>
                
                <tr>
                    <td style="font-size: 25px;">End Date : </td>
                    <td><input style="margin-left: 20px; font-size: 20px;" type="date" name="txtend" value="<?php
                    echo $end
                    ?>" /></td>
                </tr>
            </table>
            <input style="padding: 9px 25px; background-color: rgba(0, 136, 169, 1); border: none; border-radius: 50px; cursor: pointer; transition: all 0.3s ease 0s; margin-top: 20px; font-size: 20px;" type="submit" value="update" name="btnupdate" />
            <input style="padding: 9px 25px; background-color: rgba(0, 136, 169, 1); border: none; border-radius: 50px; cursor: pointer; transition: all 0.3s ease 0s; margin-top: 20px; font-size: 20px;" type="button" value="cancel" name="btncancel" onclick="location='eventlist.php'"/>
                </form>
        </div>
        <?php endif; ?>
	</div>
    </body>
</html>