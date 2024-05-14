<!DOCTYPE html>
<html>
    <head>
	<title>Description</title>
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
                        background-color: black;
                        color: white;
		}
                		
                table tbody {
                    color: white;
                }
                
                .scroll {
                    height: 200px;
                    width: 700px;
                    overflow: auto;
                }
                
                footer{
                margin-top: 200px;
            }
            
            .contain{
                position: relative;
                top: 200px;
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
            
            .to-top{
                color:white;
                padding-top:1.8em;
                display: block;/* or block */
                position:absolute;
                border-color:white;
                text-decoration:none;
                transition:all .3s ease-out;
                left: 4%;
                margin-top: 50px;
            }
            .to-top:before{
                content:'▲';
                font-size:.9em;
                position:absolute;
                top:0;
                left:50%;
                margin-left:-.7em;
                border:solid .13em white;
                border-radius:10em;
                width:1.4em;
                height:1.4em;
                line-height:1.3em;
                border-color:inherit;
                transition:transform .5s ease-in;
            }
            .to-top:hover{
                color: cyan;
                border-color: cyan;
            }
            .to-top:hover:before{
        	transform: rotate(360deg);
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
    </head>
    <body>
        <?php
        include './header.php';
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

        <form action="" method="POST">
        <table border="1" class="table">
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
                        <td><img style='height: 200px; width: 150px; margin-left: 50px;' src='images/%s'></td>
                        <td style='font-size: 20px;'>Title : %s<br>Duration : %s<br>Showing Date : %s<br>End Date : %s</td>
                        <td style='font-size: 20px;'>
                        <div class='scroll' style='border: solid 1px white;'>
                        <div id='description' style='padding-left: 10px;'>
                        %s
                        </div>
                        </div>
                        </td>
                            </tr>", $record->cover_img, $record->title, $record->duration, $record->date_showing, $record->end_date, $record->description);
                }
            }
            //step4: close connection, release memory from $result
            $result->free();
            $con->close();
            ?>  
                </tbody>
        </table>
        </form>
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
            
        <div>
            <a href="#" class="to-top">Back to top</a>
        </div>
        </footer>
    </body>
</html>
