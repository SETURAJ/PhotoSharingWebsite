<?php


session_start();
if($_SESSION['user'] == null)
{
    header('Location:/imageShare/Login/login.php');
}
