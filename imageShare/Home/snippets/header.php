<?php

include_once  '/imageShare/Auth/isSigned.php';
include_once  "/imageShare/Database/config.php";

$login = "/imageShare/Login/Login.php";
$home = "/imageShare/Home/home.php";
$logout = "/imageShare/Login/logout.php";
$upload = "/imageShare/Home/upload.php";
$shared = "/imageShare/Home/shared.php";
$name = $_SESSION['user']['username'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Home Page</title>
<meta charset="UTF-8">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<style>
    /*body{*/
    /*    background-image: url("/imageShare/static/imgs/pexels-sohel-patel-1199824.jpg");*/
    /*}*/
    nav{
        background-color: black;
    }

    body {
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        min-height: 100vh;
        height: 100%;
        text-decoration-color: black;
    }
    .button{
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }
    .button:hover{
        background-color: #e7e7e7;
        border: none;
        color: #F9AA33;
        padding: 15px 32px;
        box-shadow: 10px 10px 5px 5px grey;
        text-align: center;
        /*text-decoration: none;*/
        display: inline-block;
        font-size: 16px;
    }
    .w3-bar-block {
        box-shadow: -10px 0px 10px 1px gray;
    }
    h1,h2,h3,h4,h5{font-family: sans-serif; text-decoration-color: black;}
    .photo img{ cursor: pointer}
    .photo img:hover{opacity: 0.6; transition: 0.3s}
</style>

<div class="w3-sidebar w3-bar-block w3-dark-grey w3-animate-right w3-top w3-text-light-grey w3-large rounded" style="z-index:3;width:250px;font-weight:bold;display:none;right:0;" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item button w3-center w3-padding-32 rounded" >CLOSE</a>
    <a href="<?php echo $home; ?>" onclick="w3_close()" class="w3-bar-item button w3-center w3-padding-16 rounded">HOME</a>
    <a href="<?php echo $shared; ?>" onclick="w3_close()" class="w3-bar-item button w3-center w3-padding-16 rounded">SHARED</a>
    <a href="<?php echo $upload; ?>" onclick="w3_close()" class="w3-bar-item button  w3-center  w3-padding-16 rounded">UPLOAD</a>
    <a href="<?php echo $logout ?>" onclick="w3_close()" class="w3-bar-item button w3-center w3-padding-16 rounded">LOGOUT</a>
    <a href="<?php echo $home; ?>" onclick="w3_close()" class="w3-bar-item button  w3-center  w3-padding-16 rounded">ABOUT</a>
</div>

<nav class="navbar navbar-light  shadow-lg bd-navbar rounded" style="background-color: #344955; ">
    <div class="container-fluid">
    <p class="navbar-brand ms-3 mt-2 fs-3 fw-bold font-monospace" style="color: #F9AA33">Photo Sharing</p>
    <a href="javascript:void(0)" class="w3-right w3-button nav-item rounded" style="background-color: #F9AA33; "onclick="w3_open()">☰</a>
    </div>
</nav>

<div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

</head>

<script>

    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }

</script>

<body>