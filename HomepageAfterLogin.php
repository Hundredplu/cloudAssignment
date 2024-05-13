<?php 
    $con = mysqli_connect('localhost','root');
    mysqli_select_db($con, 'amit_project');
    $sql = "SELECT * FROM products ";
    $featured = $con -> query($sql);   
    
    $query = "SELECT * FROM comment  ";
    $show = $con -> query($query);  
    
    if(isset($_POST['post_message'])){
        $user = $_POST['name'];
        $message = $_POST['message'];

        $code = "INSERT INTO comment (user,comment)
                VALUES ('$user','$message')";

        $con -> query($code);
    }
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Page</title>
        <link href="css/productcss.css" rel="stylesheet" type="text/css"/>
        <link href="css/footer.css" rel="stylesheet" type="text/css"/>
        <link href="css/header.css" rel="stylesheet" type="text/css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-----------User voting features---------->
        <script>
            function getVote(int) {
                var xmlhttp=new XMLHttpRequest();
                xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("poll").innerHTML=this.responseText;
                }
            }
            xmlhttp.open("GET","poll_vote.php?vote="+int,true);
            xmlhttp.send();
            }
        </script>
    </head>
    <body>  
        <?php include'./Header.php'?>
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <h2>WELCOME TO</h2>
                        <h1>Football Society</h1>
                        <p>We offer the best products for the most affordable prices</p>
                        <!---------------press to go to products list---------------> 
                        <a href="#categories" class="btn">Explore Now &#8594;</a> 
                    </div>
                    <div class="col-2">
                        <img src="images/image1.png" alt=""/> 
                    </div>
                </div>
            </div>
        </div>
        <!---------------products list--------------->  
        <div class="categories" id="categories">
        <div class="small-container">
            <h2 class="title">Featured Products</h2>
            <div class="row"> 
                <?php 
                    while($product = mysqli_fetch_assoc($featured)):
                ?> 
                <div class="col-4" id="col-4">
                    <a href="productdetails.php?id=<?php echo $product['id']; ?>"><img src="<?= $product['image'];?>" alt=""/></a>
                    <h4><?= $product['product_name'];?> </h4>
                    <p>RM<?= $product['price'];?>  &nbsp;<?= $product['quantity'];?> left</p>
                    <a href="productdetails.php?id=<?php echo $product['id']; ?>" class="btn" >View Details &#8594;</a>
                </div>

                <?php endwhile;?>

                </div>
              
                
            </div>
            </div>  
          </div>
        </div>
        <!---------------feedback--------------->   
        <div class="feedback">
            <h2 class="title">User Feedback</h2>
            <div class="small-container">
                <div class="col-3">
                    <form action="" method="post">
                        <h2>Comment</h2>
                        <input type="text" name="name" class="name" placeholder="comment as..." required/><br>
                        <textarea name="message" cols="30" rows="10" class="message"  placeholder="leave a comment" required></textarea><br>
                        <button type="submit" name="post_message" class="btn" onClick="alert( 'Comment Added...' )">Post</button>
                    </form>
                </div>
                <div class="row">
                    <?php 
                        while($comment = mysqli_fetch_assoc($show)):
                    ?> 
                    <!---------------comment features--------------->
                    <div class="col-3">
                        <p><?= $comment['comment'];?></p>
                        <img src="images/user.png" alt=""/>
                        <h3>User <?= $comment['user'];?></h3>
                    </div>
                    <?php endwhile;?> 
                    
                </div>
                <div class="col-3">
                    <!---------------voting features--------------->
                    <div id="poll">
                        <h3>Do you like our society so far?</h3>
                        <form>
                        Yes: <input type="radio" name="vote" value="0" onclick="getVote(this.value)"><br>
                        No: <input type="radio" name="vote" value="1" onclick="getVote(this.value)">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!---------------brands--------------->
        <div class="brands">
            <h2 class="title">Brands</h2>
            <div class="small-container">
                <div class="row">
                    <div class="col-5">
                        <img src="images/logo-adidas.png" alt=""/>
                    </div>
                    <div class="col-5">
                        <img src="images/logo-puma.png" alt=""/>
                    </div>
                    <div class="col-5">
                        <img src="images/logo-nike.png" alt=""/>
                    </div>
                    <div class="col-5">
                        <img src="images/logo-paypal.png" alt=""/>
                    </div>
                </div>  
            </div>
        </div>  
        <?php include './footer.php'; ?>
    </body>
</html>