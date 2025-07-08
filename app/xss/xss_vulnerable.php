<?php
$comment = $_GET['comment'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>XSS Demo</title>
</head>
<body>
    <h1>XSS Lab: Echo Comment VULNERABLE</h1>

    <form method="GET" action="">
        <label>Enter your comment:</label><br>
        <input type="text" name="comment" size="50">
        <button type="submit">Submit</button>
    </form>

    <h2>Output:</h2>
    <div style="border:1px solid #ccc; padding:10px; margin-top:10px;">
        <?php
        echo $comment; // 🚨 VULNERABLE to XSS
        ?>
    </div>
</body>
</html>
