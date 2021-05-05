

<?php

echo get_users($_POST['id']);

function get_users($id)
{
    include_once "/imageShare/Database/config.php";

    $sql = "SELECT * FROM account JOIN shared where account.id = shared.user_id and  shared.image_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bindValue(1, $id, PDO::PARAM_INT);

        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($users);
//        echo "<pre>", print_r($users), "</pre>";
//                echo "<option value=\"";
//                echo $user_id;
//                echo "\">";
//                echo $username;
//                echo "</option>";


    }

}