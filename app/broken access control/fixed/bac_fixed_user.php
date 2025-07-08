<?php
session_start();

// ✅ Require login with the exact known auth token
if (
    empty($_SESSION['username']) ||
    ($_SESSION['auth_token'] ?? '') !== 'login!!!!hard'
) {
    header("Location: /bac/vulnerable/login");
    exit;
}

$username = $_SESSION['username'];
$role = $_SESSION['role'] ?? 'unknown';

?>

<h2>Welcome, User!</h2>
<p>Your role: User </p>
