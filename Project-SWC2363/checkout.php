<?php
include 'includes/header.php';
include 'includes/db.php';

if (!isset($_SESSION['logged_in'])) {
    header("Location: user_auth.php?login=true");
    exit();
}

// Fetch total price from session/cart calculation if not provided directly
$total_price = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        // Fetch the price of each product from the database
        $stmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $stmt->bind_result($price);
        $stmt->fetch();
        $stmt->close();

        // Calculate total price based on quantity
        $total_price += $price * $quantity;
    }
}

// Handle order submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, ?)");
    $stmt->bind_param("id", $user_id, $total_price);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    // Insert each item in the order
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        // Fetch price again for each product for accuracy
        $stmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $stmt->bind_result($price);
        $stmt->fetch();
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO order_item (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
        $stmt->execute();
        $stmt->close();
    }

    // Clear cart
    unset($_SESSION['cart']);
    echo "<p>Order placed successfully! Your Order ID is #{$order_id}</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    <h2>Checkout</h2>
    <form method="POST" action="checkout.php">
        <p><strong>Total Price: MYR <?php echo number_format($total_price, 2); ?></strong></p>
        <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
        <button type="submit">Place Order</button>
    </form>
</body>
</html>

<?php include 'includes/footer.php'; ?>
