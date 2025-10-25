<?php
require_once '../config.php';

if (!isAdmin()) {
    redirect('../login.php');
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");
}

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$sql = "SELECT * FROM users WHERE name LIKE '%$search%' OR username LIKE '%$search%' ORDER BY id";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User List</title>
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
                <h1>User</h1>
            </div>
            
            <div class="search-box">
                <form method="GET">
                    <label>Name:</label>
                    <input type="text" name="search" value="<?php echo $search; ?>">
                    <button type="submit" class="btn">提交</button>
                </form>
            </div>
            
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Username</th>
                        <th>Phone</th>
                        <th>Name</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['phone']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td class="action-links">
                                <a href="#">Edit</a>
                                <a href="?delete=<?php echo $user['id']; ?>" onclick="return confirm('Delete this user?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
