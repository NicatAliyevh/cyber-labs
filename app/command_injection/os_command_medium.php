<?php
if (isset($_GET['source'])) {
    highlight_file(__FILE__);
    exit;
}
$output = '';
if (isset($_GET['ip'])) {
    $encoded_ip = $_GET['ip'];
    // Blacklist some dangerous chars (easy to bypass!)
    $blacklist = [';', '&', '|', '>', '<'];
    foreach ($blacklist as $bad) {
        if (strpos($encoded_ip, $bad) !== false) {
            die('Input contains forbidden characters!');
        }
    }
    $ip = urldecode($encoded_ip); //no one actually does this kind of things hdasddsfkaslew, i just wanted to add url-encode bypass
    $command = "ping -n 2 " . $ip;
    $output = shell_exec($command);
}
?>
<!DOCTYPE html><body>
<h2>OS Command Injection — Blacklist Defense</h2>
<form method="GET">
  <input name="ip" value="<?= htmlspecialchars($_GET['ip'] ?? '') ?>" required>
  <button>Ping</button>
</form>
<pre><?= htmlspecialchars($output) ?></pre>
<a href="/home">Back to Home</a><br>
<a href="?source=1">If you want, you can read the source code</a>
</body></html>

