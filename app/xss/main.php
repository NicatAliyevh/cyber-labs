<?php
// Any PHP logic you want here
$title = "Welcome to Cross Site Scripting Labs";
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
            <li><a href="/xss/vulnerable">Vulnerable</a></li>
            <li><a href="/xss/fixed">Fixed</a></li>
        </ul>
    </div>
</body>
</html>
