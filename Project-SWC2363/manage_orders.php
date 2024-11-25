<?php
include 'includes/header.php';
include 'includes/db.php';

// Ensure only admins can access this page
if (!isset($_SESSION['is_admin'])) {
    header("Location: user_auth.php?login=true");
    exit();
}

// Fetch all orders
$order_query = $conn->query("SELECT orders.id, orders.total_price, orders.status, orders.created_at, users.username 
                             FROM orders 
                             JOIN users ON orders.user_id = users.id");

?>

<div class="container">
    <h2>Manage Orders</h2>

    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php while ($order = $order_query->fetch_assoc()): ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['username']; ?></td>
                <td>MYR<?php echo number_format($order['total_price'], 2); ?></td>
                <td><?php echo $order['status']; ?></td>
                <td><?php echo $order['created_at']; ?></td>
                <td>
                    <a href="update_order_status.php?id=<?php echo $order['id']; ?>">Update Status</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
