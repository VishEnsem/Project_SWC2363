<?php
session_start(); // Start the session

// Include the database connection
include 'includes/db.php';

// Registration Logic
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Hash the password
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $passwordHash, $email);

    if ($stmt->execute()) {
        echo "Registration successful! You can <a href='user_auth.php?login=true'>login</a> now.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Login Logic
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database to check for the user
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // If user exists and password matches, set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['logged_in'] = true;
        $_SESSION['is_admin'] = $user['is_admin'];

        // Check if the user is an admin and redirect accordingly
        if ($user['is_admin'] == 1) {
            // Redirect to the admin dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            // Redirect to the user homepage
            header("Location: index.php");
            exit();
        }
    } else {
        $login_error = "Invalid username or password.";
    }

    $stmt->close();
}


// Logout Logic
if (isset($_GET['logout'])) {
    session_unset();  // Unset all session variables
    session_destroy(); // Destroy the session

    // Redirect to the login page
    header("Location: user_auth.php?login=true");
    exit();
}

// Show Login or Registration Forms
if (isset($_GET['login'])) {
    echo '<h2>Login</h2>';
    if (isset($login_error)) {
        echo "<p style='color: red;'>$login_error</p>";
    }

    echo '
    <form action="user_auth.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        <button type="submit" name="login">Login</button>
    </form>
    <p>Don\'t have an account? <a href="user_auth.php?register=true">Register here</a></p>';
} elseif (isset($_GET['register'])) {
    echo '<h2>Register</h2>';

    echo '
    <form action="user_auth.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        <button type="submit" name="register">Register</button>
    </form>
    <p>Already have an account? <a href="user_auth.php?login=true">Login here</a></p>';
} else {
    // If the user is logged in, show the welcome message
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        echo "<h2>Welcome, " . $_SESSION['username'] . "!</h2>";
        echo "<p><a href='user_auth.php?logout=true'>Logout</a></p>";
        exit();
    } else {
        // If not logged in, show the login form
        header("Location: user_auth.php?login=true");
        exit();
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Shoppee</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your CSS file -->
</head>
</html>