<?php

include_once 'snippets/header.php';
?>

<div class=" container-fluid justify-content-center align-items-center p-5 mt-5">
    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if(!is_dir("uploads/"))
        {
            mkdir("uploads/");
        }
        $target_dir = "uploads/" . $_SESSION['user']['id'] . "/";

        if(!is_dir($target_dir))
        {
            mkdir($target_dir);
        }

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {

            $temp = explode(".", $_FILES["fileToUpload"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$newfilename)) {

                $sql = "INSERT INTO `images` (`name`, `user_id`, `path`, `caption`) VALUES (?, ?, ?, ?)";

                if (isset($conn)) {
                    $stmt = $conn->prepare($sql);
                }

                if($stmt){
                    $stmt->bindValue(1,basename($_FILES["fileToUpload"]["name"]),PDO::PARAM_STR);
                    $stmt->bindValue(2,$_SESSION['user']['id'],PDO::PARAM_INT);
                    $stmt->bindValue(3,$target_dir.$newfilename,PDO::PARAM_STR);
                    $stmt->bindValue(4,$target_file,PDO::PARAM_STR);

                    if($stmt->execute())
                    {
                        if (isset($home)) {
                            header("Location:". $home);
                        }
                    }
                }
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    ?>

        <div class="row justify-content-center">
            <div class="col-sm-3">
                <div class="card profile-card shadow rounded-3">
                    <div class="card-body ">
                        <form class="form-signin" action="upload.php" method="post" enctype="multipart/form-data">
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <img class="m-5"src="#" id="blah" alt="File is not Uploaded">
                                <input class="btn btn-secondary mb-4" type="file" name="fileToUpload" id="fileToUpload" onchange="readURL(this);">
                                <input class="btn btn-secondary p-2" type="submit" value="Upload Image" name="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

</div>


<script>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);

                document.getElementById("blah").style.maxWidth = "200px";
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


<?php
require_once 'snippets/footer.php';
?>

