<?php
include_once  "/imageShare/Database/config.php";


if($_SERVER['REQUEST_METHOD'] == "POST"){
    $sql = "DELETE FROM shared where user_id = :u_id AND image_id = :i_id";
    $stmt = $conn->prepare($sql);
    echo $_POST['shared_users'];
    echo $_POST['id'] ;
    $stmt->bindValue(":u_id",$_POST['shared_users'],PDO::PARAM_INT);
    $stmt->bindValue(":i_id",$_POST['id'],PDO::PARAM_INT);
    if($stmt->execute())
    {
        echo "success";
    }
    header("location:./home.php");
}