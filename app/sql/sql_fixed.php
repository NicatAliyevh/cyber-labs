<?php
// DB config
$host = 'localhost';
$dbname = 'sql_lab';
$user = 'root'; 
$pass = 'admin123';     

// Show all errors (development only)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if (isset($_GET['username']) && isset($_GET['password'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];

    // ✅ SECURE SQL using placeholders
    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($sql);
    
    // Bind parameters to prevent SQL injection
    $stmt->execute([
        ':username' => $username,
        ':password' => $password
    ]);

    if ($row = $stmt->fetch()) {
        echo "<h3>Welcome, " . htmlspecialchars($row['username']) . "!</h3>";
    } else {
        echo "<p>Invalid username or password.</p>";
    }
}
?>

<form method="GET" style="max-width: 300px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9;">
    <h2 style="text-align: center; font-family: Arial, sans-serif;">Login</h2>
    
    <input 
        type="text" 
        name="username" 
        placeholder="Username" 
        style="width: 100%; padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc;"
    >
    
    <input 
        type="text" 
        name="password" 
        placeholder="Password" 
        style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ccc;"
    >
    
    <button 
        type="submit" 
        style="width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;"
    >
        Login
    </button>
</form>
