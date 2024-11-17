<?php
session_start();

// Set the password for access
define('PASSWORD', 'your_custom_password'); // Replace with your desired password

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['password'] === PASSWORD) {
        $_SESSION['authenticated'] = true;
        header("Location: chat.php");
        exit();
    } else {
        $error = "Invalid password. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login to ChatGPT</h1>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="POST">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
