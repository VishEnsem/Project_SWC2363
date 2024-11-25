<?php
include 'includes/header.php'; 
include 'includes/db.php';  

$query = "SELECT * FROM products";
$result = $conn->query($query);
?>

<h2>All Products</h2>
<div class="product-list">
    <?php while($row = $result->fetch_assoc()): ?>
        <div class="product">
            <img src="image/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
            <h4><?php echo $row['name']; ?></h4>
            <p>MYR<?php echo $row['price']; ?></p>
            <a href="product_items.php?id=<?php echo $row['id']; ?>">View Product</a>
        </div>
    <?php endwhile; ?>
</div>

<?php include 'includes/footer.php'; ?>
