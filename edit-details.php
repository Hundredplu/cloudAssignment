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

$con = mysqli_connect("localhost","root","","assignment");
if(!$con){
    die("Connection Failed:". mysqli_connect_error());
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
            (isset($_GET["bookid"]))?
            $book = trim($_GET["bookid"]):
                $book = "";
            
            //DB Step 1: connection
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            //DB Step 2: sql statement 
            $sql = "SELECT * FROM booking 
                    WHERE BookingID = '$book'";
            
            //DB Step 3: run sql
            $result = $con->query($sql);
            
            if($record = $result->fetch_object()){
                //record found
                $book = $record->BookingID;
                $customer = $record->CustomerName;
                $movie = $record->MovieName;               
                $venue = $record->Venue;
                $date = $record->ShowingDate;
                $time = $record->ShowingTime;
                $seat = $record->MovieSeat;
            }
            else{
                //record not found
                echo "<div class = 'error'>
                    Unable to retrieve record.
                    [ <a href = 'customerbookinginfo.php'>
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
            $customer = trim($_POST["txtcustomer"]);
            $movie = trim($_POST["slmvname"]);
            $venue = trim($_POST["rbvenue"]);
            $date = trim($_POST["txtdate"]);
            $time = trim($_POST["sltime"]);
            $seat = trim($_POST["txtseat"]);
            $book = trim($_POST["hfbook"]);
            
            //validation 
            $error["cusname"] = checkCustomerName($customer);
            $error["movname"] = checkMovie($movie);
            $error["mvvenue"] = checkVenue($venue);
            $error["mvdate"] = checkMvDate($date);
            $error["mvtime"] = checkTime($time);
            $error["mvseat"] = checkSeat($seat);
            
            //filter error
            $error = array_filter($error);
            
            if(empty($error)){
                //GOOD, no error, update record
                //DB Step 1: connection
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                
                //DB Step 2: sql statement
                $sql = "UPDATE booking
                        SET CustomerName = ?, MovieName = ?, Venue = ?, ShowingDate = ?, ShowingTime = ?, MovieSeat = ?
                        WHERE BookingID = ?";
                
                //DB Step 3: execute sql
                $stmt = $con->prepare($sql);
                $stmt->bind_param("sssssss", $customer, $movie, $venue, $date, $time, $seat, $book);
                if($stmt->execute()){
                    //record updated
                    echo "<div class='info'>
                    <a href = 'customerbookinginfo.php'>Back to lists</a>
                    Info of Booking ID $book is updated
                    </div>";
                }
                else{
                    //unable to update
                    echo "<div class='error'>
                    <a href = 'customerbookinginfo.php'>Back to lists</a>
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
        
        <?php if($hideForm == false) : ?>
        
        <div id="rcorners1" class="vl">              
                <form style="margin-left: 25px;" action="" method="post">
                <h1 style="margin-left: 370px; font-size: 40px;">Edit Page</h1>
                <table>
                <tr>
                    <td style="font-size: 25px; color: blue;">Booking ID : </td>
                    <td style="color: blue;"><?php echo $book; ?></td>
                    <td><input style="margin-left: 7px; font-size: 20px;" type="hidden" name="hfbook" value="<?php echo $book; ?>" /></td>
                </tr>
                
                <tr style="height: 70px;">
                    <td style="font-size: 25px;">Customer Name : </td>
                    <td><input style="margin-left: 7px; font-size: 20px;" type="text" name="txtcustomer" value="<?php
                    echo $customer
                    ?>" /></td>
                </tr>

                <tr>
                    <td style="font-size: 25px;">Movie : </td>
                    <td>
                        <select style="margin-left: 7px; font-size: 20px;" name="slmvname">
                            <option selected="selected">Select Movies</option>
                            <?php
                            $records = mysqli_query($conn, "SELECT * FROM movies");
                            while($data = mysqli_fetch_array($records)){
                                echo "<option value='".$data['title']."'>".$data['title']."</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr style="height: 70px;">
                    <td style="font-size: 25px;">Venue : </td>
                    <td style="font-size: 19px;">
                        <?php
                        $venues = getAllVenue();
                        foreach($venues as $ven => $value){
                            printf("
                                <input type='radio' name='rbvenue' %s value='%s' />%s
                                    ",($venue == $ven)? 'checked': "",
                                    $ven, $value);
                        }
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td style="font-size: 25px;">Date : </td>
                    <td><input style="margin-left: 7px; font-size: 20px;" type="date" name="txtdate" value="<?php
                    echo $date
                    ?>" /></td>
                </tr>
                
                <tr style="height: 70px;">
                    <td style="font-size: 25px;">Time : </td>
                    <td>
                        <select style="margin-left: 7px; font-size: 20px;" name="sltime">
                            <?php
                            $times = getAllTime();
                            foreach($times as $mim => $sec){
                                printf("
                                    <option value='%s'%s>%s                        
                                    </option>
                                        ", $mim,
                                        ($time == $mim)? 'selected': "", 
                                        $sec);
                            }                  
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td style="font-size: 25px;">Seat : </td>
                    <td><input style="margin-left: 7px; font-size: 20px;" type="text" name="txtseat" value="<?php
                    echo $seat
                    ?>" /></td>
                </tr>
            </table>
            <input style="padding: 9px 25px; background-color: rgba(0, 136, 169, 1); border: none; border-radius: 50px; cursor: pointer; transition: all 0.3s ease 0s; margin-top: 20px; font-size: 20px;" type="submit" value="update" name="btnupdate" />
            <input style="padding: 9px 25px; background-color: rgba(0, 136, 169, 1); border: none; border-radius: 50px; cursor: pointer; transition: all 0.3s ease 0s; margin-top: 20px; font-size: 20px;" type="button" value="cancel" name="btncancel" onclick="location='customerbookinginfo.php'"/>
                </form>
        </div>
        <?php endif; ?>
	</div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>