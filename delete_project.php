<?php
$key = mysqli_connect   ('localhost','root','','new_web');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $show = mysqli_query($key,"DELETE FROM `cards` where  `id` = '$id'");
    mysqli_close($key);
    ?>
    <script>
            setTimeout(function(){
                location.replace("admin.php");
            }, 100);
    </script>
    <?php
}

?>