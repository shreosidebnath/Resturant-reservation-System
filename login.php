<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['user_id'] = 0;
        $_SESSION['username'] = 'admin';
        $_SESSION['is_admin'] = true;
        redirect('admin/index.php');
    } else {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['name'] = $user['name'];
                redirect('zhuowei.php');
            } else {
                $error = "Invalid password!";
            }
        } else {
            $error = "User not found!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Online Restaurant Booking System</title>
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
                    <li><a href="zhuce.php">Register</a></li>
                    <li><a href="login.php" class="active">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="breadcrumb">
        <div class="container">
            <a href="index.php">Home</a> >> Login
        </div>
    </div>

    <section class="form-section">
        <div class="container">
            <div class="form-container">
                <?php if (isset($error)): ?>
                    <p style="color: red; margin-bottom: 15px;"><?php echo $error; ?></p>
                <?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label></label>
                        <button type="submit" class="btn">LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
