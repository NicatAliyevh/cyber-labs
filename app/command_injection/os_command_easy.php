<?php
if (isset($_GET['source'])) {
    highlight_file(__FILE__);
    exit;
}
$output = '';
if (isset($_GET['ip'])) {
    $ip = $_GET['ip'];

    // Windows ping command syntax (-n count)
    $command = "ping -n 2 " . $ip;

    // Run command
    $output = shell_exec($command);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>OS Command Injection Lab (Windows)</title>
</head>
<body>
    <h2>OS Command Injection Lab (Windows)</h2>

    <form method="GET" action="">
        <label for="ip">Enter IP address or hostname to ping:</label><br />
        <input type="text" id="ip" name="ip" value="<?= isset($_GET['ip']) ? htmlspecialchars($_GET['ip']) : '' ?>" required />
        <button type="submit">Ping</button>
    </form>

    <?php if ($output): ?>
        <h3>Command Output:</h3>
        <pre><?= htmlspecialchars($output) ?></pre>
    <?php endif; ?>

    <a href="/home">Back to Home</a><br>
    <a href="?source=1">If you want, you can read the source code</a>
</body>
</html>
