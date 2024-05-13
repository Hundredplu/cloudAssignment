<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Payment</title>
        <link href="css/payment.css" rel="stylesheet" type="text/css"/>
        <script src="https://kit.fontawesome.com/dfb98cae41.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
        include './Header.php';
        include_once './config/helperP&O.php';
        include_once './config/Con.php';
        ?>
        
        <div class="container">
            <?php
        
            //declare global 
            global $orderID, $custName, $phoneNo, $address, $city
                    , $state, $zipCode;
                
                if (!empty($_POST)){
            
                
                    (isset($_POST['txtid']))?
                        $orderID =  trim ($_POST['txtid']): 
                            $orderID = "";
            
                    (isset($_POST['txtCust']))?
                        $custName =  trim ($_POST['txtCust']): 
                            $custName = "";
                
                    (isset($_POST['txtPhoneNo']))?
                        $phoneNo =  trim ($_POST['txtPhoneNo']): 
                            $phoneNo = "";
               
          
                    (isset($_POST['txtAddress']))?
                        $address =  trim ($_POST['txtAddress']): 
                            $address = "";
                    
                    (isset($_POST['txtCity']))?
                        $city =  trim ($_POST['txtCity']): 
                            $city = "";
                    
                    (isset($_POST['ddlstate']))?
                        $state =  trim ($_POST['ddlstate']): 
                            $state = "";
                    
                    (isset($_POST['txtZipcode']))?
                        $zipCode =  trim ($_POST['txtZipcode']): 
                            $zipCode = "";
               
                          
                    //Validation
                    $error['orderId' ] = checkOrderId        ($orderID );
                    $error['custName'] = checkCustomerName   ($custName);
                    $error['phoneNo' ] = checkPhoneNo        ($phoneNo );
                    $error['address' ] = checkAddress        ($address );
                    $error['city'    ] = checkCity           ($city    );
                    $error['state'   ] = checkState          ($state   );
                    $error['zipCode' ] = checkZipCode        ($zipCode );
                   
                    
          
                    //filter error
                    $error = array_filter($error);
          
          
                        if (empty ($error)){
                        //GOOD no error, insert record 
              
                        //DB Step 1 : connection
                        $connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
              
                        //DB Step2 :sql statement
                        $sql = "INSERT INTO order_details 
                            (order_id,delivered_to,phone_no,deliver_address,city,state,zipCode) 
                            VALUES (?,?,?,?,?,?,?)";
              
                        //DB Step 3 : execute sql
                        $statement = $connection -> prepare($sql);
              
                        $statement -> bind_param('dsssssd', 
                                $orderID, $custName, $phoneNo, $address, $city
                                , $state, $zipCode);
              
                        $statement -> execute();
              
                            if($statement -> affected_rows > 0){
                               echo ("<script> window.alert('Complete keying details?'); window.location.href='payment.php'  </script>");
                                // Records are inserted                              
                            } else {
                                //records are unable to be inserted                               
                                echo "<div class='error'>
                                    <a href = 'payment.php'>back to lists</a>
                                    unable to insert records</div>";
                            }
              
                            //Step 4 : close connection and statement
                            $connection -> close();
                            $statement -> close();
              
                        }else {
              
                            //NOT GOOD , display error
                            echo "<ul class='error'>";
                            foreach ($error as $value){
                            echo "<li>$value</li>"; 
                            }
                            echo "</ul>";
                        } 
                }
        ?>
            
        <form action="" method="POST">
            <div class="row">
                <div class="col">
                
                <h3 class="title">Delivery information</h3>
                <div class="inputBox">
                    <span>Full name:</span> 
                    <input type="text" name="txtCust" value="<?php echo $custName ?>" />
                </div>
            
                <div class="inputBox">
                    <span>Phone Number :</span> 
                    <input type="text" name="txtPhoneNo" value="<?php echo $phoneNo ?>" /> 
                </div>
                
                <div class="inputBox">
                    <label>Address : </label>
                        <input type="text" name="txtAddress" 
                               value="<?php echo $address ?>" /> 
                </div>
                <div class="inputBox">
                    <label>City : </label>   
                        <input type="text" name="txtCity"  
                               value="<?php echo $city ?>" />
                </div>
                
            
                <div class="inputBox">
                    <label>State : </label>  
                        <select name="ddlstate">
                            <?php
                                $state = getState();
                                foreach ($state as $State => $value){
                                    printf("<option value='%s'%s>%s</option>"
                                            , $State
                                            ,($state == $State)? 'selected' : ""
                                            ,$value);
                                } 
                            ?>
                        </select>
                </div>
                <div class="inputBox">
                    <label>ZIP code: </label> 
                    <input type="text" name="txtZipcode" 
                           value="<?php echo $zipCode ?>" />
                </div>
            
             
                
        </div>
                
                
         </div>         
           <div style="display: flex; gap: 15px;">  
        <input type="submit" value="Proceed to payment details" name="btnsubmit" class="btnsubmit" />
        <input type="button" value="Cancel" name="btncancel" 
                       class="btnsubmit" onclick="location='viewcart.php'">
           </div>
    </form>    
</div>      
</body>
</html>
