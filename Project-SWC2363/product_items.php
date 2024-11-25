<?php
include 'includes/header.php';
include 'includes/db.php';

$product_id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
?>

<h2><?php echo $product['name']; ?></h2>
<img src="image/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
<p><?php echo $product['description']; ?></p>
<p>Price: MYR<?php echo $product['price']; ?></p>

<form action="cart.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" value="1" min="1">
    <button type="submit">Add to Cart</button>
</form>

<?php include 'includes/footer.php'; ?>
