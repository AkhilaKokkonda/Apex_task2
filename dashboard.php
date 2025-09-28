<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page if not logged in
    header("Location: /APEX_TASK2/login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="dashboard-container">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
    <p>You are now logged in to your dashboard.</p>

    <!-- Example dashboard buttons -->
    <a href="php/logout.php">Logout</a>
    <!-- You can add more buttons like Profile, Settings, etc. -->
    <!-- <a href="profile.php">Profile</a> -->
    <!-- <a href="settings.php">Settings</a> -->
</div>

</body>
</html>
