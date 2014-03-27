<?php session_start(); ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Test kreatora">
        <meta name="author" content="Jakub Karolczak">
        <link rel="shortcut icon" href="res/favicon.ico">

        <title>Centrum gier</title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">

    </head>
    <body>


        <?php
        // put your code here

        if (isset($_SESSION['email'])) {
            //<!--MENU NAVBAR-->
            include 'service/navbar.php';
            include 'main.php';
        } else {
            //<!--MENU NAVBAR-->
            include 'navbarLogin.php';
            include 'promo.php';
        }
        ?>

    </body>
    
    <?php include'footer.php'; ?>
    </div>
    
</html>
