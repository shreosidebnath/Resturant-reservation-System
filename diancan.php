<?php
require_once 'config.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$table_id = isset($_GET['id']) ? intval($_GET['id']) : 25;

$sql = "SELECT * FROM food ORDER BY id";
$result = mysqli_query($conn, $sql);

$table_sql = "SELECT * FROM tables WHERE id = $table_id";
$table_result = mysqli_query($conn, $table_sql);
$table = mysqli_fetch_assoc($table_result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food List - Online Restaurant Booking System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="nav-container">
                <div class="logo">Online Restaurant Booking System</div>
                <ul class="nav-menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="zhuowei.php">Table List</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div style="background: url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 1200 300%27%3E%3Cpath fill=%27%23d2b48c%27 d=%27M0,150 Q300,100 600,150 T1200,150 L1200,300 L0,300 Z%27/%3E%3C/svg%3E'); height: 200px; background-size: cover;"></div>

    <div class="breadcrumb">
        <div class="container">
            <a href="index.php">Home</a> >> order
        </div>
    </div>

    <section class="container" style="padding: 20px 0;">
        <p style="color: #999; margin-bottom: 30px;">No order yet</p>
        
        <div class="food-list">
            <h2>Food List</h2>
            <div class="food-grid">
                <?php while ($food = mysqli_fetch_assoc($result)): ?>
                    <div class="food-card">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 300 200'%3E%3Crect fill='%23f5f5dc' width='300' height='200'/%3E%3Cellipse cx='150' cy='100' rx='100' ry='60' fill='%23ffa500'/%3E%3Ccircle cx='120' cy='80' r='15' fill='%23ff6347'/%3E%3Ccircle cx='180' cy='90' r='12' fill='%2332cd32'/%3E%3Ctext x='50%25' y='180' font-size='24' fill='%23333' text-anchor='middle'%3E<?php echo $food['name']; ?> - $<?php echo $food['price']; ?><?php echo $food['name']; ?>%3C/text%3E%3C/svg%3E" alt="<?php echo $food['name']; ?>">
                        <h3><?php echo $food['name']; ?></h3>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
</body>
</html>
