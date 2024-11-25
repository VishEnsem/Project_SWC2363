<?php
// Include header
include 'includes/header.php';
include 'includes/db.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: user_auth.php?login=true");
    exit();
}

// Query the database for product and order counts
$product_result = $conn->query("SELECT COUNT(*) AS total FROM products");
$order_result = $conn->query("SELECT COUNT(*) AS total FROM orders");

$product_count = $product_result ? $product_result->fetch_assoc()['total'] : 0;
$order_count = $order_result ? $order_result->fetch_assoc()['total'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your CSS file -->
</head>

<body>
    <div class="dashboard-container">
        <h1>Admin Dashboard</h1>
        
        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <h1>Welcome to the Admin Dashboard</h1>
            <p>From here, you can manage products, orders, and other aspects of the e-commerce platform.</p>
            <div class="dashboard">
                <p>Total Products: <?php echo $product_count; ?></p>
                <p>Total Orders: <?php echo $order_count; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div>
        <button><a href="add_product.php" class="button">Add New Product</a></button>
        <button><a href="manage_orders.php" class="button">Manage Orders</a></button>
    </div>
</body>
</html>
    

<?php
// Include footer
include 'includes/footer.php';
?>
