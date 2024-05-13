<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Select Seat</title>
        <link href="css/menu.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        include './Header.php';
        require_once 'config/Con.php';
        ?>
        
            
        <?php
        global $hideForm;
        
        // ask server, which method used by the app?
        if($_SERVER["REQUEST_METHOD"]== "GET"){
            //get method, retreive record from DB
            //display output to the form
            //retreive paremeter from URL (id)
            
            (isset($_GET["id"]))? 
            $id = strtoupper(trim($_GET["id"])) :
                $id = "";
            
            //DB step 1: connection
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            //DB step 2 :sql statemnt
            $sql = "SELECT * FROM images WHERE id = '$id' ";
            
            //DB Step 3: run sql
            $result = $con->query($sql);
            
            if($record = $result-> fetch_object()){
                // record round
                $id = $record->id;
                $name = $record->name;
                $date = $record->date_time;
                $location = $record->location;
                $price = $record->price;
                $description = $record->description;
                $image_path = $record->image_path;
            }else{
                //record not found 
                echo "<div class='error'>
                    Unable to retrive record.
                [ <a href='admin/ticketmenu.php'>
                Back to list </a> ]
                </div>";
                $hideForm = true;
                
            }
            
            $con->close();
            $result->free();
            
        }else{
            
            //update record
            
            //retrive new input data from user
            $seatNumber = trim($_POST["seatNumber"]);
            $name = trim($_POST["name"]);
            $id = trim($_POST["id"]);
    
            
            
             
                //GOOD, no error, update record    
                $connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                //DB Step 1 : connection
               $sql = "INSERT INTO ticket (seatNumber,name,id) VALUES ('$seatNumber','$name','$id')";
              $result = mysqli_query($connection, $sql);

              $connection -> close();
          
        }
        
       ?>
        <?php
        if (isset($_POST['paybtn'])){
         header("Location: payment_ticket.php");
          exit;
         }
        ?>
        <?php if($hideForm == false): ?>
        
    <div id="ticket_box">
            
        <h1 id="seat_tittle">Select Your Seat</h1>
        
        <hr id="ticket_line">
        
        <img src="uploads/seat_map.png" id="seat_map" width="500" height="600" alt="alt"/>
        
        <hr id="ticket_line">
        
        <form action="" method="post">
            <table id='seat'>
                <tr>
                    <td id="event_font">Event ID :</td>
                    <td>
                        <?php echo $id; ?>
                        <input type="hidden" name="id" value="<?php echo $id ?>"/>
                    </td>
                </tr>
                <tr>
                    <td id="event_font">Event Name :</td>
                    <td>
                        <?php echo $name; ?>
                        <input type="hidden" name="name" value="<?php echo $name ?>"/>
                    </td>
                </tr>
                <tr>
                    <td id="event_font">Seat Number:</td>
                    <td id="box"><input type="number" name="seatNumber" id="seatNumber" required></td>
                </tr>
            </table>
            
      
            <input type="submit" value="Confirm" id="btnC" name="paybtn" />
            <input type="button" value="Back" id="btnB" name="btncancel" onclick="location='admin/ticketmenu.php'">
           
        </form>
       
    </div>
        <?php endif; ?>
        

    </body>
        <?php
            include './footer.php';
    ?>
</html>
