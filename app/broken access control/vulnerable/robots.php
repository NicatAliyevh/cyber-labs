<?php
session_start();

if (
    empty($_SESSION['username']) ||
    ($_SESSION['auth_token'] ?? '') !== 'login!!!!hard'
) {
    header("Location: /bac/vulnerable/login");
    exit;
}

header('Content-Type: text/plain');
echo "User-agent: *\n";
echo "Disallow: /bac/vulnerable/admin_cannot_be_guessed\n";
