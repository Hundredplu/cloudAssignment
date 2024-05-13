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
   
        <form action="" method="POST">
            <div class="row">
                
                
                <?php
        
            //declare global 
            global $paymentID, $payMethod, $cardNumber, $cardName, $expDateMonth, $expDateYear, $CVV;
                if (!empty($_POST)){
            
                
                    (isset($_POST['id']))?
                        $paymentID =  trim ($_POST['id']): 
                            $paymentID = "";
                    
                    (isset($_POST['ddlpaymethod']))?
                        $payMethod =  trim ($_POST['ddlpaymethod']): 
                            $payMethod = "";
            
                    (isset($_POST['Cname']))?
                        $cardName =  trim ($_POST['Cname']): 
                            $cardName = "";
                
                    (isset($_POST['Cnumber']))?
                        $cardNumber =  trim ($_POST['Cnumber']): 
                            $cardNumber = "";
                       
                    (isset($_POST['EDmonth']))?
                        $expDateMonth =  trim ($_POST['EDmonth']): 
                            $expDateMonth = "";
                  
                    (isset($_POST['EDyear']))?
                        $expDateYear =  trim ($_POST['EDyear']): 
                            $expDateYear = "";
                
          
                    (isset($_POST['CVV']))?
                        $CVV =  trim ($_POST['CVV']):
                            $CVV = "";
                          
                    //Validation
                    $error['paymentId' ] = checkPaymentId    ($paymentID   );
                    $error['payMethod' ] = checkPaymentMethod($payMethod   );
                    $error['cardName'  ] = checkCardName     ($cardName    );
                    $error['cardNumber'] = checkCardNumber   ($cardNumber  );
                    $error['EDmonth'   ] = checkMonth        ($expDateMonth);
                    $error['EDyear'    ] = checkYear         ($expDateYear );                    
                    $error['CVV'       ] = checkCVV          ($CVV         );
          
                    //filter error
                    $error = array_filter($error);
          
          
                        if (empty ($error)){
                        //GOOD no error, insert record 
              
                        //DB Step 1 : connection
                        $connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
              
                        //DB Step2 :sql statement
                        $sql = "INSERT INTO payment_details 
                            (payment_id,cardName,cardNumber,expDateMonth,expDateYear,CVV,pay_method) 
                            VALUES (?,?,?,?,?,?,?)";
              
                        //DB Step 3 : execute sql
                        $statement = $connection -> prepare($sql);
              
                        $statement -> bind_param('dssddds', 
                                $paymentID, $cardName, $cardNumber, $expDateMonth, $expDateYear, $CVV, $payMethod);
              
                        $statement -> execute();
              
                            if($statement -> affected_rows > 0){
                               echo ("<script> window.alert('Complete keying details?'); window.location.href='payment_successful.php'</script>");
                                // Records are inserted                              
                            } else {
                                //records are unable to be inserted                               
                                echo "<div class='error'>
                                    <a href = 'payment.php'>BACK to lists</a>
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
                
         <div class="col">
            <h3 class="title">Payment</h3>
            <div class="field input">
                        <label>Payment Method</label>
                        <select name="ddlpaymethod">
                            <?php
                                $payment_method = getPaymethod();
                                foreach ($payment_method as $method => $value){
                                    printf("<option value='%s'%s>%s</option>"
                                            , $method
                                            ,($payMethod == $method)? 'selected' : ""
                                            ,$value);
                                } 
                            ?>
                        </select>
                    </div>
            
                <div class="inputBox">
                    <span>Name on card :</span> 
                    <input type="text" name="Cname" 
                           value="<?php echo $cardName ?>" /> 
                </div>
                <div class="inputBox">
                    <span>Credit card number :</span>   
                    <input type="text" name="Cnumber" 
                           value="<?php echo $cardNumber ?>" /> 
                </div>
                <div class="inputBox">
                    <span>Exp Date Month :</span>
                        <input type="number" name="EDmonth" 
                               value="<?php echo $expDateMonth ?>" />
                </div>
            
                <div class="inputBox">
                    <span>Exp Date Year :</span>
                        <input type="number" name="EDyear" 
                               value="<?php echo $expDateYear ?>" />
                </div>
            
                <div class="inputBox">
                    <span>Card Verification Value(CVV) :</span>
                        <input type="number" name="CVV" 
                               value="<?php echo $CVV ?>" />
                </div>
            
            </div>
         </div>         
           <div style="display: flex; gap: 15px;">  
        <input type="submit" value="Proceed to checkout" name="btnsubmit" class="btnsubmit" />
        <input type="button" value="Cancel" name="btncancel" 
                       class="btnsubmit" onclick="location='viewcart.php'">
           </div>
    </form>    
</div>      
</body>
</html>
