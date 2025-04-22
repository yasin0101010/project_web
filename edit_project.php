<?php
session_start();


$key = mysqli_connect('localhost', 'root', '', 'new_web');

$project_id = $_GET['id'];

$project_query = "SELECT * FROM `cards` WHERE `id` = $project_id";
$project_result = mysqli_query($key, $project_query);
$project = mysqli_fetch_assoc($project_result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['name'];
    $description = $_POST['text'];
    
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['tmp_name'];
        $target_dir = "uploads/"; // دایرکتوری آپلود
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($image, $target_file); 
        $file_name = basename($_FILES['image']['name']); // نام فایل
        $file_tmp = $_FILES['image']['tmp_name']; // مسیر موقت فایل
        $file_path = $target_dir . $file_name;
        $image = $file_path;

        } 
    else {
        // اگر فایل جدیدی آپلود نشود، لوکیشن قبلی حفظ شود
        $image = $project['picture'];
    }

    $update_query = "UPDATE `cards` SET `name` = '$title', `text` = '$description', `picture` = '$image' WHERE `id` = $project_id";
    if (mysqli_query($key, $update_query)) {
        echo "<p class='alert alert-success'>Project updated successfully!</p>";?>
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
    <title>Edit Project</title>
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
        .btn-primary {
            background-color: #ff5722; /* نارنجی مایل به قرمز */
            border-color: #ff5722;
            width: 100%;
            padding: 10px;
            font-size: 1rem;
        }
        .btn-primary:hover {
            background-color: #e64a19; /* نارنجی تیره‌تر */
            border-color: #e64a19;
        }
        small.text-muted {
            color: #6c757d; /* خاکستری مایل به سفید */
        }
    </style>
<body>
    <div class="container mt-5">
        <h2>Edit Project</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $project['name'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="text" name="text" rows="3" required><?php echo $project['text'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image URL:</label>
                <input type="file" class="form-control" id="image" name="image" value="<?php echo $project['picture'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>
</html>