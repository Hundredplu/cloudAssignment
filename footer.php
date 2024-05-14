<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <title></title>
        <style>
            footer{
                margin-top: 1010px;
            }
            
            .contain{
                position: absolute;
                top: 1900px;
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
                display:inline-block;/* or block */
                position:relative;
                border-color:white;
                text-decoration:none;
                transition:all .3s ease-out;
                right: 44%;
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

