<?php
require_once "/imageShare/Database/config.php";
session_start();
$_SESSION['user'] = null;

$username = $pass1 = "";
$name_err =  $username_err = $password_err =  "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $input_name = trim($_POST["username"]);
    if (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $username_err = "Please enter a valid username.";
    } else {
        $username = $input_name;
    }

    $input_email = trim($_POST["email"]);
    $email = $input_email;


    $input_password = trim($_POST["pass1"]);
    $pass1 = $input_password;


    $input_password = trim($_POST["pass2"]);
    $pass2 = $input_password;

    if($pass1 == $pass2)
    if (empty($name_err)  && empty($password_err) ) {

        try {
            $stmt = $conn->prepare("SELECT count(*) FROM  account  WHERE `username`=? OR `email` = ?");

            if ($stmt) {
                $stmt->bindValue(1, $username, PDO::PARAM_STR);
                $stmt->bindValue(2, $email, PDO::PARAM_STR);
                $stmt->execute();
                $number_of_rows = $stmt->fetchColumn();

                if ($number_of_rows == 0) {
                    $stmt = $conn->prepare("INSERT INTO  account  (`username`, `password`, `email`)  values(?,?,?) ");

                    if ($stmt) {
                        $stmt->bindValue(1, $username, PDO::PARAM_STR);
                        $stmt->bindValue(2, $pass1, PDO::PARAM_STR);
                        $stmt->bindValue(3, $email, PDO::PARAM_STR);

                        if ($stmt->execute()) {
                            header("Location: ./Login.php");
                        } else {
                            echo "Something Went Wrong";
                        }
                    }
                } else {
                    echo "username or email already used";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . "/static/css/signup_css.php";
    ?>
</head>
<body>
    <form  method="post" class="box">
        <h1>Signup</h1>
        <input type="text" name="username" placeholder="Username" required autofocus>
        <input type="password" name="pass1" placeholder="Password" required>
        <input type="password" name="pass2" placeholder="Confirm Password" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="submit" value="Signup">
        <h4 style="color: black;">Already have an Account?<br><br> <a href="Login.php" style="color: rgb(15, 120, 134)"> LogIn </a></h4>

    </form>
</body>
</html>