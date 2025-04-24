<?php

    session_start();

    $connect_db = mysqli_connect("localhost", "root", "", "new_web");

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username =  $_POST['username'];
        $password =  $_POST['password'];

        $query = "SELECT * FROM `user` WHERE `email` = '$username' AND `password` = '$password'";
        $result = mysqli_query($connect_db, $query);
        $row = mysqli_fetch_array($result);
        if ($row) {
            $_SESSION['login_check'] = true;
            if ($row['admin'] == 1) {
                $_SESSION['admin'] = true; // کاربر مدیر است
            }
            echo "Login successful!";
            ?>
            <script>
    
                setTimeout(function(){
                        location.replace("index.php");
                    }, 100); 
            </script>
            <?php
        } else {
            echo "Invalid username or password!";
            ?>
            <script>
    
                setTimeout(function(){
                        location.replace("login.html");
                    }, 2000); 
            </script>
            <?php
        }
    } elseif (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            echo "Passwords do not match!";
        } else {
            // اضافه کردن کاربر جدید به پایگاه داده
            $insert_query = "INSERT INTO `user` (`fullname`, `email`, `password`) VALUES ('$fullname', '$email', '$password')";
            if (mysqli_query($connect_db, $insert_query)) {
                echo "Registration successful!";
                ?>
                <script>
        
                    setTimeout(function(){
                            location.replace("index.php");
                        }, 100); 
                </script>
                <?php
            } else {
                echo "Error: " . mysqli_error($connect_db);
            }
        }
    }
    mysqli_close($connect_db);
?>
