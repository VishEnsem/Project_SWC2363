<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoppee</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Shoppee</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="contact.php">Contact</a></li>

                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                    <?php if ($_SESSION['is_admin']): ?>
                        <li><a href="dashboard.php">Admin Dashboard</a></li>
                    <?php endif; ?>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="user_auth.php?logout=true">Logout</a></li>
                <?php else: ?>
                    <li><a href="user_auth.php?login=true">Login</a></li>
                    <li><a href="user_auth.php?register=true">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>
</html>
