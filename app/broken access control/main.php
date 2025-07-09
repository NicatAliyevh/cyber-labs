<?php
// Any PHP logic you want here
$title = "Welcome to Broken Access Control Labs";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="../../app/style/style.css">
</head>
<body>
    <div class="container">
        <h2><?= htmlspecialchars($title) ?></h2>
        <p>This environment contains vulnerable labs for learning and practicing web security:</p>
        <ul>
            <li><a href="/bac/vulnerable/login">Vulnerable</a></li>
            <li><a href="/bac/fixed/login">Fixed</a></li>
        </ul>
    </div>
</body>
</html>
