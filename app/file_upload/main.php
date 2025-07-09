<?php
// Any PHP logic you want here
$title = "Welcome to File Upload Vulnerabilities Labs";
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
      <li><a href="/file_upload/easy">Easy level with no defense</a></li>
      <li><a href="/file_upload/medium">Medium level with blacklist</a></li>
      <li><a href="/file_upload/impossible">Impossible</a></li>
    </ul>
  </div>
</body>
</html>
