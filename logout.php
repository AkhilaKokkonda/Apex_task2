<?php
session_start();
session_unset();
session_destroy();

// Redirect to login using absolute path
header("Location: /APEX_TASK2/login.html");
exit;
?>
