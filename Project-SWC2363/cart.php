<?php
include 'includes/header.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $_SESSION['cart'][$product_id] = $quantity;
}

include 'includes/db.php';
$total_price = 0;
?>

<h2>Your Cart</h2>
<?php if (empty($_SESSION['cart'])): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        <?php foreach ($_SESSION['cart'] as $product_id => $quantity): ?>
            <?php
            $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
            $item_total = $product['price'] * $quantity;
            $total_price += $item_total;
            ?>
            <tr>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $quantity; ?></td>
                <td>$<?php echo $product['price']; ?></td>
                <td>$<?php echo number_format($item_total, 2); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p><strong>Total Price: MYR<?php echo number_format($total_price, 2); ?></strong></p>
    <button><a href="checkout.php" class="button">Proceed to Checkout</a></button>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
