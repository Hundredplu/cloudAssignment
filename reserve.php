<?php


$con = mysqli_connect("localhost","root","","assignment");
if(!$con){
    die("Connection Failed:". mysqli_connect_error());
}   
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <style>
        body {
         background-color: black;
        }
        
        #rcorners1 {
         border-radius: 25px;
         background: white;
         width: 1000px;
         height: 515px;
         margin-left: 250px;
         margin-bottom: 10px;
         margin-top: 10px;
        }

        .vl {
        border-block-end: 5px solid green;
        }
        
        footer{
                margin-top: 65px;
            }
            
            .contain{
                position: absolute;
                top: 900px;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                max-width: 1200px;
                text-align: center;
            }
            
            .contain .btn{
                display: inline-block;
                width: 70px;
                height: 70px;
                background: #fff;
                box-shadow: 0 5px 15px -5px #aaa;
                margin: 10px;
                border-radius: 30%;
                overflow: hidden;
                position: relative;
                color: #42d2ff;
            }
            
            .contain .btn i{
                position: relative;
                z-index: 4;
                line-height: 70px;
                font-size: 26px;
                transition: 0.3s ease-in-out;
            }
            
            .contain .btn::before{
                content: "";
                position: absolute;
                width: 120%;
                height: 120%;
                background: linear-gradient(#00c6ff, #0072ff);
                transform: rotate(45deg);
                left: -110%;
                top: 90%;
            }
            
            .contain .btn:hover i{
                color: #fff;
                transform: scale(1.3);
            }
            
            .contain .btn:hover::before{
                animation: onHover 0.7s 1;
                left: -10%;
                top: -10%;
            }
            
            .footer-basic .copyright {
                margin-top: 20px;
                text-align:center;
                font-size:16px;
                color:grey;
                margin-bottom:0;
            }

            @keyframes onHover{
                0%{
                    left: -110%;
                    top: 90%;
                }
                50%{
                    left: 10%;
                    top: -30%;
                }
                100%{
                    left: -10%;
                    top: -10%;
                }                          
            }
    </style>
    <body>
        <?php
        include './header.php';
        require_once './config/helper2.php';
        ?>
 
        <?php
        global $customer, $movie, $venue, $date, $time, $seat;
        
        if (!empty($_POST)){           
            
            (isset($_POST['txtcustomer']))?
            $customer = trim($_POST['txtcustomer']):
                $customer = "";
            
            (isset($_POST['slmvname']))?
            $movie = trim($_POST['slmvname']):
                $movie = "";
            
            (isset($_POST['rbvenue']))?
            $venue = trim($_POST['rbvenue']):
                $venue = "";
            
            (isset($_POST['txtdate']))?
            $date = trim($_POST['txtdate']):
                $date = "";
            
            (isset($_POST['sltime']))?
            $time = trim($_POST['sltime']):
                $time = "";
            
            (isset($_POST['txtseat']))?
            $seat = trim($_POST['txtseat']):
                $seat = "";
            
            //validation
            $error["cusname"] = checkCustomerName($customer);
            $error["movname"] = checkMovie($movie);
            $error["mvvenue"] = checkVenue($venue);
            $error["mvdate"] = checkMvDate($date);
            $error["mvtime"] = checkTime($time);
            $error["mvseat"] = checkSeat($seat);
            
            $error = array_filter($error);
            if (empty($error)){
                //Good insert record later
                $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); //follow sequence
                $sql = "INSERT INTO booking (CustomerName, MovieName, Venue, ShowingDate, ShowingTime, MovieSeat) VALUES (?,?,?,?,?,?)";
                $statement = $connection ->prepare($sql);
                $statement -> bind_param('ssssss', $customer, $movie, $venue, $date, $time, $seat);
                $statement -> execute();
                if($statement -> affected_rows > 0){
                    echo "<script>alert('Booking Successfull!')
                    window.location = 'checkout.php'</script>";
                    //record insert successfully 
                }
                else{
                    //unable to insert record
                    echo "<div class='error'>
                    <a href = 'moviespage.php'>Back to Moviespage</a>
                    Unable to insert records</div>";
                }
                $connection -> close();
                $statement -> close();
            }
            else{
                //Not Good display error
                echo "<ul class = 'error'>";
                foreach ($error as $value){
                    echo "<li>$value</li>";
                }
                echo "</ul>";
                
            }
        }
        ?>
        <div id="rcorners1" class="vl">
                <form action="" method="post">
                <h1 style="margin-left: 360px; font-size: 40px;">Start Booking Now</h1>
                <table style="margin-top: 30px; margin-left: 70px;">
                
                <tr>
                    <td style="font-size: 25px;">Customer Name : </td>
                    <td><input style="margin-left: 7px; font-size: 20px;" type="text" name="txtcustomer" value="<?php
                    echo $customer 
                    ?>" /></td>
                </tr>
                
                <tr style="height: 70px;">
                    <td style="font-size: 25px;">Movie : </td>
                    <td>
                        <select style="margin-left: 7px; font-size: 20px;" name="slmvname">
                            <option selected="selected">Select Movies</option>
                            <?php
                            $records = mysqli_query($con, "SELECT * FROM movies");
                            while($data = mysqli_fetch_array($records)){
                                echo "<option value='".$data['title']."'>".$data['title']."</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td style="font-size: 25px;">Venue : </td>
                    <td style="font-size: 16px;">
                        <?php
                        $venues = getAllVenue();
                        foreach($venues as $ven => $value){
                            printf("
                                <input style='margin-left: 7px;' type='radio' name='rbvenue' %s value='%s' />%s
                                    ",($venue == $ven)? 'checked': "",
                                    $ven, $value);
                        }
                        ?>
                    </td>
                </tr>
                
                <tr style="height: 70px;">
                    <td style="font-size: 25px;">Date : </td>
                    <td><input style="margin-left: 7px; font-size: 20px;" type="date" name="txtdate" value="<?php
                    echo $date
                    ?>" /></td>
                </tr>
                                
                <tr>
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
                
                <tr style="height: 70px;">
                    <td style="font-size: 25px;">Quantity of Seat : </td>
                    <td><input style="margin-left: 7px; font-size: 20px;" type="text" name="txtseat" value="<?php
                    echo $seat
                    ?>" /></td>
                </tr>

            </table>
            <input style="padding: 9px 25px; background-color: rgba(0, 136, 169, 1); border: none; border-radius: 50px; cursor: pointer; transition: all 0.3s ease 0s; margin-top: 40px; margin-left: 70px; font-size: 20px;" type="submit" value="Next" name="btninsert"/>
            <input style="padding: 9px 25px; background-color: rgba(0, 136, 169, 1); border: none; border-radius: 50px; cursor: pointer; transition: all 0.3s ease 0s; font-size: 20px;" type="button" value="Cancel" name="btncancel" onclick="location='moviespage.php'"/>
                </form>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <footer>
                <hr style="color: white;">
        <div class="contain">
            <a href="https://www.facebook.com/tarumtkl/?locale=ms_MY" class="btn">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/Vulcux" class="btn">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.tarc.edu.my/" class="btn">
                <i class="fab fa-google"></i>
            </a>
            <a href="https://www.instagram.com/tarumt_penang/" class="btn">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.youtube.com/@tarumt" class="btn">
                <i class="fab fa-youtube"></i>
            </a>           
        </div>
            
        <div class="footer-basic">       
            <p class="copyright">TAR UMT FILM © 2023</p>
        </div>
        </footer>
    </body>
</html>
