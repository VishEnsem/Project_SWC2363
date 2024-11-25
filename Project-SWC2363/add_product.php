<?php
include 'includes/header.php';
include 'includes/db.php';

// Ensure only admins can access this page
if (!isset($_SESSION['is_admin'])) {
    header("Location: user_auth.php?login=true");
    exit();
}

// Handle the form submission for adding a new product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];

    // Move the uploaded image to the "images" folder
    if (move_uploaded_file($_FILES['image']['tmp_name'], "image/$image")) {
        // Insert product into the database
        $stmt = $conn->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $name, $description, $price, $image);

        if ($stmt->execute()) {
            echo "<p>Product added successfully!</p>";
        } else {
            echo "<p>Error adding product: " . $stmt->error . "</p>";
        }
        
        $stmt->close();
    } else {
        echo "<p>Error uploading image.</p>";
    }
}
?>

<div class="container">
    <h2>Add New Product</h2>
    <form action="add_product.php" method="POST" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required><br><br>

        <label for="image">Product Image:</label>
        <input type="file" name="image" accept="image/*" required><br><br>

        <button type="submit">Add Product</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
