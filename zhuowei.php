<?php
require_once 'config.php';

$sql = "SELECT * FROM tables ORDER BY id";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table List - Online Restaurant Booking System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="nav-container">
                <div class="logo">Online Restaurant Booking System</div>
                <ul class="nav-menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="zhuowei.php" class="active">Table List</a></li>
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

    <div class="breadcrumb">
        <div class="container">
            <a href="index.php">Home</a> >> Table List
        </div>
    </div>

    <section class="container">
        <div class="table-grid">
            <?php while ($table = mysqli_fetch_assoc($result)): ?>
                <div class="table-card">
                    <div class="table-info">
                        <h3>Table for<?php echo $table['capacity']; ?></h3>
                        <p><strong><?php echo $table['name']; ?></strong></p>
                        <p>It can accommodate <?php echo $table['capacity']; ?> people</p>
                        <form action="diancan.php" method="GET">
                            <input type="hidden" name="id" value="<?php echo $table['id']; ?>">
                            <button type="submit" class="btn">Booking This</button>
                        </form>
                    </div>
                    <div class="table-image">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 150'%3E%3Crect fill='%23fff' width='200' height='150'/%3E%3Ctext x='50%25' y='50%25' font-size='24' fill='%23c94b8b' text-anchor='middle' dominant-baseline='middle'%3ERESERVED%3C/text%3E%3Crect x='20' y='80' width='40' height='50' fill='%23dc143c' rx='5'/%3E%3Cellipse cx='40' cy='70' rx='25' ry='15' fill='%23dc143c'/%3E%3Crect x='140' y='80' width='40' height='50' fill='%2332cd32' rx='5'/%3E%3Cellipse cx='160' cy='70' rx='25' ry='15' fill='%2332cd32'/%3E%3C/svg%3E" alt="Table">
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
</body>
</html>
