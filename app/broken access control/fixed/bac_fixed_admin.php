<?php
session_start();

if (
    empty($_SESSION['username']) ||
    ($_SESSION['auth_token'] ?? '') !== 'login!!!!hard' ||
    ($_SESSION['role'] ?? '') !== 'admin'
) {
    http_response_code(403);
    echo "<h2>🚫 Forbidden</h2>";
    echo "<p>You are not authorized to access the admin panel.</p>";
    echo '<p><a href="/bac/fixed/login">Login</a></p>';
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
?>

<h1>Admin Panel</h1>
<p>✅ Access granted for: <strong><?= $username ?></strong></p>
<p><strong>Flag:</strong> login!!!!hard</p>
<p>This is the <strong>Fixed BAC version</strong> — only the actual admin can access this page.</p>
<a href="/bac/fixed/login">Logout</a>
