<?php
session_start();


$key = mysqli_connect('localhost', 'root', '', 'new_web');
// if (isset($_GET['delete_project'])) {
//     $project_id = intval($_GET['delete_project']);
//     $query = "DELETE FROM `projects` WHERE `id` = $project_id";
//     mysqli_query($key, $query);
//     header("Location: admin.php");
//     exit();
// }

// // حذف کامنت
// if (isset($_GET['delete_comment'])) {
//     $comment_id = intval($_GET['delete_comment']);
//     $query = "DELETE FROM `comments` WHERE `id` = $comment_id";
//     mysqli_query($key, $query);
//     header("Location: admin.php");
//     exit();
// }
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .admin-panel {
            margin-top: 30px;
        }
        .section {
            margin-bottom: 40px;
        }
        .section h3 {
            color: #ff5722;
        }
        .actions a {
            margin-right: 10px;
        }
        .actions a.btn-danger {
            color: #fff;
        }
        .add-button {
            float: right; 
            margin-bottom: 20px; 
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <h2 class="text-center mt-5">Admin Panel</h2>

        <!-- Projects Section -->
        <div class="section">
            <h3>Projects</h3>
            <a href="index.php" class="btn btn-danger add-button m-2">Back</a>
            <a href="add_project.php" class="btn btn-success add-button m-2">Add Project</a>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $projects = mysqli_query($key, "SELECT * FROM `cards`");
                    while ($project = mysqli_fetch_assoc($projects)) {
                        echo '
                        <tr>
                            <td><img src="' . $project['picture'] . '" alt="Project Image" style="width: 50px; height: 50px;"></td>
                            <td>' . $project['name'] . '</td>
                            <td>' . substr($project['text'], 0, 50) . '...</td>
                            <td class="actions">
                                <a href="edit_project.php?id=' . $project['id'] . '" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete_project.php?id=' . $project['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</a>
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Comments Section -->
        <div class="section">
            <h3>Comments</h3>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Comment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $comments = mysqli_query($key, "SELECT * FROM `comments` ORDER BY `created_at` DESC");
                    while ($comment = mysqli_fetch_assoc($comments)) {
                        echo '
                        <tr>
                            <td>' . htmlspecialchars(substr($comment['comment'], 0, 50)) . '...</td>
                            <td class="actions">
                                <a href="delete_comment.php?id=' . $comment['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</a>
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>