<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Restaurant Booking System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="nav-container">
                <div class="logo">Online Restaurant Booking System</div>
                <ul class="nav-menu">
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="zhuowei.php">Table List</a></li>
                    <?php if (isLoggedIn()): ?>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="zhuce.php">Register</a></li>
                        <li><a href="login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 600 400'%3E%3Crect fill='%23c94b8b' width='600' height='400'/%3E%3Cg transform='translate(150,100)'%3E%3Crect fill='%23fff' x='50' y='150' width='200' height='120' rx='10'/%3E%3Crect fill='%23e0e0e0' x='60' y='160' width='100' height='80'/%3E%3Ccircle fill='%23ff9999' cx='120' cy='80' r='40'/%3E%3Cpath fill='%234a90e2' d='M100,100 Q120,90 140,100 L140,120 Q120,110 100,120 Z'/%3E%3Crect fill='%23ffcc99' x='90' y='120' width='60' height='50'/%3E%3Crect fill='%23fff9e6' x='200' y='100' width='120' height='80' rx='5'/%3E%3Crect fill='%23ffa500' x='210' y='110' width='100' height='15' rx='3'/%3E%3Ccircle fill='%23ff6b6b' cx='265' cy='150' r='20'/%3E%3C/g%3E%3C/svg%3E" alt="Restaurant Booking">
            </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', function(e) {
                document.querySelectorAll('.nav-menu a').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>
