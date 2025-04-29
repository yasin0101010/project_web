<?php
session_start();
$key = mysqli_connect   ('localhost','root','','new_web');
$show = mysqli_query($key,"SELECT * FROM `cards` WHERE 1");
mysqli_close($key);
$row = mysqli_fetch_array($show);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #121212; /* مشکی عمیق */
            color: #e0e0e0; /* متن خاکستری روشن */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .header {
            background-color: #1e1e1e; /* مشکی مات */
            padding: 20px 0;
            text-align: left;
        }
        .header h1 {
            font-size: 2rem;
            font-weight: bold;
            margin: 0;
            color: #ff5722; /* نارنجی مایل به قرمز */
        }
        .divider {
            border-bottom: 1px solid #393e46; /* خاکستری تیره */
            margin: 0;
        }
        .nav-line {
            background-color: #1e1e1e; /* مشکی مات */
            padding: 10px 0;
        }
        .nav-line a {
            color: #e0e0e0; /* متن خاکستری روشن */
            margin: 0 15px;
            text-decoration: none;
            font-size: 1rem;
        }
        .nav-line a:hover {
            color: #ff5722; /* نارنجی مایل به قرمز */
        }
        .nav-line .nav-items {
            text-align: left;
        }
        .content-section {
            margin-top: 30px;
            margin-bottom: 150px;
            min-height: 200px;
        }
        .content-section img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .content-text {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            text-align: center;
            padding: 20px;
            font-size: 1.2rem;
            color: #e0e0e0; /* متن خاکستری روشن */
        }
        .login-logo::before {
            content: url('https://via.placeholder.com/20x20?text=👤');
            margin-right: 5px;
            vertical-align: middle;
        }
        .extra-section {
            background-color: #1e1e1e; /* مشکی مات */
            padding: 40px 0;
            border-radius: 10px;
            margin-bottom: 30px;
            min-height: 200px;
        }
        .pie-chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }
        #pieChart {
            max-width: 300px;
            max-height: 300px;
        }
        .card-section {
            margin: 30px 0;
            background-color: #1e1e1e; /* مشکی مات */
            padding: 20px;
            border-radius: 10px;
            overflow: hidden;
        }
        .swiper {
            width: 100%;
            direction: rtl;
        }
        .swiper-wrapper {
            display: flex;
            transition: none !important; /* Instant "dry" transition */
            height: auto;
        }
        .swiper-slide {
            width: 18rem !important; /* Match card width */
            margin-left: 10px;
            flex-shrink: 0;
        }
        .card {
            background-color: #1e1e1e; /* مشکی مات */
            border: 1px solid #393e46; /* خاکستری تیره */
            border-radius: 8px;
            overflow: hidden;
            width: 18rem;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .card-body {
            padding: 15px;
            text-align: center;
        }
        .card-title {
            color: #ff5722; /* نارنجی مایل به قرمز */
            font-size: 1.25rem;
            margin-bottom: 10px;
        }
        .card-text {
            color: #e0e0e0; /* متن خاکستری روشن */
            font-size: 1rem;
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: #ff5722; /* نارنجی مایل به قرمز */
            border-color: #ff5722;
        }
        .btn-primary:hover {
            background-color: #e64a19; /* نارنجی تیره‌تر */
            border-color: #e64a19;
        }
        .arrows {
            position: absolute;
            top: 50%;
            width: 100%;
            transform: translateY(-50%);
            display: flex;
            justify-content: space-between;
            pointer-events: none;
        }
        .go-prev, .go-next {
            width: 40px;
            height: 40px;
            background-color: #1e1e1e; /* مشکی مات */
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.7;
            pointer-events: auto;
        }
        .go-prev:hover, .go-next:hover {
            opacity: 1;
        }
        .go-prev svg, .go-next svg {
            width: 20px;
            height: 20px;
            fill: #e0e0e0; /* آیکون‌های خاکستری روشن */
        }
        .go-next.is-active {
            opacity: 1;
        }
        .footer-section {
            background-color: #1e1e1e; /* مشکی مات */
            padding: 20px 0;
            color: #e0e0e0; /* متن خاکستری روشن */
            text-align: center;
        }
        .footer-section .copyright {
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        .footer-section .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .footer-section .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: #121212; /* مشکی عمیق */
            border-radius: 50%;
            transition: background-color 0.3s;
        }
        .footer-section .social-links a:hover {
            background-color: #ff5722; /* نارنجی مایل به قرمز */
        }
        .footer-section .social-links svg {
            width: 24px;
            height: 24px;
            fill: #e0e0e0; /* آیکون‌های خاکستری روشن */
        }
        .footer-section .social-links a:hover svg {
            fill: #fff; /* سفید */
        }
        .footer-section .social-links a[title]::after {
            content: attr(title);
            position: absolute;
            bottom: 100%;
            margin-bottom: 8px;
            background-color: #121212; /* مشکی عمیق */
            color: #e0e0e0; /* متن خاکستری روشن */
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }
        .footer-section .social-links a:hover[title]::after {
            opacity: 1;
            visibility: visible;
        }
        .card {
            background-color: #1e1e1e; /* مشکی مات */
            border: 1px solid #393e46; /* خاکستری تیره */
            border-radius: 8px;
            overflow: hidden;
            width: 18rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* افزودن انیمیشن */
        }

        .card:hover {
            transform: scale(1.05); /* بزرگ‌تر شدن کارت */
            box-shadow: 0 10px 20px rgba(255, 87, 34, 0.5); /* افزودن سایه */
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
            text-align: center;
        }

        .card-title {
            color: #ff5722; /* نارنجی مایل به قرمز */
            font-size: 1.25rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Header -->
        <div class="container-fluid d-flex align-items-center justify-content-center" >
            <div class="row p-3">
                <div class="col-12 text-center">
                    <h1 class="fs-1 fs-md-3">Mohammad Yasin Ebrahimi</h1>
                    <button class="btn btn-primary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        ☰ Menu
                    </button>
                </div>
            </div>
        </div>
        <!-- Divider -->
        <div class="row divider"></div>
        <!-- Navigation -->
        <!-- Button for Offcanvas (Visible only on small screens) -->
        

        <!-- Main Navigation (Visible only on md and larger screens) -->
        <div class="row nav-line d-none d-md-flex">
            <div class="col-12 nav-items">
                <?php
                if (isset($_SESSION['login_check'])){?>
                    <a class="text-danger" href="logout.php">Logout</a>
                <?php
                }
                else{?>
                    <a href="login.html">Login/Register</a>
                <?php
                }
                ?>
                <a href="#home">Home</a>
                <a href="#footer">About</a>
                <a href="#cards">Achievements</a>
                <?php
                if (isset($_SESSION['admin'])){?>
                    <a href="admin.php" > 
                        admin
                    </a>
                <?php
                }
                ?>
            </div>
        </div>

        <!-- Offcanvas Menu (For small screens) -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled">
            <?php
            if (isset($_SESSION['login_check'])){?>
                <li><a class="text-danger" href="logout.php">Logout</a></li>
            <?php
            }
            else{?>
                <li><a href="login.html" class="nav-link">Login/Register</a></li>
            <?php
            }
            ?>
            <li><a href="#home" class="nav-link">Home</a></li>
            <li><a href="#footer" class="nav-link">About</a></li>
            <li><a href="#cards" class="nav-link">Achievements</a></li>
            <li>
            <?php
            if (isset($_SESSION['admin'])){?>
                <a href="admin.php" class="nav-link"> 
                    admin
                </a>
                <?php
            }
            ?>
            </li>
            </ul>
        </div>
        </div>
        <!-- Main Content -->
        <div class="row p-4 home-section" style="height: auto;" id="home">
            <div class="col-lg-6 content-text">
                <p class="fs-1 fw-bold">

                    I’m a passionate and creative Python developer with a deep love for data and algorithms. Years of experience in software development have sharpened my Python skills to a fine edge. But what truly sets me apart is my strong background in artificial intelligence.
                </p>
            </div>
            <div class="col-lg-6 rounded-4 content-text" style="align-items: center;">
                <img class="rounded-4" src="uploads/pic1.png" alt="Sample Image" style="width: 450px; height: 450px;" >
            </div>
        </div>
        <!-- Pie Chart Section -->
        <div class="row extra-section" id="extra" style="height: auto;">
            <div class="col-12 pie-chart-container">
                <canvas id="pieChart" width="300" height="300"></canvas>
            </div>
        </div>
        <!-- Card Carousel Section -->
        <div class="row card-section " style="direction: rtl;" id="cards">
        <?php
        while($row){ 
            ?>
            <div class="card col-3 m-3" style="width: 18rem;">
                <img src="<?php print($row['picture'])?>" class="card-img-top rounded-4 pt-2" alt="Project 1">
                <div class="card-body">
                    <h5 class="card-title"><?php print($row['name'])?></h5>
                    <p class="card-text"><?php print($row['text'])?></p>
                </div>
            </div>
            <?php
            $row = mysqli_fetch_array($show);
        }
        ?>

        <div class="row comment-section mt-5" id="comments">
            <div class="col-12">
                <h3 class="text-center">Leave a Comment</h3>
                    <form action="comment.php" method="POST" class="mb-4">
                        <div class="mb-3">
                            <label for="comment" class="form-label">Your Comment:</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <div class="row">
                        <?php
                        $key = mysqli_connect('localhost', 'root', '', 'new_web');
                        $show_comments = mysqli_query($key, "SELECT * FROM `comments` ORDER BY `created_at` DESC");
                        if (mysqli_num_rows($show_comments) > 0) {
                            while ($comment = mysqli_fetch_assoc($show_comments)) {?>
                                <div class="card mb-3 col-md-3 m-3">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php print($comment['username'])?> </h5>
                                        <p class="card-text"><?php print($comment['comment'])?></p>
                                        <small class="card-text" style="color: ;"><?php print($comment['created_at'])?></small>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        mysqli_close($key);
                        ?>
                    </div>
                    
            </div>
        </div>
        <!-- Footer Section -->
        <div class="row footer-section" id="footer">
            <div class="col-12">
                <div class="copyright">
                    &copy; 2025 Mohammad Yasin Ebrahimi. All rights reserved.
                </div>
                <div class="social-links">
                    <a href="https://instagram.com/yourprofile" title="Instagram" target="_blank">
                        <svg viewBox="0 0 24 24" focusable="false">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.948-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path>
                        </svg>
                    </a>
                    <a href="https://youtube.com/yourchannel" title="YouTube" target="_blank">
                        <svg viewBox="0 0 24 24" focusable="false">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"></path>
                        </svg>
                    </a>
                    <a href="https://t.me/yourprofile" title="Telegram" target="_blank">
                        <svg viewBox="0 0 24 24" focusable="false">
                            <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0h-.056zm4.747 7.376c.155.513-.33.773-.33.773l-7.879 5.58-3.316 1.027s-.483.167-.688-.038c-.206-.206 0-.617 0-.617l2.356-2.261-1.433-1.433L9.56 6.222l6.476-1.468s.447-.193.655.622z"></path>
                        </svg>
                    </a>
                    <a href="https://github.com/yourprofile" title="GitHub" target="_blank">
                        <svg viewBox="0 0 24 24" focusable="false">
                            <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.387.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        // Pie Chart Configuration
        const ctx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Python', 'HTML/CSS', 'C#'],
                datasets: [{
                    data: [79.49, 15.50, 5.01],
                    backgroundColor: ['#ff5722', '#393e46', '#e0e0e0'], 
                    borderColor: '#121212',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#e0e0e0' 
                        }
                    }
                }
            }
        });
        // Swiper Initialization
        const swiper = new Swiper('.swiper', {
            direction: 'horizontal',
            loop: false,
            slidesPerView: 4,
            spaceBetween: 10,
            slidesPerGroup: 4,
            speed: 0,
            navigation: {
                nextEl: '.go-next',
                prevEl: '.go-prev',
            },
            autoHeight: true,
            rtl: true
        });
    </script>
</body>
</html>