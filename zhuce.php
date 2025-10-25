<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Username already exists!";
    } else {
        $sql = "INSERT INTO users (username, password, name, phone) VALUES ('$username', '$password', '$name', '$phone')";
        if (mysqli_query($conn, $sql)) {
            redirect('login.php');
        } else {
            $error = "Registration failed!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Online Restaurant Booking System</title>
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
                    <li><a href="zhuce.php" class="active">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="breadcrumb">
        <div class="container">
            <a href="index.php">Home</a> >> Register
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
                        <label>Name:</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Phone:</label>
                        <input type="text" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label></label>
                        <button type="submit" class="btn">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
