<?php
include 'includes/header.php';
include 'includes/db.php';

if (!isset($_SESSION['is_admin'])) {
    header("Location: user_auth.php?login=true");
    exit();
}

$order_id = $_GET['id'];

// Update order status if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_status = $_POST['status'];
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $order_id);
    $stmt->execute();
    $stmt->close();

    echo "<p>Order status updated successfully!</p>";
}

?>

<div class="container">
    <h2>Update Order Status (Order ID: <?php echo $order_id; ?>)</h2>

    <form method="POST">
        <label for="status">Status:</label>
        <select name="status" required>
            <option value="Pending">Pending</option>
            <option value="Shipped">Shipped</option>
            <option value="Completed">Completed</option>
            <option value="Cancelled">Cancelled</option>
        </select>
        <button type="submit">Update Status</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
