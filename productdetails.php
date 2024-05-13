<?php
session_start();

    if(isset($_GET['action']) == 'add'){
    
        $id= $_GET['id'];
    
    if(isset($_SESSION['mycart'][$id])){
        $previous = $_SESSION['mycart'][$id]['qty'];
        $_SESSION['mycart'][$id] = 
                array("id"=>$id,"qty"=>$previous+$_POST['quantity']);
    }else{
        $_SESSION['mycart'][$id] = 
                array("id"=>$id,"qty"=>$_POST['quantity']);
    }
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
        <title>Product details</title>
        <link href="css/productdetails.css" rel="stylesheet" type="text/css"/>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <?php
        include './Header.php';
        

        $id = "";
        if (isset($_GET["id"])){
            $id = $_GET["id"];
        }
        
        
        $sql = "SELECT * FROM products WHERE id = $id";
        
        $result = $con->query($sql);
        
          
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
        
        ?>    
                
        <form action="productdetails.php?action=add&id=<?php echo $row["id"]?>" method="post">
        <h1 class="title" >Product Details
            <br/>
            
        <?php
            if(isset($_SESSION['mycart'])){
                echo "<a href='viewcart.php'>".count($_SESSION['mycart'])."</a>";
            } else {
                echo 0;
            }
            ?> <a href="viewcart.php"> Item/s in your Cart</a></h1>
        <div class="flex-box-product">
            <div class="left">
                <div class="big-img">
                    <img src="<?php echo $row["image"]?>"  >
                    
                </div>
                
            </div>
            
            <div class="right">
                <div class="url"><a href="HomepageAfterLogin.php"> Home </a> > 
                    <a href="HomepageAfterLogin.php#categories"> Product </a> 
                    
                </div>
                
            
                <div class="pname"><?php echo $row["product_name"]; ?></div>
                
                <div class="price"> 
                    <?php echo "RM".$row["price"]; ?> &nbsp;
                    <?php echo  $row['quantity']; ?> left
                </div>
                <div class="size">
                    <p>Size :</p>
                    <select name="psize" class="psize">
                        <option>Select your size</option>
                        <option value="s">S</option>
                        <option value="m">M</option>
                        <option value="l">L</option>
                        <option value="xl">XL</option>
                    </select>
                </div>
                <div class="quantity">
                    <p>Quantity :</p>
                    <input type="number" min="0" max="99" value="1" name="quantity">
                </div>
                <div class="btn-box">
                    <button class="cart-btn"  name="btncart" >Add to Cart</button>
                  
                </div>
            
             <input type="hidden" name="hidden_name" 
                       value="<?php echo $row["product_name"] ?>" />
             
             <input type="hidden" name="hidden_size" 
                       value="<?php echo $row["product_name"] ?>" />
                
                <input type="hidden" name="hidden_price" 
                       value="<?php echo $row["price"] ?>" />
            
            </div>
        
        
        </div>
        <?php 
        }
        }
        ?>
        
        </form>
    </body>
    <?php 
    include 'footer.php';
    ?>
</html>
