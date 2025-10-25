<?php
require_once 'config.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT o.*, t.name as table_name FROM orders o 
        LEFT JOIN tables t ON o.table_id = t.id 
        WHERE o.user_id = $user_id 
        ORDER BY o.created_at DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List - Online Restaurant Booking System</title>
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
                    <li><a href="orderlist.php" class="active">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="breadcrumb">
        <div class="container">
            <a href="index.php">home</a> >> Orderlist
        </div>
    </div>

    <section class="order-section">
        <div class="container">
            <div class="order-detail">
                <h2>Pay</h2>
                <p>Detail</p>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php $order = mysqli_fetch_assoc($result); ?>
                    <p><strong><?php echo $order['table_name']; ?></strong></p>
                    <p>Total: $<?php echo $order['total_amount']; ?></p>
                    <p>Status: <?php echo $order['status']; ?></p>
                <?php else: ?>
                    <p style="color: #999;">Table4</p>
                <?php endif; ?>
                
                <div class="order-image">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Cdefs%3E%3ClinearGradient id='sky' x1='0%25' y1='0%25' x2='0%25' y2='100%25'%3E%3Cstop offset='0%25' style='stop-color:%234a90e2;stop-opacity:1' /%3E%3Cstop offset='100%25' style='stop-color:%2387ceeb;stop-opacity:1' /%3E%3C/linearGradient%3E%3C/defs%3E%3Crect fill='url(%23sky)' width='400' height='300'/%3E%3Cpath fill='%23708090' d='M0,200 L50,150 L100,180 L150,140 L200,160 L250,120 L300,150 L350,130 L400,170 L400,300 L0,300 Z'/%3E%3Crect fill='%23c0c0c0' x='150' y='100' width='100' height='100'/%3E%3Cpath fill='%23708090' d='M145,100 L200,50 L255,100 Z'/%3E%3Crect fill='%234682b4' x='170' y='130' width='20' height='30'/%3E%3Crect fill='%234682b4' x='210' y='130' width='20' height='30'/%3E%3Crect fill='%238b4513' x='185' y='160' width='30' height='40'/%3E%3C/svg%3E" alt="Building">
                </div>
            </div>
        </div>
    </section>
</body>
</html>
