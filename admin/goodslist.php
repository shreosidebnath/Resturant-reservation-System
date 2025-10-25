<?php
require_once '../config.php';

if (!isAdmin()) {
    redirect('../login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = floatval($_POST['price']);
    $image = 'default.jpg';
    
    $sql = "INSERT INTO food (name, price, image) VALUES ('$name', $price, '$image')";
    mysqli_query($conn, $sql);
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM food WHERE id = $id");
}

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$sql = "SELECT * FROM food WHERE name LIKE '%$search%' ORDER BY id";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Food List</title>
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
                <h1>Food</h1>
                <button class="btn btn-primary" onclick="document.getElementById('addForm').style.display='block'">New Food</button>
            </div>
            
            <div id="addForm" style="display: none; background: white; padding: 20px; margin-bottom: 20px; border-radius: 5px;">
                <form method="POST">
                    <div class="search-box">
                        <label>Name:</label>
                        <input type="text" name="name" required>
                        <label>Price:</label>
                        <input type="number" name="price" step="0.01" required>
                        <button type="submit" class="btn">submit</button>
                    </div>
                </form>
            </div>
            
            <div class="search-box">
                <form method="GET">
                    <label>Name:</label>
                    <input type="text" name="search" value="<?php echo $search; ?>">
                    <button type="submit" class="btn">submit</button>
                </form>
            </div>
            
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($food = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $food['id']; ?></td>
                            <td><?php echo $food['name']; ?></td>
                            <td><?php echo $food['price']; ?></td>
                            <td>
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect fill='%23f5deb3' width='100' height='100'/%3E%3Ccircle cx='50' cy='50' r='30' fill='%23ffa500'/%3E%3Ctext x='50' y='55' font-size='12' fill='%23fff' text-anchor='middle'%3E<?php echo substr($food['name'], 0, 1); ?>%3C/text%3E%3C/svg%3E" alt="<?php echo $food['name']; ?>">
                            </td>
                            <td class="action-links">
                                <a href="#">Edit</a>
                                <a href="?delete=<?php echo $food['id']; ?>" onclick="return confirm('Delete this food?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
