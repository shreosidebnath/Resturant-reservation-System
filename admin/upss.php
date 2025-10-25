<?php
require_once '../config.php';

if (!isAdmin()) {
    redirect('../login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'])) {
    $status = $_POST['status'] === 'Open' ? 'Open' : 'Close';
    
    $check = mysqli_query($conn, "SELECT * FROM restaurant_status LIMIT 1");
    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conn, "UPDATE restaurant_status SET status = '$status' WHERE id = 1");
    } else {
        mysqli_query($conn, "INSERT INTO restaurant_status (status) VALUES ('$status')");
    }
    
    $success = "Status updated successfully!";
}

$status_result = mysqli_query($conn, "SELECT * FROM restaurant_status LIMIT 1");
$current_status = 'Open';
if (mysqli_num_rows($status_result) > 0) {
    $status_row = mysqli_fetch_assoc($status_result);
    $current_status = $status_row['status'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Update Status</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <h2>Sufee Admin</h2>
            <ul class="admin-menu">
                <li><a href="index.php">Table</a></li>
                <li><a href="userlist.php">User</a></li>
                <li><a href="goodslist.php">Food</a></li>
                <li><a href="upss.php">Status</a></li>
            </ul>
        </aside>
        
        <main class="admin-content">
            <div style="background: white; padding: 30px; border-radius: 5px; max-width: 600px;">
                <h2 style="margin-bottom: 30px;">Update Status</h2>
                
                <?php if (isset($success)): ?>
                    <p style="color: green; margin-bottom: 20px;"><?php echo $success; ?></p>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="status-toggle">
                        <label style="font-weight: bold;">Status</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="status" value="Close" <?php echo $current_status === 'Close' ? 'checked' : ''; ?>>
                                Close
                            </label>
                            <label>
                                <input type="radio" name="status" value="Open" <?php echo $current_status === 'Open' ? 'checked' : ''; ?>>
                                Open
                            </label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
