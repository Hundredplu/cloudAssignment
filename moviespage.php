<?php

  include 'config.php';
  $movies = $conn->query("SELECT * FROM movies where '".date('Y-m-d')."' BETWEEN date(date_showing) and date(end_date) order by rand()");
  session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Movies</title>
        <link href="Styles/homepageCss.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <style>
        * {box-sizing: border-box;}
        body {
            font-family: Verdana, sans-serif;
            background-color: black;
        }
        .mySlides {display: none;}
        img {vertical-align: middle;}

        .slideshow-container {
          max-width: 1800px;
          position: relative;
          margin: auto;
          margin-top: 1%;
        }

        .text {
          color: #f2f2f2;
          font-size: 15px;
          padding: 8px 12px;
          position: absolute;
          bottom: 8px;
          width: 100%;
          text-align: center;
        }

        .numbertext {
          color: #f2f2f2;
          font-size: 12px;
          padding: 8px 12px;
          position: absolute;
          top: 0;
        }

        .dot {
          height: 15px;
          width: 15px;
          margin: 0 2px;
          margin-bottom: 1%;
          background-color: #bbb;
          border-radius: 50%;
          display: inline-block;
          transition: background-color 0.6s ease;
        }

        .active {
          background-color: #717171;
        }

        .fade {
          -webkit-animation-name: fade;
          -webkit-animation-duration: 1.5s;
          animation-name: fade;
          animation-duration: 1.5s;
        }
        
        * {box-sizing: border-box;}

        .container {
          position: absolute;
          width: 100%;
          max-width: 300px;
        }
        
        .images {
          display: block;
          width: 300px;
          height: auto;
          margin-top: 30px;
          margin-left: 30px;
        }

        .overlay {
          position: absolute; 
          bottom: 0; 
          background: rgb(0, 0, 0);
          background: rgba(0, 0, 0, 0.5); 
          color: #f1f1f1; 
          width: 300px;
          transition: .5s ease;
          opacity:0;
          color: white;
          font-size: 20px;
          padding: 50px;
          text-align: center;
          margin-left: 30px;
        }

        .container:hover .overlay {
          opacity: 1;
        }
        
        a.links {
          color: inherit;
          text-decoration: none;
        }

        a.links {
          background:
          linear-gradient(
           to right,
           rgba(100, 200, 200, 1),
           rgba(100, 200, 200, 1)
           ),
          linear-gradient(
           to right,
           rgba(255, 0, 0, 1),
           rgba(255, 0, 180, 1),
           rgba(0, 100, 200, 1)
           );
           background-size: 100% 3px, 0 3px;
           background-position: 100% 100%, 0 100%;
           background-repeat: no-repeat;
           transition: background-size 400ms;
        }

        a.links:hover {
           background-size: 0 3px, 100% 3px;
        }   

div#movie-carousel-field {
    position: relative;
    margin-top:26vh;
    display: flex;
}
#movie-carousel-field .list {
    display: flex;
    white-space: pre;
    overflow: hidden;
    max-width: calc(90%);
}
#movie-carousel-field .list-nav {
    width: calc(5%);
    display: flex;
    align-items: center;
}
#movie-carousel-field a {
    margin:auto;
    font-size:3rem;
}
#movie-carousel-field .movie-item {
    cursor: pointer;
    transition: all 1s;
    animation: all 1.5s;
}
#movies{
    display:contents;
    max-width: calc(100%);

}
#movie-carousel-field .movie-item {
    height: 43vh;
    width: 13vw;
    margin: .5em
    }

#movie-carousel-field .movie-item img,#movies .movie-item img {
  
    height: 52vh;
    width: 17vw;
    display: flex;
    position: relative;
    top: 0px;
    left: 0;
}
#movies .movie-item{
  position: relative;
  float: left;
}
#movies .movie-item {
margin: .5em;
float:left;
}
#movies .movie-item .mov-det{
position: absolute;
}

  .movie-item:hover {
    position: relative;
    top: -1em;
    height: 52vh;
}
 .mov-det {
    position: absolute;
    bottom: 0;
    transition: .5s ease;
    opacity: 0;
    display: none
}
 .movie-item:hover .mov-det {
   display: block;
    opacity: 1;
    right: 3vw;
    top: 28vh;;

   }
   .reserve-img{
        height: 53vh;
        width: 20vw;
        border:2px solid #f4623a;
        border-radius: 3px
   }
    </style>
    
    <script>
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
      } else {
        document.getElementById("myBtn").style.display = "none";
      }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
      document.body.scrollTop = 0; 
      document.documentElement.scrollTop = 0; 
    } 
    </script>
    <body> 
        
        <?php
        include './header.php';
        ?>
        <div id="home" align="center">
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <img src="./images/tar.png" style="width:80%; height: 420px;">
                </div>
                <div class="mySlides fade">
                    <img src="./images/2d.png" style="width:80%; height: 420px;">
                </div>
                <div class="mySlides fade">
                    <img src="./images/3d.png" style="width:80%; height: 420px;">
                </div>
                <div class="mySlides fade">
                    <img src="./images/netflix.png" style="width:80%; height: 420px;">
                </div>
                <div class="mySlides fade">
                    <img src="./images/1080.png" style="width:80%; height: 420px;">
                </div>
            </div>
        </div>
            <br>
            
            <div style="text-align:center">
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
            </div>
    <script>
            var slideIndex = 0;
            showSlides();

            function showSlides() {
              var i;
              var slides = document.getElementsByClassName("mySlides");
              var dots = document.getElementsByClassName("dot");
              for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
              }
              slideIndex++;
              if (slideIndex > slides.length) {slideIndex = 1}    
              for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
              }
              slides[slideIndex-1].style.display = "block";  
              dots[slideIndex-1].className += " active";
              setTimeout(showSlides, 2500);
            }
    </script>
    <br>
    <center><h1 style="color: goldenrod; font-size: 50px; margin-bottom: 30px;">Now Showing</h1></center>
			<div id="movies">	

	<?php while($row=$movies->fetch_assoc()): ?>
        <div class="movie-item">
          <img style="margin-left: 20px; padding-bottom: 20px;" class="" src="./images/<?php echo $row['cover_img']  ?>" alt="<?php echo $row['title'] ?>" >
          <div class="mov-det">
              <button type="button" class="btn btn-primary"><a href="description.php?movtitle='$mvtitle'">Show Details</a></button>
          </div>
        </div>
    <?php endwhile; ?>
	</div>    
    <?php
        include './footer.php';
    ?>
   
    </body>
</html>