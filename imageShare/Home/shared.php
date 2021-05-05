<?php /** @noinspection PhpUndefinedVariableInspection */

include_once 'snippets/header.php';

?>


<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content" style="max-width:1600px;margin-top:83px; margin-right:83px; margin-left:83px;">

    <!-- Photo grid -->
    <div class="w3-row w3-grayscale-min">
        <?php

        $stmt=$conn->prepare("select * from Images  JOIN shared where Images.id = shared.image_id AND shared.user_id = ? ");


        if($stmt)
        {
        $stmt->bindValue(1,$_SESSION['user']['id'],PDO::PARAM_INT);
        $stmt->execute();
        ?>
        <div class="photo">
            <?php
//            $images=$stmt->fetchAll(PDO::FETCH_ASSOC);
            while($image=$stmt->fetch(PDO::FETCH_ASSOC)){
                echo "<img class=\"photos\" src=\"";
                echo $image['path'] . "\" ";
                echo "id=\"". $image['id'] . "\" ";

                echo "alt=\"";
                echo $image['caption'] . "\" ";
                echo " style=\"width:300px\" onclick=\"onClick(this)\" >";
            }
//            echo "<pre>", print_r($images),"</pre>";
            }



            ?>
        </div>
    </div>

    <!-- Pagination -->
    <div class="w3-center w3-padding-32">
        <div class="w3-bar">
            <a href="#" class="w3-bar-item w3-button w3-hover-black">«</a>
            <a href="#" class="w3-bar-item w3-black w3-button">1</a>
            <a href="#" class="w3-bar-item w3-button w3-hover-black">2</a>
            <a href="#" class="w3-bar-item w3-button w3-hover-black">3</a>
            <a href="#" class="w3-bar-item w3-button w3-hover-black">4</a>
            <a href="#" class="w3-bar-item w3-button w3-hover-black">»</a>
        </div>
    </div>

    <!-- Modal for full size images on click-->
    <div id="modal01" class="w3-modal w3-black" style="padding-top:0" >
        <span class="w3-button w3-black w3-xlarge w3-display-topright" onclick="document.getElementById('modal01').style.display='none'">×</span>
        <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
            <img id="img01" class="w3-image">
            <p id="caption"></p>
            <span id="download" class="material-icons">download</span>
        </div>
    </div>

</div>


<?php


?>
<script>


    // Modal Image Gallery
    function onClick(element) {
        document.getElementById("img01").src = element.src;
        var block = document.getElementById("modal01");
        block.style.display = "block";
        id = element.id;
        var captionText = document.getElementById("caption");
        captionText.innerHTML = element.alt;


    }

</script>

<script>
    document.getElementById("download").onclick = function (e) {
        console.log("here");
        const url = document.getElementById("img01").src;
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
    }
</script>
</body>


<?php
require_once 'snippets/footer.php';
?>
</html>

