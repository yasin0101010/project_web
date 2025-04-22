<?php
session_start();
unset($_SESSION['login_check']);
unset($_SESSION['admin']);
?>
<script>
    
    setTimeout(function(){
            location.replace("index.php");
        }, 100); 
</script>