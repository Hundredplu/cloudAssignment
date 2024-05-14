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
			height: 2000px;
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
                        margin-bottom: 700px;
		}
                
                .scroll {
                        height: 150px;
                        width: 150px;
                        overflow: auto;
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
                                <li><a href="./feedback/feedbacklist.php">Check Feedback List</a></li>
                                
			</ul>
		</div>
            <div class="main">
        <?php
        include './config/helper2.php';
        //array map between table field name & table 
        //display name
        $header = array(
          'mvid' => 'Movie ID',
          'title' => 'Movie Title',
          'cover_img' => 'Image',
          'description' => 'Description',
          'duration' => 'Duration',
          'date_showing' => 'Date Showing',
          'end_date' => 'End Date'
        );     
        ?>
        
        <button style='width: 120px;' class='btn btn-primary'><a style='text-decoration: none;' class='text-light' href='add-event.php?movieid=%s'>Add Movie</a></button>
        <?php
        //check if user clicked delete button?
        if(isset($_POST["btnDeleteChecked"])){
            //retrieve student id from selected checkbox
            $checked = $_POST["checked"]; // array
            if(!empty($checked)){
                //DB step 1: connection
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                
                foreach ($checked as $value){
                    $escChecked[] = $con->real_escape_string($value);
                }
                
                //DB Step 2: sql statement 
                //DELETE FROM Student WHERE StudentID
                //IN ('22PMD0001', '22PMD0002')
                $sql = "DELETE FROM movies WHERE mvid IN ('" .
                implode("','", $escChecked)
                . "')";
                
                //DB Step 3: Run SQL
                if($con->query($sql)){
                    printf("<div class='info'>%d record(s) has been deleted!</div>", count($escChecked));
                }
            }
        }
        ?>
        
        <form action="" method="POST">
        <table border="1" class="table">
                <thead>
    <tr>
                <th>#</th>  
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Showing Date</th>
                <th>End Date</th>
                <th>Action</th>
            </tr>
        </thead>
            <tbody>
                <?php
            //retrieve records from DB
            //in order to connect to db - 4 parameters
            //1. hostname 2. username 3. password 4. db name
            //Step1: connect php app with DB
            //object oriented method    
            
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            //step2: sql statement
            $sql = "SELECT * FROM movies";
            
            //step3: run sql
            //$result - keep all student records
            if($result = $con->query($sql)){               
                //retrieve record 1 by 1 and display
                while ($record = $result->fetch_object()){
                    //display output
                    printf("<tr>
                        <td><input type='checkbox' name='checked[]' value='%s' /></td>
                        <td>%s</td>
                        <td>%s</td>
                        <td><img style='height: 150px; width: 100px;' src='images/%s'></td>
                        <td>
                        <div class='scroll' style='border: solid 1px white;'>
                        <div id='description' style='padding-left: 10px;'>
                        %s
                        </div>
                        </div>
                        </td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>
                        <button style='width: 100px;' class='btn btn-primary'><a style='text-decoration: none;' class='text-light' href='edit-event.php?movid=%s'>Update</a></button>
                        <button style='width: 100px;' class='btn btn-danger'><a style='text-decoration: none;' class='text-light' href='delete-event.php?movid=%s'>Delete</a></button>
                        </td>
                            </tr>", $record->mvid, $record->mvid, $record->title,  $record->cover_img,  $record->description, $record->duration, $record->date_showing, $record->end_date, $record->mvid, $record->mvid);
                }
                
                printf("<tr><td colspan='10'>%d record(s) returned.
                        </td></tr>", $result->num_rows);
                
                printf("<tr><td colspan='10'><input type='submit' value='Delete Checked' name='btnDeleteChecked' onclick='return confirm('This will delete all checked records.')' />
                        </td></tr>");
            }
            //step4: close connection, release memory from $result
            $result->free();
            $con->close();
            ?>
            </tbody>    
        </table>
        </form>
            </div>
	</div>
    </body>
</html>
