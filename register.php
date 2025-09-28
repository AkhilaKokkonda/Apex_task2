<?php
session_start();
include 'config.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'] ?? '';
    $username = $_POST['username'] ?? '';
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$fullName || !$username || !$email || !$password) {
        $error = "Please fill all the fields.";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (full_name, username, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullName, $username, $email, $hashed);

        if ($stmt->execute()) {
            // Redirect to login page after 2 seconds using absolute path
            echo "<p style='color:green; font-size:18px; text-align:center;'>Registration successful! Redirecting to login...</p>";
            header("Refresh:2; url=/APEX_TASK2/login.html");
            exit;
        } else {
            if (strpos($stmt->error, "Duplicate") !== false) {
                $error = "Username or Email already exists.";
            } else {
                $error = "Error: " . $stmt->error;
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="form-container">
    <h2>Register</h2>
    <?php if ($error) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form action="register.php" method="POST">
        <input type="text" name="fullName" placeholder="Full Name" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="../login.html">Login</a></p>
</div>
</body>
</html>
