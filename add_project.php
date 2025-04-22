<?php
session_start();


$key = mysqli_connect('localhost', 'root', '', 'new_web');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_FILES['image']['tmp_name'];
    $target_dir = "uploads/"; // دایرکتوری آپلود
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($image, $target_file); // آپلود فایل

    $query = "INSERT INTO `cards` (`name`, `text`, `picture`) VALUES ('$title', '$description', '$target_file')";
    if (mysqli_query($key, $query)) {
        echo "<p class='alert alert-success'>Project added successfully!</p>";?>
        <script>
            setTimeout(function(){
                location.replace("admin.php");
            }, 100);
        </script>
        <?php
    } else {
        echo "<p class='alert alert-danger'>Error: " . mysqli_error($key) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    <style>
        body {
            background-color: #121212; /* مشکی عمیق */
            color: #e0e0e0; /* متن خاکستری روشن */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            background-color: #1e1e1e; /* مشکی مات */
            padding: 40px;
            border-radius: 10px;
            margin-top: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        h2 {
            color: #ff5722; /* نارنجی مایل به قرمز */
            margin-bottom: 20px;
        }
        label {
            color: #ff5722; /* نارنجی مایل به قرمز */
            font-weight: bold;
        }
        .form-control {
            background-color: #121212; /* مشکی عمیق */
            border: 1px solid #393e46; /* خاکستری تیره */
            color: #e0e0e0; /* متن خاکستری روشن */
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .form-control:focus {
            border-color: #ff5722; /* نارنجی مایل به قرمز */
            box-shadow: 0 0 5px rgba(255, 87, 34, 0.5); /* هایلایت نارنجی */
        }
        .btn-success {
            background-color: #ff5722; /* نارنجی مایل به قرمز */
            border-color: #ff5722;
            width: 100%;
            padding: 10px;
            font-size: 1rem;
        }
        .btn-success:hover {
            background-color: #e64a19; /* نارنجی تیره‌تر */
            border-color: #e64a19;
        }
        small.text-muted {
            color: #6c757d; /* خاکستری مایل به سفید */
        }
    </style>
<body>
    <div class="container mt-5">
        <h2>Add Project</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image URL:</label>
                <input type="file" class="form-control" id="image" name="image" required >
            </div>
            <button type="submit" class="btn btn-success">Add Project</button>
        </form>
    </div>
</body>
</html>