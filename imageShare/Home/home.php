<?php

include_once 'snippets/header.php';

?>
<!-- !PAGE CONTENT! -->

<div class="w3-main w3-content" style="max-width:1600px;margin-top:83px; margin-right:83px; margin-left:83px;">

    <!-- Photo grid -->
    <div class="w3-row w3-grayscale-min">
        <?php

        if (isset($conn)) {
            $stmt = $conn->prepare("select * from Images where user_id = ?");
        }


        if ($stmt)
        {
        $stmt->bindValue(1, $_SESSION['user']['id'], PDO::PARAM_INT);
        $stmt->execute();
        ?>
        <div class="photo">
            <div class="container-fluid">
                <div class="row justify-content-center">

            <?php
            $i = 0;
            while ($image = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if($i%4 == 0){
                echo "<br>";
            }
                ?>
                    <div class="col-sm-3 justify-content-center m-2">
                        <div class="card profile-card align-items-center">
                            <div class="card-body">
                <img class="photos m-3" src="
            <?php

                $i = $i + 1;
                echo $image['path'] . "\" ";
                echo "id=\"" . $image['id'] . "\" ";

                echo "alt=\"";
                echo $image['caption'] . "\" ";
                echo " style=\"width:300px\" onclick=\"onClick(this)\" download>";
                ?>
            </div>
            </div>
            </div>
            <?php
            }

            }
            ?>
                        </div>
            </div>

        </div>
    </div>


    <!-- Modal for full size images on click-->
    <div id="modal01" class="w3-modal w3-white" style="padding-top:0">
        <span class="w3-button w3-black w3-xlarge w3-display-topright"
              onclick="document.getElementById('modal01').style.display='none'">×</span>
        <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
            <img id="img01" class="w3-image">
            <p id="caption"></p>
            <span id="download" class="material-icons">download</span>
            <a id="link">Share</a>
            <form action="remove_user.php" method="post">
                <label for="shared_users">Shared With</label>
                <select name="shared_users" id="shared_users">
                </select>
                <input type="hidden" name="id" id="id" value="">
                <input type="submit" value="Remove selected user">
            </form>
        </div>
    </div>

</div>
<?php


?>
<script>


    // Modal Image Gallery
    function onClick(element) {
        document.getElementById("img01").src = element.src;
        document.getElementById("img01").style.maxWidth = "500px"
        var block = document.getElementById("modal01");
        block.style.display = "block";
        id = element.id;
        var captionText = document.getElementById("caption");
        captionText.innerHTML = element.alt;
        var link = document.getElementById("link");
        link.href = "share_image.php?image_id=" + id;

        $.ajax({
            type: "POST",
            url: 'get_user.php',
            dataType: 'json',
            data: { id:id },

            success: function (data) {
                console.log("success")
                console.log(data)

                var select = document.getElementById("shared_users");
                var imageId = document.getElementById("id");
                imageId.value = id;
                for (let i = 0; i < data.length; i++) {
                    var user = data[i];
                    var option = document.createElement('option')
                    option.value = user['id']
                    option.innerText = user['username']
                    select.appendChild(option)
                }
            },
            error: function (obj) {
                console.error(obj)
            }
        });
    }
</script>




<script>
    document.getElementById("download").onclick = function (e) {
        console.log("here");
        const url = document.getElementById("img01").src;
    }
    //        <?php
    //
    //        // Initialize a file URL to the variable
    //        $url = ?>//url<?php
    //
    //        // Use basename() function to return the base name of file
    //        $file_name = basename($url);
    //
    //        // Use file_get_contents() function to get the file
    //        // from url and use file_put_contents() function to
    //        // save the file by using base name
    //        if(file_put_contents( $file_name,file_get_contents($url))) {
    //            echo "File downloaded successfully";
    //        }
    //        else {
    //            echo "File downloading failed.";
    //        }
    //
    //        ?>

</script>
</div>
<?php
 require_once 'snippets/footer.php';
?>
</html>

