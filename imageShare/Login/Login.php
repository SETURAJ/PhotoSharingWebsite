<?php
require_once "/imageShare/Database/config.php";
$_SESSION['user'] = null;
$username = $password = "";
$name_err = $password_err =  "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $input_name = trim($_POST["username"]);
    $username = $input_name;

    $input_password = trim($_POST["password"]);
    $password = $input_password;

    if (empty($name_err)  && empty($password_err)) {
        try {

            $stmt = $conn->prepare("select * from account where username = ? AND  password = ? ");

            if ($stmt) {
                $stmt->bindValue(1, $username, PDO::PARAM_STR);
                $stmt->bindValue(2, $password, PDO::PARAM_STR);
                $r = $stmt->rowCount();
                $stmt->execute();
                $b = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (empty($b)) {
                    echo '<script> alert("INVALID LOGIN DETAILS"); </script>';

                } else {
                    session_start();
                    $_SESSION['isSigned'] = "SignedIn";
                    $_SESSION['user'] = $b[0];
                    header("Location: ../Home/home.php");
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
}
?>



<!DOCTYPE html>


<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . "/static/css/login_css.php";

    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<body>

    <form class="box m-auto w-25 shadow" method="post">
        <h1>Login</h1>
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Login">
        <h4 style="color: black;">Don't have an Account?<br><br> <a href="signup.php" style="color: rgb(15, 120, 134)"> SignUp </a></h4>
    </form>

</body>

</html>