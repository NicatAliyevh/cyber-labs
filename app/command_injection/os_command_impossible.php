<?php
if (isset($_GET['source'])) {
    highlight_file(__FILE__);
    exit;
}
$output = '';
if (isset($_GET['ip'])) {
    // Get user input and sanitize it to allow only valid IP addresses or hostnames
    $ip = $_GET['ip'];

    // Basic validation: allow only letters, numbers, dots, hyphens and colons (for IPv6)
    if (preg_match('/^[a-zA-Z0-9\.\-\:]+$/', $ip)) {
        // Escape shell argument to be safe
        $safe_ip = escapeshellarg($ip);

        // Windows ping command
        $command = "ping -n 2 " . $safe_ip;

        $output = shell_exec($command);
    } else {
        $output = "Invalid IP address or hostname.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>OS Command Injection Lab - Fixed</title>
</head>
<body>
    <h2>OS Command Injection Lab - Fixed Version</h2>

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
