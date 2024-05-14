<?php
include './payment/connect.php';
//check variable exists
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $date = $_POST['paymentDate'];
    $amount = $_POST['paymentMethod'];
    
    //insert valeies into DB
        $sql = "INSERT INTO payment(name,paymentDate,paymentMethod) VALUES ('$name','$date','$amount')";
        $result = mysqli_query($con, $sql);
        if($result){
            //link to movies.php
            header('location:moviespage.php');
        }else{
            //unsuccesful, error message
            die(mysqli_error($con));
        }
    //if ($result) {
    //echo "Data inserted successfully";
    //} else {
    // echo "Error: " . $sql . "<br>" . mysqli_error($con);
    //}     
    }

?>





<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; 
  display: flex;
  -ms-flex-wrap: wrap; 
  flex-wrap: wrap;
  margin: 0 -16px;
}


.col-50 {
  -ms-flex: 50%; 
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; 
  flex: 75%;
}

.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

button.cancelcheckout {
  float:right;
  margin-right: 60px;
  margin-top: 80px;
  background-color: green; 
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  transition-duration: 0.4s;
  cursor: pointer;
  background-color: blueviolet; 
  color: white; 
  border: 2px solid blueviolet;
  border-radius: 8px;
}


button.cancelcheckout:hover {
  background-color: white;
  color: blueviolet;
}


.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>

<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="" method="POST" onsubmit="return validateForm()">
        <div class="row">
          <div class="col-50">
            <button class="cancelcheckout" onclick="cancelCheckout()">Cancel Checkout</button>  
            <h3>Checkout</h3> 
            <label for="fname">Accepted Cards</label> 
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i> 
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="name" placeholder="Please enter your name" required>
            <label for="method">Payment Method </label>
            <input type="radio" name="paymentMethod" value="Credit Card" required>Credit Card</input>
            <input type="radio" name="paymentMethod" value="Debit Card" >Debit Card</input>
            <br><br><label for="date">Payment Date </label>
            <input type="date" name="paymentDate" id="paymentDate"  value="" style="width : 400px; height: 30px; padding-left: 8px;" readonly  >
            <br><br><label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September" required>
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018" required>
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352" required>
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" required > I have read the terms and conditions
        </label>
          
          <input type="submit" name="submit" value="Complete checkout" class="btn">
          
    
      </form>
    </div>
      <script>
  //Cancel Checkout function
  //if user click confirm, they will link to movies.php
  function cancelCheckout() {
  var confirmation = confirm("Are you sure you want to cancel the checkout?");
  if (confirmation) {
  alert("Checkout Canceled. Have a Nice Day !");
  window.location.href = "movies.php";
    }
 }
  //payment date        
  // get the current date and format it as "YYYY-MM-DD"
  var currentDate = new Date().toISOString().substr(0, 10);

  // set the value of the paymentDate field to the current date
  document.getElementById("paymentDate").value = currentDate;
 
  //validation function
  function validateForm() {
  var ccnum = document.getElementById("ccnum").value;
  var cvv = document.getElementById("cvv").value;
  var expmonth = document.getElementById("expmonth").value;
  var expyear = document.getElementById("expyear").value;
  
  //credit card number validation
  if (!ccnum.match(/^\d{4}-\d{4}-\d{4}-\d{4}$/)) {
  alert("Oops, please enter a valid credit card number in the format 1111-2222-3333-4444.");
  return false;
  }
  
 //expiry year validation
//if expiry month is not valid and smaller than current year
 if (!expyear.match(/^\d{4}$/) || expyear < 2023) {
    alert("Oops, your expiry year is invalid(e.g. 2023)!");
    return false;
    
//if  the expyear is greater tha current year
//all month is accepted
} else if (expyear > 2023) {
    if (!expmonth.match(/^(January|February|March|April|May|June|July|August|September|October|November|December)$/i)) {
        alert("Oops, your expiry month is invalid (e.g. January).");
        return false;
    }
 
 //if the expyyear is same as current year
 //only following month is accepted
} else if (expyear == 2023) {
    if (!expmonth.match(/^(June|July|August|September|October|November|December)$/i)) {
        alert("Oops, your expiry month is invalid for year 2023 (June - December).");
        return false;
    }

//if not valid,
} else {
    alert("Oops, Your Card Is Expired !");
    return false;
}
  
  
  //cvv number validation
  if (!cvv.match(/^\d{3}$/)) {
    alert("Oops, your valid CVV number is invalid ! (3 digits).");
    return false;
  }



  
 //if checkout successful, link to movies.php 
  alert("Checkout successful!");
  window.location.href = "movies.php";
  return true;
  
  
}
</script>
</body>
</html>

