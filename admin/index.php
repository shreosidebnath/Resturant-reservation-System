<?php
require_once '../config.php';

if (!isAdmin()) {
    redirect('../login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $capacity = isset($_POST['capacity']) ? intval($_POST['capacity']) : 4;
    
    $sql = "INSERT INTO tables (name, capacity) VALUES ('$name', $capacity)";
    mysqli_query($conn, $sql);
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM tables WHERE id = $id");
}

$sql = "SELECT * FROM tables ORDER BY id";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Table List</title>
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
            <div class="admin-header">
                <h1>Table list</h1>
                <button class="btn btn-primary" onclick="document.getElementById('addForm').style.display='block'">New Table</button>
            </div>
            
            <div id="addForm" style="display: none; background: white; padding: 20px; margin-bottom: 20px; border-radius: 5px;">
                <form method="POST">
                    <div class="search-box">
                        <label>Name:</label>
                        <input type="text" name="name" required>
                        <button type="submit" class="btn">submit</button>
                    </div>
                </form>
            </div>
            
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Num</th>
                        <th>Status</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($table = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $table['id']; ?></td>
                            <td><?php echo $table['name']; ?></td>
                            <td><?php echo $table['capacity']; ?>人</td>
                            <td><?php echo $table['status']; ?></td>
                            <td class="action-links">
                                <a href="#">Edit</a>
                                <a href="?delete=<?php echo $table['id']; ?>" onclick="return confirm('Delete this table?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
