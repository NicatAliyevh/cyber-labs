<?php
session_start();

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

<h1>Admin Panel</h1>
<p>CONGRATULATIONS FOR SOLVING THIS LAB!</p>
<p>Welcome, Admin!</p>
<p>This page is vulnerable to Broken Access Control — any authenticated user can access it.</p>
