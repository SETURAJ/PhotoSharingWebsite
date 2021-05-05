<?php

define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

try {
        $conn = new PDO('mysql:host=localhost;dbname=imageShare', DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }