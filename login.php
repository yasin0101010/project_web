<?php
session_start();

$connect_db = mysqli_connect("localhost", "root", "", "new_web");

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `user` WHERE `email` = '$username' AND `password` = '$password'";
    $result = mysqli_query($connect_db, $query);
    $row = mysqli_fetch_array($result);
    if ($row) {
        $_SESSION['login_check'] = true;
        if ($row['admin'] == true) {
            $_SESSION['admin'] = true;
        }
        ?>
        <div id="alertBox" class="alert success">Login successful!</div>
        <script>
            document.getElementById('alertBox').style.display = 'block';
            setTimeout(() => {
                document.getElementById('alertBox').style.display = 'none';
                location.replace("index.php");
            }, 2000);
        </script>
        <?php
    } else {
        ?>
        <div id="alertBox" class="alert error">Invalid username or password!</div>
        <script>
            document.getElementById('alertBox').style.display = 'block';
            setTimeout(() => {
                document.getElementById('alertBox').style.display = 'none';
                location.replace("login.php");
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
        ?>
        <div id="alertBox" class="alert error">Passwords do not match!</div>
        <script>
            document.getElementById('alertBox').style.display = 'block';
            setTimeout(() => {
                document.getElementById('alertBox').style.display = 'none';
            }, 2000);
        </script>
        <?php
    } else {
        $insert_query = "INSERT INTO `user` (`fullname`, `email`, `password`) VALUES ('$fullname', '$email', '$password')";
        if (mysqli_query($connect_db, $insert_query)) {
            ?>
            <div id="alertBox" class="alert success">Registration successful!</div>
            <script>
                document.getElementById('alertBox').style.display = 'block';
                setTimeout(() => {
                    document.getElementById('alertBox').style.display = 'none';
                    location.replace("index.php");
                }, 2000);
            </script>
            <?php
        } else {
            ?>
            <div id="alertBox" class="alert error">Error: <?php echo mysqli_error($connect_db); ?></div>
            <script>
                document.getElementById('alertBox').style.display = 'block';
                setTimeout(() => {
                    document.getElementById('alertBox').style.display = 'none';
                }, 2000);
            </script>
            <?php
        }
    }
}
mysqli_close($connect_db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .alert {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #1e1e1e; /* مشکی مات */
            color: #e0e0e0; /* متن خاکستری روشن */
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            font-size: 0.9rem;
            display: none;
            animation: fadeIn 0.5s ease-in-out;
        }
        .alert.success {
            border-left: 4px solid rgb(60, 255, 34);
        }
        .alert.error {
            border-left: 4px solid #d32f2f; 
        }
        @keyframes fadeIn {
            from { opacity: 0; top: 0; }
            to { opacity: 1; top: 20px; }
        }
        body {
            background-color: #121212; /* مشکی عمیق */
            color: #e0e0e0; /* متن خاکستری روشن */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .auth-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .auth-box {
            background-color: #1e1e1e; /* مشکی مات */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .auth-box h2 {
            color: #ff5722; /* نارنجی مایل به قرمز */
            margin-bottom: 20px;
        }
        .auth-box .form-control {
            background-color: #121212; /* مشکی عمیق */
            border: 1px solid #393e46; /* خاکستری تیره */
            color: #e0e0e0; /* متن خاکستری روشن */
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .auth-box .form-control:focus {
            border-color: #ff5722; /* نارنجی مایل به قرمز */
            box-shadow: 0 0 5px rgba(255, 87, 34, 0.5); /* هایلایت نارنجی */
        }
        .auth-box .btn-primary {
            background-color: #ff5722; /* نارنجی مایل به قرمز */
            border-color: #ff5722;
            width: 100%;
            padding: 10px;
            font-size: 1rem;
        }
        .auth-box .btn-primary:hover {
            background-color: #e64a19; /* نارنجی تیره‌تر */
            border-color: #e64a19;
        }
        .auth-box .switch-link {
            color: #ff5722; /* نارنجی مایل به قرمز */
            text-decoration: none;
            font-size: 0.9rem;
            margin-top: 15px;
            display: inline-block;
        }
        .auth-box .switch-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container-fluid auth-container">
        <!-- Login Form -->
        <div id="loginBox" class="auth-box">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <input type="text" class="form-control" name="username" placeholder="Username or Email" required>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <a href="#" class="switch-link" onclick="switchToRegister()">Don't have an account? Register here</a>
        </div>

        <!-- Register Form -->
        <div id="registerBox" class="auth-box" style="display: none;">
            <h2>Register</h2>
            <form action="login.php" method="POST">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name" required>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            <a href="#" class="switch-link" onclick="switchToLogin()">Already have an account? Login here</a>
        </div>
    </div>

    <script>
        function switchToRegister() {
            document.getElementById('loginBox').style.display = 'none';
            document.getElementById('registerBox').style.display = 'block';
        }

        function switchToLogin() {
            document.getElementById('registerBox').style.display = 'none';
            document.getElementById('loginBox').style.display = 'block';
        }
    </script>
</body>
</html>