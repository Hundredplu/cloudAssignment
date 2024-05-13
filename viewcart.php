<?php
session_start();

    if(isset($_GET['remove'])){
    
        $id = $_GET['remove'];
    
        unset($_SESSION['mycart'][$id]);
        header("location:viewcart.php");
   
}


$con = new mysqli ("localhost","root","", "amit_project");
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Cart</title>
        <link href="css/viewcart.css" rel="stylesheet" type="text/css"/>
        
        
</head>
<body>
    <?php include'./Header.php' ?>
        
    <div class="wraper">
           
        <div class="cart-container">
            <h1>my cart</h1>
            
            
                <?php
            
                    if(!isset($_SESSION['mycart'])|| count($_SESSION['mycart']) == 0){
                        echo "<h1>Cart is Empty</h1>"; 
                        echo "<a href='HomepageAfterLogin.php#categories'>Continue Shopping</h1><br>"; 
                    }else{

                ?>
		
            <table rules="all">
                <thead>
                    <tr>
			<th>serial no</th>
			<th>Product Name</th>
			<th>Product Price</th>
			<th>quantity</th>
			<th>subtotal</th>
			<th>action</th>
                    </tr>
		</thead>
        
                <tbody>
				
                    <?php
                        $sno = 1;
                        $total = 0;
                        foreach ($_SESSION['mycart'] as $key => $value){
                            
                            $q = mysqli_query($con, "SELECT * from products where id = $key");
                            
                                foreach ($q as $a) {
                                    echo"
                                        <form action='' method='POST'>
                                        <tr>
                                    <td>$sno</td>    
                                    <td>".$a['product_name']."</td>   
                                    <td>RM ".$a['price']."</td>   
                                    <td><input type='number' name='quantity' value='$value[qty]' /></td>   
                                    <td>RM ".$value['qty']*$a['price']."</td> 
                                    <td><a href='?remove=".$key."'>Delete</a></td> 
                                    </tr>
                                    </form>";
                                
                                    $total += $value['qty']*$a['price']; // calculate total
                                }
                                    $sno++; 
                        }
                        
                    ?>		
				
                    <tr class="total">
			<td colspan="4"><h3>Amount Payable</h3></td>
			<td><h5><?php echo "RM ".$total; ?></h5></td>
                        <td><a href="HomepageAfterLogin.php#categories">Back</a></td>
                    </tr>
       
                    <tr>
                        <td colspan="6">
                            <form action="deliverydetails.php" method="post">
                                <button  class="btn">Proceed to Delivery Details</button>
                            </form>
                        </td>
                    </tr>
                    
                    
                </tbody>
            </table>
                
                <?php
                    }//else for count of add to cart
                ?>
            <?php
            if(isset($_SESSION['mycart'])){
                echo "<a href='viewcart.php'>".count($_SESSION['mycart'])."</a>";
            } else {
                echo 0;
            }
            ?> <a href="viewcart.php"> Item/s in your Cart</a>
        </div>
        
    </div>
    
</body>
<?php
        include './footer.php';
?>
</html>
