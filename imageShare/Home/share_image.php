<?php

include_once 'snippets/header.php';

?>

<div class="w3-main w3-content" style="max-width:1600px;margin-top:83px; margin-right:83px; margin-left:83px;">

<?php

if(isset($_GET['image_id']))
{
    $image_id = $_GET['image_id'];
}
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    echo "ehere";
    $share_with = $name_err = "";
    $share_with = trim($_POST["share"]);
    echo $share_with;


    if(empty($name_err))
    {
        $stmt=$conn->prepare("select * from account where username=?");
        echo $share_with;

        if($stmt)
        {

            $stmt->bindValue(1,$share_with,PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

//            echo $share_with;
//            echo "<pre>" ,print_r($user), "</pre>";
            $user_id = $user[0]['id'];
            if (sizeof($user) == 0)
            {
                echo "username doesn't exist<br>";
                echo "<a href=\"home.php\">HOME</a>";
            }
            else
            {
                $stmt=$conn->prepare("INSERT INTO `shared` (`image_id`, `user_id`)  values (?, ?) ");

                if($stmt)
                {
                    $stmt->bindValue(1,$image_id,PDO::PARAM_STR);
                    $stmt->bindValue(2,$user_id,PDO::PARAM_STR);
                    if($stmt->execute())
                    {
                        header("location:". $home);
                    }
                    else
                    {
                        echo "Something Went Wrong<br>";
                        echo "<a href=\"home.php\">HOME</a>";

                    }
                }
            }
        }
    }
}
?>



<form method="post" action="share_image.php/?image_id=<?php echo $_GET['image_id'] ?>">

    <input type="text" name="share" placeholder="Enter username to share with">
    <input type="submit">
</form>

</div>


<?php
require_once 'snippets/footer.php';
?>





