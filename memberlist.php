<?php
//memberportal and adminportal

//establish connection to database
include 'config.php';
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
                <h1 style="margin-top: -120px; margin-left: -50px; margin-bottom: 50px;">List of Member(s)</h1>
                <table class="table">
  <thead>
    <tr>
      <th scope="col">Member ID</th>
      <th scope="col">Member Name</th>
      <th scope="col">Member Email</th>
      <th scope="col">Operation</th>
    </tr>
  </thead>
  <tbody>
      <?php
      //sql statement to retrieve all member records
      $sql = "SELECT id, name, email FROM user_form";
      //execute sql statement
      $result = mysqli_query($conn, $sql);
      //if true, insert all record into a table
      if($result) {
          while($row= mysqli_fetch_assoc($result)) {
              $memberID = $row['id'];
              $memberName = $row['name'];
              $memberEmail = $row['email'];
              echo '<tr>
                    <th scope="row">'.$memberID.'</th>
                    <td>'.$memberName.'</td>
                    <td>'.$memberEmail.'</td>
                    <td>
                    <button style="width: 100px;" class="btn btn-primary">
                    <a style="text-decoration: none;" class="text-light" 
                    href="adminupdatemember.php?updatememberid='.$memberID.'">Update</a>
                    </button>
                    <button style="width: 100px;" class="btn btn-danger">
                    <a style="text-decoration: none;" class="text-light" 
                    href="deletemember.php?deletememberid='.$memberID.'">Delete</a>
                    </button>
                    </td>
                    </tr>';
          }
      }
      ?>
  
  </tbody>
</table>
        </table>
        </form>
            </div>
	</div>
    </body>
</html>