<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php
include '../config/helperR&L.php';

session_start();
session_unset();
session_destroy();
echo "<script>alert('Logged Out.');
       window.location.href='HomepageBeforeLogin.php';
       </script>";
 

