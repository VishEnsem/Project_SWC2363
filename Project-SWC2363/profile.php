<?php
include 'includes/header.php';
include 'includes/db.php';

if (!isset($_SESSION['logged_in'])) {
    header("Location: user_auth.php?login=true");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<h2>Welcome, <?php echo $user['username']; ?>!</h2>
<p>Email: <?php echo $user['email']; ?></p>

<h3>Your Orders</h3>
<?php
$order_stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
$order_stmt->bind_param("i", $user_id);
$order_stmt->execute();
$orders = $order_stmt->get_result();

if ($orders->num_rows > 0): ?>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
        <?php while ($order = $orders->fetch_assoc()): ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td>MYR<?php echo $order['total_price']; ?></td>
                <td><?php echo $order['status']; ?></td>
                <td><?php echo $order['created_at']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>You have no orders yet.</p>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
