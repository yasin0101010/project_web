<?php
session_start();

if (!isset($_SESSION['login_check']) ) {
    ?>
    <script>
    
    setTimeout(function(){
            location.replace("login.php");
        }, 100); 
    </script>
    <?php
}

$key = mysqli_connect('localhost', 'root', '', 'new_web');
$username = $_SESSION['username']; 
$comment = $_POST['comment'];

$query = "INSERT INTO `comments` (`username`, `comment`) VALUES ('$username', '$comment')";
if (mysqli_query($key, $query)) {
    ?>
    <script>
    
        setTimeout(function(){
                location.replace("index.php");
            }, 100); 
    </script>
    <?php
} else {
    echo "Error: " . mysqli_error($key);
}

mysqli_close($key);

?>
    <script>
    
        setTimeout(function(){
                location.replace("index.php");
            }, 100); 
    </script>
